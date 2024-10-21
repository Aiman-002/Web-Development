

function submitForm() {
   
    const firstName = document.getElementById('firstName').value;
    const lastName = document.getElementById('lastName').value;
    const email = document.getElementById('email').value;

    
    const displaySection = document.getElementById('displaySection');
    displaySection.innerHTML = `
        <p>First Name: ${firstName}</p>
        <p>Last Name: ${lastName}</p>
        <p>Email: ${email}</p>
    `;
}
