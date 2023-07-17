const RoundBtnCart = document.getElementById("round-btn");
const ItemCount = document.getElementById("item-count");
const BookmarkBtns = document.getElementsByClassName("bookmark-btn");

const updateItemCount = (count) => {
    ItemCount.textContent = count;
  };
  

const checkUserCart = () => {
  fetch('http://localhost/boutique2/user/gc')
    .then(response => response.json())
    .then(userCart => {
      RoundBtnCart.style.backgroundColor = userCart ? 'green' : 'red';
    })
    .catch(error => {
      console.log('Error:', error);
    });
};

const checkUserCartItems = () => {
    fetch('http://localhost/boutique2/user/gc')
      .then(response => response.json())
      .then(userCart => {
        const itemCount = userCart ? userCart.products.length : 0;
        updateItemCount(itemCount);
        incrementRoundBtns(userCart.products);
      })
      .catch(error => {
        console.log('Error:', error);
      });
};
  
const incrementRoundBtns = (products) => {
    Array.from(BookmarkBtns).forEach(btn => {
      const productId = btn.dataset.productId;
      const cartItem = products.find(item => item.productId === productId);
      if (cartItem) {
        const quantity = cartItem.quantity;
        const roundBtn = btn.nextElementSibling.nextElementSibling;
        roundBtn.textContent = quantity;
        roundBtn.style.display = 'block';
      }
    });
  };

window.addEventListener('load', () => {
    checkUserCart();
    checkUserCartItems();
  });
  
Array.from(BookmarkBtns).forEach(btn => {
    btn.addEventListener('click', () => {
      const productId = btn.dataset.productId;
      const price = btn.dataset.price;
      addProductToCart(productId, price);
    });
});

// Sample data (replace with your dynamic data)
const cartItems = [
  {
    image: 'http://example.com/image1.png',
    description: 'Product 1',
    quantity: 2,
    totalPrice: 50
  },
  {
    image: 'http://example.com/image2.png',
    description: 'Product 2',
    quantity: 1,
    totalPrice: 30
  },
  {
    image: 'http://example.com/image3.png',
    description: 'Product 3',
    quantity: 3,
    totalPrice: 80
  }
];

// Get the cart items container
const cartItemsContainer = document.querySelector('.cart-items');

// Create cart item elements
cartItems.forEach(item => {
  const cartItem = document.createElement('div');
  cartItem.classList.add('cart-item');
  cartItem.innerHTML = `
    <img src="${item.image}" alt="Product Image">
    <div class="cart-item-description">
      <p>${item.description}</p>
      <p>Quantity: ${item.quantity}</p>
      <p>Total Price: ${item.totalPrice}</p>
    </div>
  `;
  cartItemsContainer.appendChild(cartItem);
});
