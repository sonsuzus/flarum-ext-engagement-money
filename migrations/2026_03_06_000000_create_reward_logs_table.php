<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        if (!$schema->hasTable('sonsuz_reward_logs')) {
            $schema->create('sonsuz_reward_logs', function (Blueprint $table) {
                $table->increments('id');
                $table->string('type', 50); // like_given, best_answer, user_registered, daily_login
                $table->unsignedInteger('discussion_id')->nullable();
                $table->unsignedInteger('post_id')->nullable();
                $table->unsignedInteger('actor_user_id')->nullable();
                $table->unsignedInteger('target_user_id')->nullable();
                $table->decimal('amount', 12, 2)->default(0);
                $table->string('unique_key', 191)->unique();
                $table->timestamps();
            });
        }
    },

    'down' => function (Builder $schema) {
        $schema->dropIfExists('sonsuz_reward_logs');
    },
];
