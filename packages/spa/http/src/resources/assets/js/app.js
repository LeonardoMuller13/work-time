import Vue from 'vue'
import App from './views/App.vue'
import router from './router'

import 'bootstrap/dist/css/bootstrap.css'
import * as moment from 'moment'
window.moment = moment;

new Vue({
    router,
    render: function (h) { return h(App) }
}).$mount('#app')

