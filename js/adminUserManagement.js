var file = document.querySelector("#uploadPicture");
var hiddenButton = document.querySelector("#registerHiddenSubmitButton");
var mainButton = document.querySelector("#saveUser");
var fileFormatError = document.querySelector("#fileTypeError");

/**********	Forms 	Below is another way of selecting elements, but specifically for forms	**************/
var firstName = document.forms["registerUser"]["firstName"];
var lastName = document.forms["registerUser"]["lastName"];
var dob = document.forms["registerUser"]["dob"];
var pass = document.forms["registerUser"]["password"];
var confPass = document.forms["registerUser"]["confirmPassword"];
var cb = document.querySelector("#aCheckBox");

/********** Errors *************/
var firstNameError = document.querySelector("#firstNameError");
var lastNameError = document.querySelector("#lastNameError");
var dobError = document.querySelector("#dobError");
var passwordError1 = document.querySelector("#passwordError1");
var passwordError = document.querySelector("#passwordError");
var cbError = document.querySelector("#checkBoxError");


function getImage() 
{
	var img = document.querySelector("#pictureForUpload");
	return img.src;
}


file.addEventListener("change", function() {
	var img = document.querySelector("#pictureForUpload");
	var val = this.value;
	val = val.substring(val.lastIndexOf('.') + 1).toLowerCase();

	if (val == "png" || val == "jpg" || val == "jpeg" || val == "gif" || val == "tiff") {
 		img.src = window.URL.createObjectURL(this.files[0]);
 		console.log(img.src);
 		fileFormatError.textContent = "";
		fileFormatError.style.color = "";
	} else {
		val.value = '';
		img.src = 'img/profile-placeholder.png';
		fileFormatError.textContent = "Incorrect file format";
		fileFormatError.style.color = "#e20b0b";
	}
});

mainButton.addEventListener("click", function() {
	hiddenButton.click();
});

firstName.addEventListener("blur", firstNameVerify, true);
lastName.addEventListener("blur", lastNameVerify, true);
pass.addEventListener("blur", passwordVerify, true);
dob.addEventListener("blur", dobVerify, true);
cb.addEventListener("blur", cbVerify, true);


