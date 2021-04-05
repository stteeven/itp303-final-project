function searchValidation(event) {
	if (!$("#location").val()) {
		alert("Please enter a valid input.");
		event.preventDefault();
	}
}

function setTemp(response) {
	try {
		let feelsLike = response.data[0].app_temp;
		console.log(feelsLike);
		$("#temp").val(feelsLike);
	}

	catch(err) {
		searchValidation(event);
	}
}

function getTemp(response) {
	try {
		let feelsLike = response.data[0].app_temp;
		console.log(feelsLike);
		return feelsLike;
	}

	catch(err) {
		searchValidation(event);
	}
}

function displayResults(response) {

	try {
		let iconElement = response.data[0].weather.icon;
		console.log(iconElement);
		let cityElement = response.data[0].city_name;
		console.log(cityElement);
		let feelsLike = response.data[0].app_temp;
		console.log(feelsLike);
		let descriptionElement = response.data[0].weather.description;

		// let tempElement = response.data[0].temp;
		// console.log(tempElement);
		$(".icon").attr("src", "https://www.weatherbit.io/static/img/icons/" + iconElement + ".png");
		$(".city").text(cityElement);
		// $(".temp").text(tempElement);
		$(".desc").text(descriptionElement + ".");
		$(".feels-like").text(feelsLike);

		// $("#temp").val(feelsLike);
		// $("input[id=temp]").val(feelsLike);
		// document.getElementById("temp").value = feelsLike;

	}

	catch(err) {
		searchValidation(event);
		$(".validation").text("Please input a valid city name.");
	}
	
}

function ajaxGet(endpointUrl, returnFunction){
	var xhr = new XMLHttpRequest();
	xhr.open('GET', endpointUrl, true);
	xhr.onreadystatechange = function(){
		if (xhr.readyState == XMLHttpRequest.DONE) {
			if (xhr.status == 200) {
				// When ajax call is complete, call this function, pass a string with the response
				returnFunction(xhr.responseText);
			} else {
				alert('AJAX Error.');
				console.log(xhr.status);
			}
		}
	}
	xhr.send();
};


// ---- Submit the search form
document.querySelector("form").onsubmit = function(event) {

	if (document.querySelector("form") == document.querySelector("#results-form")) {
		event.preventDefault();
	}
	
	// WEATHERBIT OG AJAX
	let url = "https://api.weatherbit.io/v2.0/current";
	let city = $("#location").val();
	let key = "3573c26c459247e6be9588c211b6fa19";

	$.ajax({
		method: "GET",
		url: url,
		data: {
			key: key,
			city: city,
			units: "I"
		}
	})
	.done(function(results){
		console.log(results);
		displayResults(results);
		// let temp = getTemp(results);
		// return temp;
		setTemp(results);
		// DEFINE LOCATION AND TEMP VARS
	let location = document.querySelector("#location").value.trim();
	let temp = document.querySelector("#temp").value.trim();

	console.log(temp);

	ajaxGet("backend.php?location=" + city +"&temp=" + temp, function(clothing_results){
		// The following code will only run when we get a response from backend.php
		console.log(clothing_results);

		// // Convert results JSON string into JS objects
		clothing_results = JSON.parse(clothing_results);
		// console.log(clothing_results);

		// Display the results on the browser
		let resultsList = document.querySelector(".clothing-container");

		// Clear previous results upon every search
		while( resultsList.hasChildNodes()) {
			resultsList.removeChild(resultsList.lastChild);
		}

		// Run through the song results. Create a <li> element for each result
		// Append a <li> per result
		for (let i = 0; i < clothing_results.length; i++) {
			// Create parent div and add classes
			let itemDiv = document.createElement("div");
			itemDiv.classList.add("col-10", "col-sm-5", "col-md-3", "item");
			let itemImg = document.createElement("img");
			// itemImg.addClass("icon");
			itemImg.src = clothing_results[i].image_src;
			let itemName = document.createElement("div");
			itemName.classList.add("item-name");

			let retailSite = document.createElement("a");
			retailSite.innerHTML = clothing_results[i].name;
			retailSite.href = clothing_results[i].retail_site;
			// let details = document.createElement("a");
			// details.classList.add("details");
			// details.href = "details.php";
			// details.innerHTML = "Details";

			itemName.appendChild(retailSite);
			itemDiv.appendChild(itemImg);
			itemDiv.appendChild(itemName);
			// itemDiv.appendChild(details);
			resultsList.appendChild(itemDiv);

			var $draggable = $('.item').draggabilly({
						axis: 'both'
					})
		}
	});
	})
	.fail(function() {
		console.log("Request failed");
	});

	searchValidation(event);

	if (document.querySelector("form") == document.querySelector("#results-form")) {
		event.preventDefault();
	}


}



// setTemp(results);

// set val on submit