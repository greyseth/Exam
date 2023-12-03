function togglePassword(id = "password") {
	let passwordShow = false;
	if (document.querySelector(`#${id}Input`).type === "text")
		passwordShow = false;
	else passwordShow = true;

	if (passwordShow) {
		document.querySelector("#" + id + "Input").type = "text";
		document.querySelector(
			"#" + id + "Toggle"
		).src = `${base_url}assets/img/icons/noview.svg`;
	} else {
		document.querySelector("#" + id + "Input").type = "password";
		document.querySelector(
			"#" + id + "Toggle"
		).src = `${base_url}assets/img/icons/view.svg`;
	}
}
