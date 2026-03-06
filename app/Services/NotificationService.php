<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;

class NotificationService
{
    /**
     * Get paginated notifications for a user.
     */
    public function getNotifications(
        User $user,
        int $page = 1,
        int $perPage = 20
    ): array {
        $query = Notification::forUser($user->id)
            ->recent(30)
            ->orderBy("created_at", "desc");

        $total = $query->count();
        $notifications = $query
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        $unreadCount = Notification::forUser($user->id)
            ->unread()
            ->count();

        return [
            "notifications" => $notifications->map(function (
                Notification $n
            ) {
                return $this->formatNotification($n);
            }),
            "unread_count" => $unreadCount,
            "pagination" => [
                "current_page" => $page,
                "per_page" => $perPage,
                "total" => $total,
                "last_page" => (int) ceil($total / $perPage),
            ],
        ];
    }

    /**
     * Get unread notification count for a user.
     */
    public function getUnreadCount(User $user): int
    {
        return Notification::forUser($user->id)
            ->unread()
            ->count();
    }

    /**
     * Mark a single notification as read.
     */
    public function markAsRead(User $user, int $notificationId): bool
    {
        $notification = Notification::forUser($user->id)
            ->find($notificationId);

        if (!$notification) {
            return false;
        }

        $notification->markAsRead();
        return true;
    }

    /**
     * Mark all notifications as read for a user.
     */
    public function markAllAsRead(User $user): int
    {
        return Notification::forUser($user->id)
            ->unread()
            ->update(["is_read" => true]);
    }

    // ── Notification Creators ──

    /**
     * Create a follow notification.
     */
    public function createFollowNotification(
        User $follower,
        User $target
    ): Notification {
        return Notification::create([
            "user_id" => $target->id,
            "type" => Notification::TYPE_FOLLOW,
            "title" => "{$follower->username} mengikuti kamu",
            "avatar_url" => $follower->image_url,
            "action_label" => "Ikuti Balik",
            "related_user_id" => $follower->id,
        ]);
    }

    /**
     * Create a like notification.
     */
    public function createLikeNotification(
        User $liker,
        User $postOwner,
        int $postId,
        ?string $postPreview = null
    ): Notification {
        // Don't notify yourself
        if ($liker->id === $postOwner->id) {
            return new Notification();
        }

        return Notification::create([
            "user_id" => $postOwner->id,
            "type" => Notification::TYPE_LIKE,
            "title" => "{$liker->username} menyukai postingan kamu",
            "subtitle" => $postPreview
                ? '"' . mb_strimwidth($postPreview, 0, 50, "...") . '"'
                : null,
            "avatar_url" => $liker->image_url,
            "related_user_id" => $liker->id,
            "related_post_id" => $postId,
        ]);
    }

    /**
     * Create a comment notification.
     */
    public function createCommentNotification(
        User $commenter,
        User $postOwner,
        int $postId,
        ?string $commentPreview = null
    ): Notification {
        // Don't notify yourself
        if ($commenter->id === $postOwner->id) {
            return new Notification();
        }

        return Notification::create([
            "user_id" => $postOwner->id,
            "type" => Notification::TYPE_COMMENT,
            "title" => "{$commenter->username} berkomentar di postingan kamu",
            "subtitle" => $commentPreview
                ? '"' . mb_strimwidth($commentPreview, 0, 50, "...") . '"'
                : null,
            "avatar_url" => $commenter->image_url,
            "related_user_id" => $commenter->id,
            "related_post_id" => $postId,
        ]);
    }

    /**
     * Create an achievement notification.
     */
    public function createAchievementNotification(
        User $user,
        string $achievementName,
        ?string $achievementType = null,
        ?array $metadata = null
    ): Notification {
        if ($achievementType == 'achievement') {
            $title = "Kamu mendapat badge \"{$achievementName}\"";
        } else {
            $title = "Kamu berhasil menyelesaikan \"{$achievementName}\"";
        }
        return Notification::create([
            "user_id" => $user->id,
            "type" => Notification::TYPE_ACHIEVEMENT,
            "title" => $title,
            "metadata" => $metadata,
        ]);
    }

    /**
     * Create a reward notification.
     */
    public function createRewardNotification(
        User $user,
        int $coins,
        ?string $reason = null
    ): Notification {
        return Notification::create([
            "user_id" => $user->id,
            "type" => Notification::TYPE_REWARD,
            "title" => "Kamu mendapat {$coins} koin!",
            "subtitle" => $reason,
        ]);
    }

    /**
     * Create a system notification.
     */
    public function createSystemNotification(
        User $user,
        string $title,
        ?string $subtitle = null
    ): Notification {
        return Notification::create([
            "user_id" => $user->id,
            "type" => Notification::TYPE_SYSTEM,
            "title" => $title,
            "subtitle" => $subtitle,
        ]);
    }

    /**
     * Create notifications for unlocked achievements from gamification result.
     */
    public function createAchievementNotifications(
        User $user,
        array $achievementsUnlocked
    ): void {
        foreach ($achievementsUnlocked as $achievement) {
            $this->createAchievementNotification(
                $user,
                $achievement["name"] ?? "Achievement",
                $achievement["type"] ?? null,
                [
                    "achievement_id" => $achievement["id"] ?? null,
                    "achievement_type" => $achievement["type"] ?? null,
                    "level" => $achievement["level"] ?? null,
                    "reward_coins" => $achievement["reward_coins"] ?? 0,
                    "reward_xp" => $achievement["reward_xp"] ?? 0,
                ]
            );
        }
    }

    // ── Formatting ──

    /**
     * Format a notification for API response.
     */
    private function formatNotification(Notification $notification): array
    {
        return [
            "id" => $notification->id,
            "type" => $notification->type,
            "title" => $notification->title,
            "subtitle" => $notification->subtitle,
            "avatar_url" => $notification->avatar_url,
            "action_label" => $notification->action_label,
            "related_user_id" => $notification->related_user_id,
            "related_post_id" => $notification->related_post_id,
            "related_place_id" => $notification->related_place_id,
            "is_read" => $notification->is_read,
            "metadata" => $notification->metadata,
            "created_at" => $notification->created_at?->toISOString(),
        ];
    }
}
