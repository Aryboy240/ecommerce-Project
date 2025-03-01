// get the modals
const viewModal = document.getElementById('viewModal');
const editModal = document.getElementById('editModal');
const deleteModal = document.getElementById('deleteModal');

// get the buttons that will trigger the modals
const viewButtons = document.querySelectorAll('.btn-view');
const editButtons = document.querySelectorAll('.btn-add');
const deleteButtons = document.querySelectorAll('.btn-delete');

// get the close buttons inside modals
const closeButtons = document.querySelectorAll('.close-btn');

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

