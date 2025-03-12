/* 
    Developer: Aryan Kora
    University ID: 230059030
    Function: Adding to the cart backend with notification pop-up
*/

document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".add-to-cart");
    const forms = document.querySelectorAll(".add-to-cart-form");

    // Ensure only one notification container is created
    let notification = document.querySelector(".notification");
    if (!notification) {
        notification = document.createElement("div");
        notification.classList.add("notification");
        document.body.appendChild(notification);
    }

    // Check if a notification message exists in sessionStorage
    const storedNotification = sessionStorage.getItem("notificationMessage");
    const storedSuccess = sessionStorage.getItem("notificationSuccess");

    if (storedNotification) {
        showNotification(storedNotification, storedSuccess === "true");
        // Clear sessionStorage after showing the notification
        sessionStorage.removeItem("notificationMessage");
        sessionStorage.removeItem("notificationSuccess");
    }

    function showNotification(message, success = true) {
        notification.textContent = message;
        notification.style.backgroundColor = success ? "#4CAF50" : "#f44336"; // Green for success, red for error

        setTimeout(() => {
            notification.classList.add("show");
        }, 10); // Slight delay for animation to trigger

        setTimeout(() => {
            notification.classList.remove("show");
        }, 3000); // Notification stays visible for 3 seconds
    }

    // Handle button clicks (homepage & search page)
    function handleAddToCart(event) {
        event.preventDefault(); // Prevent form submission if triggered by a form

        const button = event.currentTarget;
        const productId =
            button.getAttribute("data-product-id") ||
            button.closest("form").querySelector('input[name="product_id"]')
                .value;
        const quantity =
            button.getAttribute("data-quantity") ||
            button.closest("form").querySelector('input[name="quantity"]')
                .value;

        if (!productId) {
            showNotification("Error: Product ID is missing!", false);
            return;
        }

        checkUserLoggedIn(productId, quantity);
    }

    // Attach event listeners to buttons (homepage & search page)
    buttons.forEach((button) =>
        button.addEventListener("click", handleAddToCart)
    );
    forms.forEach((form) => form.addEventListener("submit", handleAddToCart));

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
            body: JSON.stringify({ product_id: productId, quantity: quantity }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    // Store notification data in sessionStorage before reload
                    sessionStorage.setItem(
                        "notificationMessage",
                        "Product added to cart successfully!"
                    );
                    sessionStorage.setItem("notificationSuccess", "true");
                    // Immediately reload the page after storing the notification
                    location.reload();
                } else {
                    // Store error notification in sessionStorage before reload
                    sessionStorage.setItem(
                        "notificationMessage",
                        "Error: " + data.error
                    );
                    sessionStorage.setItem("notificationSuccess", "false");
                    // Immediately reload the page after storing the notification
                    location.reload();
                }
            })
            .catch((error) => console.log("Error:", error));
    }
});
