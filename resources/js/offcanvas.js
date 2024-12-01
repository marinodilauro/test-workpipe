document.addEventListener('DOMContentLoaded', function () {
  const addUserBtn = document.getElementById('addUserBtn');
  const addUserOffCanvas = document.getElementById('addUserOffCanvas');
  const closeOffCanvasBtn = document.getElementById('closeOffCanvasBtn');
  const addUserForm = document.getElementById('addUserForm');

  function openOffCanvas() {
    addUserOffCanvas.classList.remove('translate-x-full');
  }

  function closeOffCanvas() {
    addUserOffCanvas.classList.add('translate-x-full');
  }

  addUserBtn.addEventListener('click', function (event) {
    event.preventDefault();
    openOffCanvas();
  });

  closeOffCanvasBtn.addEventListener('click', closeOffCanvas);

  // Close off-canvas when clicking outside
  document.addEventListener('click', function (event) {
    if (!addUserOffCanvas.contains(event.target) && !addUserBtn.contains(event.target)) {
      closeOffCanvas();
    }
  });
});

