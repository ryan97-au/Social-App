
// variables for key presses
var nextElement = 32; // spacebar
var selectElement = 13; // enter key

var rowHighlight = 0;
var visibleRowCount = 0;
var visibleRows = [];

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
        td = tr[i].getElementsByTagName("td")[2];
        if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
                visibleRows[visibleRowCount] = tr[i];
                visibleRowCount++;
            } 
            else {
                tr[i].style.display = "none";
            }
        }       
    }

    visibleRows[rowHighlight].style.background = "#19D74F";
    visibleRows[rowHighlight].scrollIntoView(false);
    visibleRows[rowHighlight].style.margin = "0px";
    visibleRows[rowHighlight].style.border = "2px solid #ffff00";

    var str = theTable[rowHighlight].outerHTML.toString();
    alert(str);
    if (str.indexOf('remove') > -1) {
        document.getElementById("select_btn").innerText="Add";
    }
    else {
        document.getElementById("select_btn").innerText="Remove";
    }

    if(event) {
        var key = event.which;
        if (key == selectElement) 
        { // user presses enter in search box
            input.blur();
            document.getElementById("view_friend_all").focus();    
        }
    }
}

function init() 
{
    rowHighlight = 0;
    var theTable = document.getElementById("userNameTable").getElementsByTagName("tr");
    theTable[rowHighlight].style.background = "#19D74F";
    theTable[rowHighlight].style.border = "2px solid #ffff00";  
    filter(event);    
}

window.onload=init;

function admin_search(event)
{
    if (document.getElementById('searchBar').style.display!='block'){
        document.getElementById('searchBar').style.display='block';
        document.getElementById('search_btn').innerText='Clear';
        document.getElementById('searchBar').focus();       
    }
    else {
    document.getElementById('searchBar').value='';
    document.getElementById('search_btn').innerText='Search';
    document.getElementById('searchBar').blur();
    document.getElementById('searchBar').style.display='none';
    document.getElementById('next_btn').focus();                
    }
    filter(event);
}

function viewFriendBtnAll(event){
    //event.preventDefault();
    var key = event.which;
    // if key pressed is the spacebar, change focus to next button
    if (key == nextElement){  
        document.getElementById("view_friend_all").blur();
        document.getElementById("view_friend_next").focus();
    }
    // if key pressed is the enter key, view previous post
    if (key == selectElement){
    }
}

function viewFriendBtnNext(event){
    //event.preventDefault();
    var key = event.which;
    // if key pressed is the spacebar, change focus to next button
    if (key == nextElement){  
        document.getElementById("view_friend_next").blur();
        document.getElementById("view_friend_choose").focus();
    }
    // if key pressed is the enter key, view previous post
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
        theTable[rowHighlight].style.background = "#19D74F";
        theTable[rowHighlight].style.margin = "0px";
        theTable[rowHighlight].style.border = "2px solid #ffff00";

        theTable[rowHighlight].scrollIntoView(false);
        
        console.log(rowHighlight);
        console.log(theTable.length);

        }
    }    
}

function viewFriendBtnChoose(event){
    //event.preventDefault();
    var key = event.which;
    // if key pressed is the spacebar, change focus to next button
    if (key == nextElement){  
        document.getElementById("view_friend_choose").blur();
        document.getElementById("back_btn").focus();
    }
    // if key pressed is the enter key, view previous post
    if (key == selectElement){
    } 
}

function friendBtnBack(event){
    event.preventDefault();
    var key = event.which;
    if (key == nextElement){
        document.getElementById("back_btn").blur();
        document.getElementById("view_friend_all").focus();      
    }
    if (key == selectElement){
        //window.history.back();
        alert("Test");
    } 
}