<!DOCTYPE html>
<html>
<head>
	<title>SNAP LOGIN</title>
	<link rel="stylesheet" type="text/css" href="css/user_login_letter.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
</head>
<body class="wrapper">
	<header>
		<h2>LOGIN</h2>
	</header>

	<section>
		<p id="label">Select the button with the letter of your first or last name, test</p>
		<p>Or click here to search all users:  <button id="search_btn" class="button" onclick="window.location.href='user_login.php?letter_group=all'">Search</button></p>
		<div id="mainBox">
			<button onclick="window.location.href='user_login.php?letter_group=ABC'" class="letters row1" id="abc" onfocus="abc_audio()" autofocus>A B C</button>
			<button onclick="window.location.href='user_login.php?letter_group=DEF'" class="letters row1" id="def" onfocus="def_audio()">D E F</button>
			<button onclick="window.location.href='user_login.php?letter_group=GHI'" class="letters row1" id="ghi" onfocus="ghi_audio()">G H I</button>
			<button onclick="window.location.href='user_login.php?letter_group=JKL'" class="letters row1" id="jkl" onfocus="jkl_audio()">J K L</button>
		</div>
		<div id="mainBox2">
			<button onclick="window.location.href='user_login.php?letter_group=MNO'" class="letters row2" id="mno" onfocus="mno_audio()">M N O</button>
			<button onclick="window.location.href='user_login.php?letter_group=PQRS'" class="letters row2" id="pqrs" onfocus="pqrs_audio()">P Q R S</button>
			<button onclick="window.location.href='user_login.php?letter_group=TUV'" class="letters row2" id="tuv" onfocus="tuv_audio()">T U V</button>
			<button onclick="window.location.href='user_login.php?letter_group=WXYZ'" class="letters row2" id="wxyz" onfocus="wxyz_audio()">W X Y Z</button>
                        
		</div>
	</section>
        <p id="label">Select your type of Navigation and Speed</p>
        <input type="text" value=3 name="Speed" id="SpeedSetting" onclick="pause()" >
        <button class="SpeedUpdate" href="javascript:;" onclick="UpdateSpeed()" >Update</button>
        <form>
                <input type="radio" name="System Type" value="One Button" id="OneBtnSym" onclick="changesym();" checked> One Button<br>
                <input type="radio" name="System Type" value="Two Button" id="TwoBtnSym" onclick="changesym();"> Two Button<br>
        </form>
        
        
        <!--The sound files are located in the /sound folder.
        Ogg format was used as it was the only(?) format that was allowed to be uploaded-->
        <audio id="abc_sound"><source src="sound/abc.ogg" type="audio/ogg"></audio>
        <audio id="def_sound"><source src="sound/def.ogg" type="audio/ogg"></audio>
        <audio id="ghi_sound"><source src="sound/ghi.ogg" type="audio/ogg"></audio>
        <audio id="jkl_sound"><source src="sound/jkl.ogg" type="audio/ogg"></audio>
        <audio id="mno_sound"><source src="sound/mno.ogg" type="audio/ogg"></audio>
        <audio id="pqrs_sound"><source src="sound/pqrs.ogg" type="audio/ogg"></audio>
        <audio id="tuv_sound"><source src="sound/tuv.ogg" type="audio/ogg"></audio>
        <audio id="wxyz_sound"><source src="sound/wxyz.ogg" type="audio/ogg"></audio>
        
        <!--Script for playing the audio files
        Was supposed to be in the user_login_letter.js file, but somehow I was not able to save the code there
        Sound files came from a free tts online website ttsmp3.com-->
        <script>
                var play_abc = document.getElementById("abc_sound");
                var play_def = document.getElementById("def_sound");
                var play_ghi = document.getElementById("ghi_sound");
                var play_jkl = document.getElementById("jkl_sound");
                var play_mno = document.getElementById("mno_sound");
                var play_pqrs = document.getElementById("pqrs_sound");
                var play_tuv = document.getElementById("tuv_sound");
                var play_wxyz = document.getElementById("wxyz_sound");

                function abc_audio() {
                        stop_audio(play_wxyz);
                        play_abc.play();
                }
                
                function def_audio() {
                        stop_audio(play_abc);
                        play_def.play();
                }
                
                function ghi_audio() {
                        stop_audio(play_def);
                        play_ghi.play();
                }
                
                function jkl_audio() {
                        stop_audio(play_ghi);
                        play_jkl.play();
                }
                
                function mno_audio() {
                        stop_audio(play_jkl);
                        play_mno.play();
                }
                
                function pqrs_audio() {
                        stop_audio(play_mno);
                        play_pqrs.play();
                }
                
                function tuv_audio() {
                        stop_audio(play_pqrs);
                        play_tuv.play();
                }
                
                function wxyz_audio() {
                        stop_audio(play_tuv);
                        play_wxyz.play();
                }
                //Used for pausing and resetting the audio to prevent overlap
                //Currently only stops the audio from the previous button playing
                function stop_audio(audio) {
                        audio.pause();
                        audio.currentTime = 0;
                }        
        </script>
        
	<script type="text/javascript" src="js/user_login_letter.js"></script>
</body>
</html>