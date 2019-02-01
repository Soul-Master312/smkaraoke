import ListRoomComponent from '../components/room/ListRoomComponent'
import CreateRoomComponent from '../components/room/CreateRoomComponent';

export default [
    {
        path: '/room/list',
        name: 'frontend.room.list',
        component: ListRoomComponent,
    },
    {
        path: '/room/create',
        name: 'frontend.room.create',
        component: CreateRoomComponent,
    }
]