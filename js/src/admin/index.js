import app from 'flarum/admin/app';

app.initializers.add('sonsuzus-engagement-money', () => {
  const transPrefix = 'sonsuzus-engagement-money.admin.settings.';

  app.extensionData
    .for('sonsuzus-engagement-money')
    .registerSetting({
      setting: 'sonsuzus-engagement-money.reward_like',
      label: app.translator.trans(transPrefix + 'reward_like'),
      type: 'number',
    })
    .registerSetting({
      setting: 'sonsuzus-engagement-money.reward_best_answer_owner',
      label: app.translator.trans(transPrefix + 'reward_best_answer_owner'),
      type: 'number',
    })
    .registerSetting({
      setting: 'sonsuzus-engagement-money.reward_best_answer_selector',
      label: app.translator.trans(transPrefix + 'reward_best_answer_selector'),
      type: 'number',
    })
    .registerSetting({
      setting: 'sonsuzus-engagement-money.reward_registration',
      label: app.translator.trans(transPrefix + 'reward_registration'),
      type: 'number',
    })
    .registerSetting({
      setting: 'sonsuzus-engagement-money.reward_daily_login',
      label: app.translator.trans(transPrefix + 'reward_daily_login'),
      type: 'number',
    });
});