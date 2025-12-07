<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Location - Egyptian Heritage Explorer</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;900&family=Lato:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Lato', sans-serif;
            background: #f0f4f8;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #1a3a52 0%, #0f2537 100%);
            padding: 2rem 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-header {
            text-align: center;
            padding: 0 1.5rem 2rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 2rem;
        }

        .logo {
            width: 70px;
            height: 70px;
            margin: 0 auto 1rem;
            background: #d4af37;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
        }

        .sidebar-header h2 {
            font-family: 'Cinzel', serif;
            color: #d4af37;
            font-size: 1.2rem;
            margin-bottom: 0.3rem;
            font-weight: 700;
        }

        .sidebar-header p {
            color: rgba(255,255,255,0.6);
            font-size: 0.85rem;
        }

        .nav-menu {
            list-style: none;
            padding: 0 1rem;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.9rem 1.2rem;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: white;
        }

        .nav-link.active {
            background: #d4af37;
            color: white;
        }

        .nav-link i {
            width: 25px;
            margin-right: 1rem;
            font-size: 1.1rem;
        }

        .logout-btn {
            margin: 2rem 1.5rem;
            width: calc(100% - 3rem);
            padding: 0.9rem;
            background: transparent;
            border: 2px solid rgba(255,255,255,0.2);
            color: rgba(255,255,255,0.7);
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .logout-btn:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            border-color: white;
        }

        .main-content {
            margin-left: 280px;
            flex: 1;
            padding: 2rem;
        }

        .page-header {
            background: white;
            border-radius: 15px;
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .page-header h1 {
            font-family: 'Cinzel', serif;
            color: #2d3748;
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
            font-size: 0.9rem;
        }

        .breadcrumb-item a {
            color: #718096;
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            color: #d4af37;
        }

        .breadcrumb-item.active {
            color: #2d3748;
        }

        .form-card {
            background: white;
            border-radius: 15px;
            padding: 2.5rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            max-width: 800px;
            margin: 0 auto;
        }

        .loading-state {
            text-align: center;
            padding: 3rem;
        }

        .spinner {
            border: 4px solid #f3f4f6;
            border-top: 4px solid #0891b2;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .form-header {
            text-align: center;
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid #f0f4f8;
        }

        .form-header i {
            font-size: 3.5rem;
            color: #0891b2;
            margin-bottom: 1rem;
        }

        .form-header h2 {
            font-family: 'Cinzel', serif;
            color: #2d3748;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: #718096;
            font-size: 1rem;
        }

        .info-badge {
            display: inline-block;
            background: #e6f7ff;
            color: #0891b2;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.7rem;
            font-size: 1rem;
        }

        .form-label .required {
            color: #ef4444;
            margin-left: 0.2rem;
        }

        .form-control {
            width: 100%;
            padding: 0.9rem 1.2rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #0891b2;
            box-shadow: 0 0 0 3px rgba(8,145,178,0.1);
        }

        .form-control::placeholder {
            color: #a0aec0;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2.5rem;
            padding-top: 1.5rem;
            border-top: 2px solid #f0f4f8;
        }

        .btn {
            flex: 1;
            padding: 0.9rem 2rem;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #0891b2 0%, #0e7490 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(8,145,178,0.4);
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #2d3748;
        }

        .btn-secondary:hover {
            background: #cbd5e0;
        }

        .helper-text {
            font-size: 0.85rem;
            color: #718096;
            margin-top: 0.5rem;
        }
    </style>
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
            <!-- Loading State -->
            <div id="loadingState" class="loading-state">
                <div class="spinner"></div>
                <p class="text-muted">Loading location data...</p>
            </div>

            <!-- Form Content (Hidden initially) -->
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
        // Get location ID from URL
        const urlParams = new URLSearchParams(window.location.search);
        const locationId = urlParams.get('id');

        if (!locationId) {
            alert('No location ID provided!');
            window.location.href = 'Location.php';
        }

        // Load location data when page loads
        window.addEventListener('DOMContentLoaded', loadLocationData);

        async function loadLocationData() {
            try {
                const response = await fetch(`../Php/Location/get_Location_By_Id.php?id=${locationId}`);
                const data = await response.json();

                if (data.success && data.data) {
                    const location = data.data;
                    
                    // Fill form with data
                    document.getElementById('locId').value = location.id;
                    document.getElementById('locationId').textContent = location.id;
                    document.getElementById('siteName').value = location.site;
                    
                    // Hide loading, show form
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
                
                // Check if response is JSON
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
                    // If not JSON, it's the old script with alerts
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