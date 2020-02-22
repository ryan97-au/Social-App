

// variables for key presses
var nextElement = 32; // spacebar
var selectElement = 13; // enter key
var leftclick = 1;

var rowHighlight = 0;
var visibleRowCount = 0;
var visibleRows = [];


window.onload=init;

function choose_user($name) {
    alert($name);
}

function filter(event) {

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

  visibleRows[rowHighlight].style.background = "#FF6B6B";
  visibleRows[rowHighlight].scrollIntoView(false);
  visibleRows[rowHighlight].style.margin = "0px";
  visibleRows[rowHighlight].style.border = "2px solid #ffff00";

  var str = theTable[rowHighlight].outerHTML.toString();
  alert(str);
  if (str.indexOf('remove') > -1) 
  {
    document.getElementById("select_btn").innerText="Add";
  }
  else
  {
    document.getElementById("select_btn").innerText="Remove";
  }

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

function viewFriendBtnAll(event){
    var key = event.which;
    // if key pressed is the spacebar
    if (key == nextElement){    
        document.getElementById("view_friend_all").blur();
        document.getElementById("view_friend_next").focus();
    }
    // if key pressed is the enter key
    if (key == selectElement){
      // TODO
    }   
}
function viewFriendClickAll(){
  // TODO
}

function viewFriendBtnNext(event){
  event.preventDefault();
  var key = event.which;
  // if key pressed is the spacebar
  if (key == nextElement){    
      document.getElementById("view_friend_next").blur();
      document.getElementById("view_friend_choose").focus();
  }
  // if key pressed is the enter key, view next post
  if ((key == selectElement)||(key == leftclick)){ 

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
  var str = theTable[rowHighlight].outerHTML.toString();
  if (str.indexOf('remove') > -1) 
  {
    document.getElementById("select_btn").innerText="Remove Friend";
  }
  else
  {
    document.getElementById("select_btn").innerText="Add Friend";
  }
    console.log(rowHighlight);
    console.log(theTable.length);

  }
}  
function viewFriendClickNext(){
        var theTable = visibleRows;
        theTable[rowHighlight].style.background = "white";
        theTable[rowHighlight].style.margin = "20px";
        theTable[rowHighlight].style.border = "0px";

        if(rowHighlight < visibleRowCount - 1) {
          rowHighlight++;
        }else {
          rowHighlight = 0;        
        }

        theTable[rowHighlight].style.background = "#FF6B6B";
        theTable[rowHighlight].style.margin = "0px";
        theTable[rowHighlight].style.border = "2px solid #ffff00";

        theTable[rowHighlight].scrollIntoView(false);
        var str = theTable[rowHighlight].outerHTML.toString();
        if (str.indexOf('remove') > -1) {
            document.getElementById("select_btn").innerText="Remove";
        }
        else {
            document.getElementById("select_btn").innerText="Add";
        }
        console.log(rowHighlight);
        console.log(theTable.length);  
}

function viewFriendBtnChoose(event){
    var key = event.which;
    // if key pressed is the spacebar
    if (key == nextElement){    
        document.getElementById("view_friend_choose").blur();
        document.getElementById("back_btn").focus();
    }
    // if key pressed is the enter key
    if (key == selectElement){
      // TODO
    }   
}
function viewFriendClickChoose(){
  // TODO
}

/* 
function for back key presses
*/
function viewFriendBtnBack(event){
    event.preventDefault();
    var key = event.which;
    // if key pressed is the spacebar
    if (key == nextElement){
        document.getElementById("back_btn").blur();
        document.getElementById("view_friend_all").focus();
    }
    // if key pressed is the enter key
    if (key == selectElement){
        //window.history.back();
        //alert("test");
        document.getElementById("back_btn").blur();
        document.getElementById("user_home_btn").focus();
    }   
}
