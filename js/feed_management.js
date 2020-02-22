function selected(row){
	var d = document.getElementById(row);
	d.classList.toggle("selected");
}


$("#post_list").on("change", "input[type='checkbox']" , function() {
	$('input[type="checkbox"]').not(this).prop("checked", false);
	removeColor(document.querySelectorAll("#post_list tr"));
});

$("#post_preview").on("change", "input[type='checkbox']", function() {
	$('#post_preview input[type="checkbox"]').not(this).prop("checked", false);
	removeColor(document.querySelectorAll("#post_comments tr"));
});

/*	for LOADING POSTS	*/
$("#load_post").on("click", function() {
	var counter = 0;
	$(":checkbox").each(function() {
		var isChecked = $(this).is(":checked");
		if (isChecked) {
			counter++;
		}
	});

	// if a checkbox is selected, execute below
	if (counter > 0) {
		var checkBox = "";
		$(":checkbox").each(function() {
			var isChecked = $(this).is(":checked");

			if (isChecked) {
				checkBox = $(this).val();
			}
		});

		$.ajax({
			url: "php/feedManagement.php",
			method: "POST",
			data: {
				value: checkBox,
				condition: "load"},
			success: function(data) {
				$("#post_preview").html(data);
			}
		});
	}
});


/*	For REMOVING posts	*/
$("#delete_post").on("click", function() {
	var checkBox = "";
	$(":checkbox").each(function() {
		var isChecked = $(this).is(":checked");

		if (isChecked) {
			checkBox = $(this).val();
		}
	});

	$.ajax({
		url: "php/feedManagement.php",
		method: "POST",
		data: {
			value: checkBox,
			condition: "delete"},
		success: function(data) {
			$("#post_list").html(data);
		}
	});
});


/*	For REMOVING post comment(s)	*/
$("#delete_comment").on("click", function() {
	var checkBox = "";
	var counter = 0;
	$(".commentBoxes").each(function() {
		var isChecked = $(this).is(":checked");

		if (isChecked) {
			checkBox = $(this).val();
		}
	});

	$(".commentBoxes").each(function() {
		var isChecked = $(this).is(":checked");

		if (isChecked) {
			counter++;
		}
	});

	if (counter > 0) {
			$.ajax({
			url: "php/feedManagement.php",
			method: "POST",
			data: {delete: checkBox},
			success: function(data) {
				$("#post_comments").html(data);
			}
		});
	}
});


/**********************************************/
/*	Searching post */
$("#filter_post_btn").on("click", function() {
	var inputVal = $("#user_keyword").val();			// search value
	var fDate = $("#from_date").val();					// from date
	var tDate = $("#to_date").val();					// to date

	// If user is only searching and not using the dates
	if ((inputVal.length > 0) && (fDate.length <= 0 && tDate.length <= 0)) {
		$.ajax({
			url: "php/feedManagement.php",
			method: "POST",
			data: {keyword: inputVal},
			success: function(data) {
				$("#post_preview").html("");
				$("#post_list").html(data);		
			}
		});

	// If user is filtering posts based on dates and NOT using the search form 
	} else if ((fDate.length > 0 && tDate.length > 0) && (inputVal.length <= 0)) {
		// Checks if from date is less than to date or if both dates are the same
		// If true execute the search
		if (fDate < tDate || fDate == tDate) {
			$.ajax({
				url: "php/feedManagement.php",
				method: "POST",
				data: {
					fDate: fDate,
					tDate: tDate
				},
				success: function(data) {
					$("#post_preview").html("");
					$("#post_list").html(data);			
				}
			});	

		} else if (fDate > tDate) {
			$("#post_list").html("From date needs to be BEFORE To date. Try Again.");	
		}


	// If user is using both the search form and the dates to search posts
	} else if ((inputVal.length > 0) && (fDate.length > 0 && tDate.length > 0)) {

		if (fDate < tDate || fDate == tDate) {
			$.ajax({
				url: "php/feedManagement.php",
				method: "POST",
				data: {
					sKeyword: inputVal,
					sfDate: fDate,
					stDate: tDate
				},
				success: function(data) {
					$("#post_preview").html("");
					$("#post_list").html(data);		
				}
			});

		} else if (fDate > tDate) {
			$("#post_list").html("From date needs to be BEFORE To date. Try Again.");
		}
	}
});


// Removes the color of other clicked text boxes
function removeColor(thisArr) {
	var arr = thisArr;
	for (var i = 0; i < arr.length; i++) {
		if (arr[i].hasAttribute("class")) {
			var remove = arr[i].querySelector("td input");
			if (!remove.checked) {
				arr[i].removeAttribute("class");
			}
		}
	}
}