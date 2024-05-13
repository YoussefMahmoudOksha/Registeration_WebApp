document.addEventListener("DOMContentLoaded", function () {
    document.querySelector("form").addEventListener("submit", function (event) {
        event.preventDefault();
        var errorMessages = validateForm();
        if (errorMessages.length > 0) {
            showErrors(errorMessages);
        }
        else {
            // If JavaScript validation passes, submit the form programmatically
            this.submit(); // Submit the form
        }
    });
});

function validateForm() {
    var errorMessages = [];
    // Full Name Validation
    var fullName = document.getElementById("full_name").value.trim();
    if (!isValidFullName(fullName)) {

        errorMessages.push(
            "Please enter a valid full name (only alphabetic characters allowed)."
        );

    }

    // User Name Validation
    var userName = document.getElementById("user_name").value.trim();
    if (!isValidUserName(userName)) {

        errorMessages.push("Please enter a valid username.");

    }

    // Birthdate Validation
    var birthdate = new Date(document.getElementById("birthday").value);
    if (!isValidBirthdate(birthdate)) {

        errorMessages.push("Please enter a valid birthday (you must be at least 16 years old).");

    }

    // Phone Validation
    var phone = document.getElementById("phone").value.trim();
    if (!isValidPhone(phone)) {

        errorMessages.push("Please enter a valid phone number.");

    }

    // Address Validation
    var address = document.getElementById("address").value.trim();
    if (address === "") {

        errorMessages.push("Please enter your address.");

    }

    // Password Validation
    var password = document.getElementById("password").value.trim();
    var confirmPassword = document
        .getElementById("confirm_password")
        .value.trim();
    if (password === "") {

        errorMessages.push("Please enter a password.");

    }
    if (password !== confirmPassword) {
        errorMessages.push("Passwords do not match.");

    }

    if (!isValidPassword(password)) {
        // Pass password as parameter
        errorMessages.push("Password must be at least 8 characters long and contain at least one number and one special character.");
    }

    // Email Validation
    var email = document.getElementById("email").value.trim();
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        errorMessages.push("Please enter a valid email address.");

    }

    // Image Validation 
    var fileinput = document.querySelector("input[type='file']");
    if (!fileinput.files[0] || !isValidImage(fileinput.files[0].name)) {
        errorMessages.push("Please upload a valid image file(jpg, jpeg, png, gif).");
    }
    return errorMessages;
}

function isValidPassword(password) {
    // Check if password meets complexity requirements
    var passwordRegex = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@#$%^&+=!]).{8,}$/;
    return passwordRegex.test(password);

}

function isValidFullName(name) {
    // Regular expression to match only alphabetic characters
    var nameRegex = /^[a-zA-Z\s]+$/;
    return nameRegex.test(name);
}

function isValidBirthdate(date) {
    // Check if the provided date is valid and the user is at least 16 years old
    if (!(date instanceof Date && !isNaN(date))) {
        return false;
    }
    var today = new Date();
    var minBirthdate = new Date(
        today.getFullYear() - 16,
        today.getMonth(),
        today.getDate()
    );
    return date <= minBirthdate;
}

function isValidUserName(userName) {
    return userName !== "";
}
function isValidPhone(phone) {
    // Phone format
    var phoneRegex = /^(01)(2|5|1|0)[0-9]{8}$/;
    return phoneRegex.test(phone);
}

function isValidImage(image) {
    const extensions = ["jpg", "jpeg", "png", "gif"];
    let res = image.split(".").pop().toLowerCase();
    return extensions.includes(res);
}

function showErrors(errorMessages) {
    var errorSummary = document.getElementById("error-summary");
    errorSummary.innerHTML = "There are some errors, please correct them below.<br>";
    errorSummary.style.display = "block";
    errorMessages.forEach(function (message) {
        errorSummary.innerHTML += "- " + message + "<br>";
    });

}
