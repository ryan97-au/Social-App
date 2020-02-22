var letters = document.querySelectorAll(".letters");	
var cons = document.querySelectorAll(".containers input");
var checkmark = document.getElementById("OneBtnSym");
var checkmark2 = document.getElementById("TwoBtnSym");
var speed = document.getElementById("SpeedSetting");
var counter = 0;
var LoopSpeed = speed.value * 1000;
var autolo= true;

/*Check if space is used to change selected item, in two buttom system only*/
window.addEventListener("keydown", function(e){
	if (e.keyCode == "32") {
        
		Incrementposition(e);
                
	}
});

/*Default with auto loop on*/
loopsym = setInterval(Incrementposition, LoopSpeed)

 
/*When Update is clicked it will change the speed in which each element will be swapped to speed.value is in seconds*/
function UpdateSpeed(){
       type = localStorage.getItem("systemType");
       if( type == "One"){
       clearInterval(loopsym);
       localStorage.setItem("loopSpeed", speed.value);
       loopSpeed = 1000 * localStorage.getItem("loopSpeed", speed.value);
       loopsym = setInterval(Incrementposition, loopSpeed);
       }
}

/*Will pause looping when trying to change the speed*/
function pause(){
        clearInterval(loopsym);
}
/*change between 2 button and 1 button systems*/
function changesym(){
       
        if (checkmark2.checked){
        autolo = false;
                localStorage.setItem("systemType" , "Two");
                clearInterval(loopsym);
} else if (checkmark.checked) {
localStorage.setItem("systemType" , "One");
autolo = true;
loopsym = setInterval(Incrementposition, LoopSpeed);

}
letters[0].focus();
counter = 0;
}

/*Used to increment the current selected item*/
function Incrementposition(e){
        if (counter === 0) {
                counter++;

	} else if (counter === letters.length - 1) {
		counter = 0;

	} else {
		counter++;
	}
        letters[counter].focus();
        type = localStorage.getItem("systemType")
                e.preventDefault();
                
}
