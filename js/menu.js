//Markus Volkmann looping function
var autolo;
var timeinterval;
var counter = 2;
var Menubuttons = (document.getElementsByClassName("button sidebutton"));
var Homebuttons = (document.getElementsByName("looped"));
var buttons = Homebuttons;




if (localStorage.getItem("systemType") == "One"){
        autolo = true;
        timeinterval = 1000 * localStorage.getItem("loopSpeed");
        loopsym = setInterval(Incrementpositions, timeinterval)
}else if (localStorage.getItem("systemType") == "Two"){
        autolo = false;
        }



function Incrementpositions(){
var temp = window.location.href.indexOf("post") 
if(temp == -1){
               
        if (counter === 0) {
                counter++;

	} else if (counter === buttons.length - 1) {
		counter = 0;

	} else {
		counter++;
	}
        buttons[counter].focus();
}
}



function user_home_btn(event) {
        event.preventDefault();
        
        var key = event.keyCode;
        
        if (key == 32) {
                document.getElementById("user_home_btn").blur();
                document.getElementById("news_feed_btn").focus();
        }
        
        if (key == 13) {
                //alert("wait a second")
                windows.location.href = 'user_home.php';
        }
}


function news_feed_btn(event) {
        event.preventDefault();
        
        var key = event.keyCode;
        
        if (key == 32) {
                document.getElementById("news_feed_btn").blur();
                document.getElementById("new_post_btn").focus();
        }
        
        if (key == 13) {
                key.preventDefault();
                key.stopPropagation();
                windows.location.href = 'view_feed.php';
        }
}


function create_post_btn(event) {
        event.preventDefault();
        
        var key = event.keyCode;
        
        if (key == 32) {
                document.getElementById("new_post_btn").blur();
                document.getElementById("message_post_btn").focus();
        }
        
        if (key == 13) {
                key.preventDefault();
                key.stopPropagation();
                windows.location.href = 'create_post.php';
        }
}


function message_btn(event) {
        event.preventDefault();
        
        var key = event.keyCode;
        
        if (key == 32) {
                document.getElementById("message_post_btn").blur();
                document.getElementById("events_btn").focus();
        }
        
        if (key == 13) {
                //key.preventDefault();
                //key.stopPropagation();
                windows.location.href = 'friends.php';
        }
}


function events_btn(event) {
        event.preventDefault();
        
        var key = event.keyCode;
        
        if (key == 32) {
                document.getElementById("events_btn").blur();
                document.getElementById("user_home_btn").focus();
        }
        
        if (key == 13) {
                key.preventDefault();
                key.stopPropagation();
                windows.location.href = 'events.php';
        }
}


//Siu Keun Hoh
//Script for creating functions that plays the audio files

/*
var x = document.getElementById("getHelp");

function getHelpAudio() {
    x.play();
} */
    
var playHome = document.getElementById("home");
var playNewsfeed = document.getElementById("newsfeed");
var playNewPost = document.getElementById("newPost");
var playMessage = document.getElementById("message");
var playEvents = document.getElementById("events");
    
function homeAudio() {
        stopAudio(events);
        playHome.play();
}
    
function newsfeedAudio() {
        stopAudio(home);
        playNewsfeed.play();
}
    
function newPostAudio() {
        stopAudio(newsfeed);
        playNewPost.play();
}
    
function messageAudio() {
        stopAudio(newPost);
        playMessage.play();
}
    
function eventsAudio() {
        stopAudio(message);
        playEvents.play();
}
    
//Used for pausing and resetting the audio to prevent overlap
function stopAudio(audio) {
        audio.pause();
        audio.currentTime = 0;
}