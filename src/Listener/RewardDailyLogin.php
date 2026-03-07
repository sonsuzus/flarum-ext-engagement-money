<?php

namespace Sonsuzus\EngagementMoney\Listener;

use Flarum\User\Event\LoggedIn;
use Sonsuzus\EngagementMoney\Model\RewardLog;
use Sonsuzus\EngagementMoney\Support\MoneyManager;

class RewardDailyLogin
{
    public function __construct(protected MoneyManager $money)
    {
    }

    public function handle(LoggedIn $event): void
    {
        $user = $event->user ?? null;

        if (!$user) {
            return;
        }

        $rewardAmount = 5;
        $today = date('Y-m-d');

        $uniqueKey = 'daily_login:' . $user->id . ':' . $today;

        if (RewardLog::where('unique_key', $uniqueKey)->exists()) {
            return;
        }

        $this->money->add($user, $rewardAmount);

        RewardLog::create([
            'type' => 'daily_login',
            'discussion_id' => null,
            'post_id' => null,
            'actor_user_id' => $user->id,
            'target_user_id' => $user->id,
            'amount' => $rewardAmount,
            'unique_key' => $uniqueKey,
        ]);
    }
}
