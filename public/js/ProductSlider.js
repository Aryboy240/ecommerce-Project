/*  Developer: Aryan Kora
    University ID: 230059030
    Function: Product Slider Script
*/
const productContainers = document.querySelectorAll(".f-product-container");
const nxtBtn = document.querySelectorAll(".nxt-btn");
const preBtn = document.querySelectorAll(".pre-btn");
const test = 150;

productContainers.forEach((item, i) => {
    let containerDimensions = item.getBoundingClientRect();
    let containerWidth = containerDimensions.width;

    // Scroll to the middle initially
    // item.scrollLeft = item.scrollWidth / 2 - containerWidth / 2;

    item.scrollLeft = -item.scrollWidth;

    nxtBtn[i].addEventListener("click", () => {
        item.scrollLeft += containerWidth - test;
    });

    preBtn[i].addEventListener("click", () => {
        item.scrollLeft -= containerWidth - test;
    });
});
