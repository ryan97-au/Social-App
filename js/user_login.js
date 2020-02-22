function choose_user($name) {
	alert($name);
}
var autolo;
var counter = 2;
var buttons = document.getElementsByName("looped");
var loginevent = document.getElementsByName("studentLoginBtn");
var selection_List = buttons;

var test = false;


//Check current system and implement
if (localStorage.getItem("systemType") == "One"){
        autolo = true;
        timeinterval = 1000*localStorage.getItem("loopSpeed");
        loopsym = setInterval(Incrementpositions, timeinterval)
}else if (localStorage.getItem("systemType") == "Two"){
        autolo = false;
        }



function Incrementpositions(e){
        if (counter === 0) {
                counter++;

	} else if (counter === selection_List.length - 1) {
		counter = 0;

	} else {
		counter++;
	}
        selection_List[counter].focus();
        if(autolo == false){
                e.preventDefault();
        }
}
        
function filter(event) {
   
  if (window.location.href.indexOf("user_login.php") >0){
  var input, filter, table, tr, td, i;
  input = document.getElementById("searchBar");
  filter = input.value.toUpperCase();
  table = document.getElementById("userNameTable");
  tr = table.getElementsByTagName("tr");
  rowHighlight = 0;
  visibleRowCount = 0;
  visibleRows = [];
  for (i = 0; i < tr.length; i++) {
    tr[i].style.background = "white";        
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
        visibleRows[visibleRowCount] = tr[i];
        visibleRowCount++;
      } else {
        tr[i].style.display = "none";
      }
    }       
  }

  visibleRows[rowHighlight].style.background = "#ff6b6b";
  visibleRows[rowHighlight].style.margin = "0px";
  visibleRows[rowHighlight].style.border = "2px solid #ffff00";
  visibleRows[rowHighlight].scrollIntoView(false);
  //alert(event);
  if(event)
  {
    var key = event.which;
    if (key == selectElement) 
    { // user presses enter in search box
      input.blur();
      document.getElementById("next_btn").focus();    
    }
  }
}
}



function student_popup($name,$img,$id)
{
  // Get the modal
var modal = document.getElementById('student_popup');

  // var ui = document.getElementById('student_avatar');
  // ui.src=$img;

  var ud = document.getElementById('student_username');
 // ud.innerText='Log in as ' + $name;
  ud.innerHTML = "<input type='hidden' name='thisUser' value='" + $id + "'>" + 'Log in as ' + $name;

  document.getElementById('student_popup').style.display='block';
  document.getElementById("select_btn").blur();
  document.getElementById('student_login').focus();
}


function admin_popup($name,$img,$id)
{
  // Get the modal
var modal = document.getElementById('admin_popup');

  // var ui = document.getElementById('admin_avatar');
  // ui.src=$img;

  var ud = document.getElementById('admin_username');
 // ud.innerText='Please enter the password for ' + $name;
  ud.innerHTML = "<input type='hidden' name='adminUser' value='" +  $id + "'>" + 'Please enter the password for ' + $name;

  document.getElementById('admin_popup').style.display='block';

  document.getElementById("select_btn").blur();
  document.getElementById('admin_cancel').focus();

}



// variables for key presses
var nextElement = 32; // spacebar
var selectElement = 13; // enter key

var rowHighlight = 0;
var visibleRowCount = 0;
var visibleRows = [];



function init() 
{
	rowHighlight = 0;
        if ( window.location.href.indexOf("user_login.php") >0){
	var theTable = document.getElementById("userNameTable").getElementsByTagName("tr");
  theTable[rowHighlight].style.background = "#ff6b6b";
  }

  var admin = getUrlParameter('letter_group');  //If the user has clicked the 'search' button on index.php....
  if (admin == 'all') {
    admin_search(event);
  }else
  {
    filter(event);  
  }
}

window.onload=init;

/*
functions for post navigation
*/
function loginBtnNext(event) { 
  event.preventDefault();
    var key = event.which;
  // if key pressed is the spacebar, change focus to choose button
  if (key == nextElement){
    document.getElementById("next_btn").blur();
    document.getElementById("select_btn").focus();
  }
  // if key pressed is the enter key, view next post
  if (key == selectElement){ 

    //var theTable = document.getElementById("userNameTable").getElementsByTagName("tr");
    var theTable = visibleRows;
    theTable[rowHighlight].style.background = "white";
    theTable[rowHighlight].style.margin = "20px";
    theTable[rowHighlight].style.border = "0px";

    if( rowHighlight<visibleRowCount-1 )
    {

      rowHighlight++;

    }else
    {
      rowHighlight=0;
    
    }
    theTable[rowHighlight].style.background = "#ff6b6b";
    theTable[rowHighlight].style.margin = "0px";
    theTable[rowHighlight].style.border = "2px solid #ffff00";
    theTable[rowHighlight].scrollIntoView(false);

    console.log(rowHighlight);
    console.log(theTable.length);

  }
}
function loginClickNext(){
    var theTable = visibleRows;
    theTable[rowHighlight].style.background = "white";
    theTable[rowHighlight].style.margin = "20px";
    theTable[rowHighlight].style.border = "0px";

    if( rowHighlight<visibleRowCount-1 )
    {

      rowHighlight++;

    }else
    {
      rowHighlight=0;
    
    }
    theTable[rowHighlight].style.background = "#ff6b6b";
    theTable[rowHighlight].style.margin = "0px";
    theTable[rowHighlight].style.border = "2px solid #ffff00";
    theTable[rowHighlight].scrollIntoView(false);

    console.log(rowHighlight);
    console.log(theTable.length);  
}

