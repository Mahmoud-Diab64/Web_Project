<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Locations - Egyptian Heritage Explorer</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;900&family=Lato:wght@400;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../css/Location.css">
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
        <div class="hero-section">
            <h1>
                <i class="fas fa-map-marker-alt"></i>
                Heritage Locations
            </h1>
            <p>Explore all Egyptian heritage locations</p>
        </div>

        <div class="controls-section">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Search locations..." onkeyup="searchLocations()">
            </div>
            <a href="Add_Location.php" class="btn-add">
                <i class="fas fa-plus-circle"></i>
                Add New Location
            </a>
        </div>

        <div class="locations-grid" id="locationsGrid">
            <?php
            require_once '../Php/Config/config.php';
            
            $sql = "SELECT Loc_ID, Site FROM location ORDER BY Loc_ID DESC";
            $result = $con->query($sql);
            
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $colors = ['#667eea', '#764ba2', '#f093fb', '#4facfe', '#43e97b', '#fa709a'];
                    $randomColor = $colors[array_rand($colors)];
                    
                    echo '<div class="location-card" data-location="' . htmlspecialchars($row['Site']) . '">';
                    echo '<div class="card-image" style="background: linear-gradient(135deg, ' . $randomColor . ' 0%, #764ba2 100%);">';
                    echo '<i class="fas fa-map-marker-alt"></i>';
                    echo '</div>';
                    echo '<div class="card-body">';
                    echo '<h3 class="card-title">' . htmlspecialchars($row['Site']) . '</h3>';
                    echo '<div class="card-info">';
                    echo '<i class="fas fa-layer-group"></i>';
                    echo '<span>0 Artifacts</span>';
                    echo '</div>';
                    echo '<div class="card-actions">';
                    echo '<a href="Edit_Location.php?id=' . $row['Loc_ID'] . '" class="btn-edit">';
                    echo '<i class="fas fa-edit"></i> Edit';
                    echo '</a>';
                    echo '<button class="btn-delete" onclick="deleteLocation(' . $row['Loc_ID'] . ')">';
                    echo '<i class="fas fa-trash"></i> Delete';
                    echo '</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="empty-state" style="grid-column: 1/-1;">';
                echo '<i class="fas fa-map-marker-alt"></i>';
                echo '<h3>No Locations Found</h3>';
                echo '<p>Start by adding your first location</p>';
                echo '</div>';
            }
            
            $con->close();
            ?>
        </div>
    </main>

    <script>
        function searchLocations() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const grid = document.getElementById('locationsGrid');
            const cards = grid.getElementsByClassName('location-card');

            for (let i = 0; i < cards.length; i++) {
                const locationName = cards[i].getAttribute('data-location').toLowerCase();
                if (locationName.includes(filter)) {
                    cards[i].style.display = '';
                } else {
                    cards[i].style.display = 'none';
                }
            }
        }

        function deleteLocation(id) {
            if (confirm('Are you sure you want to delete this location?\n\nThis action cannot be undone!')) {
                window.location.href = '../Php/Location/delete_Location.php?id=' + id;
            }
        }

        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = 'logout.php';
            }
        }
    </script>
</body>
</html>