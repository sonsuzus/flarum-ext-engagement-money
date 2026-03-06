# 💰 Flarum Engagement Money

Adds **engagement rewards** to your Flarum forum using the
antoinefr/flarum-ext-money currency system.

This extension rewards users for interacting with posts and helping others by marking the best answers.

It is designed to increase **community participation and healthy discussion**.

---

## ✨ Features

This extension rewards users for the following actions:

| Action                        | Reward  |
| ----------------------------- | ------- |
| Giving a like                 | **+1**  |
| Being selected as Best Answer | **+10** |
| Selecting a Best Answer       | **+5**  |

Additional behavior:

* Rewards are **reverted** if a like is removed.
* Rewards are **reverted** if the best answer is unset.
* Prevents duplicate rewards.
* Prevents rewarding users for liking their own posts.

---

## ⚙️ Requirements

This extension requires:

* Flarum **1.8+**
* antoinefr/flarum-ext-money
* fof/best-answer
* flarum/likes

Make sure these extensions are installed and enabled.

---

## 📦 Installation

Install via Composer:

```bash
composer require sonsuzus/flarum-ext-engagement-money
```

Then run:

```bash
php flarum migrate
php flarum cache:clear
```

Enable the extension from the **Flarum admin panel**.

---

## 🧠 How It Works

The extension listens to Flarum events:

* Like events
* Unlike events
* Best Answer selection
* Best Answer removal

When these events occur, the extension updates the user's balance in the Money extension.

All rewards are stored in a log table:

```
sonsuz_reward_logs
```

This prevents:

* duplicate rewards
* reward abuse
* inconsistent balance changes

---

## 🗄 Database

The extension creates the following table:

```
sonsuz_reward_logs
```

This table stores:

* reward type
* discussion ID
* post ID
* actor user
* rewarded user
* reward amount
* unique reward key

---

## 🔒 Anti-Abuse Design

The extension includes protections against common abuse cases:

* No reward for liking your own post
* Duplicate rewards are blocked
* Rewards are reversed if actions are undone

---

## 👤 Author

**Ufuk**
Programming Teacher & Forum Administrator

🌐 [https://sonsuz.us](https://sonsuz.us)
📧 [sonsuzus@gmail.com](mailto:sonsuzus@gmail.com)
GitHub: [https://github.com/sonsuzus](https://github.com/sonsuzus)

---

## 📜 License

MIT License

---

## 💡 Future Ideas

Possible future improvements:

* Admin panel reward configuration
* Daily reward limits
* Leaderboard integration
* Gamification features

da hazırlayabilirim.
Böyle olunca eklenti baya **“gerçek bir açık kaynak projesi” gibi** görünür.
