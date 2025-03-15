// Developer: Aqsa Amjad
// University ID: 230066670
// Function: opening/closing the delete modal & customer info panel

// get the delete modal
const deleteModal = document.getElementById('deleteModal');
// get the customer info panel
const customerDetailsPanel = document.querySelector('.customer-details-panel');
// get the close buttons for both modal and panel
const closeBtns = document.querySelectorAll('.close-btn');
// get the buttons that trigger both
const viewButtons = document.querySelectorAll('.btn-view'); // view button
const deleteButtons = document.querySelectorAll('.btn-delete'); // delete button

// function to open the delete modal
const openDeleteModal = () => {
    deleteModal.style.display = 'flex'; // show the modal
};
// function to close the delete modal
const closeDeleteModal = () => {
    deleteModal.style.display = 'none'; // hide the modal
};

// function to open the customer info panel
const openSidePanel = () => {
    customerDetailsPanel.style.display = 'block'; // show the panel
};
// function to close the customer info panel
const closeSidePanel = () => {
    customerDetailsPanel.style.display = 'none'; // hide the panel
};

// add event listeners to close modal when the close button is clicked
closeBtns.forEach(button => {
    button.addEventListener('click', () => {
        // close the modal or side panel associated with the clicked close button
        button.closest('.modal, .customer-details-panel').style.display = 'none';
    });
});

// add event listeners to the delete buttons
deleteButtons.forEach(button => {
    button.addEventListener('click', openDeleteModal);
});

// add event listeners to the view buttons
viewButtons.forEach(button => {
    button.addEventListener('click', openSidePanel);
});

// close the modal if clicked outside the modal content
window.addEventListener('click', function(event) {
    if (event.target === deleteModal) {
        closeDeleteModal();
    }
});


function editField(field) {
    document.getElementById(`${field}Text`).classList.add('hidden');
    document.getElementById(`${field}Input`).classList.remove('hidden');

    // show the correct buttons by targeting within the parent element
    const parent = document.getElementById(`${field}Input`).closest('.detail-view');
    parent.querySelector('.edit-btn').classList.add('hidden');
    parent.querySelector('.save-btn').classList.remove('hidden');
}

function saveField(field) {
    const input = document.getElementById(`${field}Input`);
    const text = document.getElementById(`${field}Text`);
    
    text.textContent = input.value;
    input.classList.add('hidden');
    text.classList.remove('hidden');

    // show the correct buttons by targeting within the parent element
    const parent = input.closest('.detail-view');
    parent.querySelector('.edit-btn').classList.remove('hidden');
    parent.querySelector('.save-btn').classList.add('hidden');
}
