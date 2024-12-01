document.addEventListener('DOMContentLoaded', function () {
  function initializeModals() {
    const openModalButtons = document.querySelectorAll('[data-modal-trigger]');
    const closeModalButtons = document.querySelectorAll('[data-modal-close]');

    function openModal(modalId) {
      const modal = document.getElementById(modalId);
      if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
      }
    }

    function closeModal(modalId) {
      const modal = document.getElementById(modalId);
      if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
      }
    }

    openModalButtons.forEach(button => {
      button.addEventListener('click', function (e) {
        e.preventDefault();
        const modalId = this.getAttribute('data-modal-trigger');
        openModal(modalId);

        const userId = this.getAttribute('data-user-id');
        const userFirstName = this.getAttribute('data-user-first-name');
        const userLastName = this.getAttribute('data-user-last-name');
        const userEmail = this.getAttribute('data-user-email');
        const userDOB = this.getAttribute('data-user-dob');

        if (modalId === 'editUserModal') {
          const editModalTitle = document.getElementById('editUserModalTitle');
          if (editModalTitle) {
            editModalTitle.textContent = `Edit User: ${userFirstName} ${userLastName}`;
          }

          const userFirstNameInput = document.getElementById('editFirstName');
          if (userFirstNameInput) {
            userFirstNameInput.value = userFirstName;
          }

          const userLastNameInput = document.getElementById('editLastName');
          if (userLastNameInput) {
            userLastNameInput.value = userLastName;
          }

          const userEmailInput = document.getElementById('editEmail');
          if (userEmailInput) {
            userEmailInput.value = userEmail;
          }

          const userDOBInput = document.getElementById('editDOB');
          if (userDOBInput) {
            userDOBInput.value = userDOB;
          }

          const userIdInput = document.getElementById('editUserId');
          if (userIdInput) {
            userIdInput.value = userId;
          }

          const editForm = document.getElementById('editForm');
          editForm.action = `/users/${userId}`;

        } else if (modalId === 'deleteUserModal') {
          const deleteModalTitle = document.getElementById('deleteUserModalTitle');
          if (deleteModalTitle) {
            deleteModalTitle.textContent = `Delete User: ${userFirstName} ${userLastName}`;
          }
          const deleteForm = document.getElementById('deleteForm');
          deleteForm.action = `/users/${userId}`;
        }
      });
    });

    closeModalButtons.forEach(button => {
      button.addEventListener('click', function () {
        const modalId = this.closest('[data-modal]').id;
        closeModal(modalId);
      });
    });
  }

  initializeModals();
});

