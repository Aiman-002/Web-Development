

function validateForm() {
    
    resetErrorMessages();

    
    const name = document.getElementById('name').value;
    const contact = document.getElementById('contact').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const gender = document.querySelector('input[name="gender"]:checked');
    const agree = document.getElementById('agree');

    
    validateName(name);
    validateContact(contact);
    validateEmail(email);
    validatePassword(password);
    validateGender(gender);
    validateAgree(agree);

    
    if (allValid()) {
        displaySuccess();
    }
}

function resetErrorMessages() {
    const errorElements = document.querySelectorAll('[id$="Error"]');
    errorElements.forEach((element) => {
        element.textContent = '';
    });
}

function validateName(name) {
    const nameError = document.getElementById('nameError');
    if (!name.match(/^[a-zA-Z\s]+$/)) {
        nameError.textContent = 'Invalid name';
    }
}

function validateContact(contact) {
    const contactError = document.getElementById('contactError');
    if (!contact.match(/^\d{10}$/)) {
        contactError.textContent = 'Invalid contact number';
    }
}

function validateEmail(email) {
    const emailError = document.getElementById('emailError');
    if (!email.match(/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/)) {
        emailError.textContent = 'Invalid email address';
    }
}

function validatePassword(password) {
    const passwordError = document.getElementById('passwordError');
    if (password.length < 8) {
        passwordError.textContent = 'Password must be at least 8 characters long';
    }
}

function validateGender(gender) {
    const genderError = document.getElementById('genderError');
    if (!gender) {
        genderError.textContent = 'Please select a gender';
    }
}

function validateAgree(agree) {
    const agreeError = document.getElementById('agreeError');
    if (!agree.checked) {
        agreeError.textContent = 'You must agree to the terms and conditions';
    }
}

function allValid() {
    const errorElements = document.querySelectorAll('[id$="Error"]');
    for (const element of errorElements) {
        if (element.textContent !== '') {
            return false;
        }
    }
    return true;
}

function displaySuccess() {
    const displaySection = document.getElementById('displaySection');
    if (displaySection) {
        displaySection.innerHTML = `<p>Signup successful!</p>`;
    } else {
        console.error("Error: 'displaySection' element not found.");
    }
}
