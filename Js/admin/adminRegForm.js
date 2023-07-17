// Admin Reg Form //

const form = document.getElementById('reg-form');
const Message = document.getElementById('registration-message');

Message.style.color = 'red';

form.addEventListener('submit', (event) => {
  event.preventDefault(); // Prevent default form submission

    clearErrors();

    if (!validateFields() || !validateFirstName() || !validateLastName() || !validateUsername() || !validateEmail() || !validatePassword() || !validateConfirmedPassword()) {
      return;
    }

    fetch('http://localhost/boutique2/admin/rv', {
      method: 'POST',
      body: new FormData(form)
    })
    .then(response => {
        if (response.ok) {
          return response.json(); // Parse response as JSON
        } else {
          throw new Error('Network response was not OK');
        }
      })
      .then(data => {
        const message = data.message;
        if (data.success) {
          Message.style.color = 'green'; // Set color to green for success message
          window.location = "http://localhost/boutique2/admin/l";
        } else {
          Message.style.color = 'red'; // Set color to red for error message
        }
        Message.textContent = message; // Display the message in the result container
      })
      .catch(error => {
        console.error('Error:', error);
      });
    });


    function clearErrors() {
      Message.textContent = '';
    }

    function validateFields() {
        const lastnameInput = document.getElementById('lastname');
        const lastnameValue = lastnameInput.value.trim();

        const firstnameInput = document.getElementById('firstname');
        const firstnameValue = firstnameInput.value.trim();

        const usernameInput = document.getElementById('username');
        const usernameValue = usernameInput.value.trim();

        const emailInput = document.getElementById('email');
        const emailValue = emailInput.value.trim();

        const passwordInput = document.getElementById('password');
        const passwordValue = passwordInput.value.trim();

        const confirmedpasswordInput = document.getElementById('confirmed-password');
        const confirmedpasswordValue = confirmedpasswordInput.value.trim();
  
        if (lastnameValue === '' && firstnameValue === '' && usernameValue === '' && emailValue === '' && passwordValue === '' && confirmedpasswordValue === '') {
          Message.textContent = 'Les champs doivent être remplis';
          return false;
        }
  
        return true;
      }

    function validateLastName() {
      const lastnameInput = document.getElementById('lastname');
      const lastnameValue = lastnameInput.value.trim();

      if (lastnameValue === '') {
        Message.textContent = 'Le nom de famille doit être renseigné.';
        return false;
      }

      return true;
    }

    function validateFirstName() {
        const firstnameInput = document.getElementById('firstname');
        const firstnameValue = firstnameInput.value.trim();
  
        if (firstnameValue === '') {
          Message.textContent = 'Le prénom doit être renseigné.';
          return false;
        }
  
        return true;
    }

    function validateUsername() {
        const usernameInput = document.getElementById('username');
        const usernameValue = usernameInput.value.trim();
  
        if (usernameValue === '') {
          Message.textContent = 'Le pseudo ou email doit être renseigné.';
          return false;
        }
  
        return true;
    }

    function validateEmail() {
      const emailInput = document.getElementById('email');
      const emailValue = emailInput.value.trim();

      if (emailValue === '') {
        Message.textContent = 'Veuillez renseigner votre adresse mail';
        return false;
      }

      if (!isValidEmail(emailValue)) {
        Message.textContent = 'Entrez une adresse mail valide.';
        return false;
      }

      return true;
    }

    function isValidEmail(email) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    }

    function validatePassword() {
        const passwordInput = document.getElementById('password');
        const passwordValue = passwordInput.value.trim();
  
        if (passwordValue === '') {
          Message.textContent = 'Le mot de passe doit être renseigné.';
          return false;
        }
  
        return true;
    }

    function validateConfirmedPassword() {
      const confirmedpasswordInput = document.getElementById('confirmed-password');
      const confirmedpasswordValue = confirmedpasswordInput.value.trim();

      const passwordInput = document.getElementById('password');
      const passwordValue = passwordInput.value.trim();


      if (confirmedpasswordValue === '') {
        Message.textContent = 'Le mot de passe doit être confirmé.';
        return false;
      }

      if (!areValidPasswords(passwordValue, confirmedpasswordValue)) {
        Message.textContent = 'Les mots de passes ne sont pas identiques.';
        return false;
      }

      return true;
  }

  function areValidPasswords(password, confirmedpassword) {
    if (password === confirmedpassword) {
      return true;
    }

}