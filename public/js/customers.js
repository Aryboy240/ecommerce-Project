// get the modals
const viewModal = document.getElementById("viewModal");
const editModal = document.getElementById("editModal");
const deleteModal = document.getElementById("deleteModal");

// get the buttons that will trigger the modals
const viewButtons = document.querySelectorAll(".btn-view");
const deleteButtons = document.querySelectorAll(".btn-delete");

// get the buttons inside modals
const closeButtons = document.querySelectorAll(".close-btn");
const saveButton = document.querySelector(".btn-save");
const cancelButtons = document.querySelectorAll(".btn-cancel");
const deleteButton = document.querySelector(".btn-confirmDelete");

// function to open a modal
function openModal(modal) {
    modal.style.display = "flex"; // show the modal
}

// function to close a modal
function closeModal(modal) {
    modal.style.display = "none"; // hide the modal
}

// add event listeners to open modals when the buttons are clicked
viewButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
        e.preventDefault();
        openModal(viewModal); // open the view modal
    });
});

// add event listeners to close modals when the close button is clicked
closeButtons.forEach((button) => {
    button.addEventListener("click", () => {
        // close the modal associated with the clicked close button
        button.closest(".modal").style.display = "none";
    });
});

// add event listeners to close modals when the cancel button is clicked
cancelButtons.forEach((button) => {
    button.addEventListener("click", () => {
        // close the modal associated with the clicked cancel button
        closeModal(button.closest(".modal"));
    });
});

// Select all edit buttons
const editButtons = document.querySelectorAll(".btn-edit");

// Open the edit modal and populate fields with user info
editButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
        e.preventDefault();
        const userId = button.getAttribute("data-id"); // Get the user ID from the button
        openModal(editModal); // Show the edit modal

        // Fetch user data from the backend (assuming you're using a RESTful route)
        fetch(`/admin/users/${userId}`)
            .then((response) => response.json())
            .then((user) => {
                // Log the user data to check
                console.log(user);

                // Populate the modal form fields with the user data
                document.getElementById("edit-user-id").value = user.id;
                (document.getElementById("edit-name").value = user.name),
                    (document.getElementById("edit-email").value = user.email);
                (document.getElementById("edit-fullName").value =
                    user.fullName),
                    (document.getElementById("edit-birthday").value =
                        user.birthday);
            })
            .catch((error) => {
                console.error("Error fetching user data:", error);
            });
    });
});

// Handle the save button inside the edit modal
document
    .getElementById("edit-form")
    .addEventListener("submit", function (event) {
        event.preventDefault();

        const userId = document.getElementById("edit-user-id").value;
        const name = document.getElementById("edit-name").value;
        const email = document.getElementById("edit-email").value;
        const birthday = document.getElementById("edit-birthday").value;

        fetch(`/admin/users/${userId}/update`, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ name, email, birthday }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    // Close modal and refresh the page
                    closeModal(editModal);
                    window.location.reload(); // This will refresh the page
                } else {
                    alert("Error updating user.");
                }
            })
            .catch((error) => {
                console.error("Error saving user data:", error);
            });
    });
