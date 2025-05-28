function openModal() {
  document.getElementById("modal-signUp").classList.remove("hidden");
  // Show register form by default
  showRegisterForm();
}

function closeModal() {
  document.getElementById("modal-signUp").classList.add("hidden");
}

function showLoginForm() {
  document.getElementById("signIn").classList.remove("hidden");
  document.getElementById("signUp").classList.add("hidden");

  // Update button styles
  document.getElementById("btnLogin").classList.remove("text-gray-500");
  document.getElementById("btnLogin").classList.add("text-blue-600");
  document.getElementById("btnRegister").classList.remove("text-blue-600");
  document.getElementById("btnRegister").classList.add("text-gray-500");
}

function showRegisterForm() {
  document.getElementById("signIn").classList.add("hidden");
  document.getElementById("signUp").classList.remove("hidden");

  // Update button styles
  document.getElementById("btnRegister").classList.remove("text-gray-500");
  document.getElementById("btnRegister").classList.add("text-blue-600");
  document.getElementById("btnLogin").classList.remove("text-blue-600");
  document.getElementById("btnLogin").classList.add("text-gray-500");
}

//! Event listeners for form switching
document.getElementById("btnLogin").addEventListener("click", showLoginForm);
document
  .getElementById("btnRegister")
  .addEventListener("click", showRegisterForm);

// Password toggle functionality for login form
document
  .getElementById("toggleLoginPassword")
  .addEventListener("click", function () {
    const passwordInput = document.getElementById("login-password");
    const icon = document.getElementById("iconLoginPassword");

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      icon.classList.remove("bi-eye-slash");
      icon.classList.add("bi-eye");
    } else {
      passwordInput.type = "password";
      icon.classList.remove("bi-eye");
      icon.classList.add("bi-eye-slash");
    }
  });

// Password toggle functionality for register form
document
  .getElementById("toggleRegisterPassword")
  .addEventListener("click", function () {
    const passwordInput = document.getElementById("register-password");
    const icon = document.getElementById("iconRegisterPassword");

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      icon.classList.remove("bi-eye-slash");
      icon.classList.add("bi-eye");
    } else {
      passwordInput.type = "password";
      icon.classList.remove("bi-eye");
      icon.classList.add("bi-eye-slash");
    }
  });
