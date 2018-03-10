
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(function(){
  const $js_set_lang = $('.js_set_lang')

  const setLang = function(e) {
    e.preventDefault();
    const lang = e.target.dataset.lang;
    Cookies.set('lang', lang);
    location.reload();
  }

  $js_set_lang.on('click', setLang)
})

$(function(){
  const $btn_confirm = $('.btn_confirm');

  const confirmAction = function(e) {
    const message = e.target.dataset.message || '{{ __("messages.label.confirm") }}'
    return confirm(message)
  }

  $btn_confirm.on('click', confirmAction)
})
