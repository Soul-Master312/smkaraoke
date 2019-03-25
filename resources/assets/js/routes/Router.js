import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../store/store'

Vue.use(VueRouter);

// Routes
import HomeRoutes from './HomeRoutes';
import RoomRoutes from './RoomRoutes';

const baseRoutes  = [];

const routes = baseRoutes.concat(
    HomeRoutes,
    RoomRoutes
);
// end

const router = new VueRouter({
    mode: 'history',
    routes
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        let loggedIn = store.getters.isLoggedIn;
        if (!loggedIn) {
            next({
                name: 'frontend.room.login',
                query: { redirect: to.fullPath },
            })
        } else {
            next()
        }
    } else {
        next()
    }
});

export default router;