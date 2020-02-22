/*	Element selectors	*/
var pictureButton = document.querySelector("#pictureBtn");
var textArea = document.querySelector("textarea");
var modal = document.querySelector(".modal");
var images = [].slice.call(document.querySelectorAll(".modal img"));
var displayPic = document.querySelector("#selectedPicture");
var selectButton = document.querySelector("#selectPicButton");
var cancelButton = document.querySelector("#cancelPicButton");
var picM = document.querySelector("#picM");	// This is the one used to send the selected picture
var upload = document.querySelector(".upload");
var uploadURL = document.querySelector("#uploadURL");
var localURL = document.querySelector("#uploadLocal");


var theSource;
var isTrue = false;
var disable = false;
var number = 0;

var isUpload = false;	// If upload local is true, don't disable the upload 

mainFunc();	// Calls main function



/* functions below	
	- Levi
*/
/*********		For resetting pictures using the mouse button		*********/
function resetColor() {
	//	Used for resetting	
		for (var i = 0; i < images.length - 2; i++) {
			//images[i].removeAttribute("id");
			images[i].classList.remove("imageHover");
		}
};

function resetColor2() {
	for (var i = 0; i < images.length - 2; i++) {
		images[i].removeAttribute("id");
	}
}

$("#uploadLocal").change(function() {
		displayPic.src = window.URL.createObjectURL(this.files[0]);

		modal.classList.add("hideModal");
		displayPic.style.display = "block";
		isTrue = true;
		document.getElementById("pictureBtn").focus();
		picM.value = displayPic.src;
		//checker();
		decider = true;
		counter = 10;
		disable = false;
		upload.classList.toggle("uploadVisibility");
		localURL.classList.toggle("uploadVisibility");

		isUpload = true;		

		upload.style.color = "Grey";
		uploadURL.disabled = true;
		uploadURL.placeholder = "";
});


function pictureButtonFunc() {
	disable = true;
	decider = false;
	// Used for toggling the textarea to be small or big depending if the user wants to use a picture
	if (isTrue == false) {
		textArea.classList.toggle("textBig");
		textArea.classList.toggle("textSmall");
	}
	document.getElementById("pictureBtn").blur();
	modal.classList.toggle("hideModal");
	upload.classList.toggle("uploadVisibility");
	localURL.classList.toggle("uploadVisibility");

	/*	This means, if the user is trying to upload a picture locally, then dont disable the form for uploading locally	*/
	if (isUpload == false) {
		checker();
	}
}

function selectPicture() {
	if (document.getElementById("uploadURL").value != ""){
		displayPic.src = document.getElementById("uploadURL").value;
	} else {
		displayPic.src = theSource;
	}

	modal.classList.add("hideModal");
	displayPic.style.display = "block";
	isTrue = true;
	document.getElementById("pictureBtn").focus();
	picM.value = displayPic.src;
	checker();
	decider = true;
	counter = 10;
	disable = false;
	upload.classList.toggle("uploadVisibility");
	localURL.classList.toggle("uploadVisibility");
}

function selectPicture2(e) {
		if (document.getElementById("uploadURL").value != ""){
			displayPic.src = document.getElementById("uploadURL").value;
		} else {
			displayPic.src = theSource;
		}
		modal.classList.add("hideModal");
		displayPic.style.display = "block";
		isTrue = true;
		picM.value = displayPic.src;
		checker();
		decider = true;
		counter = 10;
		disable = false;
		upload.classList.toggle("uploadVisibility");
		localURL.classList.toggle("uploadVisibility");
		e.preventDefault();
		e.stopPropagation();
		document.getElementById("pictureBtn").focus();
}

function cancelButtonFunc() {
	modal.classList.toggle("hideModal");
	upload.classList.toggle("uploadVisibility");
	localURL.classList.toggle("uploadVisibility");
	document.getElementById("pictureBtn").focus();
	decider = true;
	counter = 10;
	disable = false;
	displayPic.src = "#";
	picM.value = "";
	displayPic.style.display = "none";

	isTrue = false;
	if (isTrue == false) {
		textArea.classList.toggle("textBig");
		textArea.classList.toggle("textSmall");
	}
	isUpload = false;
	checker();
}

/* This is the main function, which runs everything on the page.
   I decided to put everything inside one function to make it cleaner, and easier to read.. */
function mainFunc() {
	// Event listeners
	pictureButton.addEventListener("click", pictureButtonFunc);			//	Button for the picture to show the 6 pictures	
	//selectButton.addEventListener("click", selectButtonFunc);			//	Select button for the pictures 
	cancelButton.addEventListener("click", cancelButtonFunc);
	reactButtonPoster();
}

// If a user decides to select a pre-uploaded picture,
// then the form for inserting a URL will be disabled.
function checker() {
	var thisSrc = displayPic.src;

	if (thisSrc.indexOf("#") >= 0) {
		uploadURL.disabled = false;
		localURL.disabled = false;
	} else {
		upload.style.color = "Grey";
		uploadURL.disabled = true;
		uploadURL.placeholder = "";

		localURL.disabled = true;
		localURL.style.color = "Grey";
		localURL.value = "";
		localURL.placeholder = "";
	}
}

