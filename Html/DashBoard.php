<?php
session_start();
require_once '../Php/Config/config.php';

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

$totalUsers      = $con->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
$totalArtifacts  = $con->query("SELECT COUNT(*) AS total FROM artifacts")->fetch_assoc()['total'];
$totalCategories = $con->query("SELECT COUNT(*) AS total FROM categories")->fetch_assoc()['total'];
$totalLocations  = $con->query("SELECT COUNT(*) AS total FROM location")->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Egyptian Heritage Explorer</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;900&family=Lato:wght@400;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="fas fa-landmark"></i>
            </div>
            <h2>Egyptian Heritage</h2>
            <p>Admin Dashboard</p>
        </div>
        
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="#" class="nav-link active" data-section="dashboard">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="#" class="nav-link" data-section="users">
                    <i class="fas fa-users"></i>
                    <span>Manage Users</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="Show_art.php" class="nav-link" data-section="artifacts">
                    <i class="fas fa-monument"></i>
                    <span>Manage Artifacts</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="Show_Catigries" class="nav-link" data-section="categories">
                    <i class="fas fa-th-large"></i>
                    <span>Manage Categories</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="Location.php" class="nav-link" data-section="locations">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Manage Locations</span>
                </a>
            </li>
        </ul>

        <button class="logout-btn" onclick="logout()">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </button>
    </aside>

    <main class="main-content">

        <!-- ========= Dashboard Section ========= -->
        <div id="dashboard-section" class="section-card active">
            <div class="top-bar">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <h1 class="mb-1">Welcome back, Admin! 👋</h1>
                        <p class="text-muted mb-0">Here's what's happening with your heritage platform</p>
                    </div>
                    <div class="text-end">
                        <div class="fw-bold text-dark">Ahmed Mohamed</div>
                        <div class="small text-muted">System Administrator</div>
                    </div>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card users">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?= $totalUsers ?></h3>
                        <p>Total Users</p>
                    </div>
                </div>
                
                <div class="stat-card artifacts">
                    <div class="stat-icon">
                        <i class="fas fa-monument"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?= $totalArtifacts ?></h3>
                        <p>Heritage Artifacts</p>
                    </div>
                </div>
                
                <div class="stat-card categories">
                    <div class="stat-icon">
                        <i class="fas fa-th-large"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?= $totalCategories ?></h3>
                        <p>Categories</p>
                    </div>
                </div>
                
                <div class="stat-card locations">
                    <div class="stat-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?= $totalLocations ?></h3>
                        <p>Locations</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- باقي الصفحات زي ما هي -->
        <!-- Users Section -->
        <div id="users-section" class="section-card">
            <div class="section-header">
                <h3><i class="fas fa-users me-2"></i>Manage Users</h3>
                <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fas fa-plus"></i> Add New User
                </button>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Join Date</th><th>Actions</th></tr>
                    </thead>
                    <tbody id="usersTableBody">
                        <tr><td colspan="6" class="text-center"><div class="spinner-border text-primary"></div></td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Artifacts Section -->
        <div id="artifacts-section" class="section-card">
            <div class="section-header">
                <h3><i class="fas fa-monument me-2"></i>Manage Heritage Artifacts</h3>
                <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#addArtifactModal">
                    <i class="fas fa-plus"></i> Add New Artifact
                </button>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr><th>ID</th><th>Name</th><th>Category</th><th>Location</th><th>Era</th><th>Actions</th></tr>
                    </thead>
                    <tbody id="artifactsTableBody">
                        <tr><td colspan="6" class="text-center"><div class="spinner-border text-primary"></div></td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Categories Section -->
        <div id="categories-section" class="section-card">
            <div class="section-header">
                <h3><i class="fas fa-th-large me-2"></i>Manage Categories</h3>
                <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    <i class="fas fa-plus"></i> Add New Category
                </button>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead><tr><th>ID</th><th>Category Name</th><th>Description</th><th>Artifacts Count</th><th>Actions</th></tr></thead>
                    <tbody id="categoriesTableBody">
                        <tr><td colspan="5" class="text-center"><div class="spinner-border text-primary"></div></td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Locations Section -->
        <div id="locations-section" class="section-card">
            <div class="section-header">
                <h3><i class="fas fa-map-marker-alt me-2"></i>Manage Locations</h3>
                <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#addLocationModal">
                    <i class="fas fa-plus"></i> Add New Location
                </button>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead><tr><th>ID</th><th>Location Name</th><th>City</th><th>Region</th><th>Artifacts</th><th>Actions</th></tr></thead>
                    <tbody id="locationsTableBody">
                        <tr><td colspan="6" class="text-center"><div class="spinner-border text-primary"></div></td></tr>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/dashboard.js"></script>
</body>
</html>
