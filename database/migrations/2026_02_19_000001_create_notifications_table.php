<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("notifications", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("user_id")
                ->constrained("users")
                ->cascadeOnDelete();
            $table
                ->enum("type", [
                    "follow",
                    "like",
                    "comment",
                    "achievement",
                    "reward",
                    "system",
                ])
                ->index();
            $table->string("title");
            $table->string("subtitle")->nullable();
            $table->string("avatar_url")->nullable();
            $table->string("action_label")->nullable();
            $table
                ->unsignedBigInteger("related_user_id")
                ->nullable()
                ->index();
            $table
                ->unsignedBigInteger("related_post_id")
                ->nullable()
                ->index();
            $table
                ->unsignedBigInteger("related_place_id")
                ->nullable()
                ->index();
            $table->boolean("is_read")->default(false)->index();
            $table->json("metadata")->nullable();
            $table->timestamps();

            $table->index(["user_id", "is_read"]);
            $table->index(["user_id", "created_at"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("notifications");
    }
};
