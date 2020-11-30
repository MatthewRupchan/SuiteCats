
//send the correct id based on what was clicked.
function cat0clicked() {
	var id = document.getElementById("cat0").value;
	updateAlbum(id);
	return;
}

function cat1clicked() {
	var id = document.getElementById("cat1").value;
	updateAlbum(id);
	return;
}

function cat2clicked() {
	var id = document.getElementById("cat2").value;
	updateAlbum(id);
	return;
}

function cat3clicked() {
	var id = document.getElementById("cat3").value;
	updateAlbum(id);
	return;
}

function cat4clicked() {
	var id = document.getElementById("cat4").value;
	updateAlbum(id);
	return;
}

function cat5clicked() {
	var id = document.getElementById("cat5").value;
	updateAlbum(id);
	return;
}

//Main Ajax Function
function updateAlbum(cat_id) {
	
	var mail = new XMLHttpRequest();
	
	mail.onreadystatechange = function() { //this is what we do on return of information
		if(this.readyState == 4 && this.status == 200) {
			var results = JSON.parse(this.responseText);
		
			/*
			NUMBER	DATABASE_ELEMENT
			0		Img_URL
			1		cat_name
			2		interaction_timer
			*/
			
			document.getElementById("album_pic").src = results[0];
			document.getElementById("album_pic").alt = results[1];
			document.getElementById("name").value = results[1];
			document.getElementById("visit_link").href = "interaction.php?cat_id=" + cat_id;
			document.getElementById("rename_cat_id").value = cat_id;
			document.getElementById("lastvisit").innerHTML = " Last Visited: " + results[2];
		}
	}
	
	//send cat id to the php script
	var deliver_to = "../phpscripts/cat_info_for_suite.php?cat_id=" + cat_id;
	
	mail.open("GET", deliver_to, true);
	mail.send();
}

//Wait for an image to be clicked
if (document.getElementById("pic0")) {
	document.getElementById("pic0").addEventListener("click", cat0clicked);
}
if (document.getElementById("pic1")) {
	document.getElementById("pic1").addEventListener("click", cat1clicked);
}
if (document.getElementById("pic2")) {
	document.getElementById("pic2").addEventListener("click", cat2clicked);
}
if (document.getElementById("pic3")) {
	document.getElementById("pic3").addEventListener("click", cat3clicked);
}
if (document.getElementById("pic4")) {
	document.getElementById("pic4").addEventListener("click", cat4clicked);
}
if (document.getElementById("pic5")) {
	document.getElementById("pic5").addEventListener("click", cat5clicked);
}