<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="{{ asset("public/images/karaoke.jpg") }}" type="image/x-icon">
        <title>Karaoke - Soulmaster</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <style>
            *{
                margin: 0;
                padding:0;
                box-sizing: border-box;
            }
            img {
                max-width: 100%;
                height: auto;
            }
            .container_playlist {
                max-height: 430px;
                overflow-y: scroll;
            }
            .table tbody tr {
                display: none;
            }
            .footer {
                margin-top: 2em;
                text-align: center;
            }
            .input_search {
                margin-top: 2em;
            }
            .loader {
                border-top: 5px solid blue;
                border-right: 5px solid green;
                border-bottom: 5px solid red;
                border-left: 5px solid pink;
                border-radius: 50%;
                width: 24px;
                height: 24px;
                animation: spin 2s linear infinite;
            }
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="jumbotron">
                <h1>Karaoke Soulmaster</h1>
                <p>Let's believe that everyone can be singer.</p>
            </div>
            <div class="row">
                <div class="col-sm-8" style="margin-bottom: 5px;">
                    <div class="embed-responsive embed-responsive-16by9">
                        <div id="player" class="embed-responsive-item"></div>
                        {{--<iframe class="embed-responsive-item" id="karaoke" src="https://www.youtube.com/embed/"></iframe>--}}
                    </div>
                </div>
                <div class="col-sm-4 container_playlist">
                    <button type="button" style="float: right;" onclick="nextSong()" class="btn btn-primary">Next Song <span class="glyphicon glyphicon-menu-right"></span></button>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th rowspan="2">Selected Songs: <span class="badge" id="numberOfSongs">0</span></th>
                            </tr>
                        </thead>
                        <tbody class="list_songs" id="sortable">
                            
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-12 input_search">
                    <div class="form-group">
                        <p class="text-danger text_error"></p>
                        <input type="text" class="form-control" placeholder="type name of song which you want to search in here" id="keyWord">
                    </div>
                    <div class="row list_videos">

                    </div>
                </div>
            </div>
            <div class="footer">
                Since 2017. Make by SoulMaster
            </div>
        </div>
        <script src="https://www.gstatic.com/firebasejs/4.2.0/firebase.js"></script>
        <script>
            var config = {
                apiKey: "AIzaSyAWDh8jRyaCtB3OlU48_ujUKKZIte7q1WA",
                authDomain: "karaoke-soulmaster.firebaseapp.com",
                databaseURL: "https://karaoke-soulmaster.firebaseio.com/",
                storageBucket: "karaoke-soulmaster.appspot.com",
                messagingSenderId: "416394444100",
            };
            var check = false;
            function get_key() {
                return firebase.database().ref().child('songs').push().key;
            }
            firebase.initializeApp(config);
            var ref = firebase.database().ref('list-songs/');
            ref.once('value').then(function(snapshot) {
                snapshot.forEach(function(childSnapshot) {
                    add_song(childSnapshot.key, childSnapshot.val().id, childSnapshot.val().title);
                });
                check = true;
            });
            ref.on('child_added', function(snapshot) {
                if(check){
                    add_song(snapshot.key, snapshot.val().id, snapshot.val().title);
                }
            });
            ref.on('child_removed', function(snapshot) {
                var target = $('#' + snapshot.key);
                var key = $('.list_songs tr').first().attr('id');
                if (target.length > 0){
                    target.fadeOut(500,function () {
                        target.remove();
                        countSong();
                        if ($('.list_songs').find('tr').length > 0) {
                            if (key == snapshot.key){
                                player.loadVideoById($('.list_songs tr').first().attr('data-id'));
                            }
                        }else{
                            player.loadVideoById("");
                        }
                    });
                }
            });

            function add_song(key, id, title) {
                html = `
                     <tr class="song ui-state-default" id="`+ key +`" data-key="`+ key +`" data-id="`+ id +`" data-title="`+ title +`">
                        <td>`+ title +`</td>
                        <td class="playing">
                            <button type="button" class="btn btn-danger btn-xs deleteSong"><span class="glyphicon glyphicon-minus"></span></button>
                        </td>
                     </tr>
                `;
                $('.table tbody').append(html).fadeIn(500,function () {
                    $(this).find('tr').fadeIn(500);
                    countSong();
                });
                if (Number($('#numberOfSongs').html()) === 1) player.loadVideoById(id);
            }
            $('body').on('click','.addSong', function(){
                var target = $(this).closest('.thumbnail');
                add_firebase(get_key(), target.attr('data-id'), target.attr('data-title'));
            });
            $('body').on('click','.deleteSong', function(){
                delete_firebase($(this).closest('.song').attr('data-key'));
            });

            var tag = document.createElement('script');
            tag.src = "https://www.youtube.com/iframe_api";
            var ScriptTag = document.getElementsByTagName('script')[0];
            ScriptTag.parentNode.insertBefore(tag, ScriptTag);

            var player;
            function onYouTubeIframeAPIReady() {
                player = new YT.Player('player', {
                    events: {
                        'onReady': onPlayerReady,
                        'onStateChange': onPlayerStateChange
                    }
                });
            }
            function onPlayerReady(event) {
//                event.target.playVideo();
            }
            function onPlayerStateChange(event) {
                if (event.data == YT.PlayerState.ENDED) {
                    nextSong();
                }
            }
            function nextSong() {
                $('.list_songs tr').first().fadeOut(500,function () {
                    delete_firebase($(this).attr('data-key'));
                    $(this).remove();
                    countSong();
                    if ($('.list_songs').find('tr').length > 0) {
                        player.loadVideoById($('.list_songs tr').first().attr('data-id'));
                    }else{
                        player.loadVideoById("");
                    }
                });
            }
            $(function() {
                //sortable
                $(".list_songs").sortable({
                    items: '.song:not(.fixed)',
                    group: 'no-drop',
                    drop: false,
                    axis: 'y',
                });
                $(".list_songs").disableSelection();
            });
            function countSong() {
                $('#numberOfSongs').html($('.table tbody').find('tr').length);
                var target = $('.list_songs tr').first();
                target.addClass('fixed');
                target.find('.playing').empty();
                target.find('.playing').append(`<div class="loader"></div>`);
            }
            function delete_firebase(key) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    url: '',
                    type: "POST",
                    data: {'key': key},
                    success: function (response) {
//                      console.log(response);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
            function add_firebase(key, id, title) {
                $.ajax({
                    url: "create",
                    type: "GET",
                    data: {'key': key, 'id':id,'title':title},
                    success: function (response) {
//                      console.log(response);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
            function search() {
                $('.list_videos').empty();
                $.ajax({
                    url: "",
                    type: "GET",
                    data: {'key':$('#keyWord').val()},
                    success: function (response) {
                     console.log(JSON.stringify(response));
                        var items = response.items;
                        if (response.items.length === 0) {
                            $('.text_error').html('Can not find the song which as you want');
                            return;
                        }
                        var html = "";

                        for (var i in items){
                            if (Number(i)%4 === 0){
                                if (Number(i) === 0){
                                    html += `<div class="col-sm-12">`;
                                }else{
                                    html +=  `</div>` + `<div class="col-sm-12">`;
                                }

                            }
                            html += `
                                <div class="col-sm-3" data-toggle="tooltip" title='`+ items[i].snippet.description +`'>
                                    <div class="thumbnail" data-id="`+ items[i].id.videoId +`" data-title="`+ items[i].snippet.title +`">
                                        <img src="`+ items[i].snippet.thumbnails.high.url +`"></img>
                                        <div class="caption">
                                            <p>`+ items[i].snippet.title +`</p>
                                        </div>
                                        <button type="button" class="btn btn-success addSong"><span class="glyphicon glyphicon-plus"></span></button>
                                     </div>
                                </div>
                            `;
                        }
                        $('.list_videos').append(html);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
            $('#keyWord').on('keyup', function(e){
                if (e.which==13 || e.which==9) {
                    $(this).attr('disabled', true);
                    setTimeout(function(){ $('#keyWord').attr('disabled', false); }, 5000);
                    search();
                }
            });
        </script>
    </body>
</html>
