<?php

namespace Sonsuzus\EngagementMoney;

use Flarum\Extend;
use Flarum\Likes\Event\PostWasLiked;
use Flarum\Likes\Event\PostWasUnliked;
use Flarum\User\Event\LoggedIn;
use Flarum\User\Event\Registered;
use FoF\BestAnswer\Events\BestAnswerSet;
use FoF\BestAnswer\Events\BestAnswerUnset;
use Sonsuzus\EngagementMoney\Listener\ReverseLikeActorReward;
use Sonsuzus\EngagementMoney\Listener\RewardBestAnswerSet;
use Sonsuzus\EngagementMoney\Listener\RewardBestAnswerUnset;
use Sonsuzus\EngagementMoney\Listener\RewardDailyLogin;
use Sonsuzus\EngagementMoney\Listener\RewardLikeActor;
use Sonsuzus\EngagementMoney\Listener\RewardUserRegistration;

return [
    (new Extend\Event())
        ->listen(PostWasLiked::class, RewardLikeActor::class)
        ->listen(PostWasUnliked::class, ReverseLikeActorReward::class)
        ->listen(BestAnswerSet::class, RewardBestAnswerSet::class)
        ->listen(BestAnswerUnset::class, RewardBestAnswerUnset::class)
        ->listen(Registered::class, RewardUserRegistration::class)
        ->listen(LoggedIn::class, RewardDailyLogin::class),
];
