<?php

namespace Sonsuzus\EngagementMoney;

use Flarum\Extend;
use Flarum\Likes\Event\PostWasLiked;
use Flarum\Likes\Event\PostWasUnliked;
use FoF\BestAnswer\Events\BestAnswerSet;
use FoF\BestAnswer\Events\BestAnswerUnset;
use Sonsuzus\EngagementMoney\Listener\RewardBestAnswerSet;
use Sonsuzus\EngagementMoney\Listener\RewardBestAnswerUnset;
use Sonsuzus\EngagementMoney\Listener\RewardLikeActor;
use Sonsuzus\EngagementMoney\Listener\ReverseLikeActorReward;

return [
    (new Extend\Event())
        ->listen(PostWasLiked::class, RewardLikeActor::class)
        ->listen(PostWasUnliked::class, ReverseLikeActorReward::class)
        ->listen(BestAnswerSet::class, RewardBestAnswerSet::class)
        ->listen(BestAnswerUnset::class, RewardBestAnswerUnset::class),
];
