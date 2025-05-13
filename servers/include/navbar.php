<?php require_once('../admin/connections/admin_register.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$UserName = $_SESSION['UserName'] ?? 'Guest';
$profileImage = $_SESSION['profileImage'] ?? 'defaultMale.png';
?>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#"><i class="bi bi-house-door-fill"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-folder2-open"></i> Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-person-lines-fill"></i> About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-envelope-fill"></i> Contact</a>
                </li>
            </ul>
        </div>

        <!-- Profile with Dropdown -->
        <div class="dropdown d-flex align-items-center">
            <!-- Profile Picture & Modal Trigger -->
            <figure>
                <a href="#" class="d-flex align-items-center text-decoration-none" data-bs-toggle="modal"
                    data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                    <img src="/ETEC_FINAL/servers/assets/uploads/<?= htmlspecialchars($profileImage) ?>" alt="Profile"
                        width="30" height="30" class="rounded-circle me-2 shadow-sm">
                </a>
            </figure>

            <!-- Username -->
            <span class="fw-semibold text-primary">
                <?php echo $UserName ?>
            </span>
        </div>
</nav>
<!-- @Modal form for insert profile -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Chance Your profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Please Upload your profile </label>
                        <input type="file" name="profileImage" class="form-control" id="recipient-name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                        class="bi bi-x-circle me-2"></i>Cancel</button>
                <button type="submit" name="Confirm" class="btn btn-success"><i
                        class="bi bi-check-circle me-2"></i>Confirm</button>
            </div>
        </div>
    </div>
</div>