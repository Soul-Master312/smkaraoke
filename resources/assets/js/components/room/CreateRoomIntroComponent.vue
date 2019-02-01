<template>
    <section class="page-header" style="border:none">

        <div class="row page-header__content narrower text-center">
            <div class="col-full">

                <h3 class="subhead">Our Blog.</h3>
                <h1 class="display-1">
                    Thoughts, Ideas, Insights and Other Stuff.
                </h1>

                <a href="#0" class="page-header__search-trigger">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <span>Search the blog</span>
                </a>
                <div class="page-header__search">
                    <form role="search" method="get" class="page-header__search-form" action="#">
                        <label>
                            <span class="hide-content">Search for:</span>
                            <input type="search" class="search-field" placeholder="Type Keywords" value="" name="s" title="Search for:" autocomplete="off">
                        </label>
                        <input type="submit" class="search-submit" value="Search">
                    </form>

                    <a href="#0" title="Close Search" class="page-header__overlay-close">Close</a>
                </div>  <!-- end page-header__search -->

            </div>
        </div>

    </section>
</template>

<script>
    export default {
        name: "CreateRoomIntroComponent"
    }
</script>

<style scoped>

</style>