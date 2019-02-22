<template>
    <div>
        <CreateRoomIntroComponent></CreateRoomIntroComponent>
        <div class="blog-content-wrap">
            <div class="row blog-content">
                <div class="row comment-respond">

                    <!-- START respond -->
                    <div id="respond" class="col-full">

                        <el-form ref="form" :model="room" label-width="120px" label-position="top"
                                 v-loading.body="loading"
                                 @keydown="form.errors.clear($event.target.name);">
                            <el-form-item :label="trans('createroom.form.room name')"
                                          :class="{'el-form-item is-error': form.errors.has('name') }">
                                <input v-model="room.name" class="full-width" placeholder="" type="text">
                                <div class="el-form-item__error" v-if="form.errors.has('name')"
                                     v-text="form.errors.first('name')"></div>
                            </el-form-item>
                            <el-form-item :label="trans('createroom.form.password')"
                                          :class="{'el-form-item is-error': form.errors.has('password') }">

                                <input v-model="room.password" class="full-width" placeholder="" type="password">
                                <div class="el-form-item__error" v-if="form.errors.has('password')"
                                     v-text="form.errors.first('password')"></div>
                            </el-form-item>
                            <el-form-item :label="trans('createroom.form.confirm password')"
                                          :class="{'el-form-item is-error': form.errors.has('password_confirmation') }">
                                <input v-model="room.password_confirmation" class="full-width" placeholder="" type="password">
                                <div class="el-form-item__error" v-if="form.errors.has('password_confirmation')"
                                     v-text="form.errors.first('password_confirmation')"></div>
                            </el-form-item>
                            <el-form-item>
                                <el-button style="padding: 0" class="btn btn--primary btn-wide btn--large full-width" @click="onSubmit()" :loading="loading">{{ trans('createroom.button.accept') }}</el-button>
                            </el-form-item>
                        </el-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CreateRoomIntroComponent from "./CreateRoomIntroComponent";
    import Form from 'form-backend-validation';

    export default {
        name: "CreateRoomComponent",
        components: {CreateRoomIntroComponent},
        data() {
            return {
                loading: false,
                room: {
                    name: '',
                    password: '',
                    password_confirmation: ''
                },
                form: new Form(),
            }
        },
        methods: {
            onSubmit() {
                this.form = new Form(_.merge(this.room));
                if (!this.form.couple_photo || (typeof this.form.couple_photo == 'string'))
                    delete this.form.couple_photo;
                this.loading = true;
                this.form.post('/api/room/create')
                    .then((response) => {
                        console.log(response);
                        this.loading = false;
                        this.$message({
                            type: 'success',
                            message: response.message,
                        });
                    })
                    .catch((error) => {
                        this.loading = false;
                        this.$notify.error({
                            title: 'Error',
                            message: 'There are some errors in the form.',
                        });
                    });
            }
        }
    }
</script>

<style scoped>

</style>