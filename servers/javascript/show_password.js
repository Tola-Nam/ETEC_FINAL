function togglePasswordVisibility(inputId, iconId) {
  const passwordField = document.getElementById(inputId);
  const icon = document.getElementById(iconId);

  if (passwordField.type === "password") {
    passwordField.type = "text";
    icon.classList.remove("bi-eye-slash");
    icon.classList.add("bi-eye");
  } else {
    passwordField.type = "password";
    icon.classList.remove("bi-eye");
    icon.classList.add("bi-eye-slash");
  }
}

// Event listeners for both password fields
document
  .getElementById("togglePassword")
  .addEventListener("click", function () {
    togglePasswordVisibility("password", "iconPassword");
  });

document
  .getElementById("toggleConfirmPassword")
  .addEventListener("click", function () {
    togglePasswordVisibility("confirm_pass", "iconConfirmPassword");
  });
