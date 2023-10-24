import Router from 'vue-router'
import { store } from './vuex/store';
import Balance from "./components/Balance.vue";
import OperationsList from "./components/OperationsList.vue";
import Login from "./components/Auth/Login.vue";

const onlyAuthenticated = (to, from, next) => {
    if (store.getters.isAuthenticated) {
        next();
        return;
    }
    next('/login');
};

const onlyNotAuthenticated = (to, from, next) => {
    if (!store.getters.isAuthenticated) {
        next();
        return;
    }
    next('/');
};

export const router = new Router({
    mode: 'history',
    routes: [
        {
            path: '/login',
            name: 'login',
            component: Login,
            beforeEnter: onlyNotAuthenticated,
        },
        {
            path: '/',
            name: 'balance',
            component: Balance,
            beforeEnter: onlyAuthenticated,
        },
        {
            path: '/operation-list',
            name: 'operation-list',
            component: OperationsList,
            beforeEnter: onlyAuthenticated,
        }
    ],
})
