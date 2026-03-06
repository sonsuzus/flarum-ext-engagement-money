<?php

namespace Sonsuzus\EngagementMoney\Listener;

use FoF\BestAnswer\Events\BestAnswerUnset;
use Sonsuzus\EngagementMoney\Model\RewardLog;
use Sonsuzus\EngagementMoney\Support\MoneyManager;
use Flarum\User\User;

class RewardBestAnswerUnset
{
    public function __construct(protected MoneyManager $money)
    {
    }

    public function handle(BestAnswerUnset $event): void
    {
        $discussion = $event->discussion;
        $post = $event->post;

        if (!$discussion || !$post) {
            return;
        }

        $logs = RewardLog::where('discussion_id', $discussion->id)
            ->where('post_id', $post->id)
            ->where('type', 'best_answer')
            ->get();

        foreach ($logs as $log) {
            $user = User::find($log->target_user_id);

            if ($user) {
                $this->money->subtract($user, (float) $log->amount);
            }

            $log->delete();
        }
    }
}
