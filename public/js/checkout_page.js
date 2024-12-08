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
    cardSection.classList.remove("active");
    payPalSection.classList.remove("active");
    walletSection.classList.remove("active");
}

// Event listener for the credit/debit card button
card.addEventListener("click", function() {
    console.log("Card button clicked");  // Debugging log
    hideAllSections();  // Hide all sections first
    cardSection.classList.add("active");  // Show card section
});

// Event listener for the PayPal button
payPal.addEventListener("click", function() {
    console.log("PayPal button clicked");  // Debugging log
    hideAllSections();  // Hide all sections first
    payPalSection.classList.add("active");  // Show PayPal section
});

// Event listener for the wallet button
wallet.addEventListener("click", function() {
    console.log("Wallet button clicked");  // Debugging log
    hideAllSections();  // Hide all sections first
    walletSection.classList.add("active");  // Show wallet section
});
