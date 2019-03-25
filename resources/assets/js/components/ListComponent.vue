<template>
    <div>
        <b-row class="mb-4 mt-4">
            <b-col cols="2">
                <b-button variant="primary" @click="next()">Qua Bài</b-button>
            </b-col>
        </b-row>

        <b-row class="mb-4 mt-4">
            <b-col v-if="playing === null">
                Không có bài hát nào đang phát
            </b-col>
            <b-col v-else>
                Bài hát đang phát: <span class="text-info">{{ playing.title }}</span> <b-spinner variant="info" type="grow"/>
            </b-col>
        </b-row>

        <b-row>
            <b-col>
                <b-table
                        id="table-transition"
                        :bordered="bordered"
                        :outlined="outlined"
                        :hover="hover"
                        :fixed="fixed"
                        :items="songs"
                        :fields="fields"
                        :dark="dark"
                        responsive
                        :busy="isBusy"
                        primary-key="title"
                        :tbody-transition-props="transProps"
                >
                    <div slot="table-busy" class="text-center text-success my-2">
                        <b-spinner class="align-middle" />
                        <strong>Loading...</strong>
                    </div>
                    <template slot="actions" slot-scope="row">
                        <b-button variant="danger" @click="deleteSong(row.item)">
                            Xóa
                        </b-button>
                        <b-button v-if="row.index !== 0" variant="primary" @click="goToFirst(row.index)">
                            Ưu Tiên
                        </b-button>
                    </template>
                </b-table>
            </b-col>
        </b-row>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "ListComponent",
        data() {
            return {
                transProps: {
                    name: 'flip-list'
                },
                fields: [
                    {
                        key: 'title',
                        label: 'Tên Bài Hát',
                    },
                    {
                        key: 'actions',
                        label: 'Hành Động',
                    },
                ],
                songs: [],
                songData: [],
                playing: null,
                bordered: true,
                outlined: true,
                dark:true,
                hover: true,
                fixed: false,
                isBusy: true,
            }
        },
        methods: {
            deleteSong(item) {
                axios.post('/api/song/delete', {node: item.node})
                    .then(function (response) {

                    })
                    .catch(function (error) {

                    });
            },
            goToFirst(index) {
                let item = [];
                let data = {};
                item.push(this.songs[index]);
                this.songs = _.union(item, this.songs);
                this.songs.forEach(function (item, key) {
                    item.order = key + 1;
                   data[item.node] = item;
                });
                axios.post('/api/song/add-first', data)
                    .then(function (response) {
                        //console.log(response.data);
                    })
                    .catch(function (error) {

                    });
            },
            next() {
                axios.post('/api/song/add-playing', this.songs[0])
                    .then(function (response) {

                    })
                    .catch(function (error) {

                    });
            },
            loadData() {
                let target = this;
                this.$firebase.ref(this.$baseConfig.SONG_URL).orderByChild('order').on('value', function(data) {
                    target.songs = [];
                    data.forEach(function (item) {
                        target.songs.push(item.val());
                    });
                    target.isBusy = false;
                },function (error) {
                    console.log(error);
                });
                this.$firebase.ref(this.$baseConfig.SONG_URL).on('child_removed', function(data) {
                    delete target.songs[_.findIndex(target.songs, data.val())];
                });
                this.$firebase.ref(this.$baseConfig.PLAYING_URL).on('value', function(data) {
                    target.playing = data.val();
                });
            }
        },
        mounted() {
            this.loadData();
        }
    }
</script>

<style>
    table#table-transition .flip-list-move {
        transition: all 1s;
    }
    table#table-transition .flip-list-enter, table#table-transition .flip-list-leave-to {
        opacity: 0;
        transform: translateX(30px);
    }
</style>