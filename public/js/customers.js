// get the modals
const viewModal = document.getElementById('viewModal');
const editModal = document.getElementById('editModal');
const deleteModal = document.getElementById('deleteModal');

// get the buttons that will trigger the modals
const viewButtons = document.querySelectorAll('.btn-view');
const editButtons = document.querySelectorAll('.btn-edit');
const deleteButtons = document.querySelectorAll('.btn-delete');

// get the buttons inside modals
const closeButtons = document.querySelectorAll('.close-btn');
const saveButton = document.querySelector('.btn-save');
const cancelButtons = document.querySelectorAll('.btn-cancel');
const deleteButton = document.querySelector('.btn-confirmDelete');

// function to open a modal
function openModal(modal) {
    modal.style.display = 'flex'; // show the modal
}

// function to close a modal
function closeModal(modal) {
    modal.style.display = 'none'; // hide the modal
}

// add event listeners to open modals when the buttons are clicked
viewButtons.forEach(button => {
    button.addEventListener('click', (e) => {
        e.preventDefault();
        openModal(viewModal); // open the view modal
    });
});

editButtons.forEach(button => {
    button.addEventListener('click', (e) => {
        e.preventDefault();
        openModal(editModal); // open the edit modal
    });
});

deleteButtons.forEach(button => {
    button.addEventListener('click', (e) => {
        e.preventDefault();
        openModal(deleteModal); // open the delete modal
    });
});

// add event listeners to close modals when the close button is clicked
closeButtons.forEach(button => {
    button.addEventListener('click', () => {
        // close the modal associated with the clicked close button
        button.closest('.modal').style.display = 'none';
    });
});

// add event listeners to close modals when the cancel button is clicked
cancelButtons.forEach(button => {
    button.addEventListener('click', () => {
        // close the modal associated with the clicked cancel button
        closeModal(button.closest('.modal'));
    });
});

// save and delete buttons currently do nothing (for backend implementation)
saveButton.addEventListener('click', (e) => {
    // for now, do nothing (backend will implement saving logic)
    console.log('Save button clicked, but no action implemented');
});

deleteButton.addEventListener('click', (e) => {
    // for now, do nothing (backend will implement deletion logic)
    console.log('Delete button clicked, but no action implemented');
});
