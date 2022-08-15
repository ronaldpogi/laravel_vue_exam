import { createRouter, createWebHistory } from "vue-router";

import userIndex from '../components/user/UserIndex.vue'
import UserLogin from '../components/user/UserLogin.vue'
import UserRegister from '../components/user/UserRegister.vue'
import UserCreate from '../components/user/UserCreate.vue'
import UserUpdateRole from '../components/user/UserUpdateRole.vue'
import UserUpdateInfo from '../components/user/UserUpdateInfo.vue'

const routes = [
    { path: '/user', name: 'userIndex', component: userIndex },
    { path: '/', name: 'UserLogin', component: UserLogin },
    { path: '/user/register', name: 'UserRegister', component: UserRegister },
    { path: '/user/create', name: 'UserCreate', component: UserCreate },
    { path: '/user/update/role/:id', name: 'UserUpdateRole', component: UserUpdateRole, props: true },
    { path: '/user/update/info/:id', name: 'UserUpdateInfo', component: UserUpdateInfo, props: true }

]

export default createRouter({
    history: createWebHistory(),
    routes
})