<template>
    <div>
        <CreateRoomIntroComponent></CreateRoomIntroComponent>
        <div class="blog-content-wrap">
            <div class="row blog-content">
                <div class="row comment-respond">

                    <!-- START respond -->
                    <div id="respond" class="col-full">
                        <h1>123</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CreateRoomIntroComponent from "./import/CreateRoomIntroComponent";
    export default {
        name: "RoomComponent",
        components: {CreateRoomIntroComponent},
        data() {
            return {

            }
        },
        mounted() {

        }
    }
</script>

<style scoped>

</style>