                // AUTOCOMPELTION //

// Retrieve the search input element
const searchInput = document.getElementById('search-input');
const autoCompletionMsg = document.getElementById('autocompletion-msg');
const bar = document.getElementById('bar')
const container = document.querySelector('.container');
const originalTableContent = container.innerHTML;

searchInput.addEventListener('input', function() {
    const searchTerm = searchInput.value.trim().toLowerCase();
    fetch('http://localhost/boutique2/user/sa')
        .then(response => response.json())
        .then(productsData => {
            const matchedProducts = productsData.filter(product => {
                const productName = product.name.toLowerCase();
                return productName.includes(searchTerm);
            });
            console.log(matchedProducts);

            const matchedProductsLength = parseInt(matchedProducts.length, 10) || 0;

            container.innerHTML = '';
            bar.classList.add('bar')
            container.appendChild(bar);
            container.appendChild(autoCompletionMsg)

            if (searchTerm === '') {
                autoCompletionMsg.innerHTML = '';
            }

            else if (searchTerm !== '') {
                
            }

            if (matchedProductsLength > 1) {
                autoCompletionMsg.innerHTML = matchedProductsLength + ' résultats trouvés';
                console.log('Produits trouvés: ' + matchedProductsLength);

                matchedProducts.forEach(product => {
                    const productName = product.name;
                    const productDescription = product.description;
                    const productPrice = product.price;

                  
                    const table = document.createElement('table');
                    table.classList.add('table', 'product-table');

                    // Create a new table row for each matched product
                    const newRow = document.createElement('tr');
                    newRow.classList.add('table-content');
                    newRow.innerHTML = `
                        <td>
                            <div class="tooltip">
                                <img src="http://localhost/boutique2/webfiles/img/shop/${product.image}" width="150px">
                                <span class="tooltip-text">
                                    <strong class="product-name">Nom:</strong> ${productName}<br>
                                    <strong class="product-description">Description:</strong> ${productDescription}<br>
                                    <strong class="product-price">Prix:</strong> ${productPrice}€
                                </span>
                            </div>
                        </td>
                        <td><a href="${URL}user/v/${product.id}"><button class="view-btn">Voir</button></a></td>
                        <td>
                          <form action="<?= URL ?>user/ac/" method="POST">
                          <input type="number" name="quantity" class="quantity-input" value="1" min="1">
                          <input type="hidden" name="productId" value="<?php echo $products[$i]->getId(); ?>">
                          <input type="hidden" name="price" value="<?php echo $products[$i]->getPrice(); ?>">
                          <button class="bookmark-btn" id="bookmark-btn">Ajouter</button>
                          </form>
                        </td>`;

                    // Append the new row to the table
                    table.appendChild(newRow);

                    container.appendChild(table);
                });

            } else if (matchedProductsLength === 1) {
                autoCompletionMsg.innerHTML = matchedProductsLength + ' résultat trouvé';

                matchedProducts.forEach(product => {
                    const productName = product.name;
                    const productDescription = product.description;
                    const productPrice = product.price;

                    // Create a new table for each matched product
                    const table = document.createElement('table');
                    table.classList.add('table', 'product-table');

                    // Create a new table row for each matched product
                    const newRow = document.createElement('tr');
                    newRow.classList.add('table-content');
                    newRow.innerHTML = `
                        <td>
                            <div class="tooltip">
                                <img src="http://localhost/boutique2/webfiles/img/shop/${product.image}" width="150px">
                                <span class="tooltip-text">
                                    <strong class="product-name">Nom:</strong> ${productName}<br>
                                    <strong class="product-description">Description:</strong> ${productDescription}<br>
                                    <strong class="product-price">Prix:</strong> ${productPrice}€
                                </span>
                            </div>
                        </td>
                        <td><a href="${URL}user/v/${product.id}"><button class="view-btn">Voir</button></a></td>
                        <td>
                          <form action="<?= URL ?>user/ac/" method="POST">
                          <input type="number" name="quantity" class="quantity-input" value="1" min="1">
                          <input type="hidden" name="productId" value="<?php echo $products[$i]->getId(); ?>">
                          <input type="hidden" name="price" value="<?php echo $products[$i]->getPrice(); ?>">
                          <button class="bookmark-btn" id="bookmark-btn">Ajouter</button>
                          </form>
                        </td>`;

                    // Append the new row to the table
                    table.appendChild(newRow);

                    // Append the table and search bar to the container
                    container.appendChild(table);
                });
            } else {
                if (searchTerm === '') {
                    autoCompletionMsg.innerHTML = '';

                matchedProducts.forEach(product => {
                    const productName = product.name;
                    const productDescription = product.description;
                    const productPrice = product.price;

                    // Create a new table for each matched product
                    const table = document.createElement('table');
                    table.classList.add('table', 'product-table');

                    // Create a new table row for each matched product
                    const newRow = document.createElement('tr');
                    newRow.classList.add('table-content');
                    newRow.innerHTML = `
                        <td>
                            <div class="tooltip">
                                <img src="http://localhost/boutique2/webfiles/img/shop/${product.image}" width="150px">
                                <span class="tooltip-text">
                                    <strong class="product-name">Nom:</strong> ${productName}<br>
                                    <strong class="product-description">Description:</strong> ${productDescription}<br>
                                    <strong class="product-price">Prix:</strong> ${productPrice}€
                                </span>
                            </div>
                        </td>
                        <td><a href="${URL}user/v/${product.id}"><button class="view-btn">Voir</button></a></td>
                        <td>
                          <form action="<?= URL ?>user/ac/" method="POST">
                          <input type="number" name="quantity" class="quantity-input" value="1" min="1">
                          <input type="hidden" name="productId" value="<?php echo $products[$i]->getId(); ?>">
                          <input type="hidden" name="price" value="<?php echo $products[$i]->getPrice(); ?>">
                          <button class="bookmark-btn" id="bookmark-btn">Ajouter</button>
                          </form>
                        </td>`;

                    // Append the new row to the table
                    table.appendChild(newRow);

                    // Append the table and search bar to the container
                    container.appendChild(table);
                });
                } else {
                    autoCompletionMsg.innerHTML = '';

                matchedProducts.forEach(product => {
                    const productName = product.name;
                    const productDescription = product.description;
                    const productPrice = product.price;

                    // Create a new table for each matched product
                    const table = document.createElement('table');
                    table.classList.add('table', 'product-table');

                    // Create a new table row for each matched product
                    const newRow = document.createElement('tr');
                    newRow.classList.add('table-content');
                    newRow.innerHTML = `
                        <td>
                            <div class="tooltip">
                                <img src="http://localhost/boutique2/webfiles/img/shop/${product.image}" width="150px">
                                <span class="tooltip-text">
                                    <strong class="product-name">Nom:</strong> ${productName}<br>
                                    <strong class="product-description">Description:</strong> ${productDescription}<br>
                                    <strong class="product-price">Prix:</strong> ${productPrice}€
                                </span>
                            </div>
                        </td>
                        <td><a href="http://localhost/boutique2/user/v/${product.id}"><button class="view-btn">Voir</button></a></td>
                        <td>
                          <form action="<?= URL ?>user/ac/" method="POST">
                          <input type="number" name="quantity" class="quantity-input" value="1" min="1">
                          <input type="hidden" name="productId" value="<?php echo $products[$i]->getId(); ?>">
                          <input type="hidden" name="price" value="<?php echo $products[$i]->getPrice(); ?>">
                          <button class="bookmark-btn" id="bookmark-btn">Ajouter</button>
                          </form>
                        </td>`;

                    // Append the new row to the table
                    table.appendChild(newRow);

                    // Append the table and search bar to the container
                    container.appendChild(table);
                });
                }
                // Restore the original table content
                container.innerHTML = originalTableContent;
            }
        })
        .catch(error => {
            console.log('Error fetching autocomplete data:', error);
        });
});

