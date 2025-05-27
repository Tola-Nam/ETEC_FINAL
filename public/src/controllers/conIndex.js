// !do not use it in file index.php
// Initialize app after resources load
function initializeApp() {
  //! Initialize Swiper
  const swiper = new Swiper(".mySwiper", {
    slidesPerView: "auto",
    spaceBetween: 20,
    freeMode: true,
    loop: false,
    mousewheel: {
      forceToAxis: true,
    },
    keyboard: {
      enabled: true,
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      768: {
        slidesPerView: "auto",
        spaceBetween: 20,
      },
    },
  });

  //~ Show main content with smooth transition
  setTimeout(() => {
    document.getElementById("loading-screen").style.display = "none";
    const mainContent = document.getElementById("main-content");
    mainContent.style.display = "block";
    // Force reflow then add loaded class for smooth fade-in
    mainContent.offsetHeight;
    mainContent.classList.add("loaded");
  }, 800);
}

// ^Wait for DOM and Swiper to load
document.addEventListener("DOMContentLoaded", function () {
  // Check if Swiper is loaded, otherwise wait
  if (typeof Swiper !== "undefined") {
    initializeApp();
  } else {
    const swiperScript = document.querySelector('script[src*="swiper"]');
    if (swiperScript) {
      swiperScript.addEventListener("load", initializeApp);
    } else {
      // Fallback: wait a bit for script to load
      setTimeout(initializeApp, 1000);
    }
  }
});

//? Add click handlers for cards with smooth animations
document.addEventListener("click", function (e) {
  const card = e.target.closest(".card-hover");
  if (card) {
    // Add subtle click animation
    card.style.transform = "scale(0.98) translateY(-5px)";
    setTimeout(() => {
      card.style.transform = "translateY(-5px)";
    }, 150);
  }
});

//^ Category button interactions
document.addEventListener("click", function (e) {
  if (e.target.matches("button")) {
    // Remove active state from all buttons
    document.querySelectorAll("button").forEach((btn) => {
      btn.classList.remove("bg-emerald-500", "text-white");
      btn.classList.add("text-emerald-500");
    });

    //! Add active state to clicked button
    e.target.classList.add("bg-emerald-500", "text-white");
    e.target.classList.remove("text-emerald-500");
  }
});

//~ Lazy loading fallback for images
if ("IntersectionObserver" in window) {
  const imageObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const img = entry.target;
        img.classList.add("opacity-100");
        observer.unobserve(img);
      }
    });
  });

  document.querySelectorAll('img[loading="lazy"]').forEach((img) => {
    img.classList.add("opacity-0", "transition-opacity", "duration-300");
    imageObserver.observe(img);
  });
}
