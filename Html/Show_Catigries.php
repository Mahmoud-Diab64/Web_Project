<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - Egyptian Heritage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Lato:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/ShowCatigories.css">
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
                <a href="DashBoard.php" class="nav-link">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-users"></i>
                    <span>Manage Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-monument"></i>
                    <span>Manage Artifacts</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="Show_Catigories.php" class="nav-link active">
                    <i class="fas fa-th-large"></i>
                    <span>Manage Categories</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Manage Locations</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
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

    <button class="mobile-menu-toggle" id="menuToggle">
        <i class="fas fa-bars"></i>
    </button>

    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <h1><i class="fas fa-layer-group me-3"></i>Heritage Categories</h1>
                <p>Explore all Egyptian heritage categories</p>
            </div>

            <div class="controls">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Search categories...">
                    <i class="fas fa-search"></i>
                </div>
                <a href="Add_Catigory.php" class="btn-add">
                    <i class="fas fa-plus-circle"></i>
                    Add New Category
                </a>
            </div>

            <div id="categoriesContainer">
                <div class="loading">
                    <div class="spinner"></div>
                    <p class="text-muted">Loading categories...</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        
        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
            });
        }

        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = 'login.php';
            }
        }

        // عنوان الـ PHP file حسب مكانه عندك
        const API_URL = '../Php/Category/ShowCategory.php';
        const UPLOAD_PATH = '../UploadsForCategory/';

        let allCategories = [];

        // Load categories on page load
        window.addEventListener('DOMContentLoaded', loadCategories);

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            const filtered = allCategories.filter(cat => 
                cat.Cate_Name.toLowerCase().includes(searchTerm)
            );
            displayCategories(filtered);
        });

        async function loadCategories() {
            try {
                const response = await fetch(API_URL);
                const data = await response.json();

                if (data.success && data.categories) {
                    allCategories = data.categories;
                    displayCategories(allCategories);
                } else {
                    showNoData();
                }
            } catch (error) {
                console.error('Error loading categories:', error);
                showError();
            }
        }

        function displayCategories(categories) {
            const container = document.getElementById('categoriesContainer');

            if (categories.length === 0) {
                showNoData();
                return;
            }

            const html = `
                <div class="categories-grid">
                    ${categories.map(cat => `
                        <div class="category-card">
                            <img src="${UPLOAD_PATH}${cat.Img}" 
                                 alt="${cat.Cate_Name}" 
                                 class="category-image"
                                 onerror="this.src='https://via.placeholder.com/280x220/667eea/ffffff?text=${encodeURIComponent(cat.Cate_Name)}'">
                            <div class="category-body">
                                <h3 class="category-name">${cat.Cate_Name}</h3>
                                <div class="category-meta">
                                    <div class="artifact-count">
                                        <i class="fas fa-monument"></i>
                                        <span>${cat.artifact_count || 0} Artifacts</span>
                                    </div>
                                </div>
                                <div class="category-actions">
                                    <button class="btn-action btn-edit" onclick="editCategory(${cat.Cate_Id})">
                                        <i class="fas fa-edit"></i>
                                        Edit
                                    </button>
                                    <button class="btn-action btn-delete" onclick="deleteCategory(${cat.Cate_Id}, '${cat.Cate_Name}')">
                                        <i class="fas fa-trash"></i>
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    `).join('')}
                </div>
            `;

            container.innerHTML = html;
        }

        function showNoData() {
            const container = document.getElementById('categoriesContainer');
            container.innerHTML = `
                <div class="no-data">
                    <i class="fas fa-inbox"></i>
                    <h3>No Categories Found</h3>
                    <p class="text-muted">Start by adding your first category</p>
                </div>
            `;
        }

        function showError() {
            const container = document.getElementById('categoriesContainer');
            container.innerHTML = `
                <div class="no-data">
                    <i class="fas fa-exclamation-triangle text-danger"></i>
                    <h3>Error Loading Categories</h3>
                    <p class="text-muted">Please try again later</p>
                </div>
            `;
        }

        function editCategory(id) {
            // Redirect to edit page
            window.location.href = `EditCatigory.php?id=${id}`;
        }

        async function deleteCategory(id, name) {
            if (!confirm(`Are you sure you want to delete "${name}"?`)) {
                return;
            }

            try {
                const formData = new FormData();
                formData.append('cate_id', id);

                const response = await fetch('../Php/Category/DeleteCatigory.php', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    alert('Category deleted successfully!');
                    loadCategories(); // Reload
                } else {
                    alert('Error: ' + data.message);
                }
            } catch (error) {
                alert('Error deleting category');
                console.error(error);
            }
        }
    </script>
</body>
</html>