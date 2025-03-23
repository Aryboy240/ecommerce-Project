document.addEventListener('DOMContentLoaded', function () {
    const wishlistButtons = document.querySelectorAll('.wishlist-button');

    wishlistButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault(); 

            const form = button.closest('.wishlist-form');
            const productId = form.querySelector('input[name="product_id"]').value;

            if (button.classList.contains('active')) {
                showMessage('Product is already in your wishlist.', 'error');
                return; 
            }

            fetch('/wishlist/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ product_id: productId }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    button.classList.add('active');
                    showMessage('Product added to wishlist successfully!');
                } else {
                    showMessage('Error adding product to wishlist.','error');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.wishlist-form').forEach(form => {
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            const productId = form.querySelector('input[name="product_id"]').value;

            fetch('/wishlist/remove', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ product_id: productId }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const row = form.closest('tr'); 
                    if (row) {
                        row.remove(); 
                    }

                    showMessage(data.message, 'error');
                    
                    
                    const wishlistCount = document.querySelector('.wishlist-count');
                    const currentCount = parseInt(wishlistCount.textContent.match(/\d+/)[0]);
                    const newCount = currentCount - 1;
                    wishlistCount.textContent = newCount + " item(s)";
                    
                    const tableBody = document.querySelector('.wishlist-table tbody');
                    if (tableBody && tableBody.children.length === 0) {
                        const tableContainer = document.querySelector('.table-container');
                        const wishlistActions = document.querySelector('.wishlist-actions');

                        if (tableContainer) tableContainer.remove();
                        if (wishlistActions) wishlistActions.remove();
                        
                        const wishlistSection = document.querySelector('.wishlist-section');
                        const emptyWishlist = document.createElement('div');
                        emptyWishlist.className = 'empty-wishlist';
                        emptyWishlist.innerHTML = `
                            <p>Your wishlist is empty.</p>
                            <a href="/search" class="continue-shopping-btn">Explore Our Products</a>
                        `;
                        wishlistSection.appendChild(emptyWishlist);
                    
                        if (wishlistCount) {
                            wishlistCount.style.display = 'none';
                        }
                    }
                } else {
                    showMessage('Failed to remove item. Please try again.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('Something went wrong. Please try again.', 'error');
            });
        });
    });
});

function showMessage(message, type = "success") {
    let messageBox = document.createElement('div');
    messageBox.className = `message-box ${type === 'success' ? '' : 'error'}`;
    messageBox.innerText = message;
    document.body.appendChild(messageBox);

    setTimeout(() => {
        messageBox.classList.add('show');
    }, 10);

    setTimeout(() => {
        messageBox.classList.remove('show');
        setTimeout(() => messageBox.remove(), 500);
    }, 3000);
}