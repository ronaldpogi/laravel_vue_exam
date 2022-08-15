require('./bootstrap');

import axios from "axios";

axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');

import { createApp } from 'vue';

import router from './router'

createApp({
    components: {}
}).use(router).mount('#app')