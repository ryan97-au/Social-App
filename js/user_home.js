/*
QUT Capstone Project 2017
Project Owner: Nursery Road State Special School

SNAP - Social Networking Action Platform

Author: Robert Piper
Author: Heath Mayocchi
Author: Levinard Hugo
Author: David Mackenzie
*/


/* User homepage focus functions */
function view_feed(event){
	event.preventDefault();
    var key = event.keyCode;
	// if key pressed is the spacebar, change focus to create post button
	if (key == 32){
		document.getElementById("view_feed_btn").blur();
		document.getElementById("create_post_btn").focus();
			
	}
	// if key pressed is the enter key, goto href view feed
	if (key == 13){
		key.preventDefault();
		key.stopPropagation();
		window.location.href = 'view_feed.php';
                
	}	
}
function create_post(event){
	event.preventDefault();
    var key = event.keyCode;
	// if key pressed is the spacebar, change focus to friends button
	if (key == 32){
		document.getElementById("create_post_btn").blur();
		document.getElementById("friends_btn").focus();
	}
	// if key pressed is the enter key, goto href view feed
	if (key == 13){
		key.preventDefault();
		key.stopPropagation();
                localStorage.setItem("Pageloop", "post");
		window.location.href = 'create_post.php';
	}	
}
function friends(event){
	event.preventDefault();
    var key = event.keyCode;
	// if key pressed is the spacebar, change focus to messages button
	if (key == 32){
		document.getElementById("friends_btn").blur();
		document.getElementById("back_btn").focus();
	}
	// if key pressed is the enter key, goto href view feed
	if (key == 13){
		key.preventDefault();
		key.stopPropagation();
		window.location.href = 'friends.php';
	}	
}
function messages(event){
	event.preventDefault();
    var key = event.keyCode;
	// if key pressed is the spacebar, change focus to create post button
	if (key == 32){
		document.getElementById("messages_btn").blur();
		document.getElementById("logout_btn").focus();
	}
	// if key pressed is the enter key, goto href view feed
	if (key == 13){
		key.preventDefault();
		key.stopPropagation();
		window.location.href = '#';
	}	
}
function logout(event){
	event.preventDefault();
    var key = event.keyCode;
	// if key pressed is the spacebar, change focus to view feed button
	if (key == 32){
		document.getElementById("logout_btn").blur();
		document.getElementById("view_feed_btn").focus();
	}
	// if key pressed is the enter key, goto href view feed
	/*if (key == 13){
		window.location.href = 'http://nrsss-snap.atwebpages.com/';
		document.getElementById("logout_btn").click();
		key.preventDefault();
		key.stopPropagation();
	}*/	
}

function homeBtnBack(event) {
        event.preventDefault();
    var key = event.keyCode;
	// if key pressed is the spacebar, change focus to view feed button
	if (key == 32){
		document.getElementById("back_btn").blur();
		document.getElementById("logout_btn").focus();
	}
	// if key pressed is the enter key, goto href view feed
        
        // not in use (this is done in main)
	if (key == 13){
                
               
                document.getElementById("back_btn").blur(); 
                document.getElementById("user_home_btn").focus();  
                
                
	}
}

