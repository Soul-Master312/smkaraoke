<template>
    <div>
        <div id="preloader">
            <div id="loader"></div>
        </div>

        <HeaderComponent></HeaderComponent>

        <HomeIntroComponent v-if="currentRouteName === 'frontend.index'"></HomeIntroComponent>

        <router-view></router-view>

        <FooterComponent></FooterComponent>
    </div>
</template>

<script>
    import HeaderComponent from './layout/HeaderComponent';
    import FooterComponent from './layout/FooterComponent';
    import HomeIntroComponent from './layout/HomeIntroComponent';

    export default {
        name: "AppComponent",
        components: {HomeIntroComponent, FooterComponent, HeaderComponent},
        data() {
            return {
                currentRouteName : '',
            };
        },
        mounted() {
            this.currentRouteName = this.$router.currentRoute.name;
        }
    }
</script>

<style scoped>

</style>