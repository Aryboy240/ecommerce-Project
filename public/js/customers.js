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
