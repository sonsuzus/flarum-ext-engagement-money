<?php

namespace Sonsuzus\EngagementMoney\Listener;

use FoF\BestAnswer\Events\BestAnswerSet;
use Flarum\Settings\SettingsRepositoryInterface;
use Sonsuzus\EngagementMoney\Model\RewardLog;
use Sonsuzus\EngagementMoney\Support\MoneyManager;

class RewardBestAnswerSet
{
    public function __construct(
        protected MoneyManager $money,
        protected SettingsRepositoryInterface $settings
    ) {
    }

    public function handle(BestAnswerSet $event): void
    {
        $discussion = $event->discussion;
        $post = $event->post;
        $actor = $event->actor;

        if (!$discussion || !$post || !$actor || !$post->user) {
            return;
        }

        $answerOwner = $post->user;

        $ownerReward = (float) $this->settings->get('sonsuzus-engagement-money.reward_best_answer_owner', 20);
        $selectorReward = (float) $this->settings->get('sonsuzus-engagement-money.reward_best_answer_selector', 5);

        // En iyi cevap sahibine ödül
        if ($ownerReward > 0) {
            $answerKey = 'best_answer_owner:' . $discussion->id . ':' . $post->id;

            if (!RewardLog::where('unique_key', $answerKey)->exists()) {
                $this->money->add($answerOwner, $ownerReward);

                RewardLog::create([
                    'type' => 'best_answer',
                    'discussion_id' => $discussion->id,
                    'post_id' => $post->id,
                    'actor_user_id' => $actor->id,
                    'target_user_id' => $answerOwner->id,
                    'amount' => $ownerReward,
                    'unique_key' => $answerKey,
                ]);
            }
        }

        // Seçen kişiye ödül (Kendi yorumunu seçiyorsa verme)
        if ($selectorReward > 0 && (int) $actor->id !== (int) $answerOwner->id) {
            $selectorKey = 'best_answer_selector:' . $discussion->id . ':' . $post->id . ':' . $actor->id;

            if (!RewardLog::where('unique_key', $selectorKey)->exists()) {
                $this->money->add($actor, $selectorReward);

                RewardLog::create([
                    'type' => 'best_answer',
                    'discussion_id' => $discussion->id,
                    'post_id' => $post->id,
                    'actor_user_id' => $actor->id,
                    'target_user_id' => $actor->id,
                    'amount' => $selectorReward,
                    'unique_key' => $selectorKey,
                ]);
            }
        }
    }
}