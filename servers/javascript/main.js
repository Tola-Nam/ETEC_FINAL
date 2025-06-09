// Toggle sidebar open/closed
function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  const overlay = document.getElementById("overlay");
  const isOpen = sidebar.classList.contains("show");

  if (isOpen) {
    sidebar.classList.remove("show");
    overlay.style.display = "none";
  } else {
    sidebar.classList.add("show");
    overlay.style.display = "block";
  }
}

// Navigate pages without reload
function navigate(page, push = true) {
  fetch(`/ETEC_FINAL/servers/include/header.php?ajax=1&page=${page}`)
    .then((res) => {
      if (!res.ok) throw new Error("Page not found");
      return res.text();
    })
    .then((html) => {
      document.getElementById("content").innerHTML = html;
      if (push) {
        history.pushState({ page }, "", `?page=${page}`);
      }
    })
    .catch((err) => {
      document.getElementById(
        "content"
      ).innerHTML = `<p class="text-danger">Failed to load page: ${page}</p>`;
      console.error(err);
    });
}

// Close sidebar when clicking outside of it (mobile only)
document.addEventListener("click", function (event) {
  const sidebar = document.getElementById("sidebar");
  const overlay = document.getElementById("overlay");
  const isMobile = window.innerWidth <= 768;

  if (
    !sidebar.contains(event.target) &&
    !document.getElementById("openSidebarBtn")?.contains(event.target) &&
    isMobile
  ) {
    sidebar.classList.remove("show");
    overlay.style.display = "none";
  }
});

// Initial load
document.addEventListener("DOMContentLoaded", () => {
  const params = new URLSearchParams(window.location.search);
  const page = params.get("page") || "dashboard";
  navigate(page, false);
});
