// Function to view order details
function viewDetails(orderId) {
    // Simulate fetching order details (replace this with an actual AJAX call)
    const orderDetails = {
        id: orderId,
        customerName: orderId === '10001' ? "John Doe" : "Jane Smith",
        products: orderId === '10001' ? "Product A, Product B" : "Product C, Product D",
        paymentMethod: "Credit Card",
        transactionId: "TX" + orderId,
        orderDate: orderId === '10001' ? "2024-02-15" : "2024-02-14",
        receipt: "Receipt Link or Image"
    };
    
    // Populate the modal with order details
    document.getElementById('order-id').innerText = orderDetails.id;
    document.getElementById('customer-name').innerText = orderDetails.customerName;
    document.getElementById('products').innerText = orderDetails.products;
    document.getElementById('payment-method').innerText = orderDetails.paymentMethod;
    document.getElementById('transaction-id').innerText = orderDetails.transactionId;
    document.getElementById('order-date').innerText = orderDetails.orderDate;
    document.getElementById('receipt').innerText = orderDetails.receipt; // You can also make this a link or image

    // Display the modal
    document.getElementById('orderDetailsModal').style.display = 'block';
}

// Close modals when the close button is clicked
document.querySelectorAll('.close').forEach(closeButton => {
    closeButton.onclick = function() {
        this.closest('.modal').style.display = 'none';
    };
});

// Close modals when clicking outside of the modal content
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
};

// Function to update shipment status
function updateStatus(orderId) {
    // Show the status update modal
    document.getElementById('statusUpdateModal').style.display = 'block';
    
    // Handle form submission
    const form = document.getElementById('updateStatusForm');
    form.onsubmit = function(event) {
        event.preventDefault(); // Prevent default form submission
        
        const shipmentStatus = form.elements['shipment_status'].value;
        
        // Here you would typically send the updated status to the server
        // For demonstration, we'll just log it
        console.log(`Order ID: ${orderId}, New Shipment Status: ${shipmentStatus}`);
        
        // Close the modal after updating
        document.getElementById('statusUpdateModal').style.display = 'none';
        
        // Optionally, show a notification
        showNotification(`Order ID: ${orderId} status updated to ${shipmentStatus}`);
    };
}

// Function to show notifications
function showNotification(message) {
    const notificationContainer = document.getElementById('notificationContainer');
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.innerText = message;
    
    notificationContainer.appendChild(notification);
    
    // Automatically remove the notification after 3 seconds
    setTimeout(() => {
        notificationContainer.removeChild(notification);
    }, 3000);
}

// Search functionality
document.querySelector('.search-button').onclick = function() {
    const searchInput = document.querySelector('.search-input').value.toLowerCase();
    const rows = document.querySelectorAll('.transaction-table tbody tr');
    
    rows.forEach(row => {
        const orderId = row.querySelector('.order-id').innerText.toLowerCase();
        const customerName = row.cells[1].innerText.toLowerCase();
        
        if (orderId.includes(searchInput) || customerName.includes(searchInput)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
};

// Reset filters
document.querySelector('.reset-button').onclick = function() {
    document.querySelector('.search-input').value = '';
    const rows = document.querySelectorAll('.transaction-table tbody tr');
    rows.forEach(row => {
        row.style.display = '';
    });
};
