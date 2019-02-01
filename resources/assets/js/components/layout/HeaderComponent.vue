<template>
    <!-- header
        ================================================== -->
    <header class="s-header">

        <div class="header-logo">
            <router-link :to="{ name: 'frontend.index'}">{{ trans('home.logo') }}</router-link>
        </div>

        <nav class="row header-nav-wrap wide">
            <ul class="header-main-nav">
                <li>
                    <router-link :to="{ name: 'frontend.room.list'}">{{ trans('home.menu.list room') }}</router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'frontend.room.create'}">{{ trans('home.menu.create room') }}</router-link>
                </li>
            </ul>

            <ul class="header-social">
                <li><a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
            </ul>
        </nav>

        <a class="header-menu-toggle" href="#"><span>Menu</span></a>

    </header> <!-- end header -->
</template>

<script>
    export default {
        name: "HeaderComponent"
    }
</script>

<style scoped>

</style>