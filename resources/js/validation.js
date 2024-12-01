document.addEventListener('DOMContentLoaded', () => {
  const forms = {
    createForm: document.getElementById('addUserForm'),
    editForm: document.getElementById('editForm'),
  };

  // Form fileds validation
  function validateForm(form) {
    const firstName = form.querySelector('[name="first_name"]');
    const lastName = form.querySelector('[name="last_name"]');
    const email = form.querySelector('[name="email"]');
    const dateOfBirth = form.querySelector('[name="date_of_birth"]');
    let isValid = true;

    // Generic validation function
    function validateField(field, rules) {
      const value = field.value.trim();
      let error = '';

      // Validation rules
      if (rules.required && !value) {
        error = 'This field is required.';
      } else if (rules.min && value.length < rules.min) {
        error = `Minimum length is ${rules.min} characters.`;
      } else if (rules.max && value.length > rules.max) {
        error = `Maximum length is ${rules.max} characters.`;
      } else if (rules.pattern && !rules.pattern.test(value)) {
        error = rules.errorMessage;
      } else if (rules.date && !validateDate(value)) {
        error = 'Please enter a valid date of birth.';
      }

      // Add CSS error classes
      const errorElement = field.nextElementSibling;
      if (error) {
        errorElement.textContent = error;
        errorElement.classList.remove('hidden');
        field.classList.add('border', 'border-red-500');
        isValid = false;
      } else {
        errorElement.textContent = '';
        errorElement.classList.add('hidden');
        field.classList.remove('border', 'border-red-500');
      }
    }

    // Specific fileds validation
    validateField(firstName, { required: true, min: 3, max: 150 });
    validateField(lastName, { required: true, min: 3, max: 150 });
    validateField(email, {
      required: true,
      min: 5,
      max: 150,
      pattern: /^[^\s@]+@[^\s@]+\.(com|it)$/,
      errorMessage: 'Email must include "@" and end with ".com" or ".it".',
    });
    validateField(dateOfBirth, {
      required: true,
      date: true,
    });

    return isValid;
  }

  // Date filed validation
  function validateDate(dateString) {
    const date = new Date(dateString);
    const today = new Date();
    if (isNaN(date)) return false; // Not a valid format
    const minDate = new Date("1900-01-01");
    if (date < minDate) return false; // La data non può essere prima del 1900
    return true;
  }

  // Gestore di invio del form
  function handleFormSubmit(event) {
    const form = event.target;
    if (!validateForm(form)) {
      event.preventDefault();
    }
  }

  // Aggiungi gli ascoltatori agli eventi submit
  if (forms.createForm) {
    forms.createForm.addEventListener('submit', handleFormSubmit);
  }

  if (forms.editForm) {
    forms.editForm.addEventListener('submit', handleFormSubmit);
  }
});