function validate() {
	// check names for only letters
	// use descriptive error messages
	if (firstName.value == "") {
		firstNameError.textContent = "First name is required";
		firstName.style.border = "2px solid red";
		firstNameError.style.color = "#e20b0b";
		firstName.focus();
		return false;

	} else if (!firstName.value.match(/^[a-z-A-Z ]*$/)) {
		firstNameError.textContent = "First name can only contain letters and hyphens";
		firstName.style.border = "2px solid red";
		firstNameError.style.color = "#e20b0b";
		firstName.focus();
		return false;

	} else if (lastName.value == "") {

		lastNameError.textContent = "Last name is required";
		lastName.style.border = "2px solid red";
		lastNameError.style.color = "#e20b0b";
		lastName.focus();
		return false;

	} else if (!lastName.value.match(/^[a-z-A-Z ]*$/)) {
		lastNameError.textContent = "Last name can only contain letters and hyphens";
		lastName.style.border = "2px solid red";
		lastNameError.style.color = "#e20b0b";
		lastName.focus();
		return false;

	} else if (dob.value == "") {
		dob.style.border = "2px solid red";
		dobError.textContent = "DOB is required";
		dobError.style.color = "#e20b0b";
		dob.focus();
		return false
	// Heaths Regex 			/^([1-9]|0[1-9]|[1-2][0-9]|3[0-1])[- /.]([0-9]|1[0-2]|0[1-9])[- /.]((19|20)\d\d|[0-9]{2,2})$/i
	// Regex for YYYY-MM-DD 	/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/

	} else if (!dob.value.match((/^([1-9]|0[1-9]|[1-2][0-9]|3[0-1])[[\/-]([0-9]|1[0-2]|0[1-9])[\/-]((19|20)\d\d|[0-9]{2,2})$/i))) {
		dobError.textContent = "Correct format is DD-MM-YYYY or DD/MM/YYYY";
		dob.style.border = "2px solid red";
		dobError.style.color = "#e20b0b";
		dob.focus();
		return false

	// If checkbox is not checked
	} else if (!cb.checked) {
		cbError.textContent = "Checkbox is required";
		cbError.style.color = "#e20b0b";
		cb.focus();
		return false;

	// If checkbox is checked validate the password and confirm password
	} else if (cb.checked) {
		if (pass.value == "") {
			pass.style.border = "2px solid red";
			passwordError1.textContent = "Password is required";
			passwordError1.style.color = "#e20b0b";
			pass.focus();
			return false;

		} else if (pass.value.length < 6) {
			pass.style.border = "2px solid red";
			passwordError1.textContent = "Password is 6 characters short";
			passwordError1.style.color = "#e20b0b";
			pass.focus();
			return false;

		} else if (confPass.value == "") {
			confPass.style.border = "2px solid red";
			passwordError.textContent = "Confirm Password is required";
			passwordError.style.color = "#e20b0b";
			confPass.focus();
			return false;

		} else if (confPass.value.length < 6) {
			confPass.style.border = "2px solid red";
			passwordError.textContent = "Confirm Password is 6 characters short";
			passwordError.style.color = "#e20b0b";
			confPass.focus();
			return false;
		}

		else if (pass.value != confPass.value) {
			confPass.style.border = "2px solid red";
			passwordError.textContent = "Passwords don't match!";
			passwordError.style.color = "#e20b0b";
			confPass.focus();
			return false;
		}
	}
}

function firstNameVerify() {
	if (firstName.value.match(/^[a-z-A-Z]*$/)) {
		firstName.style.border = "";
		firstNameError.textContent = "";
		return true;
	}
}

function lastNameVerify() {
	if (lastName.value.match(/^[a-z-A-Z]*$/)) {
		lastName.style.border = "";
		lastNameError.textContent = "";
		return true;
	}
}

function passwordVerify() {
	if (pass.value != "") {
		pass.style.border = "";
		passwordError1.textContent = "";
		return true;
	}
}

function passwordVerify2() {
	if (confPass.value != "") {
		confPass.style.border = "";
		passwordError.textContent = "";
		return true;
	}
}

function dobVerify() {
	if (dob.value != "") {
		dob.style.border = "";
		dobError.textContent = "";
		return true;
	}
}

function cbVerify() {
	if (cb.checked) {
		cbError.textContent = "";
		return true;
	}
}

function load_user() 
{

	var id = document.getElementById("editUserForm").value[0];
	//alert(id);

}
/************* BELOW IS FOR THE SEARCH FORM *******************/
var mate = document.querySelectorAll(".userResults");
var editUserForm = document.querySelector("#editUserForm");
var body = document.querySelector("body");
var editingUserPicture = document.querySelector("#editUserPicture");


body.addEventListener("click", function() {
	var results = document.querySelector("#searchResults");
	results.style.display = "none";
});

for (var i = 0; i < mate.length; i++) {
	mate[i].addEventListener("click", function () {
			var text = this.innerHTML;
			/*******************************************/
			var firstTag = text.indexOf("<");
			var secondTag = text.indexOf(">", firstTag);
			var imgTag = text.substring(firstTag, secondTag + 1);
			/*******************************************/
			editingUserPicture.innerHTML = imgTag;
				text = text.replace(/(<([^>]+)>)/ig, "");		// removes the <img>
				text = text.trim();
				text = text.split(" ");
			editUserForm.value = text;
	});
}

$(document).ready
(
	function()
	{
	  $("#loadUserButton").click
	  (
	  	function()
	 		{    
	 			var tmpTxt = document.getElementById("editUserForm").value;
	 			var id = tmpTxt.substring(0,tmpTxt.indexOf(","));

		    $.post("php/show_user.php",
		    {
		        userID: id,
		    },
		    function(data, status){
		    		$("#showUserForm").appendTo( $("#showUser") );
		    		$("#showUser").html(data);
		    });
	 		}
	 	);
	}
);




/*		This is for showing the friends list when the load user is clicked	*/
$("#loadUserButton").on("click", function() {
	var val = $("#editUserForm").val();

	$.ajax({
		url: "php/admin_user_friends.php",
		method: "POST",
		data: {
			value : val
		},
		success: function(data) {
			$("table").html(data);
		}
	});
});


$("#remove_friend_btn").on("click", function() {
	var val = $("#editUserForm").val();
	var checkbox = "";

	$(".cbs").each(function() {
		var isChecked = $(this).is(":checked");

		if (isChecked) {
			checkbox = $(this).val();
		}
	});

	$.ajax({
		url: "php/admin_user_friends.php",
		method: "POST",
		data: {
			val : val,
			cb : checkbox
		},
		success: function(data) {
			$("table").html(data);
		}
	});
});

$("table").on("change", "input[type='checkbox']" , function() {
	$('input[type="checkbox"]').not(this).prop("checked", false);
});