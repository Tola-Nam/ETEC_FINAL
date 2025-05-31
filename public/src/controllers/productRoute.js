let currentQuantity = 1;
let selectedColor = "white";
let selectedSize = "M";

function changeImage(src) {
  document.getElementById("mainImage").src = src;

  //^ Update thumbnail borders
  const thumbnails = document.querySelectorAll("button img");
  thumbnails.forEach((thumb) => {
    const button = thumb.parentElement;
    if (thumb.src.includes(src.split("?")[0].split("/").pop())) {
      button.className = button.className.replace(
        "border-transparent",
        "border-gray-900"
      );
    } else {
      button.className = button.className.replace(
        "border-gray-900",
        "border-transparent"
      );
    }
  });
}

function selectColor(button, color) {
  //~ Remove selection from all color buttons
  const colorButtons = button.parentElement.querySelectorAll("button");
  colorButtons.forEach((btn) => {
    btn.className = btn.className.replace(
      "border-gray-900",
      "border-transparent"
    );
  });

  //! Add selection to clicked button
  button.className = button.className.replace(
    "border-transparent",
    "border-gray-900"
  );

  selectedColor = color;
  document.getElementById("selectedColor").textContent = `Selected: ${
    color.charAt(0).toUpperCase() + color.slice(1)
  }`;
}

function selectSize(button, size) {
  // Remove selection from all size buttons
  const sizeButtons = button.parentElement.querySelectorAll("button");
  sizeButtons.forEach((btn) => {
    btn.className =
      "py-2 px-3 border border-gray-300 rounded-md text-center hover:border-gray-900";
  });

  // Add selection style to clicked button
  button.className =
    "py-2 px-3 border border-gray-900 bg-gray-900 text-white rounded-md text-center";

  // Update the selectedSize paragraph
  document.getElementById("selectedSize").textContent = `Selected: ${size}`;

  // Update the Models paragraph with the chosen size
  // document.getElementById("sizeProduct").textContent = `Model is 6'2" and wears size ${size}`;
}

function changeQuantity(delta) {
  const newQuantity = currentQuantity + delta;
  if (newQuantity >= 1 && newQuantity <= 10) {
    currentQuantity = newQuantity;
    document.getElementById("quantity").textContent = currentQuantity;
  }
}

function addToCart() {
  // ~Simulate adding to cart
  const button = event.target;
  const originalText = button.textContent;

  button.textContent = "Added!";
  button.className = button.className.replace("bg-gray-900", "bg-green-600");

  setTimeout(() => {
    button.textContent = originalText;
    button.className = button.className.replace("bg-green-600", "bg-gray-900");
  }, 2000);

  console.log("Added to cart:", {
    color: selectedColor,
    size: selectedSize,
    quantity: currentQuantity,
  });
}
