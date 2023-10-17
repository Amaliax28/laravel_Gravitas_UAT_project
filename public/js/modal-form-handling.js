//DISABLE BUTTON UNTILL ALL FIELDS ARE FILLED
const form = document.getElementById("modal-form");
const submitBtn = document.getElementById("submitBtn");
const inputs = form.querySelectorAll("input,textarea");
inputs.forEach((input) => {
    input.addEventListener("input", () => {
        const allFilled = [...inputs].every((input) => input.value !== "");
        submitBtn.disabled = !allFilled;
    });
});
