const base_url = "http://localhost/exam/";

// Navigation Menu Sidebar functionality
let closingSidebar = false;
const navItems = [
	{
		label: "Home",
		location: "",
	},
	{
		label: "Planes",
		location: "planes",
	},
	{
		label: "Routes",
		location: "routes",
	},
	{
		label: "Book a Flight",
		location: "book",
	},
	{
		label: "Account",
		location: "account",
	},
	{
		label: "Login",
		location: "auth/login",
	},
];

function openSidebar() {
	if (closingSidebar) return;

	let sidebarHTML = `
    <aside>
        <div class="aside-container">
            <div class="aside-header">
                <h2>Navigation Menu</h2>
                <img src="${base_url}assets/img/icons/cross.svg" class="svg-primary-color hover pointer" 
                    onclick="closeSidebar()"/>
            </div>
            <ul class="aside-list">                        
    `;

	navItems.forEach((nav) => {
		sidebarHTML += `
        <li>
            <a class="hover pointer underline"
                href="${base_url}index.php/${nav.location}">
                ${nav.label}
            </a>
        </li>`;
	});

	sidebarHTML += `
            </ul>
        </div>
    </aside>`;

	document.querySelector("header").insertAdjacentHTML("afterend", sidebarHTML);
}

function closeSidebar() {
	const animTime = 1000; //1 second
	closingSidebar = true;

	document.querySelector("aside").classList.add("aside-out");
	document
		.querySelector(".aside-container")
		.classList.add("aside-container-out");

	setTimeout(() => {
		closingSidebar = false;
		document.querySelector("aside").remove();
	}, animTime);
}

//Notification close functionality
function closeNotif() {
	const notifAnimTime = 1000;
	const el = document.querySelector(".notif");
	el.classList.add("notif-out");
	setTimeout(() => {
		el.remove();
	}, notifAnimTime);
}

//Account overlay
let overlayOpen = false;
function toggleAccountOverlay() {
	overlayOpen = !overlayOpen;

	if (overlayOpen) {
		const overlayHTML = `	
			<div class="account-overlay">
				<a href="${base_url}index.php/account">View Account</a>
				<div class="overlay-separator"></div>
				<a href="${base_url}index.php/auth/logout" style="color:red;">Log Out</a>
			</div>`;

		document
			.querySelector("header")
			.insertAdjacentHTML("afterend", overlayHTML);
	} else {
		overlayAnimTime = 750;
		document
			.querySelector(".account-overlay")
			.classList.add("account-overlay-out");
		setTimeout(() => {
			document.querySelector(".account-overlay").remove();
		}, overlayAnimTime);
	}
}

//NotifSidebar
let closingNotif = false;
function notifSidebar() {
	if (closingNotif) return;
	document.querySelector("#notif-alert").style.opacity = 0;

	let notifHTML = `
    <aside>
        <div class="aside-container notif-container">
            <div class="aside-header">
                <h2>Notifications</h2>
                <img src="${base_url}assets/img/icons/cross.svg" class="svg-primary-color hover pointer" 
                    onclick="closeSidebar()"/>
            </div>
            <ul class="aside-list">                        
    `;

	if (notifs.length > 0) {
		notifs.forEach((n, i) => {
			notifHTML += `
			<li id="notif-item-${i}" class="notif-item">
				<div><p>${n.title}</p><img src="${base_url}assets/img/icons/delete.svg" 
					class="hover pointer scale svg-red"
					onclick="deleteNotif(${i})"/>
				</div>
				<div class="notif-item-separator"></div>
				<p>${n.message}</p>
			</li>
		`;
		});
	} else {
		notifHTML += `<p>No Unread Notifications</p>`;
	}

	notifHTML += `
            </ul>
        </div>
    </aside>`;

	document.querySelector("header").insertAdjacentHTML("afterend", notifHTML);
}

let deletedNotifs = 0;
function deleteNotif(index) {
	notifs.splice(index - deletedNotifs, 1);
	const toDelete = document.querySelector("#notif-item-" + index);
	if (toDelete) toDelete.remove();

	if (notifs.length <= 0) {
		document
			.querySelector(".aside-list")
			.insertAdjacentHTML("afterbegin", "<p>No Unread Notifications</p>");
	}

	deletedNotifs++;
}

function closeNotifSidebar() {
	const animTime = 1000; //1 second
	closingSidebar = true;

	deletedNotifs = 0;

	document.querySelector("aside").classList.add("aside-out");
	document
		.querySelector(".aside-container")
		.classList.add("aside-container-out");

	setTimeout(() => {
		closingNotif = false;
		document.querySelector(".notif-container").remove();
	}, animTime);
}
