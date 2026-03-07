<?php

namespace Sonsuzus\EngagementMoney\Listener;

use Flarum\Likes\Event\PostWasLiked;
use Sonsuzus\EngagementMoney\Model\RewardLog;
use Sonsuzus\EngagementMoney\Support\MoneyManager;

class RewardLikeActor
{
    public function __construct(protected MoneyManager $money)
    {
    }

    public function handle(PostWasLiked $event): void
    {
        $actor = $event->actor;
        $post = $event->post;

        if (!$actor || !$post) {
            return;
        }

        // Kendi postunu beğenmeye ödül verme
        if ((int) $actor->id === (int) $post->user_id) {
            return;
        }

        $uniqueKey = 'like_given:' . $post->id . ':' . $actor->id;

        if (RewardLog::where('unique_key', $uniqueKey)->exists()) {
            return;
        }

        $this->money->add($actor, 1);

        RewardLog::create([
            'type' => 'like_given',
            'discussion_id' => $post->discussion_id,
            'post_id' => $post->id,
            'actor_user_id' => $actor->id,
            'target_user_id' => $actor->id,
            'amount' => 1,
            'unique_key' => $uniqueKey,
        ]);
    }
}
