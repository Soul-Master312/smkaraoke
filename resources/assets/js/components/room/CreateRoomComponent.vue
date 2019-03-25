<template>
    <div>
        <CreateRoomIntroComponent></CreateRoomIntroComponent>
        <div class="blog-content-wrap">
            <div class="row blog-content">
                <div class="row comment-respond">

                    <!-- START respond -->
                    <div id="respond" class="col-lg-12">
                        <b-form @submit="onSubmit">
                            <b-form-group
                                    id="exampleInputGroup1"
                                    :label="trans('createroom.form.room name')"
                                    label-for="room_name"
                                    class="full-width">
                                <b-form-input
                                        id="room_name"
                                        type="text"
                                        v-model="room.room_name"
                                        name="room_name"
                                        class="full-width"
                                        placeholder="" />
                                <div class="el-form-item__error" v-if="form.errors.has('room_name')"
                                     v-text="form.errors.first('room_name')"></div>
                            </b-form-group>

                            <b-button class="btn btn--primary btn-wide btn--large full-width"
                                      type="submit"
                                      variant="primary">
                                {{ trans('createroom.button.accept') }}
                            </b-button>
                        </b-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CreateRoomIntroComponent from "./import/CreateRoomIntroComponent";
    import Form from 'form-backend-validation';

    export default {
        name: "CreateRoomComponent",
        components: {CreateRoomIntroComponent},
        data() {
            return {
                loading: false,
                room: {
                    room_name: '',
                    user_name: '',
                    password: '',
                    password_confirmation: ''
                },
                form: new Form(),
            }
        },
        methods: {
            onSubmit() {
                this.form = new Form(_.merge(this.room));
                this.loading = true;
                this.form.post('/api/room/create')
                    .then((response) => {
                        this.$store.dispatch('login', response.data).then(() => {
                            this.$message({
                                type: 'success',
                                message: response.message,
                            });
                            this.$router.push({ name: 'frontend.room', params: {identifier: response.data.user.identifier} });
                        });
                        this.loading = false;
                    })
                    .catch((error) => {
                        this.loading = false;
                        this.$notify.error({
                            title: this.trans('message.error.title'),
                            message: this.trans('message.error.form error'),
                        });
                    });
            }
        }
    }
</script>

<style scoped>

</style>