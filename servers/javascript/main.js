// Load page inside #content
function loadPage(url) {
  fetch(url)
    .then((response) => response.text())
    .then((html) => {
      document.getElementById("content").innerHTML = html;
    })
    .catch((error) => console.error("Failed to load:", error));
}

// Dropdown button toggle
// document.addEventListener("DOMContentLoaded", function () {
//   const dropdownButton = document.getElementById("dropdownButton");
//   const dropdownMenu = document.getElementById("dropdownMenu");

//   dropdownButton.addEventListener("click", function () {
//     dropdownMenu.classList.toggle("hidden");
//   });

// Load dashboard automatically
//   loadPage("../admin/dashboard.php");
// });
function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  const openBtn = document.getElementById("openSidebarBtn");

  if (window.innerWidth <= 768) {
    // Mobile: show/hide sidebar
    sidebar.classList.toggle("show");
  } else {
    // Desktop: collapse/expand
    sidebar.classList.toggle("collapsed");
    document.getElementById("main-content").classList.toggle("collapsed");
  }
}
