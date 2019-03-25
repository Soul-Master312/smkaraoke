import ListRoomComponent from '../components/room/ListRoomComponent'
import CreateRoomComponent from '../components/room/CreateRoomComponent';
import RoomComponent from '../components/room/RoomComponent';
import LoginRoomComponent from '../components/room/LoginRoomComponent';

export default [
    {
        path: '/room/login',
        name: 'frontend.room.login',
        component: LoginRoomComponent,
    },
    {
        path: '/room/list',
        name: 'frontend.room.list',
        component: ListRoomComponent,
    },
    {
        path: '/room/create',
        name: 'frontend.room.create',
        component: CreateRoomComponent,
    },
    {
        path: '/room/:identifier',
        name: 'frontend.room',
        component: RoomComponent,
        meta: { requiresAuth: true }
    }
]