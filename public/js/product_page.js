/* Oyinlola Arowolo
id= 230402373*/
document.addEventListener('DOMContentLoaded', function() {
    // Product image gallery functionality
    var MainImg = document.getElementById('MainImg');
    var smallimg = document.getElementsByClassName('small-img');

    if (MainImg && smallimg.length > 0) {
        for(let i = 0; i < smallimg.length; i++) {
            smallimg[i].onclick = function() {
                MainImg.src = smallimg[i].src;
            }
        }
    }

    // Get elements
    const priceSlider = document.querySelector('.price-range-slider');
    const maxPrice = document.querySelector('.max-price');
    const activeFilters = document.querySelector('.active-filters');
    const categoryLinks = document.querySelectorAll('.categories ul li a');
    
    // Initialize active filters
    let currentFilters = {
        category: 'All Categories',
        priceRange: `£0 - £${priceSlider.value}`
    };

    // Update price display and filters when slider moves
    priceSlider.addEventListener('input', () => {
        maxPrice.textContent = `£${priceSlider.value}`;
        currentFilters.priceRange = `£0 - £${priceSlider.value}`;
        updateActiveFilters();
    });

    // Handle category selection
    categoryLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            currentFilters.category = link.textContent;
            updateActiveFilters();
            
            // Update visual selection
            categoryLinks.forEach(l => l.classList.remove('active'));
            link.classList.add('active');
        });
    });

    // Function to update active filters display
    function updateActiveFilters() {
        activeFilters.innerHTML = `
            <h2>Active Filters</h2>
            <div class="filter-tags">
                <div class="filter-tag">
                    <span>Category: ${currentFilters.category}</span>
                    <button class="remove-filter" data-filter="category">×</button>
                </div>
                <div class="filter-tag">
                    <span>Price Range: ${currentFilters.priceRange}</span>
                    <button class="remove-filter" data-filter="price">×</button>
                </div>
            </div>
            <button class="clear-all">Clear All Filters</button>
        `;

        // Add event listeners to remove buttons
        document.querySelectorAll('.remove-filter').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const filterType = e.target.dataset.filter;
                if (filterType === 'category') {
                    currentFilters.category = 'All Categories';
                    categoryLinks.forEach(l => l.classList.remove('active'));
                } else if (filterType === 'price') {
                    priceSlider.value = 500;
                    maxPrice.textContent = '£500';
                    currentFilters.priceRange = '£0 - £500';
                }
                updateActiveFilters();
            });
        });

        // Add event listener to clear all button
        document.querySelector('.clear-all').addEventListener('click', () => {
            currentFilters.category = 'All Categories';
            currentFilters.priceRange = '£0 - £500';
            priceSlider.value = 500;
            maxPrice.textContent = '£500';
            categoryLinks.forEach(l => l.classList.remove('active'));
            updateActiveFilters();
        });
    }

    // Initialize active filters display
    updateActiveFilters();
});
