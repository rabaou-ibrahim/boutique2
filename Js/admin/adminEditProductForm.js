const AdminEditForm = document.getElementById('admin-edit-form');
const Message = document.getElementById("admin-edit-message");

Message.style.color = 'red';

AdminEditForm.addEventListener('submit', (event) => {
    event.preventDefault(); // Prevent default form submission

    clearErrors();

    if (!validateFields() || !validateProductName() || !validateProductDescription() || !validateProductPrice() || !validateProductImage()) {
      return;
    }

    fetch('http://localhost/boutique2/admin/ev', {
      method: 'POST',
      body: new FormData(AdminEditForm)
    })
    .then(response => {
      if (response.ok) {
        return response.json();
      } else {
        throw new Error('Network response was not OK');
      }
    })
    .then(data => {
      console.log(data)
      const AdminAddMessage = data.message;
      if (data.success) {
        Message.style.color = 'green';
        window.location = 'http://localhost/boutique2/admin/';
      } else {
        Message.style.color = 'red'; 
      }
      Message.textContent = AdminAddMessage; 
    })
    .catch(error => {
      // Handle errors
      console.error('Error:', error);
    });
});

function clearErrors() {
  Message.textContent = '';
}

function validateFields() {
  const nameInput = document.getElementById('name');
  const nameValue = nameInput.value.trim();

  const descriptionInput = document.getElementById('description');
  const descriptionValue = descriptionInput.value.trim();

  const priceInput = document.getElementById('price');
  const priceValue = priceInput.value.trim();

  if (nameValue === '' && descriptionValue === '' && priceValue) {
    Message.textContent = 'Les champs doivent être remplis';
    return false;
  }

  return true;
}

function validateProductName() {
  const nameInput = document.getElementById('name');
  const nameValue = nameInput.value.trim();

  if (nameValue === '') {
    Message.textContent = 'Le nom doit être renseigné.';
    return false;
  }

  return true;
}

function validateProductDescription() {
  const descriptionInput = document.getElementById('description');
  const descriptionValue = descriptionInput.value.trim();

  if (descriptionValue === '') {
    Message.textContent = 'La description doit être renseignée.';
    return false;
  }

  return true;
}

function validateProductImage() {
  const imageInput = document.getElementById('image');
  const imageValue = imageInput.value.trim();

  if (imageValue === '') {
    Message.textContent = "L'image doit être renseignée";
    return false;
  }
  return true;
}

function validateProductPrice() {
  const priceInput = document.getElementById('price');
  const priceValue = priceInput.value.trim();

  if (priceValue === '') {
    Message.textContent = 'Le prix doit être renseignée.';
    return false;
  }
  return true;
}

