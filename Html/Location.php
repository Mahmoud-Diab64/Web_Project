<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Locations - Egyptian Heritage Explorer</title>
    
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

        /* Sidebar */
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

        /* Main Content */
        .main-content {
            margin-left: 280px;
            flex: 1;
            padding: 2rem;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #1a3a52 0%, #2c5f7f 100%);
            border-radius: 20px;
            padding: 3rem;
            text-align: center;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .hero-section h1 {
            font-family: 'Cinzel', serif;
            color: #d4af37;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .hero-section p {
            color: rgba(255,255,255,0.8);
            font-size: 1.1rem;
        }

        /* Search and Add Section */
        .controls-section {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .search-box {
            flex: 1;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 0.9rem 1.2rem 0.9rem 3rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            outline: none;
            border-color: #d4af37;
            box-shadow: 0 0 0 3px rgba(212,175,55,0.1);
        }

        .search-box i {
            position: absolute;
            left: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: #718096;
            font-size: 1.1rem;
        }

        .btn-add {
            background: linear-gradient(135deg, #d4af37 0%, #c9a557 100%);
            color: white;
            padding: 0.9rem 2rem;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(212,175,55,0.4);
            color: white;
        }

        /* Locations Grid */
        .locations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
        }

        .location-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .location-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .card-image {
            height: 200px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: white;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            font-family: 'Cinzel', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 1rem;
        }

        .card-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #718096;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }

        .card-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-edit, .btn-delete {
            flex: 1;
            padding: 0.7rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-edit {
            background: #e6f7ff;
            color: #0891b2;
        }

        .btn-edit:hover {
            background: #0891b2;
            color: white;
        }

        .btn-delete {
            background: #fee;
            color: #ef4444;
        }

        .btn-delete:hover {
            background: #ef4444;
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .empty-state i {
            font-size: 5rem;
            color: #e2e8f0;
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: #718096;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
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

    <!-- Main Content -->
    <main class="main-content">
        <!-- Hero Section -->
        <div class="hero-section">
            <h1>
                <i class="fas fa-map-marker-alt"></i>
                Heritage Locations
            </h1>
            <p>Explore all Egyptian heritage locations</p>
        </div>

        <!-- Search and Add Controls -->
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

        <!-- Locations Grid -->
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