document.addEventListener('DOMContentLoaded', () => {
    // Fetch and display products
    fetch('get_products.php')
        .then(response => response.json())
        .then(data => {
            const productList = document.getElementById('product-list');
            data.forEach(product => {
                const productItem = document.createElement('div');
                productItem.classList.add('product-item');
                productItem.innerHTML = `
                    <h3>${product.name}</h3>
                    <img src="product_image.jpg" alt="${product.name}">
                    <p>${product.description}</p>
                    <p>Price: $${product.price}</p>
                    <button onclick="addToCart(${product.id})">Add to Cart</button>
                `;
                productList.appendChild(productItem);
            });
        });

    // Contact form submission
    document.getElementById('contact-form').addEventListener('submit', event => {
        event.preventDefault();
        const formData = new FormData(event.target);
        fetch('contact.php', {
            method: 'POST',
            body: formData
        }).then(response => response.text())
        .then(data => {
            alert('Message sent successfully!');
            event.target.reset();
        });
    });
});

function addToCart(productId) {
    fetch('add_to_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ productId })
    }).then(response => response.text())
    .then(data => {
        alert('Product added to cart!');
        // Optionally, update the cart display here
    });
}

function loadCart() {
    fetch('get_cart.php')
        .then(response => response.json())
        .then(data => {
            const cartItems = document.getElementById('cart-items');
            cartItems.innerHTML = '';
            data.forEach(item => {
                const cartItem = document.createElement('div');
                cartItem.classList.add('cart-item');
                cartItem.innerHTML = `
                    <h3>${item.name}</h3>
                    <p>Price: $${item.price}</p>
                    <p>Quantity: ${item.quantity}</p>
                    <button onclick="removeFromCart(${item.id})">Remove</button>
                `;
                cartItems.appendChild(cartItem);
            });
        });
}

function removeFromCart(cartItemId) {
    fetch('remove_from_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ cartItemId })
    }).then(response => response.text())
    .then(data => {
        alert('Product removed from cart!');
        loadCart();
    });
}

loadCart();
