<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->table('sonsuz_reward_logs', function (Blueprint $table) {
            $table->index(['type', 'actor_user_id', 'created_at'], 'sonsuz_reward_logs_daily_idx');
        });
    },

    'down' => function (Builder $schema) {
        $schema->table('sonsuz_reward_logs', function (Blueprint $table) {
            $table->dropIndex('sonsuz_reward_logs_daily_idx');
        });
    },
];