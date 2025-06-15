function openModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.classList.remove('opacity-0', 'pointer-events-none');
    }
}

function closeModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.classList.add('opacity-0', 'pointer-events-none');
    }
}

document.addEventListener('click', function (event) {
    if (event.target.classList.contains('modal')) {
        closeModal(event.target.id);
    }
});

document.addEventListener('open-modal', function (event) {
    if (event.detail && event.detail.id) {
        openModal(event.detail.id);
    }
});

document.addEventListener('close-modal', function (event) {
    if (event.detail && event.detail.id) {
        closeModal(event.detail.id);
    }
});

window.openModal = openModal;
window.closeModal = closeModal;

export { openModal, closeModal };
