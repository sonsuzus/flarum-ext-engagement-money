<?php

namespace Sonsuzus\EngagementMoney\Listener;

use Flarum\Likes\Event\PostWasUnliked;
use Sonsuzus\EngagementMoney\Model\RewardLog;
use Sonsuzus\EngagementMoney\Support\MoneyManager;

class ReverseLikeActorReward
{
    public function __construct(protected MoneyManager $money)
    {
    }

    public function handle(PostWasUnliked $event): void
    {
        $actor = $event->actor;
        $post = $event->post;

        if (!$actor || !$post) {
            return;
        }

        $uniqueKey = 'like_given:' . $post->id . ':' . $actor->id;

        $log = RewardLog::where('unique_key', $uniqueKey)->first();

        if (!$log) {
            return;
        }

        $this->money->subtract($actor, (float) $log->amount);
        $log->delete();
    }
}
