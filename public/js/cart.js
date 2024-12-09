function updateQuantity(selectElement, itemId) {
    const quantity = selectElement.value;
    const pricePerUnit = parseFloat(
        document.getElementById(`total_${itemId}`).dataset.pricePerUnit
    );
    const totalElement = document.getElementById(`total_${itemId}`);

    // Update item total
    const newTotal = (pricePerUnit * quantity).toFixed(2);
    totalElement.textContent = newTotal;

    // Update subtotal
    const itemTotals = document.querySelectorAll('[id^="total_"]');
    let newSubtotal = 0;
    itemTotals.forEach((item) => {
        newSubtotal += parseFloat(item.textContent);
    });
    document.getElementById("subtotal").textContent = newSubtotal.toFixed(2);
    document.getElementById("cart-total").textContent = newSubtotal.toFixed(2);

    // Send update request to server (optional)
    fetch(`/cart/update/${itemId}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
        },
        body: JSON.stringify({ quantity: quantity }),
    }).then((response) => {
        if (!response.ok) {
            console.error("Failed to update quantity.");
        }
    });
}

function removeItem(itemId) {
    if (confirm("Are you sure you want to remove this item?")) {
        fetch(`/cart/remove/${itemId}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
        }).then((response) => {
            if (response.ok) {
                location.reload(); // Refresh the page after removal
            } else {
                console.error("Failed to remove item.");
            }
        });
    }
}
