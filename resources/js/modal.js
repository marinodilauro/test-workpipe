document.addEventListener('DOMContentLoaded', function () {
  function initializeModals() {
    // Trova tutti i bottoni che aprono modali
    const openModalButtons = document.querySelectorAll('[data-modal-trigger]');

    // Trova tutte le modali
    const modals = document.querySelectorAll('[data-modal]');

    // Trova tutti i bottoni di chiusura delle modali
    const closeModalButtons = document.querySelectorAll('[data-modal-close]');

    // Funzione per aprire una modale
    function openModal(modalId) {
      const modal = document.getElementById(modalId);

      if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
      }
    }

    // Funzione per chiudere una modale
    function closeModal(modalId) {
      const modal = document.getElementById(modalId);

      if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
      }
    }

    // Event listener per aprire le modali
    openModalButtons.forEach(button => {
      button.addEventListener('click', function (e) {
        e.preventDefault();
        const modalId = this.getAttribute('data-modal-trigger');
        openModal(modalId);

        const userId = this.getAttribute('data-user-id');
        const userFirstName = this.getAttribute('data-user-first-name');
        const userLastName = this.getAttribute('data-user-last-name');
        const userEmail = this.getAttribute('data-user-email');
        //console.log(userFirstName)

        // Se è una modale di modifica utente, popola i campi
        if (modalId === 'editUserModal') {

          // Imposta il titolo della modale
          const editModalTitle = document.getElementById('editUserModalTitle');
          if (editModalTitle) {
            editModalTitle.textContent = `Edit User: ${userFirstName} ${userLastName}`;
          }

          // Set the user first name
          const userFirstNameInput = document.getElementById('editFirstName');
          if (userFirstNameInput) {
            userFirstNameInput.value = userFirstName;
          }

          // Set the user last name
          const userLastNameInput = document.getElementById('editLastName');
          if (userLastNameInput) {
            userLastNameInput.value = userLastName;
          }
          // Set the user email
          const userEmailInput = document.getElementById('editEmail');
          if (userEmailInput) {
            userEmailInput.value = userEmail;
          }

          // Imposta l'ID utente nel campo nascosto
          const userIdInput = document.getElementById('editUserId');
          if (userIdInput) {
            userIdInput.value = userId;
          }

          // Imposta l'action del form con l'ID utente corretto
          editForm.action = `/users/${userId}`;

        } else {
          const deleteModalTitle = document.getElementById('deleteUserModalTitle');
          if (deleteModalTitle) {
            deleteModalTitle.textContent = `Delete User: ${userFirstName} ${userLastName}`;
          }
        }
      });
    });

    // Event listener per chiudere le modali
    closeModalButtons.forEach(button => {
      button.addEventListener('click', function () {
        const modalId = this.closest('[data-modal]').id;
        closeModal(modalId);
      });
    });
  }

  // Inizializza le modali
  initializeModals();
});