<?php

namespace Sonsuzus\EngagementMoney\Listener;

use Carbon\Carbon;
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
        $actor = $event->user;
        $post = $event->post;

        if (!$actor || !$post) {
            return;
        }

        // Kendi gönderisini beğenmeye ödül verme
        if ($post->user_id !== null && (int) $actor->id === (int) $post->user_id) {
            return;
        }

        // Ödül miktarı 0 veya altındaysa işlemi atla
        $rewardAmount = (float) $this->settings->get('sonsuzus-engagement-money.reward_like', 1);

        if ($rewardAmount <= 0) {
            return;
        }

        $uniqueKey = 'like_given:' . $post->id . ':' . $actor->id;

        if (RewardLog::where('unique_key', $uniqueKey)->exists()) {
            return;
        }

        // Günlük beğeni ödülü limiti kontrolü (0 = sınırsız)
        $dailyLimit = (int) $this->settings->get('sonsuzus-engagement-money.daily_like_limit', 50);

        if ($dailyLimit > 0) {
            $todayCount = RewardLog::where('type', 'like_given')
                ->where('actor_user_id', $actor->id)
                ->where('created_at', '>=', Carbon::today())
                ->count();

            if ($todayCount >= $dailyLimit) {
                return;
            }
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