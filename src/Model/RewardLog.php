<?php

namespace Sonsuzus\EngagementMoney\Model;

use Flarum\Database\AbstractModel;

class RewardLog extends AbstractModel
{
    protected $table = 'sonsuz_reward_logs';

    protected $fillable = [
        'type',
        'discussion_id',
        'post_id',
        'actor_user_id',
        'target_user_id',
        'amount',
        'unique_key',
    ];
}