// This function is necessary for IE11, because inputs and buttons are not allowed 
// outside of the form, therefore, I implemented hidden inputs and buttons inside the form
// which will be activated and sent when the inputs and buttons that are outside are used.
function reactButtonPoster() {
	var reactButtonPost = document.querySelector("#reactButtonPost");
	var hiddenSubmit = document.querySelector("#hiddenSubmit");
	var hiddenURL = document.querySelector("#hiddenUploadURL");

	reactButtonPost.addEventListener("click", function () {
		hiddenURL.value = uploadURL.value;
		hiddenSubmit.click();
	});
}
/*********************************************************************************/
images[0].id = "imageHover";
images.push(selectButton);
images.push(cancelButton);
var counter = 10;

var zFocused = (document.activeElement === pictureButton);

// If spacebar is pressed and decider is false (meaning the modal is showing)
window.addEventListener("keydown", function (e) {
	if (e.keyCode == "32" && decider == false) {
		if (counter < 5) {
			resetColor();
			counter++;
			images[counter].classList.add("imageHover");
			

		} else if (counter === 5) {
			resetColor();
			counter += 2;
			images[counter].focus();
			e.preventDefault();

		} else if (counter === 7) {
			resetColor();
			counter = 0;
			e.preventDefault();
			images[7].blur();
			images[counter].classList.add("imageHover");
		} 
	}

	if ((e.keyCode == "13" && counter == 10) && (disable === true)) {
		counter = 0;
		images[0].classList.add("imageHover");
		
	} else  if ((e.keyCode == "13" && decider == false) && counter == 0) {
		resetColor2();
		theSource = images[counter].src;
		images[counter].id = "imageSelected";

		selectPicture2(e);

	} else if ((e.keyCode == "13" && decider == false) && counter == 1) {
		resetColor2();
		theSource = images[counter].src;
		images[counter].id = "imageSelected";
		
		selectPicture2(e);

	} else if ((e.keyCode == "13" && decider == false) && counter == 2) {
		resetColor2();
		theSource = images[counter].src;
		images[counter].id = "imageSelected";
		
		selectPicture2(e);

	} else if ((e.keyCode == "13" && decider == false) && counter == 3) {
		resetColor2();
		theSource = images[counter].src;
		images[counter].id = "imageSelected";
		
		selectPicture2(e);

	} else if ((e.keyCode == "13" && decider == false) && counter == 4) {
		resetColor2();
		theSource = images[counter].src;
		images[counter].id = "imageSelected";
		
		selectPicture2(e);

	} else if ((e.keyCode == "13" && decider == false) && counter == 5) {
		resetColor2();
		theSource = images[counter].src;
		images[counter].id = "imageSelected";

		selectPicture2(e);
	}
});

/***	Below is for clicking the pictures, **/
		images[0].addEventListener("click", function() {
				counter = 0;
				theSource = this.src;
				resetColor();
				resetColor2();
				this.id = "imageSelected";
				selectPicture();
		});
		images[1].addEventListener("click", function() {
				counter = 1;
				theSource = this.src;
				resetColor();
				resetColor2();
				this.id = "imageSelected";
				selectPicture();
		});
		images[2].addEventListener("click", function() {
				counter = 2;
				theSource = this.src;
				resetColor();
				resetColor2();
				this.id = "imageSelected";
				selectPicture();
		});
		images[3].addEventListener("click", function() {
				counter = 3;
				theSource = this.src;
				resetColor();
				resetColor2();
				this.id = "imageSelected";
				selectPicture();
		});
		images[4].addEventListener("click", function() {
				counter = 4;
				theSource = this.src;
				resetColor();
				resetColor2();
				this.id = "imageSelected";
				selectPicture();
		});
		images[5].addEventListener("click", function() {
				counter = 5;
				theSource = this.src;
				resetColor();
				resetColor2();
				this.id = "imageSelected";
				selectPicture();
		});	
/*********************************************************************************/
/*********************************************************************************/
/*********************************************************************************/
/*****	Below are post_heath.js contents which is now deleted	******/


// variables to keep track of focus
var footerButtons = true;
var commentFocus = false;
//var pictureFocus = false;

// variables for key presses
var nextElement = 32; // spacebar
var selectElement = 13; // enter key

var decider = true;

/* 
functions for post buttons
*/
function postBtnBack(event){
	event.preventDefault();
    var key = event.which;
	// if key pressed is the spacebar, change focus to comment button
	if (key == nextElement && decider){ 	
		document.getElementById("post_back_btn").blur();
		document.getElementById("postCommentButton").focus();
	}
	// if key pressed is the enter key
	if (key == selectElement){
		document.getElementById("post_back_btn").blur();
                document.getElementById("user_home_btn").focus();
	}	
}
function postCommentButton(event){
	event.preventDefault();
    var key = event.which;
	// if key pressed is the spacebar, change focus to picture button
	if (key == nextElement && decider){ 	
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
	if (key == nextElement && decider){ 	
		document.getElementById("pictureBtn").blur();
		document.getElementById("reactButtonPost").focus();
	}
	// if key pressed is the enter key, toggle picture selection
	if (key == selectElement && decider){ 
		pictureButtonFunc(); 
		document.getElementById("pictureBtn").blur();
	}	
}
function postSubmitButton(event){
	event.preventDefault();
    var key = event.which;
	// if key pressed is the spacebar, change focus to back button
	if (key == nextElement && decider){ 	
		document.getElementById("reactButtonPost").blur();
		document.getElementById("post_back_btn").focus();
	}
	// if key pressed is the enter key, submit post to database
	if (key == selectElement && decider){
		// TODO - submit post to database
		var hiddenSubmit = document.querySelector("#hiddenSubmit");
		textArea.value.trim();		// trims spaces
		hiddenSubmit.click();
	}	
}