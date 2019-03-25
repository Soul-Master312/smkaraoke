import HomeComponent from '../components/home/HomeComponent';
import FindComponent from '../components/FindComponent';
import ListComponent from '../components/ListComponent';

export default [
    {
        path: '/',
        name: 'frontend.index',
        component: HomeComponent,
    },
    {
        path: '/find',
        name: 'frontend.find',
        component: FindComponent,
    },
    {
        path: '/list',
        name: 'frontend.list',
        component: ListComponent,
    },
]