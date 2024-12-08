/*
    Developer: Aqsa Amjad
    University ID: 230066670
    Function: Show different payment sections depending on which payment method is selected
*/

// Get references to the payment buttons
const card = document.getElementById("card");
const payPal = document.getElementById("paypal");
const wallet = document.getElementById("wallet");

// Get references to the payment sections
const cardSection = document.getElementById("payment-card");
const payPalSection = document.getElementById("payment-paypal");
const walletSection = document.getElementById("payment-wallet");

// Function to hide all sections
function hideAllSections() {
    card.classList.remove("active");
    payPal.classList.remove("active");
    wallet.classList.remove("active");

    cardSection.classList.remove("active");
    payPalSection.classList.remove("active");
    walletSection.classList.remove("active");
}

// Event listener for the credit/debit card button
card.addEventListener("click", function () {
    hideAllSections(); // Hide all sections first
    cardSection.classList.add("active"); // Show card section
    card.classList.add("active");
});

// Event listener for the PayPal button
payPal.addEventListener("click", function () {
    hideAllSections(); // Hide all sections first
    payPalSection.classList.add("active"); // Show PayPal section
    payPal.classList.add("active");
});

// Event listener for the wallet button
wallet.addEventListener("click", function () {
    hideAllSections(); // Hide all sections first
    walletSection.classList.add("active"); // Show wallet section
    wallet.classList.add("active");
});

// Function to redirect user to PayPal
function goToPayPal() {
    window.open(
        "https://www.paypal.com/signin?returnUri=https%3A%2F%2Fwww.paypal.com%2Fmyaccount%2Ftransfer&state=%2F"
    );
}

// Function to redirect user to Apple website
function goToWallet() {
    window.open("https://www.apple.com/uk/wallet/");
}
