/* FOR SIDEBAR DROPDOWN */

const dropdownLink = document.querySelector(".dropdown a");
const dropdownMenu = document.querySelector(".dropdown-content");
const dropdown = document.querySelector(".dropdown");
const downIcon = document.querySelector(".down-icon");
const downWhiteIcon = document.querySelector(".down-white-icon");
const upIcon = document.querySelector(".up-icon");
const upWhiteIcon = document.querySelector(".up-white-icon");

dropdownLink.addEventListener("click", function (event) {
    event.preventDefault();

    dropdownMenu.classList.toggle("d-none");

    downWhiteIcon.classList.toggle("d-none");

    if (!dropdownMenu.classList.contains("d-none")) {
        downIcon.classList.add("d-none");
        downWhiteIcon.classList.add("d-none");
        upIcon.classList.remove("d-none");
        upWhiteIcon.classList.remove("d-none");
    } else {
        downIcon.classList.remove("d-none");
        downWhiteIcon.classList.remove("d-none");
        upIcon.classList.add("d-none");
        upWhiteIcon.classList.add("d-none");
    }
});

/* FOR SIDEBAR ACTIVE LINK */
const currentPageUrl = window.location.href;
const sidebarLinks = document.querySelectorAll(".sidebar a"); // Get all the sidebar links

const dd = document.querySelector(".dropdown a");

sidebarLinks.forEach((link) => {
    if (link.href === currentPageUrl) {
        link.dataset.active = "";

        if (link.classList.contains("dd-link")) {
            dd.dataset.active = "";
        }
    }
});

console.log("masuk");
