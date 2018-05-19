
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('cliente-component', require('./components/Clientes.vue'));
Vue.component('categoria-component', require('./components/Categoria.vue'));
Vue.component('referencia-component', require('./components/Referencia.vue'));
Vue.component('calendario-component', require('./components/Calendario.vue'));

const app = new Vue({
    el: '#app',
    data:{
        menu: 0
    }
});
