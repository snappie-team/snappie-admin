<?php

namespace App\Http\Controllers\Api\V2;

use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController
{
    public function __construct(private NotificationService $service) {}

    /**
     * Get user notifications (paginated).
     *
     * GET /notifications
     * Query params: page (default 1), per_page (default 20)
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $user = $request->user();
            if (!$user) {
                return response()->json(
                    ["success" => false, "message" => "Unauthorized"],
                    401
                );
            }

            $page = (int) $request->query("page", 1);
            $perPage = min((int) $request->query("per_page", 20), 50);

            $data = $this->service->getNotifications($user, $page, $perPage);

            return response()->json([
                "success" => true,
                "message" => "Notifications retrieved",
                "data" => $data,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Failed to retrieve notifications",
                    "error" => $e->getMessage(),
                ],
                500
            );
        }
    }

    /**
     * Get unread notification count.
     *
     * GET /notifications/unread-count
     */
    public function unreadCount(Request $request): JsonResponse
    {
        try {
            $user = $request->user();
            if (!$user) {
                return response()->json(
                    ["success" => false, "message" => "Unauthorized"],
                    401
                );
            }

            $count = $this->service->getUnreadCount($user);

            return response()->json([
                "success" => true,
                "message" => "Unread count retrieved",
                "data" => ["unread_count" => $count],
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Failed to retrieve unread count",
                    "error" => $e->getMessage(),
                ],
                500
            );
        }
    }

    /**
     * Mark a specific notification as read.
     *
     * POST /notifications/{notification_id}/read
     */
    public function markAsRead(
        Request $request,
        int $notificationId
    ): JsonResponse {
        try {
            $user = $request->user();
            if (!$user) {
                return response()->json(
                    ["success" => false, "message" => "Unauthorized"],
                    401
                );
            }

            $success = $this->service->markAsRead($user, $notificationId);

            if (!$success) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Notification not found",
                    ],
                    404
                );
            }

            return response()->json([
                "success" => true,
                "message" => "Notification marked as read",
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Failed to mark notification as read",
                    "error" => $e->getMessage(),
                ],
                500
            );
        }
    }

    /**
     * Mark all notifications as read.
     *
     * POST /notifications/read-all
     */
    public function markAllAsRead(Request $request): JsonResponse
    {
        try {
            $user = $request->user();
            if (!$user) {
                return response()->json(
                    ["success" => false, "message" => "Unauthorized"],
                    401
                );
            }

            $count = $this->service->markAllAsRead($user);

            return response()->json([
                "success" => true,
                "message" => "{$count} notifications marked as read",
                "data" => ["marked_count" => $count],
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Failed to mark notifications as read",
                    "error" => $e->getMessage(),
                ],
                500
            );
        }
    }
}
