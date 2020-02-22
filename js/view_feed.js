// toggles the comment section from hidden to visible and shifts the post left when the comments are viewable
function feedBtnClickChoose(){  
		alert('feedBtnClickChoose');
 		// hide nav buttons
		document.getElementById("postNavigationButtons").style.display = "none";
		// diplay emoji/ comment buttons
		document.getElementById("choose_buttons").style.display = "block";

		// display comments
		document.getElementById("comment_space").style.display = "block";
		document.getElementById("post_view").style.left = "0%"; 

		// auto focus emoji button
		document.getElementById("emoji_button").focus();
		postNavButtons = false;
		chooseButtons = true;
}	

// variables to keep track of footer buttons
var postNavButtons = true;
var chooseButtons = false;	
var emojiSelectButtons = false;
var commentButtons = false;

// variables for key presses
var nextElement = 32; // spacebar
var selectElement = 13; // enter key

/*
functions for post navigation
*/
function feedBtnNext(event, str) {	
	event.preventDefault();
	var key = event.which;
	// if mouse is clicked, view next post
	//if (event.button == 1) {
	//	loadFeed(str);
	//}
	// if key pressed is the spacebar, change focus to choose button
	if (key == nextElement){
		document.getElementById("next_btn").blur();
		document.getElementById("choose_btn").focus();
	}
	// if key pressed is the enter key, view next post
	if (key == selectElement){ 
		loadFeed(str);
	}
}
function feedBtnPrevious(event, str) {
	event.preventDefault();
    var key = event.which;
	// if key pressed is the spacebar, change focus to next button
	if (key == nextElement){ 	
		document.getElementById("previous_btn").blur();
		document.getElementById("next_btn").focus();
	}
	// if key pressed is the enter key, view previous post
	if (key == selectElement){ 
		loadFeed(str);
	}
}
function feedBtnChoose(event) {
	event.preventDefault();
	var key = event.which;
	// if key pressed is the spacebar, change focus to the back button
	if (key == nextElement){ 
			document.getElementById("choose_btn").blur();
			document.getElementById("back_btn").focus();		
	}
	// if key pressed is the enter key or the mouse, display choose buttons and comments
	if (key == selectElement || key == 1){
		//alert('feedBtnChoose');
		feedBtnClickChoose();
	}	
}

function validateComment() {
	var content = document.forms["newCommentForm"]["content"].value;
	if (content == "") {
		alert("Please enter a comment before submitting");
		return false;
	} else if (content.length > 90) {
		alert("Please enter a comment with 90 characters or less");
		return false;
	}
}


