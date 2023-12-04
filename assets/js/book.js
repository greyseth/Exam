const formNavButtons = ["#routeBtn", "#nav-2", "#nav-3"];

formNavButtons.forEach((btn) => {
	document.querySelector(btn).addEventListener("click", (e) => {
		e.preventDefault();
	});
});

function routeListVis(val) {
	document.querySelector(".routes-list-container").hidden = !val;
}

function pickRoute(display, routeId) {
	document.querySelector("#routeInput").value = routeId;
	document.querySelector("#routeBtn").textContent = "CHANGE ROUTE";
	document.querySelector("#routeMsg").textContent = "Selected: " + display;

	routeListVis(false);
}

const pagesAmount = 4;
function changePage(pageNum) {
	for (let i = 0; i < pagesAmount; i++) {
		const pageElement = document.querySelector("#form-section-" + (i + 1));
		if (pageElement) pageElement.hidden = true;
	}

	document.querySelector("#form-section-" + pageNum).hidden = false;
}

function pickClass(c) {
	const prevSelected = document.querySelector(".selected");
	if (prevSelected) {
		prevSelected.classList.remove("selected");
		prevSelected.classList.add("hover", "pointer", "scale");
	}

	const newSelect = document.querySelector("#class-" + c);
	if (newSelect) {
		newSelect.classList.add("selected");
		newSelect.classList.remove("hover", "pointer", "scale");

		document.querySelector("#classInput").value = c;
	}
}

let totalSeats = 0;
const orderedDisplay = document.querySelector("#orderedSeats");
function changeSeatValue(inputName) {
	console.log("hello");
	const value = document.querySelector("#" + inputName).value;
	var regExp = /[a-zA-Z]/g;

	if (regExp.test(value)) {
		orderedDisplay.textContent = "ERROR";
	} else calculateSeats();
}

function calculateSeats() {
	const aSeats = parseInt(document.querySelector("#adultSeatInput").value);
	const cSeatValue = parseInt(
		document.querySelector("#childrenSeatInput").value
	);

	const cSeats = Math.floor(cSeatValue / 2);

	orderedDisplay.textContent = aSeats + cSeats;
	document.querySelector("#seatCountInput").value = aSeats + cSeats;
}
