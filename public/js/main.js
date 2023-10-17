/* FOR SIDEBAR DROPDOWN
document.addEventListener("DOMContentLoaded", () => {
    const dropdowns = document.querySelectorAll(".dropdown");
    const currentPageUrl = window.location.href;

    dropdowns.forEach((dropdown) => {
        const dropdownLink = dropdown.querySelector(".dropdown a");
        const dropdownMenu = dropdown.querySelector(".dropdown-content");
        const downIcon = dropdown.querySelector(".down-icon");
        const downWhiteIcon = dropdown.querySelector(".down-white-icon");
        const upIcon = dropdown.querySelector(".up-icon");
        const upWhiteIcon = dropdown.querySelector(".up-white-icon");

        dropdownLink.addEventListener("click", function (event) {
            event.preventDefault();
            dropdownMenu.classList.add("test");

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

        if (dropdownLink.href.split("#")[0] == currentPageUrl) {
            dropdownLink.dataset.active = "";
            console.log(dropdownLink.href.split("#")[0]);
        } else {
            delete dropdownLink.dataset.active;
        }
    });
    const sidebarLinks = document.querySelectorAll(".sidebar a"); // Get all the sidebar links
    const dd = document.querySelector(".dropdown a");

    sidebarLinks.forEach((link) => {
        if (link.href === currentPageUrl) {
            link.dataset.active = "";
        }
    });
});

*/
document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.querySelector(".sidebar");

    if (sidebar) {
        const dropdowns = document.querySelectorAll(".dropdown");
        const currentPageUrl = window.location.href;
        dropdowns.forEach((dropdown) => {
            const dropdownLink = dropdown.querySelector(".dropdown a");
            const dropdownMenu = dropdown.querySelector(".dropdown-content");
            const downIcon = dropdown.querySelector(".down-icon");
            const downWhiteIcon = dropdown.querySelector(".down-white-icon");
            const upIcon = dropdown.querySelector(".up-icon");
            const upWhiteIcon = dropdown.querySelector(".up-white-icon");
            dropdownLink.addEventListener("click", function (event) {
                event.preventDefault();
                downWhiteIcon.classList.toggle("d-none");

                dropdownMenu.classList.toggle("d-none");
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

            const dropdownItemsLink = dropdown.querySelectorAll(".item-cont a");
            dropdownItemsLink.forEach((itemLink) => {
                if (itemLink.href == currentPageUrl) {
                    dropdownLink.dataset.active = "";
                }
                if (
                    itemLink.getAttribute("href") == "/all-projects" &&
                    currentPageUrl.includes("project")
                ) {
                    dropdownLink.dataset.active = "";
                }
            });
        });

        const sidebarLinks = document.querySelectorAll(".sidebar a");

        sidebarLinks.forEach((link) => {
            if (link.href === currentPageUrl) {
                link.dataset.active = "";
            }
        });
    }
});

// Initialize tooltips
var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]'),
);
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});
function preview() {
    var addLogo = document.getElementById("add-logo");
    var frame = document.getElementById("frame");

    frame.classList.remove("d-none"); //display image
    addLogo.classList.add("d-none"); // remove the add icon
    frame.src = URL.createObjectURL(event.target.files[0]);
}

document.addEventListener("DOMContentLoaded", () => {
    const statusBoxes = document.querySelectorAll(".status-box");
    if (statusBoxes) {
        statusBoxes.forEach((statusBox) => {
            const textContent = statusBox.textContent.trim();
            if (textContent === "ONGOING" || textContent === "PENDING") {
                statusBox.classList.add("ongoing");
            } else if (
                textContent === "INCOMPLETE" ||
                textContent === "NO ANSWERS"
            ) {
                statusBox.classList.add("incomplete");
            } else if (
                textContent === "COMPLETE" ||
                textContent === "UPDATED"
            ) {
                statusBox.classList.add("complete");
            }
        });
    }
});
