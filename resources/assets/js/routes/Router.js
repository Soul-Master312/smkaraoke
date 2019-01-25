import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

// Routes
import HomeRoute from './HomeRoutes'

const baseRoutes  = [];
const routes = baseRoutes.concat(HomeRoute);
// end

const router = new VueRouter({
    routes
});

export default router;