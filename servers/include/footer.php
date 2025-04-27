<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Dropdown with Animation</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Local Bootstrap -->
    <script src="js/bootstrap.bundle.min.js"></script> <!-- Local Bootstrap JS -->
    <style>
        .dropdown-menu {
            transform: scale(0.9);
            opacity: 0;
            transition: transform 0.2s ease-in-out, opacity 0.2s ease-in-out;
            display: block;
            /* Keeps Bootstrap from overriding our effect */
            visibility: hidden;
        }

        .dropdown-menu.show {
            transform: scale(1);
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" id="dropdownBtn">
            Open Dropdown
        </button>
        <ul class="dropdown-menu" id="dropdownMenu">
            <li><a class="dropdown-item" href="#">Item 1</a></li>
            <li><a class="dropdown-item" href="#">Item 2</a></li>
            <li><a class="dropdown-item" href="#">Item 3</a></li>
        </ul>
    </div>

    <script>
        document.getElementById("dropdownBtn").addEventListener("click", function () {
            document.getElementById("dropdownMenu").classList.add("show");
        });

        // Close dropdown when clicking outside
        document.addEventListener("click", function (event) {
            const dropdown = document.getElementById("dropdownMenu");
            const button = document.getElementById("dropdownBtn");

            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.remove("show");
            }
        });
    </script>

</body>

</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>