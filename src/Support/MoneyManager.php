<?php

namespace Sonsuzus\EngagementMoney\Support;

use AntoineFr\Money\Event\MoneyUpdated;
use Flarum\User\User;
use Illuminate\Contracts\Events\Dispatcher;

class MoneyManager
{
    public function __construct(protected Dispatcher $events)
    {
    }

    public function add(User $user, float $amount): void
    {
        $user->money = (float) $user->money + $amount;
        $user->save();

        $this->events->dispatch(new MoneyUpdated($user));
    }

    public function subtract(User $user, float $amount): void
    {
        $user->money = (float) $user->money - $amount;
        $user->save();

        $this->events->dispatch(new MoneyUpdated($user));
    }
}
