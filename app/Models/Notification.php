<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    protected $table = "notifications";

    // Notification types
    const TYPE_FOLLOW = "follow";
    const TYPE_LIKE = "like";
    const TYPE_COMMENT = "comment";
    const TYPE_ACHIEVEMENT = "achievement";
    const TYPE_REWARD = "reward";
    const TYPE_SYSTEM = "system";

    protected $fillable = [
        "user_id",
        "type",
        "title",
        "subtitle",
        "avatar_url",
        "action_label",
        "related_user_id",
        "related_post_id",
        "related_place_id",
        "is_read",
        "metadata",
    ];

    protected $casts = [
        "id" => "integer",
        "user_id" => "integer",
        "related_user_id" => "integer",
        "related_post_id" => "integer",
        "related_place_id" => "integer",
        "is_read" => "boolean",
        "metadata" => "json",
        "created_at" => "datetime",
        "updated_at" => "datetime",
    ];

    // ── Relationships ──

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function relatedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, "related_user_id");
    }

    // ── Scopes ──

    public function scopeForUser($query, int $userId)
    {
        return $query->where("user_id", $userId);
    }

    public function scopeUnread($query)
    {
        return $query->where("is_read", false);
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where("type", $type);
    }

    public function scopeRecent($query, int $days = 30)
    {
        return $query->where(
            "created_at",
            ">=",
            now()->subDays($days)
        );
    }

    // ── Helper Methods ──

    /**
     * Mark this notification as read.
     */
    public function markAsRead(): void
    {
        $this->update(["is_read" => true]);
    }

    /**
     * Check if the notification has an associated user action (follow back, etc.)
     */
    public function hasAction(): bool
    {
        return !empty($this->action_label) && !empty($this->related_user_id);
    }
}
