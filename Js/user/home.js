const displayProduct = document.getElementById("display-product")

// This async function fetches all the stored products. When done, it displays each product inside our HTML table for
// each product there is

async function loadProducts(){ 
  try { 
    const response = await fetch('http://localhost/boutique2/user/gp', {
  });
    if (!response.ok) {
      throw new Error('Network response was not OK');
    }
      const data = await response.json();

      if (data) {
        console.log(data)

        for (let i = 0; i < data.length; i++) {
          // For each new product, we add a card
            const newCard = document.createElement('div');
            newCard.classList.add("card");

          // Append the card to the container card
            const containerCard = document.getElementById('container-card');
            containerCard.appendChild(newCard);

          // Create and append imgBx to the new card
            const imgBx = document.createElement('div');
            imgBx.classList.add("imgBx");
            var img = document.createElement("img");
            img.src = `webfiles/img/shop/${data[i].image}`;
            imgBx.appendChild(img);
            newCard.appendChild(imgBx);  
            
          // Create and append contentBx

            const contentBx = document.createElement("div")
            contentBx.classList.add("contentBx")

            // add h2 product title

            var h2 = document.createElement("h2")
            h2.innerText = `${data[i].name}`;
            contentBx.appendChild(h2);

            // add price

            const price = document.createElement("div")
            price.classList.add("price")

            var h3 = document.createElement("h3")
            h3.style.color = "white"
            h3.innerText = `${data[i].price}€`

            price.appendChild(h3)
            contentBx.appendChild(price)

            // Add button 

            link = document.createElement("a")
            link.href = ""
            link.innerText = "Voir"

            contentBx.appendChild(link)

            newCard.appendChild(contentBx)
        };  
      } else {
        console.log('echec')
      }
      }    
    catch (error) {
        console.error('Error:', error);
      }
      
}

// We call the function so that the table is displayed when we load the page

loadProducts();