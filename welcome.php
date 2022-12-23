<?php
session_start();
if(empty($_SESSION['login'])){
    header("loaction:index.php");
    exit;
}
?>
<!DOCTYPE html>

<head>
    <title>Music Player</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=neon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
</head>
<body>
    <div class="welcome">
        <div>
            <h1 class="font-effect-neon">WELCOME!!</h1>
        </div>
        <hr>
        <br>
        <div>
            <p class="font-effect-neon">To Our Music Player</p>
        </div>
    </div>
    <div class="songItem">
        <div class="track_name">
            <marquee id="song_name">No Song</marquee>
        </div>
        <audio src="bcs.mp3" id="audio_player"></audio>
        <div class="Control">
            <span class="buttons">
                <span class="prev-track" onclick="prevTrack()">
                    <i class="fa fa-step-backward fa-1x"></i>
                </span>
                <span class="playpause-track" onclick="playpauseTrack()">
                    <i class="btn fa fa-play-circle fa-2x" id="play_pause_btn"></i>
                </span>
                <span class="next-track" onclick="nextTrack()">
                    <i class="fa fa-step-forward fa-1x"></i>
                </span>
            </span>
            <span>
                <span class="current-time">00:00</span>
                <input type="range" min="0" max="100" value="0" class="seek_slider" onchange="seekTo()">
                <span class="total-duration">00:00</span>
            </span>
        </div>
        <div class="Sound">
            <i class="fa fa-volume-up"></i>
            <input type="range" min="1" max="100" value="99" class="volume_slider" onchange="setVolume()">
        </div>
    </div>
    <script>
        var audio_player = document.querySelector('#audio_player');
        const pauseIconClassName = 'fa-pause-circle'
        const playIconClassName = 'fa-play-circle'
        var buttonElement = document.querySelector('#play_pause_btn');
        var track_index = 0;

        var song_name = document.querySelector('#song_name');
        var seek_slider = document.querySelector('.seek_slider');

        let curr_time = document.querySelector('.current-time');
        let total_duration = document.querySelector('.total-duration');

        let volume_slider = document.querySelector('.volume_slider');

        const music_list = [
            {
                name: 'Better Call Saul',
                music: 'bcs.mp3'
            },
            {
                name: 'Perfect Girl',
                music: 'pg.mp3'
            },
            {
                name: 'Resonance',
                music: 'res.mp3'
            },
            {
                name: 'Where is My Mind',
                music: 'pixies.mp3'
            },
            {
                name: 'Summertime',
                music: 'summer.mp3'
            },
            {
                name: 'Somebody That I Used to Know',
                music: 'gotye.mp3'
            }
        ];

        var updateTimer;
        const loadTrack = (track_index) => {
            clearInterval(updateTimer);
            reset();
            var currnt_song = music_list[track_index];
            audio_player.src = currnt_song.music;
            song_name.innerHTML = currnt_song.name;

            setTimeout(() => {
                setUpdate()
            }, 300)
            updateTimer = setInterval(setUpdate, 1000);

        }

        loadTrack(track_index);

        const playpauseTrack = () => {


            const isPlayButton = buttonElement.classList.contains(playIconClassName)

            if (isPlayButton) {
                buttonElement.classList.remove(playIconClassName)
                buttonElement.classList.add(pauseIconClassName)
                audio_player.play()
            }
            else {
                buttonElement.classList.remove(pauseIconClassName)
                buttonElement.classList.add(playIconClassName)
                audio_player.pause()
            }
        }

        const prevTrack = () => {
            track_index = track_index - 1;
            if (track_index < 0) {
                track_index = music_list.length - 1;
            }
            loadTrack(track_index);
            buttonElement.classList.remove(playIconClassName)
            buttonElement.classList.add(pauseIconClassName)
            audio_player.play()
        }

        const nextTrack = () => {
            track_index = track_index + 1;
            if (track_index > music_list.length - 1) {
                track_index = 0;
            }
            loadTrack(track_index);
            buttonElement.classList.remove(playIconClassName)
            buttonElement.classList.add(pauseIconClassName)
            audio_player.play()
        }
        function reset() {
            curr_time.textContent = "00:00";
            total_duration.textContent = "00:00";
            seek_slider.value = 0;
        }
        function setVolume() {
            audio_player.volume = volume_slider.value / 100;
        }
        function seekTo() {
            let seekto = audio_player.duration * (seek_slider.value / 100);
            audio_player.currentTime = seekto;
        }

        function setUpdate() {
            var audio_player = document.querySelector('#audio_player');
            let seekPosition = 0;
            if (audio_player.duration) {
                seekPosition = audio_player.currentTime * (100 / audio_player.duration);
                seek_slider.value = seekPosition;

                let currentMinutes = Math.floor(audio_player.currentTime / 60);
                let currentSeconds = Math.floor(audio_player.currentTime - currentMinutes * 60);
                let durationMinutes = Math.floor(audio_player.duration / 60);
                let durationSeconds = Math.floor(audio_player.duration - durationMinutes * 60);

                if (currentSeconds < 10) { currentSeconds = "0" + currentSeconds; }
                if (durationSeconds < 10) { durationSeconds = "0" + durationSeconds; }
                if (currentMinutes < 10) { currentMinutes = "0" + currentMinutes; }
                if (durationMinutes < 10) { durationMinutes = "0" + durationMinutes; }

                curr_time.textContent = currentMinutes + ":" + currentSeconds;
                total_duration.textContent = durationMinutes + ":" + durationSeconds;
            }
        }
    </script>
    <script src="code.js"></script>
</body>
</html>