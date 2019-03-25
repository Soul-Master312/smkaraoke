<template>
    <b-container id="sm-footer" class="mt-5">
        <h5>
            Make by Soul Master
        </h5>
    </b-container>
</template>

<script>
    export default {
        name: "FooterComponent",
        data() {
            return {
                currentYear: '',
            };
        },
        methods: {

        },
        mounted() {
            this.currentYear = new Date().getFullYear();
        }
    }
</script>

<style scoped>

</style>