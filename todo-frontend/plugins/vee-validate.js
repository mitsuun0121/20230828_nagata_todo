import Vue from 'vue';
import { ValidationProvider, ValidationObserver, localize, extend } from 'vee-validate';
import ja from 'vee-validate/dist/locale/ja.json'; // エラーメッセージ日本語化
import { required, max } from 'vee-validate/dist/rules';

  extend('required', {
    ...required,
    message: '※{_field_}を入力してください',
  });

  extend('max', {
    ...max,
    message: '※{_field_}は{length}文字以内で入力してください',
  });


Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver', ValidationObserver);
localize('ja', ja);

