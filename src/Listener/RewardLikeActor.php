<?php

namespace Sonsuzus\EngagementMoney\Listener;

use Flarum\Likes\Event\PostWasLiked;
use Flarum\Settings\SettingsRepositoryInterface;
use Sonsuzus\EngagementMoney\Model\RewardLog;
use Sonsuzus\EngagementMoney\Support\MoneyManager;

class RewardLikeActor
{
    public function __construct(
        protected MoneyManager $money,
        protected SettingsRepositoryInterface $settings
    ) {
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

        // Veritabanından değeri oku, yoksa varsayılan olarak 1 al
        $rewardAmount = (float) $this->settings->get('sonsuzus-engagement-money.reward_like', 1);

        // Değer 0 veya altındaysa ödül sistemini atla (kapatma işlevi görür)
        if ($rewardAmount <= 0) {
            return;
        }

        $this->money->add($actor, $rewardAmount);

        RewardLog::create([
            'type' => 'like_given',
            'discussion_id' => $post->discussion_id,
            'post_id' => $post->id,
            'actor_user_id' => $actor->id,
            'target_user_id' => $actor->id,
            'amount' => $rewardAmount,
            'unique_key' => $uniqueKey,
        ]);
    }
}