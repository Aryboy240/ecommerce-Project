/* 
    Developer: Aryan Kora
    university ID: 230059030
    function: Adding to the cart backend
*/

document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".add-to-cart");
    const forms = document.querySelectorAll(".add-to-cart-form");

    // Handle button clicks (homepage)
    buttons.forEach((button) => {
        button.addEventListener("click", function () {
            const productId = button.getAttribute("data-product-id");
            const quantity = button.getAttribute("data-quantity");

            checkUserLoggedIn(productId, quantity);
        });
    });

    // Handle form submissions (search page)
    forms.forEach((form) => {
        form.addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent the default form submission
            const productId = form.querySelector(
                'input[name="product_id"]'
            ).value;
            const quantity = form.querySelector('input[name="quantity"]').value;

            checkUserLoggedIn(productId, quantity);
        });
    });

    function checkUserLoggedIn(productId, quantity) {
        fetch("/check-login", {
            method: "GET",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.logged_in) {
                    // If the user is logged in, add the item to the cart
                    addToCart(productId, quantity);
                } else {
                    // If the user is not logged in, redirect to login page
                    window.location.href = "/login"; // Adjust to your login URL
                }
            })
            .catch((error) => console.log("Error:", error));
    }

    function addToCart(productId, quantity) {
        // Ensure quantity is an integer
        quantity = parseInt(quantity);

        fetch("/cart/add", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    alert("Product added to cart!");
                } else {
                    alert("Error: " + data.error);
                }
            })
            .catch((error) => console.log("Error:", error));
    }
});
