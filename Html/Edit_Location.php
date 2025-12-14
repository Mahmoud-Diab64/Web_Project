<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Location - Egyptian Heritage Explorer</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;900&family=Lato:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/EditLocation.css">
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
                <i class="fas fa-edit" style="color: #0891b2;"></i>
                Edit Location
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="DashBoard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="Location.php">Locations</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>

        <div class="form-card">
            <div id="loadingState" class="loading-state">
                <div class="spinner"></div>
                <p class="text-muted">Loading location data...</p>
            </div>

            <div id="formContent" style="display: none;">
                <div class="form-header">
                    <i class="fas fa-map-marker-alt"></i>
                    <h2>Update Location Information</h2>
                    <p>Modify the details of this heritage location</p>
                    <div class="info-badge">
                        <i class="fas fa-hashtag"></i> Location ID: <span id="locationId"></span>
                    </div>
                </div>

                <form id="editForm" method="POST">
                    <input type="hidden" name="id" id="locId">
                    
                    <div class="form-group">
                        <label class="form-label">
                            Location Name
                            <span class="required">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="site" 
                            id="siteName"
                            class="form-control" 
                            placeholder="Enter location name" 
                            required
                            autofocus
                        >
                        <p class="helper-text">
                            <i class="fas fa-info-circle"></i>
                            Update the location name as needed
                        </p>
                    </div>

                    <div class="form-actions">
                        <a href="Location.php" class="btn btn-secondary">
                            <i class="fas fa-times"></i>
                            Cancel
                        </a>
                        <button type="submit" name="update" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Update Location
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const locationId = urlParams.get('id');

        if (!locationId) {
            alert('No location ID provided!');
            window.location.href = 'Location.php';
        }

        window.addEventListener('DOMContentLoaded', loadLocationData);

        async function loadLocationData() {
            try {
                const response = await fetch(`../Php/Location/get_Location_By_Id.php?id=${locationId}`);
                const data = await response.json();

                if (data.success && data.data) {
                    const location = data.data;
                    
                    document.getElementById('locId').value = location.id;
                    document.getElementById('locationId').textContent = location.id;
                    document.getElementById('siteName').value = location.site;
                    
                    document.getElementById('loadingState').style.display = 'none';
                    document.getElementById('formContent').style.display = 'block';
                } else {
                    alert('Location not found!');
                    window.location.href = 'Location.php';
                }
            } catch (error) {
                console.error('Error loading location:', error);
                alert('Error loading location data');
                window.location.href = 'Location.php';
            }
        }

        document.getElementById('editForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            if (!confirm('Are you sure you want to update this location?')) {
                return;
            }
            
            const formData = new FormData(e.target);
            
            try {
                const response = await fetch('../Php/Location/update_Locations.php', {
                    method: 'POST',
                    body: formData
                });
                
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    const data = await response.json();
                    
                    if (data.success) {
                        alert('Location updated successfully! ✅');
                        window.location.href = 'Location.php';
                    } else {
                        alert('Error: ' + data.message);
                    }
                } else {
                    alert('Location updated successfully! ✅');
                    window.location.href = 'Location.php';
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error updating location');
            }
        });

        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = 'logout.php';
            }
        }
    </script>
</body>
</html>