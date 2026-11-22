# Flarum Engagement Money

![Flarum](https://img.shields.io/badge/Flarum-2.0+-success?style=flat-square&logo=flarum)
![Version](https://img.shields.io/badge/version-v2.0.2-blue?style=flat-square)

Adds **engagement rewards** to your Flarum forum using the `antoinefr/flarum-ext-money` currency system.

🎉 **Update:** Built and optimized for **Flarum 2.0**, now with configurable daily like reward limits.

This extension rewards users for interacting with posts, helping others, registering, and returning to the forum daily. It is designed to encourage **community participation and healthy discussions**.

## ✨ Features

Reward amounts and limits are fully customizable through the Flarum Admin Panel. Set your own values or disable individual rewards by setting their amount to `0`.

Default settings:

- **Giving a like:** +1
- **Daily like reward limit:** 50 per day (`0` = unlimited)
- **Being selected as Best Answer:** +20
- **Selecting a Best Answer:** +5
- **Registering an account:** +50
- **Daily login:** +5

### 🛡️ Smart Protections

- **Reversible actions:** Rewards are automatically reverted if a like is removed or a Best Answer is unset (only if a reward was originally granted).
- **Anti-cheat:** Users do not receive rewards for liking their own posts or selecting their own replies as the Best Answer.
- **Daily like limit:** Prevents like-farming by capping how many likes per day can earn rewards. Removing a rewarded like reverts the points and restores that daily slot.
- **One-time & daily caps:** The registration reward is granted only once per user. The daily login reward is granted only once per day per user.

## ⚙️ Requirements

This extension requires **Flarum 2.0** and compatible versions of the following extensions:

- `antoinefr/flarum-ext-money`
- `fof/best-answer`
- `flarum/likes`

Make sure these extensions are installed and enabled before enabling Engagement Money.

> For Flarum 1.x, use a compatible `v1.x.x` release of this extension.

## 🚀 Installation

Install via Composer:

```bash
composer require sonsuzus/flarum-ext-engagement-money
```

## 🔄 Updating

```bash
composer update sonsuzus/flarum-ext-engagement-money
php flarum migrate
php flarum cache:clear
```
