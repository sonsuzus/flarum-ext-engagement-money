<?php

namespace Sonsuzus\EngagementMoney\Listener;

use FoF\BestAnswer\Events\BestAnswerSet;
use Sonsuzus\EngagementMoney\Model\RewardLog;
use Sonsuzus\EngagementMoney\Support\MoneyManager;

class RewardBestAnswerSet
{
    public function __construct(protected MoneyManager $money)
    {
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

        // En iyi cevap sahibine +10
        $answerKey = 'best_answer_owner:' . $discussion->id . ':' . $post->id;

        if (!RewardLog::where('unique_key', $answerKey)->exists()) {
            $this->money->add($answerOwner, 20);

            RewardLog::create([
                'type' => 'best_answer',
                'discussion_id' => $discussion->id,
                'post_id' => $post->id,
                'actor_user_id' => $actor->id,
                'target_user_id' => $answerOwner->id,
                'amount' => 20,
                'unique_key' => $answerKey,
            ]);
        }

        // Seçen kişiye +5, ama kendi yorumunu seçiyorsa verme
        if ((int) $actor->id !== (int) $answerOwner->id) {
            $selectorKey = 'best_answer_selector:' . $discussion->id . ':' . $post->id . ':' . $actor->id;

            if (!RewardLog::where('unique_key', $selectorKey)->exists()) {
                $this->money->add($actor, 5);

                RewardLog::create([
                    'type' => 'best_answer',
                    'discussion_id' => $discussion->id,
                    'post_id' => $post->id,
                    'actor_user_id' => $actor->id,
                    'target_user_id' => $actor->id,
                    'amount' => 5,
                    'unique_key' => $selectorKey,
                ]);
            }
        }
    }
}
