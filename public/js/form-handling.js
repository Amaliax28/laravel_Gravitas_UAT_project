// For Selected Status on Form
/*
var status = document.getElementById("status");
var incomplete = document.getElementById("incomplete");
var ongoing = document.getElementById("ongoing");
var complete = document.getElementById("complete");

const projectInfo = document.getElementById("project-status");
const projectStatus = projectInfo.getAttribute("data-project-status");

if (projectStatus == "COMPLETE" || projectStatus == "complete") {
    complete.selected = true;
} else if (projectStatus == "ONGOING" || projectStatus == "complete") {
    ongoing.selected = true;
} else {
    incomplete.selected = true;
}
*/

const errorTexts = document.querySelectorAll(".text-error");

if (errorTexts) {
    errorTexts.forEach((errorText) => {
        errorText.style.fontSize = "0.9rem";
    });
}

// DISABLE BUTTON UNTILL ALL FIELDS ARE FILLED
const form = document.getElementById("regular-form");
if (form) {
    const inputs = form.querySelectorAll(
        "input:not(#userImage), select:not(#roles)",
    );
    const createUserBtn = document.getElementById("createUserBtn");

    document.addEventListener("DOMContentLoaded", function () {
        createUserBtn.disabled = true;
    });
    function checkInputs() {
        let allInputsFilled = true;
        inputs.forEach((input) => {
            if (input.value.trim() === "") {
                allInputsFilled = false;
                return;
            }
        });

        createUserBtn.disabled = !allInputsFilled;
    }

    inputs.forEach((input) => {
        input.addEventListener("change", checkInputs);
    });
}

// GENERATE PASSWORD
function generatePassword() {
    var length = 10; // length of the generated password
    var charset =
        "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; // characters to include in the password
    var password = "";

    for (var i = 0; i < length; i++) {
        var randomIndex = Math.floor(Math.random() * charset.length);
        password += charset.charAt(randomIndex);
    }

    document.getElementById("password").value = password;
}

// COPY TO CLIPBOARD
function copyToClipboard() {
    const data = {
        username: document.getElementById("username").value,
        email: document.getElementById("email").value,
        password: document.getElementById("password").value,
        roles: document.getElementById("roles").value,
    };

    const userInfoTemplate = `
        Username: ${data.username}
        Email: ${data.email}
        Password: ${data.password}
        Role: ${data.roles}
    `;
    const textarea = document.createElement("textarea");
    textarea.value = userInfoTemplate;
    document.body.appendChild(textarea);
    textarea.select();
    document.execCommand("copy");
    document.body.removeChild(textarea);
    return false;
}

// TOGGLE PASSWORD VISIBILITY
function togglePassword(passwordId) {
    const passwordField = document.getElementById(passwordId);
    const eyeOpenIcon = document.querySelector("." + passwordId + "EyeOpen");
    const eyeSlashedIcon = document.querySelector(
        "." + passwordId + "EyeSlashed",
    );

    if (passwordField.type === "password") {
        passwordField.type = "text";
        eyeOpenIcon.classList.add("d-none");
        eyeSlashedIcon.classList.remove("d-none");
    } else {
        passwordField.type = "password";
        eyeOpenIcon.classList.remove("d-none");
        eyeSlashedIcon.classList.add("d-none");
    }
}

// VERIFY PASSWORD
function verifyPassword(confirmPassId, passId) {
    const confirmPassField = document.getElementById(confirmPassId);
    const passField = document.getElementById(passId);
    const passError = document.getElementById("passError");
    const errorMsg = passError.querySelector(".text-error");

    if (passField.value.trim() !== "") {
        confirmPassField.required = true;
        passError.classList.remove("d-none");
        if (confirmPassField.value.trim() !== "") {
            if (confirmPassField.value !== passField.value) {
                errorMsg.textContent =
                    "The password field confirmation does not match.";
            } else {
                passError.classList.add("d-none");
            }
        }
    } else {
        confirmPassField.required = false;
    }
}
