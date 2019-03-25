<template>
    <!-- header
        ================================================== -->
    <b-container id="sm-header">
        <div id="mySidenav" class="sm-sidenav">
            <a href="javascript:void(0)" class="closebtn sm-close-nav" id="sm-close-nav">&times;</a>
            <router-link class="sm-close-nav" :to="{ name: 'frontend.index'}">Home</router-link>
            <router-link class="sm-close-nav" :to="{ name: 'frontend.find'}">Chọn bài</router-link>
            <router-link class="sm-close-nav" :to="{ name: 'frontend.list'}">Danh sách đã chọn</router-link>
        </div>
        <!-- Use any element to open the sidenav -->
        <h3 id="sm-open-nav" class="mt-5 mb-5">☰</h3>
    </b-container> <!-- end header -->
</template>

<script>
    export default {
        name: "HeaderComponent"
    }
</script>

<style scoped>

</style>