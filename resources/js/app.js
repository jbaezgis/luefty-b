
require('./bootstrap');

window.Vue = require('vue');

// Vue.component('extraspro-component', require('./components/ExtrasProComponent.vue'));
Vue.component('follow-button', require('./components/FollowButton.vue'));
// Vue.component('extraspassform-com', require('./components/ExtrasPassForm.vue'));
// Vue.component('extrasproform-component', require('./components/ExtrasProForm.vue'));
// Vue.component('extrasproitem-component', require('./components/ExtrasProItem.vue'));

const app = new Vue({
    el: '#app'
});
