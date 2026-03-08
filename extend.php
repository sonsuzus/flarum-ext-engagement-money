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
    // 1. Admin arayüzü için derlenmiş JS dosyası
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    // 2. Çeviri (dil) dosyalarının eklendiği dizin
    new Extend\Locales(__DIR__ . '/locale'),

    // 3. Ayarların varsayılan değerleri
    (new Extend\Settings())
        ->default('sonsuzus-engagement-money.reward_like', 1)
        ->default('sonsuzus-engagement-money.reward_best_answer_owner', 20)
        ->default('sonsuzus-engagement-money.reward_best_answer_selector', 5)
        ->default('sonsuzus-engagement-money.reward_registration', 50)
        ->default('sonsuzus-engagement-money.reward_daily_login', 5),

    (new Extend\Event())
        ->listen(PostWasLiked::class, RewardLikeActor::class)
        ->listen(PostWasUnliked::class, ReverseLikeActorReward::class)
        ->listen(BestAnswerSet::class, RewardBestAnswerSet::class)
        ->listen(BestAnswerUnset::class, RewardBestAnswerUnset::class)
        ->listen(Registered::class, RewardUserRegistration::class)
        ->listen(LoggedIn::class, RewardDailyLogin::class),
];