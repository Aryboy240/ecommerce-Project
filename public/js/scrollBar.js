let lastScrollTop = 0; // Variable to store the last scroll position

// Add event listener for scrolling
document.addEventListener("scroll", () => {
    const scrollTop =
        document.documentElement.scrollTop || document.body.scrollTop; // Current scroll position

    if (scrollTop > lastScrollTop) {
        // Scrolling down
        document.body.classList.add("scroll-down");
        document.body.classList.remove("scroll-up");
    } else if (scrollTop < lastScrollTop) {
        // Scrolling up
        document.body.classList.add("scroll-up");
        document.body.classList.remove("scroll-down");
    }

    lastScrollTop = scrollTop; // Update the last scroll position
});
