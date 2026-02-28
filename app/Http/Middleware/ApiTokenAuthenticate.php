<?php

namespace App\Http\Middleware;

use App\Models\PersonalAccessTokens;
use Closure;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Response as HttpResponse;

class ApiTokenAuthenticate
{
    /**
     * The rate limiter instance.
     */
    protected RateLimiter $limiter;

    /**
     * Create a new middleware instance.
     */
    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        
        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
                'errors' => ['token' => ['Invalid token']],
            ], 401);
        }

        $hashed = hash('sha256', $token);
        $accessToken = PersonalAccessTokens::with('tokenable')
            ->where('token', $hashed)
            ->where('expires_at', '>', now())
            ->first();

        if (!$accessToken) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
                'errors' => ['token' => ['Invalid token']],
            ], 401);
        }

        // Set the user on the request
        $user = $accessToken->tokenable;
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
                'errors' => ['token' => ['Invalid token']],
            ], 401);
        }
        
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        // Check rate limit (user-based for authenticated routes)
        if (!$this->checkRateLimit($request, $user)) {
            return $this->rateLimitExceededResponse($request, $user);
        }

        $response = $next($request);
        $illuminateResponse = new HttpResponse(
            $response->getContent(),
            $response->getStatusCode(),
            $response->headers->all()
        );

        return $illuminateResponse->withHeaders($this->getRateLimitHeaders($request, $user));
    }

    /**
     * Resolve the rate limit and decay for the given request path.
     *
     * @return array{limit: int, decay: int}
     */
    protected function resolveRateLimit(string $path): array
    {
        if (str_contains($path, 'auth/register') || str_contains($path, 'auth/login')) {
            return [
                'limit' => (int) env('RATE_LIMIT_AUTH', 5),
                'decay' => (int) env('RATE_LIMIT_AUTH_DECAY', 60),
            ];
        }

        if (str_contains($path, 'gamification/checkin') || str_contains($path, 'gamification/review')) {
            return [
                'limit' => (int) env('RATE_LIMIT_GAMIFICATION', 10),
                'decay' => (int) env('RATE_LIMIT_GAMIFICATION_DECAY', 3600),
            ];
        }

        if (str_contains($path, 'social/posts') || str_contains($path, 'social/comment') || str_contains($path, 'social/like')) {
            return [
                'limit' => (int) env('RATE_LIMIT_SOCIAL', 20),
                'decay' => (int) env('RATE_LIMIT_SOCIAL_DECAY', 60),
            ];
        }

        return [
            'limit' => (int) env('RATE_LIMIT_PRIVATE_DEFAULT', 60),
            'decay' => (int) env('RATE_LIMIT_PRIVATE_DEFAULT_DECAY', 60),
        ];
    }

    /**
     * Check if request exceeds rate limit based on endpoint.
     */
    protected function checkRateLimit(Request $request, $user): bool
    {
        $key = 'private:rate-limit:' . $user->id;
        ['limit' => $limit, 'decay' => $decay] = $this->resolveRateLimit($request->path());

        if ($this->limiter->tooManyAttempts($key, $limit)) {
            return false;
        }

        $this->limiter->hit($key, $decay);
        return true;
    }

    /**
     * Get rate limit headers.
     */
    protected function getRateLimitHeaders(Request $request, $user): array
    {
        $key = 'private:rate-limit:' . $user->id;
        ['limit' => $limit] = $this->resolveRateLimit($request->path());

        return [
            'X-RateLimit-Limit' => $limit,
            'X-RateLimit-Remaining' => $this->limiter->remaining($key, $limit),
            'X-RateLimit-Reset' => now()->timestamp + $this->limiter->availableIn($key),
        ];
    }

    /**
     * Create a too many requests response.
     */
    protected function rateLimitExceededResponse(Request $request, $user): Response
    {
        $key = 'private:rate-limit:' . $user->id;
        ['limit' => $limit] = $this->resolveRateLimit($request->path());

        $retryAfterInSeconds = $this->limiter->availableIn($key);

        return response()->json([
            'success' => false,
            'message' => 'Too many requests. Please try again later.',
            'errors' => [
                'rate_limit' => ['Rate limit exceeded']
            ]
        ], 429)->withHeaders([
            'Retry-After' => $retryAfterInSeconds,
            'X-RateLimit-Limit' => $limit,
            'X-RateLimit-Remaining' => 0,
            'X-RateLimit-Reset' => now()->timestamp + $retryAfterInSeconds,
        ]);
    }
}