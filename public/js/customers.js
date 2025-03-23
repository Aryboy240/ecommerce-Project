// Developer: Aqsa Amjad
// University ID: 230066670
// Function: Handling modals and customer info

// Get the modals and panels
const deleteModal = document.getElementById("deleteModal");
const viewModal = document.getElementById("viewModal");
const editModal = document.getElementById("editModal");
const customerDetailsPanel = document.querySelector(".customer-details-panel");

// Get the buttons that trigger modals and panels
const viewButtons = document.querySelectorAll(".btn-view");
const deleteButtons = document.querySelectorAll(".btn-delete");
const editButtons = document.querySelectorAll(".btn-edit");

// Get the buttons inside modals
const closeButtons = document.querySelectorAll(".close-btn");
const saveButtons = document.querySelectorAll(".btn-save");
const cancelButtons = document.querySelectorAll(".btn-cancel");
const deleteButton = document.querySelector(".btn-confirmDelete");

// Function to open a modal
const openModal = (modal) => {
    modal.style.display = "flex";
};

// Function to close a modal
const closeModal = (modal) => {
    modal.style.display = "none";
};

// Function to open the customer info panel
const openSidePanel = () => {
    customerDetailsPanel.style.display = "block";
};

// Function to close the customer info panel
const closeSidePanel = () => {
    customerDetailsPanel.style.display = "none";
};

// Add event listeners for view buttons
viewButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
        e.preventDefault();
        openSidePanel();
    });
});

// Add event listeners for delete buttons
deleteButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
        e.preventDefault();
        openModal(deleteModal);
    });
});

// Add event listeners for edit buttons
editButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
        e.preventDefault();
        const userId = button.getAttribute("data-id");
        openModal(editModal);

        // Fetch user data from backend
        fetch(`/admin/users/${userId}`)
            .then((response) => response.json())
            .then((user) => {
                document.getElementById("edit-user-id").value = user.id;
                document.getElementById("edit-name").value = user.name;
                document.getElementById("edit-email").value = user.email;
                document.getElementById("edit-fullName").value = user.fullName;
                document.getElementById("edit-birthday").value = user.birthday;
                document.getElementById("edit-is-admin").checked =
                    user.is_admin == 1;
            })
            .catch((error) => {
                console.error("Error fetching user data:", error);
            });
    });
});

// Handle the save button inside the edit modal
const editForm = document.getElementById("edit-form");
if (editForm) {
    editForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const userId = document.getElementById("edit-user-id").value;
        const fullName = document.getElementById("edit-fullName").value;
        const name = document.getElementById("edit-name").value;
        const email = document.getElementById("edit-email").value;
        const birthday = document.getElementById("edit-birthday").value;
        const is_admin = document.getElementById("edit-is-admin").checked
            ? 1
            : 0;

        fetch(`/admin/users/${userId}/update`, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ fullName, name, email, birthday, is_admin }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    closeModal(editModal);
                    window.location.reload();
                } else {
                    alert("Error updating user.");
                }
            })
            .catch((error) => {
                console.error("Error saving user data:", error);
            });
    });
}

// Add event listeners for closing modals
closeButtons.forEach((button) => {
    button.addEventListener("click", () => {
        closeModal(button.closest(".modal"));
    });
});

// Add event listeners for cancel buttons
cancelButtons.forEach((button) => {
    button.addEventListener("click", () => {
        closeModal(button.closest(".modal"));
    });
});

// Close modals when clicking outside their content
window.addEventListener("click", (event) => {
    if (event.target === deleteModal) {
        closeModal(deleteModal);
    }
});
