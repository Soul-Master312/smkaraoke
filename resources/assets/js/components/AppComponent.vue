<template>
    <div>
        <div id="preloader">
            <div id="loader"></div>
        </div>

        <HeaderComponent></HeaderComponent>

        <router-view></router-view>

        <FooterComponent></FooterComponent>
    </div>
</template>

<script>
    import HeaderComponent from './layout/HeaderComponent';
    import FooterComponent from './layout/FooterComponent';

    export default {
        name: "AppComponent",
        components: {FooterComponent, HeaderComponent},
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