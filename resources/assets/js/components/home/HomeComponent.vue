<template>
    <b-row>
        <youtube :video-id="song.videoId" :player-vars="playerVars" ref="youtube" @ended="ended" @playing="playing"></youtube>
    </b-row>
</template>

<script>
    import HomeIntroComponent from './HomeIntroComponent';
    import axios from 'axios';

    export default {
        name: "HomeComponent",
        components: {HomeIntroComponent},
        data() {
            return {
                song: {videoId: ''},
                playerVars: {
                    autoplay: 1
                },
                nextSong: {},
            }
        },
        methods: {
            playVideo() {
                this.player.playVideo();
            },
            playing() {

            },
            ended() {
                axios.post('/api/song/add-playing', this.nextSong)
                    .then(function (response) {

                    })
                    .catch(function (error) {

                    });
            },
            loadData() {
                let target = this;
                this.$firebase.ref(this.$baseConfig.PLAYING_URL).on('value', function(data) {
                    target.song = data.val();
                    target.$refs.youtube.player.playVideo();
                });
                this.$firebase.ref(this.$baseConfig.SONG_URL).orderByChild('order').limitToFirst(1).on('value', function(data) {
                    data.forEach(function (item) {
                        console.log(item.val());
                        target.nextSong = item.val();
                    });
                },function (error) {
                    console.log(error);
                });
            }
        },
        computed: {
            player() {
                return this.$refs.youtube.player;
            },
        },
        mounted() {
            this.loadData();
        }
    }
</script>

<style scoped>

</style>