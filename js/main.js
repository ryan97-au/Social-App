/*
QUT Capstone Project 2017
Project Owner: Nursery Road State Special School

SNAP - Social Networking Action Platform

Author: Robert Piper
Author: Heath Mayocchi
Author: Levinard Hugo
Author: David Mackenzie
*/

function backBtn(){
	//window.history.back();
        //document.getElementByTagName("button").blur();
        counter = 0;
        clearInterval(loopsym);
        buttons = Menubuttons
        timeinterval = 1000 * localStorage.getItem("loopSpeed");
        loopsym = setInterval(Incrementpositions, timeinterval);
        
        document.getElementById("back_btn").blur(); 
        document.getElementById("user_home_btn").focus();   
}
