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
		label: "Orders",
		location: "orders",
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
