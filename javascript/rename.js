var originalName = document.getElementById("name").value;

function rename() {
	if (document.getElementById('name').readOnly == true) { //turn on the field if  it is turned off
		document.getElementById('name').readOnly = false;
		document.getElementById('name').style.border = "solid #fcba03 2px";

		event.preventDefault();
		return;
	} else {
		var name = document.getElementById("name").value;

		//letters only please
		if (!test_if_letters(name)) {
			alert("Invalid Name. Please use letters only.");
			event.preventDefault();
			return;
		}

		//any way to check what the original name is?
		if(name == originalName) {
			alert("That is already the cat's name.");
			event.preventDefault();
			document.getElementById('name').style.border = "solid black 1px";
			document.getElementById('name').readOnly = true;
			return;
		}

		//opportunity to cancel
		if(!confirm("Rename your cat to " + name +"?")) {
			event.preventDefault();
			document.getElementById('name').value = originalName;
			document.getElementById('name').style.border = "solid black 1px";
			document.getElementById('name').readOnly = true;
			return;
		}
	}
}

function test_if_letters(name) {
	return (/^[a-zA-Z]+$/.test(name));
}

document.getElementById("rename_button").addEventListener("click", rename);

