// Log Form //

const logForm = document.getElementById('log-form');
const LogMessage = document.getElementById('log-message');

LogMessage.style.color = 'red';

logForm.addEventListener('submit', (event) => {
  event.preventDefault(); // Prevent default form submission

    clearLogErrors();

    if (!validateLogFields() || !validateLogUsername() || !validateLogPassword()) {
      return;
    }

    fetch('http://localhost/boutique2/user/lv', {
      method: 'POST',
      body: new FormData(logForm)
    })
    .then(response => {
        if (response.ok) {
          return response.json(); // Parse response as JSON
        } else {
          throw new Error('Network response was not OK');
        }
      })
      .then(data => {
        const Logmessage = data.message;
        if (data.success) {
          LogMessage.style.color = 'green';
          window.location = 'http://localhost/boutique2/user/p';
        } else {
          LogMessage.style.color = 'red'; // Set color to red for error message
        }
        LogMessage.textContent = Logmessage; // Display the message in the result container
      })
      .catch(error => {
        console.error('Error:', error);
      });
    });


    function clearLogErrors() {
      LogMessage.textContent = '';
    }

    function validateLogFields() {

        const usernameInput = document.getElementById('username');
        const usernameValue = usernameInput.value.trim();

        const passwordInput = document.getElementById('password');
        const passwordValue = passwordInput.value.trim();

        if (usernameValue === '' && passwordValue === '') {
          LogMessage.textContent = 'Les champs doivent être remplis';
          return false;
        }
  
        return true;
      }

    function validateLogUsername() {
        const usernameInput = document.getElementById('username');
        const usernameValue = usernameInput.value.trim();
  
        if (usernameValue === '') {
          LogMessage.textContent = 'Le pseudo doit être renseigné.';
          return false;
        }
  
        return true;
    }

    function validateLogPassword() {
        const passwordInput = document.getElementById('password');
        const passwordValue = passwordInput.value.trim();
  
        if (passwordValue === '') {
          LogMessage.textContent = 'Le mot de passe doit être renseigné.';
          return false;
        }
  
        return true;
    }


