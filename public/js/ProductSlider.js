/*  Developer: Aryan Kora
    University ID: 230059030
    Function: Product Slider Script
*/

const productContainers = document.querySelectorAll(".product-container");
const nxtBtn = document.querySelectorAll(".nxt-btn");
const preBtn = document.querySelectorAll(".pre-btn");
const test = 750;

productContainers.forEach((item, i) => {
    let containerDimensions = item.getBoundingClientRect();
    let containerWidth = containerDimensions.width;

    nxtBtn[i].addEventListener("click", () => {
        item.scrollLeft += containerWidth - test;
    });

    preBtn[i].addEventListener("click", () => {
        item.scrollLeft -= containerWidth - test;
    });
});
