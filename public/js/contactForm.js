/*
    Developer: Aryan Kora
    University ID: 230059030
    Function: Contact Form backend
*/

function updateMailtoLink() {
    // Gets the user's inputs
    const fname = document.getElementById("fname").value;
    const lname = document.getElementById("lname").value;
    const pNumber = document.getElementById("pNumber").value;
    const email = document.getElementById("email").value;
    const desc = document.getElementById("desc").value;

    // If any of the fields are blank, it won't send the email.
    if (
        fname === "" ||
        lname === "" ||
        pNumber === "" ||
        email === "" ||
        desc === ""
    ) {
        alert("Please complete all of the fields");
    } else {
        // Opens the email app with the information filled in, ready to send.
        const mailtoLink = document.getElementById("mailto-link");
        mailtoLink.href = `mailto:support@optique.com?subject=Contact Us Form&body=I would like to make an admin request...,%0D%0A%0D%0AHere are the details:%0D%0AFirst Name: ${fname}%0D%0ALast Name: ${lname}%0D%0APhone: ${pNumber}%0D%0AEmail: ${email}%0D%0AMessage: ${desc}`;
    }
}
