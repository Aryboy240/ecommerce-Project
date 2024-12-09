document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".add-to-cart");
    const forms = document.querySelectorAll(".add-to-cart-form");

    // Handle button clicks (homepage)
    buttons.forEach((button) => {
        button.addEventListener("click", function () {
            const productId = button.getAttribute("data-product-id");
            const quantity = button.getAttribute("data-quantity");

            addToCart(productId, quantity);
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

            addToCart(productId, quantity);
        });
    });

    function addToCart(productId, quantity) {
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
