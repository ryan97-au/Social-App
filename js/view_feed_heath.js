
var reactFocus = 0;
var emojiFocus = 0;

/* 
function for select button after react
*/
function reactButtonSelect(event){	
    var key = event.keyCode;
	// if key pressed is the right arrow, change focus to 'react' footer button
	if (key == 39){
			document.getElementById("prev_img").src = "img/previous_selected.png";
			document.getElementById("previous_btn").focus();
	}
	if (key == 38){
		if (reactFocus == 0){// emoji btn
			feedBtnEmoji(event);
		}
		if (reactFocus == 1){// comment btn
			feedBtnComment(event);
		}
		if (reactFocus == 2){// cancel btn
			feedBtnCancel(event);
		}
		// focus next navigation button
		document.getElementById("next_img").src = "img/next_selected.png";
		document.getElementById("next_btn").focus();
	}	
}
// function for next button key presses after react
function reactNextFocus(event){
    var key = event.keyCode;
	// if key pressed is the right arrow, change focus to 'react' footer button
	if (key == 39){
		document.getElementById("next_img").src = "img/next.png";
		document.getElementById("react_btn").focus();
	}
	if (key == 38){
		if (reactFocus == 0){// emoji btn
			reactEmojiBtnUnfocused();
			reactCommentBtnFocused(); 
			reactFocus++;
		}
		else if (reactFocus == 1){// comment btn
			reactCommentBtnUnfocused();
			reactCancelBtnFocused();
			reactFocus++;
		}
		else if (reactFocus == 2){// cancel btn
			reactCancelBtnUnfocused();
			reactEmojiBtnFocused();
			reactFocus = 0;
		}
	}	
}
// function for previous button key presses after react
function reactPreviousFocus(event) {
    var key = event.keyCode;
	// if key pressed is the right arrow, change focus to next footer button
	if (key == 39){ 	
		document.getElementById("prev_img").src = "img/previous.png";
		document.getElementById("next_img").src = "img/next_selected.png";
		document.getElementById("next_btn").focus();
	}
	if (key == 38){
		if (reactFocus == 0){// emoji btn
			reactEmojiBtnUnfocused();
			reactCancelBtnFocused();
			reactFocus = 2;
		}
		else if (reactFocus == 1){// comment btn
			reactCommentBtnUnfocused();
			reactEmojiBtnFocused();
			reactFocus--;
		}
		else if (reactFocus == 2){// cancel btn
			reactCancelBtnUnfocused();
			reactCommentBtnFocused();
			reactFocus--;
		}		
	}
}
/* 
function for selecting emojis

hide react buttons
display emoji selection
prev and next change from react btn focus to emoji select focus 
*/
function feedBtnEmoji(event){
    var key = event.keyCode;
	// if key pressed is the right arrow, change focus to next footer button
	if (key == 39){
		document.getElementById("prev_img").src = "img/previous_selected.png";
		document.getElementById("previous_btn").focus();
	}
	if (key == 38 || key == 1){
		document.getElementById("react_buttons").style.visibility = "hidden";
		document.getElementById("emoji_selection").style.visibility = "visible";
		document.getElementById("next_btn").setAttribute('onkeydown', 'emojiNextFocus(event)');
		document.getElementById("previous_btn").setAttribute('onkeydown', 'emojiPreviousFocus(event)');	
		document.getElementById("react_btn").setAttribute('onkeydown', 'emojiBtnSelect(event)');
		emojiLikeFocused();
	}
}
/*
function for selecting comment

hide react buttons
display comment form
prev and next change from react btn focus to comment form focus
*/
function feedBtnComment(event){
    var key = event.keyCode;
	// if key pressed is the right arrow, change focus to next footer button
	if (key == 39){
		document.getElementById("prev_img").src = "img/previous_selected.png";
		document.getElementById("previous_btn").focus();
	}
	if (key == 38){
		document.getElementById("react_buttons").style.visibility = "hidden";
		document.getElementById("comment_form").style.visibility = "visible";
	}	
}
/*
function for selecting cancel after react

hide comments
hide react buttons
prev and next from comment form focus to changing post display
change select button function
*/
function feedBtnCancel(event){ 
	// hide comments
	document.getElementById("comment_view").classList.add('hidden'); 
	document.getElementById("comment_view").classList.remove('visible'); 
	document.getElementById("post_view").style.left = "20%"; 
	document.getElementById("latestCommentSection").style.left = "18%";
	document.getElementById("reacted_emojis").style.marginLeft = "260px";
		document.getElementById("latestCommentLabel").style.marginLeft = "-430px";
	// hide react buttons
	document.getElementById("react_buttons").style.visibility = "hidden";
	// change functions for previous and next buttons
	document.getElementById("next_btn").setAttribute('onkeydown', 'feedBtnNext(event)');
	reactNextFocus(event);
	document.getElementById("previous_btn").setAttribute('onkeydown', 'feedBtnPrevious(event)');	
	reactPreviousFocus(event);
	// change function for select button
	document.getElementById("react_btn").setAttribute('onkeydown', 'feedBtnReact(event)');
	// unfocus cancel button
	reactCancelBtnUnfocused();
	// reset button counter
	reactFocus = 0;
	// focus next button
	document.getElementById("next_img").src = "img/next_selected.png";
	document.getElementById("next_btn").focus();
}
// function for next button key presses when selecting an emoji
function emojiNextFocus(event){
    var key = event.keyCode;
	// if key pressed is the right arrow, change focus to 'react' footer button
	if (key == 39){
		document.getElementById("next_img").src = "img/next.png";
		document.getElementById("react_btn").focus();
	}
	if (key == 38){
		if (emojiFocus == 0){// emoji like
			emojiLikeUnfocused();
			emojiLoveFocused(); 
			emojiFocus++;
		}
		else if (emojiFocus == 1){// emoji love
			emojiLoveUnfocused();
			emojiLaughFocused();
			emojiFocus++;
		}
		else if (emojiFocus == 2){// emoji laugh
			emojiLaughUnfocused();
			emojiWowFocused();
			emojiFocus++;
		}
		else if (emojiFocus == 3){// emoji wow
			emojiWowUnfocused();
			emojiSadFocused();
			emojiFocus++;
		}
		else if (emojiFocus == 4){// emoji sad
			emojiSadUnfocused();
			emojiCancelFocused();
			emojiFocus++;
		}
		else if (emojiFocus == 5){// emoji cancel
			emojiCancelUnfocused();
			emojiLikeFocused();
			emojiFocus = 0;
		}
	}	
}
// function for previous button key presses when selecting an emoji
function emojiPreviousFocus(event) {
    var key = event.keyCode;
	// if key pressed is the right arrow, change focus to next footer button
	if (key == 39){ 	
		document.getElementById("prev_img").src = "img/previous.png";
		document.getElementById("next_img").src = "img/next_selected.png";
		document.getElementById("next_btn").focus();
	}
	if (key == 38){
		if (emojiFocus == 0){// emoji like
			emojiLikeUnfocused();
			emojiCancelFocused();
			emojiFocus = 5;
		}
		else if (emojiFocus == 1){// emoji love
			emojiLoveUnfocused();
			emojiLikeFocused();
			emojiFocus--;
		}
		else if (emojiFocus == 2){// emoji laugh
			emojiLaughUnfocused();
			emojiLoveFocused();
			emojiFocus--;
		}
		else if (emojiFocus == 3){// emoji wow
			emojiWowUnfocused();
			emojiLaughFocused();
			emojiFocus--;
		}
		else if (emojiFocus == 4){// emoji sad
			emojiSadUnfocused();
			emojiWowFocused();
			emojiFocus--;
		}
		else if (emojiFocus == 5){// emoji cancel
			emojiCancelUnfocused();
			emojiSadFocused();
			emojiFocus--;
		}		
	}
}
// function for select after emojis
function emojiBtnSelect(event){
    var key = event.keyCode;
	// if key pressed is the right arrow, change focus to 'react' footer button
	if (key == 39){
			document.getElementById("prev_img").src = "img/previous_selected.png";
			document.getElementById("previous_btn").focus();
	}
	if (key == 38){
		if (emojiFocus == 5){// break if cancel button
			emojiSelectCancel(event);
		} else {
			document.getElementById("emoji_form_information").innerHTML = emojiFocus;
			document.getElementsByName("emoji_form").submit();
		}
	}	
}
/*
function for selecting cancel when selecting emojis

hide emojis
prev and next from selecting emoji focus to changing post display
change select button function
*/
function emojiSelectCancel(event){ 
	// hide emojis
	document.getElementById("emoji_selection").style.visibility = "hidden";
	// show react buttons	
	document.getElementById("react_buttons").style.visibility = "visible";
	// change functions for previous and next buttons
	document.getElementById("next_btn").setAttribute('onkeydown', 'reactNextFocus(event)');
	document.getElementById("previous_btn").setAttribute('onkeydown', 'reactPreviousFocus(event)');
	// change function for select button
	document.getElementById("react_btn").setAttribute('onkeydown', 'reactButtonSelect(event)');
	// focus next button
	document.getElementById("next_img").src = "img/next_selected.png";
	document.getElementById("next_btn").focus();
	// unfocus cancel button
	emojiCancelUnfocused();
	// auto focus emoji button
	reactEmojiBtnFocused();
	// reset button counter
	emojiFocus = 0;
}
/* 
button focus functions
can not use focus as focus needs to stay on navigation buttons
*/
function reactEmojiBtnFocused(){
	document.getElementById("emoji_button").style.backgroundColor = "#000";
	document.getElementById("emoji_button").style.border = "6px dashed #00ff00";
	document.getElementById("emoji_button").style.color = "#fff";	
}
function reactEmojiBtnUnfocused(){
	document.getElementById("emoji_button").style.backgroundColor = "#00ff00";
	document.getElementById("emoji_button").style.border = "3px solid #000";
	document.getElementById("emoji_button").style.color = "#000";	
}
function reactCommentBtnFocused(){
	document.getElementById("comment_button").style.backgroundColor = "#000";
	document.getElementById("comment_button").style.border = "6px dashed #00ff00";
	document.getElementById("comment_button").style.color = "#fff";	
}
function reactCommentBtnUnfocused(){
	document.getElementById("comment_button").style.backgroundColor = "#00ff00";
	document.getElementById("comment_button").style.border = "3px solid #000";
	document.getElementById("comment_button").style.color = "#000";	
}
function reactCancelBtnFocused(){
	document.getElementById("react_cancel_button").style.backgroundColor = "#000";
	document.getElementById("react_cancel_button").style.border = "6px dashed #00ff00";
	document.getElementById("react_cancel_button").style.color = "#fff";	
}
function reactCancelBtnUnfocused(){
	document.getElementById("react_cancel_button").style.backgroundColor = "#00ff00";
	document.getElementById("react_cancel_button").style.border = "3px solid #000";
	document.getElementById("react_cancel_button").style.color = "#000";	
}
function emojiLikeFocused(){
	document.getElementById("emoji_like").style.backgroundColor = "transparent";
	document.getElementById("emoji_like").style.border = "6px dashed #00ff00";
	document.getElementById("emoji_like").style.color = "#fff";	
}
function emojiLikeUnfocused(){
	document.getElementById("emoji_like").style.backgroundColor = "transparent";
	document.getElementById("emoji_like").style.border = "3px solid #000";
	document.getElementById("emoji_like").style.color = "#000";	
}
function emojiLoveFocused(){
	document.getElementById("emoji_love").style.backgroundColor = "transparent";
	document.getElementById("emoji_love").style.border = "6px dashed #00ff00";
	document.getElementById("emoji_love").style.color = "#fff";	
}
function emojiLoveUnfocused(){
	document.getElementById("emoji_love").style.backgroundColor = "transparent";
	document.getElementById("emoji_love").style.border = "3px solid #000";
	document.getElementById("emoji_love").style.color = "#000";	
}
function emojiLaughFocused(){
	document.getElementById("emoji_laugh").style.backgroundColor = "transparent";
	document.getElementById("emoji_laugh").style.border = "6px dashed #00ff00";
	document.getElementById("emoji_laugh").style.color = "#fff";	
}
function emojiLaughUnfocused(){
	document.getElementById("emoji_laugh").style.backgroundColor = "transparent";
	document.getElementById("emoji_laugh").style.border = "3px solid #000";
	document.getElementById("emoji_laugh").style.color = "#000";	
}
function emojiWowFocused(){
	document.getElementById("emoji_wow").style.backgroundColor = "transparent";
	document.getElementById("emoji_wow").style.border = "6px dashed #00ff00";
	document.getElementById("emoji_wow").style.color = "#fff";	
}
function emojiWowUnfocused(){
	document.getElementById("emoji_wow").style.backgroundColor = "transparent";
	document.getElementById("emoji_wow").style.border = "3px solid #000";
	document.getElementById("emoji_wow").style.color = "#000";	
}
function emojiSadFocused(){
	document.getElementById("emoji_sad").style.backgroundColor = "transparent";
	document.getElementById("emoji_sad").style.border = "6px dashed #00ff00";
	document.getElementById("emoji_sad").style.color = "#fff";	
}
function emojiSadUnfocused(){
	document.getElementById("emoji_sad").style.backgroundColor = "transparent";
	document.getElementById("emoji_sad").style.border = "3px solid #000";
	document.getElementById("emoji_sad").style.color = "#000";
}
function emojiCancelFocused(){
	document.getElementById("emoji_cancel_btn").style.backgroundColor = "#000";
	document.getElementById("emoji_cancel_btn").style.border = "6px dashed #00ff00";
	document.getElementById("emoji_cancel_btn").style.color = "#fff";	
}
function emojiCancelUnfocused(){
	document.getElementById("emoji_cancel_btn").style.backgroundColor = "#00ff00";
	document.getElementById("emoji_cancel_btn").style.border = "3px solid #000";
	document.getElementById("emoji_cancel_btn").style.color = "#000";	
}