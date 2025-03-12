/*  Developer: Aryan Kora
    University ID: 230059030
    Function: Changes the "Active" state on the catagory buttons on the search page
*/

document.addEventListener("DOMContentLoaded", function () {
    // Get all category buttons
    const categoryButtons = document.querySelectorAll(".category-btn");

    // Check the current URL to see which category is selected
    const currentCategory = new URLSearchParams(window.location.search).get(
        "category"
    );

    // If a category is selected, mark that button as active
    categoryButtons.forEach((button) => {
        // Remove 'active' class from all buttons first
        button.classList.remove("active");

        // Add 'active' class to the correct category button based on the URL
        if (button.value === currentCategory) {
            button.classList.add("active");
        } else if (currentCategory === null && button.value === "all") {
            button.classList.add("active"); // Default "All" is active when no category is selected
        }
    });

    // Loop through each button and add an event listener
    categoryButtons.forEach((button) => {
        button.addEventListener("click", function () {
            // Remove the 'active' class from all buttons
            categoryButtons.forEach((btn) => btn.classList.remove("active"));

            // Add the 'active' class to the clicked button
            this.classList.add("active");
        });
    });
});
