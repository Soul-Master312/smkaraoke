import Vue from 'vue';
import VueRouter from 'vue-router';

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

export default router;