# Flarum Engagement Money

![Flarum](https://img.shields.io/badge/Flarum-2.0+-success?style=flat-square&logo=flarum)
![Version](https://img.shields.io/badge/version-v2.0.1-blue?style=flat-square)

Adds **engagement rewards** to your Flarum forum using the `antoinefr/flarum-ext-money` currency system.

🎉 **Update:** Version `v2.0.1` is a rebuilt and optimized release written for **Flarum 2.0**.

This extension rewards users for interacting with posts, helping others, registering, and returning to the forum daily. It is designed to encourage **community participation and healthy discussions**.

## ✨ Features

Reward amounts are fully customizable through the Flarum Admin Panel. Set your own values or disable individual rewards by setting their amount to `0`.

Default reward values:

- **Giving a like:** +1
- **Being selected as Best Answer:** +20
- **Selecting a Best Answer:** +5
- **Registering an account:** +50
- **Daily login:** +5

### 🛡️ Smart Protections

- **Reversible actions:** Rewards are reverted if a like is removed or a Best Answer is unset.
- **Anti-cheat:** Users do not receive rewards for liking their own posts or selecting their own replies as the Best Answer.
- **Reward limits:** The registration reward is granted only once per user. The daily login reward is granted only once per day per user.

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
