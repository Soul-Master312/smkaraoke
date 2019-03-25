<template>
    <div>
        <b-row>
            <b-col cols="12">
                <b-form @submit.prevent="searchByName">
                    <b-form-group>
                        <b-input type="text" v-model="form.key_word" id="key_word" placeholder="Nhập tên bài hát cần tìm" />
                        <b-form-invalid-feedback :state="!form.errors.has('key_word')">
                            {{ form.errors.first('key_word') }}
                        </b-form-invalid-feedback>
                    </b-form-group>
                    <b-button variant="primary" @click="searchByName">Tìm</b-button>
                </b-form>
            </b-col>

            <div class="row mt-5" v-if="!loading">
                <div class="col-3" v-for="(value, key) in songs" @click="info(value)">
                    <b-media tag="li" >
                        <b-img thumbnail fluid :src="value.snippet.thumbnails.medium.url" alt="placeholder" />
                        <h6 class="mt-0 mb-1">{{ value.snippet.title }}</h6>
                    </b-media>
                </div>
            </div>
        </b-row>
        <div class="text-center" v-if="loading">
            <b-spinner variant="primary" label="Text Centered" />
        </div>
        <!-- Info modal -->
        <b-modal id="modalInfo" ref="songModalRef" :title="title" hide-footer>
            <div class="d-block text-center">
                <h4>{{ modalInfo.snippet.title }}</h4>
            </div>
            <b-button class="mt-3" variant="outline-primary" @click="add()" block>Thêm</b-button>
            <b-button class="mt-2" variant="outline-warning" @click="addFirst()" block>Chèn</b-button>
        </b-modal>

        <!-- Success modal -->
        <b-modal @hide="hideSpinner" @show="hideModalSuccess" id="modalSuccess" ref="modalSuccessRef" hide-footer hide-header>
            <b-alert show variant="success">Chọn bài thành công</b-alert>
        </b-modal>
    </div>
</template>

<script>
    import Form from 'form-backend-validation';
    import axios from 'axios';

    export default {
        name: "FindComponent",
        data() {
            return {
                form: new Form({
                    key_word: ''
                }),
                songs: [],
                loading: false,
                title: "Chọn bài hát",
                modalInfo: {snippet: {title: ''}},
                total: 0
            }
        },
        methods: {
            searchByName() {
                this.loading = true;
                this.form.post('/api/search_by_name')
                    .then(response => {
                        this.loading = false;
                        this.songs = response.data.items;
                    })
                    .catch(response => {
                        this.loading = false;
                    });
            },
            add() {
                let target = this;
                this.loading = true;
                this.$refs.songModalRef.hide();
                axios.post('/api/song/add', {title: this.modalInfo.snippet.title, videoId: this.modalInfo.id.videoId, order: this.total + 1})
                    .then(function (response) {
                        //console.log(response);
                        target.$refs.modalSuccessRef.show();
                    })
                    .catch(function (error) {
                        //console.log(error);
                        target.loading = false;
                    });
            },
            addFirst() {
                this.$refs.songModalRef.hide();
            },
            info(item) {
                this.modalInfo = item;
                this.$root.$emit('bv::show::modal', 'modalInfo')
            },
            hideSpinner() {
                this.loading = false;
            },
            hideModalSuccess() {
                let target = this;
                setTimeout(function () { target.$refs.modalSuccessRef.hide() } , 2000);
            },
            loadData() {
                let target = this;
                this.$firebase.ref(this.$baseConfig.SONG_URL).on('value', function(data) {
                    target.total = _.size(data.val());
                });
            }
        },
        mounted() {
            this.loadData();
        }
    }
</script>

<style scoped>

</style>