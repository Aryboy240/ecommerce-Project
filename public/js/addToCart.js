/* 
    Developer: Aryan Kora
    University ID: 230059030
    Function: Adding to the cart backend with notification pop-up
*/

document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".add-to-cart");
    const forms = document.querySelectorAll(".add-to-cart-form");

    // Create notification container
    const notification = document.createElement("div");
    notification.classList.add("notification");
    document.body.appendChild(notification);

    function showNotification(message, success = true) {
        notification.textContent = message;
        notification.classList.add("show");
        notification.style.backgroundColor = success ? "#4CAF50" : "#f44336"; // Green for success, red for error

        setTimeout(() => {
            notification.classList.remove("show");
        }, 3000);
    }

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
            event.preventDefault(); // Prevent default form submission
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
                    addToCart(productId, quantity);
                } else {
                    window.location.href = "/login";
                }
            })
            .catch((error) => console.log("Error:", error));
    }

    function addToCart(productId, quantity) {
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
                    showNotification("Product added to cart successfully!");
                } else {
                    showNotification("Error: " + data.error, false);
                }
            })
            .catch((error) => console.log("Error:", error));
    }
});
