function highlightSize() {
  const height = parseInt(document.getElementById("height-input").value);
  const weight = parseInt(document.getElementById("weight-input").value);

  // Clear previous highlights
  const cells = document.querySelectorAll("td");
  cells.forEach((cell) => {
    cell.classList.remove(
      "bg-blue-200",
      "border-blue-500",
      "font-bold",
      "text-blue-800",
      "ring-2",
      "ring-blue-400"
    );
  });

  // Hide result display initially
  const resultDisplay = document.getElementById("result-display");
  const sizeResult = document.getElementById("size-result");
  resultDisplay.classList.add("hidden");

  if (!height || !weight) {
    alert("Please enter both height and weight values!");
    return;
  }

  // Find height row
  let heightRowIndex = -1;
  const heightRanges = [
    [173, 175],
    [170, 172],
    [168, 169],
    [165, 167],
    [163, 164],
    [161, 162],
    [158, 160],
    [155, 157],
    [153, 154],
    [149, 152],
  ];

  heightRanges.forEach((range, index) => {
    if (height >= range[0] && height <= range[1]) {
      heightRowIndex = index;
    }
  });

  // Find weight column
  let weightColIndex = -1;
  const weightRanges = [
    [40, 42],
    [43, 44],
    [45, 47],
    [48, 49],
    [50, 52],
    [53, 54],
    [55, 57],
    [58, 59],
    [60, 62],
    [63, 64],
    [65, 67],
    [68, 69],
    [70, 75],
  ];

  weightRanges.forEach((range, index) => {
    if (weight >= range[0] && weight <= range[1]) {
      weightColIndex = index + 1; // +1 because first column is height labels
    }
  });

  // Check if values are within range
  if (heightRowIndex === -1) {
    alert(`Height ${height}cm is outside the supported range (149-175cm)`);
    return;
  }

  if (weightColIndex === -1) {
    alert(`Weight ${weight}kg is outside the supported range (40-75kg)`);
    return;
  }

  // Highlight the cell
  const rows = document.querySelectorAll("#size-chart-body tr");
  const targetCell = rows[heightRowIndex].children[weightColIndex];

  if (targetCell && targetCell.textContent.trim()) {
    // Apply strong highlighting
    targetCell.classList.add(
      "bg-blue-200",
      "border-blue-500",
      "font-bold",
      "text-blue-800",
      "ring-2",
      "ring-blue-400"
    );

    // Show result
    const recommendedSize = targetCell.textContent.trim();
    sizeResult.textContent = recommendedSize;
    resultDisplay.classList.remove("hidden");

    // Scroll to highlighted cell
    targetCell.scrollIntoView({ behavior: "smooth", block: "center" });
  } else {
    alert(
      "No size recommendation available for this height/weight combination."
    );
  }
}

// Allow Enter key to trigger calculation
document.addEventListener("keypress", function (e) {
  if (e.key === "Enter") {
    highlightSize();
  }
});

function openModal() {
  document.getElementById("sizeGuide").classList.remove("hidden");
}

function closeModal() {
  document.getElementById("sizeGuide").classList.add("hidden");
}
