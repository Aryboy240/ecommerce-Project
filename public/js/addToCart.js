// addToCart.js
document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".add-to-cart");

    buttons.forEach((button) => {
        button.addEventListener("click", function () {
            const productId = button.getAttribute("data-product-id");
            const quantity = button.getAttribute("data-quantity");

            addToCart(productId, quantity);
        });
    });

    function addToCart(productId, quantity) {
        // Adjust the URL for your add-to-cart route
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
