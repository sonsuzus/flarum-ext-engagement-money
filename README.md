# Flarum Engagement Money

Adds **engagement rewards** to your Flarum forum using the `antoinefr/flarum-ext-money` currency system.

This extension rewards users for interacting with posts, helping others, registering, and returning daily to the forum. It is designed to increase **community participation and healthy discussions**.

## ✨ Features

Reward amounts are now **fully customizable** via the Flarum Admin Panel! Set your own values or disable specific rewards by setting them to `0`.

The default reward values are:
- **Giving a like:** +1
- **Being selected as Best Answer:** +20
- **Selecting a Best Answer:** +5
- **Registering an account:** +50
- **Daily login:** +5

### 🛡️ Smart Protections
- **Reversible Actions:** Rewards are **reverted** if a like is removed or if a best answer is unset.
- **Anti-Cheat:** Users do not receive rewards for liking their own posts or selecting their own replies as the best answer.
- **Limits:** Registration reward is given only once. Daily login reward is strictly given once per day per user.

## ⚙️ Requirements

This extension requires:
- Flarum **1.8+**
- `antoinefr/flarum-ext-money`
- `fof/best-answer`
- `flarum/likes`

Make sure these extensions are installed and enabled before enabling Engagement Money.

## 🚀 Installation

Install via Composer:

```bash
composer require sonsuzus/flarum-ext-engagement-money
```

## 🔄 Updating

```bash
composer update sonsuzus/flarum-ext-engagement-money
php flarum cache:clear
```

## 🔗 Links
- [Packagist](https://packagist.org/packages/sonsuzus/flarum-ext-engagement-money)
- [GitHub](https://github.com/sonsuzus/flarum-ext-engagement-money)
