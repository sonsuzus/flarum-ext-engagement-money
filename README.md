# Flarum Engagement Money

Adds **engagement rewards** to your Flarum forum using the `antoinefr/flarum-ext-money` currency system.

This extension rewards users for interacting with posts, helping others, registering, and returning daily to the forum.

It is designed to increase **community participation and healthy discussion**.

---

## ✨ Features

This extension rewards users for the following actions:

| Action | Reward |
|-----------------------------|--------:|
| Giving a like | **+1** |
| Being selected as Best Answer | **+20** |
| Selecting a Best Answer | **+5** |
| Registering an account | **+50** |
| Daily login | **+5** |

### Additional behavior

- Rewards are **reverted** if a like is removed.
- Rewards are **reverted** if the best answer is unset.
- Registration reward is given **only once**.
- Daily login reward is given **once per day**.
- Prevents duplicate rewards.
- Prevents rewarding users for liking their own posts.

---

## ⚙️ Requirements

This extension requires:

- Flarum **1.8+**
- `antoinefr/flarum-ext-money`
- `fof/best-answer`
- `flarum/likes`

Make sure these extensions are installed and enabled.

---

## Installation

Install via Composer:

```bash
composer require sonsuzus/flarum-ext-engagement-money
