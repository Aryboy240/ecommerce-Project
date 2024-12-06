let products = {
    data: [
        {
            productName: "Classic Aviator Sunglasses",
            category: "Sunglasses",
            price: "89.99",
            image: "{{ asset('Images/Aviator Sunglasses.jpg') }}"
        },
        {
            productName: "Round Metal Frame Glasses",
            category: "Prescription Glasses",
            price: "129.99",
            image: "{{ asset('Images/round metal glasses.jpg') }}"
        },
        {
            productName: "Premium Lens Cleaning Kit",
            category: "Accessories",
            price: "19.99",
            image: "{{ asset('Images/cleaning kit.jpg') }}"
        },
        {
            productName: "Wayfarer Style Sunglasses",
            category: "Sunglasses",
            price: "99.99",
            image: "{{ asset('Images/wayfarer-sunglasses.jpg') }}"
        },
    ],
};

for (let i of products.data) {
    // Create Card
    let card = document.createElement("div");
    // Card should have category
    card.classList.add("card", "i.category");
    // Image div
    let imgContainer = document.createElement("div");
    imgContainer.classList.add("image-container");
    // Img tag
    let image = document.createElement("img");
    image.setAttribute("src", i.image);
    imgContainer.appendChild(image);
    card.appendChild(imgContainer);

    document.getElementById("products").appendChild(card);
}