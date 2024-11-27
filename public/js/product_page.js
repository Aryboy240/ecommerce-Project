// Dynamic price range update
const priceSlider = document.querySelector('.price-range-slider');
const maxPrice = document.querySelector('.max-price');

priceSlider.addEventListener('input', () => {
    maxPrice.textContent = `£${priceSlider.value}`;
    updateFilters();
});

// Update filters display
function updateFilters() {
    const activeFilters = document.querySelector('.active-filters');
    activeFilters.innerHTML = `
        <span>Category: Glasses</span> | <span>Price: £0 - £${priceSlider.value}</span>
    `;
}
