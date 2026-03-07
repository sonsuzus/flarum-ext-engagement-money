<?php

namespace Sonsuzus\EngagementMoney\Listener;

use Flarum\User\Event\Registered;
use Sonsuzus\EngagementMoney\Model\RewardLog;
use Sonsuzus\EngagementMoney\Support\MoneyManager;

class RewardUserRegistration
{
    public function __construct(protected MoneyManager $money)
    {
    }

    public function handle(Registered $event): void
    {
        $user = $event->user ?? null;

        if (!$user) {
            return;
        }

        $rewardAmount = 50;

        $uniqueKey = 'user_registered:' . $user->id;

        if (RewardLog::where('unique_key', $uniqueKey)->exists()) {
            return;
        }

        $this->money->add($user, $rewardAmount);

        RewardLog::create([
            'type' => 'user_registered',
            'discussion_id' => null,
            'post_id' => null,
            'actor_user_id' => $user->id,
            'target_user_id' => $user->id,
            'amount' => $rewardAmount,
            'unique_key' => $uniqueKey,
        ]);
    }
}
