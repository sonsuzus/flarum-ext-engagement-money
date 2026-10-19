import Extend from 'flarum/common/extenders';
import app from 'flarum/admin/app';

const transPrefix = 'sonsuzus-engagement-money.admin.settings.';

export default [
  new Extend.Admin()
    .setting(() => ({
      setting: 'sonsuzus-engagement-money.reward_like',
      label: app.translator.trans(transPrefix + 'reward_like'),
      type: 'number',
    }))
    .setting(() => ({
      setting: 'sonsuzus-engagement-money.reward_best_answer_owner',
      label: app.translator.trans(transPrefix + 'reward_best_answer_owner'),
      type: 'number',
    }))
    .setting(() => ({
      setting: 'sonsuzus-engagement-money.reward_best_answer_selector',
      label: app.translator.trans(transPrefix + 'reward_best_answer_selector'),
      type: 'number',
    }))
    .setting(() => ({
      setting: 'sonsuzus-engagement-money.reward_registration',
      label: app.translator.trans(transPrefix + 'reward_registration'),
      type: 'number',
    }))
    .setting(() => ({
      setting: 'sonsuzus-engagement-money.reward_daily_login',
      label: app.translator.trans(transPrefix + 'reward_daily_login'),
      type: 'number',
    })),
];