document.addEventListener("DOMContentLoaded", function () {
  var swiper = new Swiper(".mySwiper", {
    slidesPerView: "auto", // Each block is treated as one slide
    spaceBetween: 20,
    freeMode: true, // Allow smooth scrolling
    loop: false,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    mousewheel: true, // Allow scroll with mouse
    keyboard: {
      enabled: true, // Allow arrow key navigation
    },
  });
});