function loginBtnPrevious(event) {
  event.preventDefault();
    var key = event.which;
    
    
  // if key pressed is the spacebar, change focus to next button
  if (key == nextElement){  
    document.getElementById("previous_btn").blur();
    document.getElementById("next_btn").focus();
  }
  // if key pressed is the enter key, view previous post
  if (key == selectElement){

    //var theTable = document.getElementById("userNameTable").getElementsByTagName("tr");
    var theTable = visibleRows;
    theTable[rowHighlight].style.background = "white";
    theTable[rowHighlight].style.margin = "20px";
    theTable[rowHighlight].style.border = "0px";

    if( rowHighlight>0 )
    {
      rowHighlight--;
    }else
    {
      rowHighlight=visibleRowCount-1;
    }

    theTable[rowHighlight].style.background = "#ff6b6b";
    theTable[rowHighlight].style.margin = "0px";
    theTable[rowHighlight].style.border = "2px solid #ffff00";
    theTable[rowHighlight].scrollIntoView(false);    
    console.log(rowHighlight);
    console.log(theTable.length);

    //key.stopPropagation();
    //plusComment(1); //this is for the latest comment
  }
}
function loginClickPrevious(){
    var theTable = visibleRows;
    theTable[rowHighlight].style.background = "white";
    theTable[rowHighlight].style.margin = "20px";
    theTable[rowHighlight].style.border = "0px";

    if( rowHighlight>0 )
    {
      rowHighlight--;
    }else
    {
      rowHighlight=visibleRowCount-1;
    }

    theTable[rowHighlight].style.background = "#ff6b6b";
    theTable[rowHighlight].style.margin = "0px";
    theTable[rowHighlight].style.border = "2px solid #ffff00";
    theTable[rowHighlight].scrollIntoView(false);    
    console.log(rowHighlight);
    console.log(theTable.length);  
}

function loginBtnSelect(event) {
  event.preventDefault();
  var key = event.which;
  // if key pressed is the spacebar, change focus to the back button
  if (key == nextElement && test == false){ 
      document.getElementById("select_btn").blur();
      document.getElementById("back_btn").focus();
      
      //document.getElementById("student_login").focus();
      //document.getElementById("student_cancel").blur();
  }
  // if key pressed is the enter key, display choose buttons and comments
  if (key == selectElement){
  
    //var theTable = document.getElementById("userNameTable").getElementsByTagName("tr");
    test = true;
    var theTable = visibleRows;    
    theTable[rowHighlight].onclick();
    if (test == true) {
            document.getElementById("student_login").focus();
    }
    
    

    document.getElementById("student_login").focus();
    //key.stopPropagation();
        //Loop system change over
  if (localStorage.getItem("systemType") == "One"){
          clearInterval(loopsym);
          selection_List = loginevent;
          loopsym = setInterval(Incrementpositions, timeinterval);
  }
  } 
}
function loginClickSelect(){  
    var theTable = visibleRows;    
    theTable[rowHighlight].onclick();
    //key.stopPropagation();
    
    document.getElementById("student_login").focus();
    document.getElementById("student_cancel").blur(); 
}

/* 
function for back key presses
*/
function loginBtnBack(event){
  event.preventDefault();
    var key = event.which;
  if (key == nextElement){
      document.getElementById("back_btn").blur();
      document.getElementById("previous_btn").focus();      
  }
  if (key == selectElement){
    window.history.back();
  } 
}

function loginBtnStudentLogin(event){
  event.preventDefault(); 
    var key = event.which;
  if (key == nextElement){
      document.getElementById("student_login").blur();
      document.getElementById("student_cancel").focus();      
  }
  if (key == selectElement){
  //document.getElementById("student_login").submit();
  } 
}

function loginBtnStudentCancel(event){
  event.preventDefault();
    var key = event.which;
  if (key == nextElement){
      document.getElementById("student_cancel").blur();
      document.getElementById("student_login").focus();      
  }else if (key == selectElement) {
      cancel_login(event);
  }
}
function loginClickStudentCancel(){
  cancel_login(event);  
}

function loginBtnAdminLogin(event){
  event.preventDefault();
    var key = event.which;
  if (key == nextElement){
      document.getElementById("admin_login").blur();
      document.getElementById("admin_cancel").focus();      
  }
  if (key == selectElement){
    document.getElementById("admin_form").submit();
  } 
}


function loginBtnAdminCancel(event){
  event.preventDefault();
    var key = event.which;
  if (key == nextElement){
      // the admin login button shouldn't be accessible via keyboard.
      // document.getElementById("admin_cancel").blur();
      // document.getElementById("admin_login").focus();      
  }else{
    if( key == selectElement){
      cancel_login(event);
    }
  }
}

function cancel_login(event)
{
  //alert('cancel_login');
  document.getElementById('admin_popup').style.display='none'  
	document.getElementById('student_popup').style.display='none';
	document.getElementById("student_cancel").blur();
	document.getElementById("next_btn").focus();  
        clearInterval(loopsym);
        selection_List = buttons;
  	loopsym = setInterval(Incrementpositions, timeinterval);
}

function admin_search(event)
{
	if(document.getElementById('searchBar').style.display!='block')
	{
		document.getElementById('searchBar').style.display='block';
		document.getElementById('search_btn').innerText='Clear';
		document.getElementById('searchBar').focus();		
	}else
	{
		document.getElementById('searchBar').value='';
//    alert(document.getElementById('searchBar').innerText);
		document.getElementById('search_btn').innerText='Search';
    document.getElementById('searchBar').blur();
    document.getElementById('searchBar').style.display='none';
		document.getElementById('next_btn').focus();				
	}
  filter(event);
}



var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};