// variables to keep track of focus
var footerButtons = true;
var commentFocus = false;
var pictureFocus = false;
var Postbuttons = (document.getElementsByName("postloop"));


// variables for key presses
var nextElement = 32; // spacebar
var selectElement = 13; // enter key


//Set up loop system

if (localStorage.getItem("systemType") == "One"){
        timeinterval = 1000 * localStorage.getItem("loopSpeed");
        loopsymp = setInterval(Incrementposition, timeinterval)
}      
  
  
  function Incrementposition(){
        if (counter === 0) {
                counter++;

	} else if (counter === buttons.length - 1) {
		counter = 0;

	} else {
		counter++;
	}
        Postbuttons[counter].focus();

}
  
  
  
  
  
/* 
functions for post buttons
*/
function postBtnBack(event){
	event.preventDefault();
    var key = event.which;
	// if key pressed is the spacebar, change focus to comment button
	if (key == nextElement){ 	
		document.getElementById("post_back_btn").blur();
		document.getElementById("postCommentButton").focus();
	}
	// if key pressed is the enter key
	if (key == selectElement){
		backBtn();
	}	
}
function postCommentButton(event){
	event.preventDefault();
    var key = event.which;
	// if key pressed is the spacebar, change focus to picture button
	if (key == nextElement){ 	
		document.getElementById("postCommentButton").blur();
		document.getElementById("pictureBtn").focus();
		// if comment was focused, remove border
		if (commentFocus == true){			
			document.getElementById("postComment").style.borderTop = "none";
			document.getElementById("postComment").style.borderBottom = "none";
			commentFocus = false;
		}
	}
	// if key pressed is the enter key
	if (key == selectElement){	
		// if comment isn't focused, display border
		if (commentFocus == false){
			document.getElementById("postComment").style.borderTop = "8px dashed #ff6b6b";
			document.getElementById("postComment").style.borderBottom = "8px dashed #ff6b6b";
			commentFocus = true;
		}
		
		// if comment is focused, remove border
		else if (commentFocus == true){			
			document.getElementById("postComment").style.borderTop = "none";
			document.getElementById("postComment").style.borderBottom = "none";
			commentFocus = false;
		}
	}	
}
function postpictureButton(event){
	event.preventDefault();
    var key = event.which;
	// if key pressed is the spacebar, change focus to submit button
	if (key == nextElement){ 	
		document.getElementById("pictureBtn").blur();
		document.getElementById("reactButtonPost").focus();
	}
	// if key pressed is the enter key, toggle picture selection
	if (key == selectElement){ 
		key.preventDefault();
		key.stopPropagation();
		pictureButtonFunc(); 
	}	
}
function postSubmitButton(event){
	event.preventDefault();
    var key = event.which;
	// if key pressed is the spacebar, change focus to back button
	if (key == nextElement){ 	
		document.getElementById("reactButtonPost").blur();
		document.getElementById("post_back_btn").focus();
	}
	// if key pressed is the enter key, submit post to database
	if (key == selectElement){
		// TODO - client side validation for comment
		// TODO - submit post to database
	}	
}