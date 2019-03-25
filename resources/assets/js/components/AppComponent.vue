<template>
    <div>
        <HeaderComponent></HeaderComponent>

        <b-container class="sm-content">
            <router-view></router-view>
        </b-container>

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