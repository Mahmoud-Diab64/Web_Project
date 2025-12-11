<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Location - Egyptian Heritage Explorer</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;900&family=Lato:wght@400;600;700&display=swap" rel="stylesheet">
    
   <link rel="stylesheet" href="../css/AddLocation.css">
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="fas fa-landmark"></i>
            </div>
            <h2>Egyptian Heritage</h2>
            <p>Admin Dashboard</p>
        </div>
        
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="DashBoard.php" class="nav-link">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="users.php" class="nav-link">
                    <i class="fas fa-users"></i>
                    <span>Manage Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="artifacts.php" class="nav-link">
                    <i class="fas fa-monument"></i>
                    <span>Manage Artifacts</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="Show_Catigries.php" class="nav-link">
                    <i class="fas fa-th-large"></i>
                    <span>Manage Categories</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="Location.php" class="nav-link active">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Manage Locations</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="settings.php" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </li>
        </ul>
        
        <button class="logout-btn" onclick="logout()">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </button>
    </aside>

    <main class="main-content">
        <div class="page-header">
            <h1>
                <i class="fas fa-plus-circle" style="color: #d4af37;"></i>
                Add New Location
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="DashBoard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="Location.php">Locations</a></li>
                    <li class="breadcrumb-item active">Add New</li>
                </ol>
            </nav>
        </div>

        <div class="form-card">
            <div class="form-header">
                <i class="fas fa-map-marker-alt"></i>
                <h2>Create New Location</h2>
                <p>Add a new heritage location to the system</p>
            </div>

            <form action="../Php/Location/insert_location.php" method="POST">
                <div class="form-group">
                    <label class="form-label">
                        Location Name
                        <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="site" 
                        class="form-control" 
                        placeholder="Enter location name (e.g., Cairo, Luxor, Giza)" 
                        required
                        autofocus
                    >
                    <p class="helper-text">
                        <i class="fas fa-info-circle"></i>
                        Enter the official name of the heritage location
                    </p>
                </div>

                <div class="form-actions">
                    <a href="Location.php" class="btn btn-secondary">
                        <i class="fas fa-times"></i>
                        Cancel
                    </a>
                    <button type="submit" name="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Save Location
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = 'logout.php';
            }
        }
    </script>
</body>
</html>