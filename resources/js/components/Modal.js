// resources/js/Modal.js
function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
    document.getElementById(modalId).classList.add('flex');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    document.getElementById(modalId).classList.remove('flex');
}

// Optional: Validation function to prevent duplicate submissions
function validateForm(form) {
    // Implement validation logic if needed
    return true; // Return true to allow form submission
}

export { openModal, closeModal };