// Define reusable functions

const RoundBtnCart = document.getElementById("round-btn");
const ItemCount = document.getElementById("item-count");
const BookmarkBtns = document.getElementsByClassName("bookmark-btn");

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
      console.log(userCart);
      updateItemCount(userCart.products.length);
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


const updateItemCount = (count) => {
  ItemCount.textContent = count.toString();
};


const addProductToCart = (productId, price) => {
  fetch('http://localhost/boutique2/user/ac', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      productId: productId,
      price: price
    })
  })
    .then(response => response.json())
    .then(result => {
      if (result.success) {
        const count = parseInt(ItemCount.textContent) + 1;
        updateItemCount(count);
        RoundBtnCart.style.backgroundColor = 'green';
      } else {
        console.log('Ajout non réalisé.');
      }
    })
    .catch(error => {
      console.log('Error:', error);
    });
};

window.addEventListener('load', () => {
  checkUserCart();
  checkUserCartItems();
});

BookmarkBtns.forEach(btn => {
  btn.addEventListener('click', (event) => {
    event.preventDefault(); // Prevent the default form submission.
    const form = event.target.closest('form'); // Get the closest parent form element.
    const productId = form.querySelector('input[name="productId"]').value;
    const price = form.querySelector('input[name="price"]').value;
    addProductToCart(productId, price);
    window.location = 'http://localhost/boutique2/user/s'
  });
});
