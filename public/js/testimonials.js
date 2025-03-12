/*  Developer: man kwok
    University ID: 230049488
*/

const testimonials = [
    { text: "Great product! Highly recommend!", rating: "★★★★★", author: "John Doe" },
    { text: "This is the best purchase I've made this year!", rating: "★★★★☆", author: "Jane Smith" },
    { text: "Good value for the price. Would buy again.", rating: "★★★☆☆", author: "Mike Johnson" },
    { text: "Exceeded my expectations!", rating: "★★★★★", author: "Emily Davis" },
    { text: "Amazing quality and fast delivery.", rating: "★★★★☆", author: "Chris Brown" },
    { text: "Satisfied with the product overall.", rating: "★★★☆☆", author: "Sarah Wilson" },
    { text: "Fantastic customer support!", rating: "★★★★★", author: "David Lee" },
    { text: "Not what I expected, but it works.", rating: "★★☆☆☆", author: "Karen Martinez" },
    { text: "Will definitely buy again!", rating: "★★★★☆", author: "Paul Anderson" }
];

let currentIndex = 0;

function renderTestimonials() {
    const section = document.getElementById("our-Testimonials-section");
    section.innerHTML = ""; 

    for (let i = currentIndex; i < currentIndex + 3 && i < testimonials.length; i++) {
        const testimonial = testimonials[i];
        const testimonialDiv = document.createElement("div");
        testimonialDiv.className = "testimonial";

        

        testimonialDiv.innerHTML = `
            <p class="testimonial-author">${testimonial.author}</p>
            <div class="testimonial-rating">${testimonial.rating}</div>
            <p class="testimonial-content">${testimonial.text}"</p>
        `;
        section.appendChild(testimonialDiv);
    }
}

function changeTestimonials() {
    currentIndex = (currentIndex + 3) % testimonials.length;
    renderTestimonials();
}

document.addEventListener("DOMContentLoaded", renderTestimonials);