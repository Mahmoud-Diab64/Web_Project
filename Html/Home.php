<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artifacts - Egyptian Heritage Explorer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;900&family=Lato:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/HomeStyle.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-landmark"></i>
                <span>Egyptian Heritage Explorer</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Catigories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
                <button class="btn btn-custom"><a href="login.php" style="color: white; text-decoration: none;">Login</a></button>
            </div>
        </div>
    </nav>

    <section class="page-header">
        <div class="page-header-content" data-aos="fade-up">
            <h1 id="categoryTitle">All Artifacts</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php" style="color: rgba(255,255,255,0.8); text-decoration: none;">Home</a></li>
                    <li class="breadcrumb-item active" id="categoryBreadcrumb">Artifacts</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="content-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3" data-aos="fade-right">
                    <aside class="filters-sidebar">
                        <div class="filter-group">
                            <div class="filter-title">
                                <i class="fas fa-search"></i>
                                <span>Search</span>
                            </div>
                            <input type="text" class="search-box" id="searchBox" placeholder="Artifact name...">
                        </div>
                        <div class="filter-group">
                            <div class="filter-title">
                                <i class="fas fa-layer-group"></i>
                                <span>Category</span>
                            </div>
                            <select class="filter-select" id="categoryFilter">
                                <option value="">All Categories</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <div class="filter-title">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Location</span>
                            </div>
                            <select class="filter-select" id="locationFilter">
                                <option value="">All Locations</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <div class="filter-title">
                                <i class="fas fa-hourglass-half"></i>
                                <span>Period</span>
                            </div>
                            <div id="periodFiltersContainer">
                                <!-- Period filters will be loaded dynamically -->
                            </div>
                        </div>
                        <button class="btn-apply-filters" onclick="applyFilters()">Apply Filters</button>
                        <button class="btn-apply-filters" onclick="resetFilters()" style="background: #6c757d; margin-top: 10px;">Reset Filters</button>
                    </aside>
                </div>

                <div class="col-lg-9">
                    <div class="results-header" data-aos="fade-left">
                        <span class="results-count" id="resultsCount">Loading artifacts...</span>
                        <select class="sort-select" id="sortSelect" onchange="sortArtifacts()">
                            <option value="newest">Sort by: Newest Added</option>
                            <option value="oldest">Sort by: Oldest Age</option>
                            <option value="name">Sort by: Name A-Z</option>
                        </select>
                    </div>

                    <div class="row g-4" id="artifactsGrid">
                        <!-- Artifacts will be loaded here -->
                    </div>

                    <div class="pagination" data-aos="fade-up" id="paginationContainer" style="display: none;">
                        <!-- Pagination will be generated here -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p style="margin: 0; opacity: 0.8;">&copy; 2025 Egyptian Heritage Explorer. All Rights Reserved.</p>
        </div>
    </footer>

    <div class="scroll-top" id="scrollTop">
        <i class="fas fa-arrow-up"></i>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Configuration
        const API_URL = '../Php/Artifacts/ShowArtifacts.php';
        const UPLOAD_PATH = '../UploadsForArtifacts/';
        
        let allArtifacts = [];
        let filteredArtifacts = [];
        let currentPage = 1;
        const itemsPerPage = 9;

        // Get category from URL
        const params = new URLSearchParams(window.location.search);
        const categoryId = params.get('category');

        // Load artifacts on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadArtifacts(categoryId);
        });

        // Load artifacts from database
        async function loadArtifacts(categoryId) {
            const grid = document.getElementById('artifactsGrid');
            
            grid.innerHTML = `
                <div class="col-12 text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-3">Loading artifacts...</p>
                </div>
            `;

            try {
                // Build API URL
                let apiUrl = API_URL;
                if (categoryId) {
                    apiUrl += `?category=${categoryId}`;
                }

                const response = await fetch(apiUrl);
                const data = await response.json();

                console.log('Artifacts Response:', data);

                if (data.success && data.artifacts && data.artifacts.length > 0) {
                    allArtifacts = data.artifacts;
                    filteredArtifacts = [...allArtifacts];
                    
                    // Update page title if category is selected
                    if (categoryId && allArtifacts.length > 0) {
                        const categoryName = allArtifacts[0].Cate_Name || 'Category';
                        document.getElementById('categoryTitle').textContent = categoryName;
                        document.getElementById('categoryBreadcrumb').textContent = categoryName;
                    }
                    
                    // Load filter options
                    loadFilterOptions();
                    
                    // Display first page
                    currentPage = 1;
                    displayArtifacts();
                    updatePagination();
                    updateResultsCount();
                } else {
                    grid.innerHTML = `
                        <div class="col-12 text-center">
                            <i class="fas fa-search" style="font-size: 4rem; opacity: 0.3;"></i>
                            <h3 class="mt-3">No Artifacts Found</h3>
                            <p>There are no artifacts available at the moment.</p>
                        </div>
                    `;
                    document.getElementById('resultsCount').textContent = 'No artifacts found';
                }
            } catch (error) {
                console.error('Error loading artifacts:', error);
                grid.innerHTML = `
                    <div class="col-12 text-center">
                        <i class="fas fa-exclamation-triangle" style="font-size: 4rem; color: #e74c3c;"></i>
                        <h3 class="mt-3">Error Loading Artifacts</h3>
                        <p>Please try again later.</p>
                    </div>
                `;
                document.getElementById('resultsCount').textContent = 'Error loading artifacts';
            }
        }

        // Load filter options dynamically
        function loadFilterOptions() {
            // Get unique categories
            const categories = [...new Set(allArtifacts.map(a => a.Cate_Name).filter(Boolean))];
            const categorySelect = document.getElementById('categoryFilter');
            categories.forEach(cat => {
                const option = document.createElement('option');
                option.value = cat;
                option.textContent = cat;
                categorySelect.appendChild(option);
            });

            // Get unique locations
            const locations = [...new Set(allArtifacts.map(a => a.Loc_Name).filter(Boolean))];
            const locationSelect = document.getElementById('locationFilter');
            locations.forEach(loc => {
                const option = document.createElement('option');
                option.value = loc;
                option.textContent = loc;
                locationSelect.appendChild(option);
            });

            // Get unique periods
            const periods = [...new Set(allArtifacts.map(a => a.Period).filter(Boolean))];
            const periodContainer = document.getElementById('periodFiltersContainer');
            periods.forEach(period => {
                const label = document.createElement('label');
                label.className = 'checkbox-item';
                label.innerHTML = `
                    <input type="checkbox" value="${period}" class="period-filter" checked>
                    <span>${period}</span>
                `;
                periodContainer.appendChild(label);
            });
        }

        // Display artifacts with pagination
        function displayArtifacts() {
            const grid = document.getElementById('artifactsGrid');

            if (filteredArtifacts.length === 0) {
                grid.innerHTML = `
                    <div class="col-12 text-center">
                        <i class="fas fa-filter" style="font-size: 4rem; opacity: 0.3;"></i>
                        <h3 class="mt-3">No Results</h3>
                        <p>Try adjusting your filters.</p>
                    </div>
                `;
                document.getElementById('paginationContainer').style.display = 'none';
                return;
            }

            // Calculate pagination
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginatedArtifacts = filteredArtifacts.slice(startIndex, endIndex);

            grid.innerHTML = paginatedArtifacts.map((art, index) => {
                let imageHtml = '';
                if (art.Img && art.Img.trim() !== '') {
                    imageHtml = `
                        <div class="artifact-img-container">
                            <img src="${UPLOAD_PATH + art.Img}" 
                                 alt="${art.Art_Name}" 
                                 class="artifact-img"
                                 onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'">
                            <span class="artifact-badge">${art.Period || 'Unknown Period'}</span>
                        </div>
                    `;
                } else {
                    imageHtml = `
                        <div class="artifact-img-container">
                            <img src="https://via.placeholder.com/400x300?text=No+Image" 
                                 alt="${art.Art_Name}" 
                                 class="artifact-img">
                            <span class="artifact-badge">${art.Period || 'Unknown Period'}</span>
                        </div>
                    `;
                }

                return `
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="${(index % 3) * 100}">
                        <div class="artifact-card">
                            ${imageHtml}
                            <div class="artifact-body">
                                <h3 class="artifact-title">${art.Art_Name}</h3>
                                <p class="artifact-desc">${art.Art_Description || 'No description available'}</p>
                                <a href="artifact_details.php?id=${art.Art_Id}" class="btn-view">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');

            // Scroll to top of grid
            window.scrollTo({
                top: document.querySelector('.content-section').offsetTop - 100,
                behavior: 'smooth'
            });

            // Re-initialize AOS for new elements
            AOS.refresh();
        }

        // Update pagination
        function updatePagination() {
            const totalPages = Math.ceil(filteredArtifacts.length / itemsPerPage);
            const paginationContainer = document.getElementById('paginationContainer');

            if (totalPages <= 1) {
                paginationContainer.style.display = 'none';
                return;
            }

            paginationContainer.style.display = 'flex';
            paginationContainer.innerHTML = '';

            // Previous button
            const prevButton = document.createElement('div');
            prevButton.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
            prevButton.innerHTML = '<i class="fas fa-chevron-left"></i>';
            prevButton.onclick = () => {
                if (currentPage > 1) {
                    currentPage--;
                    displayArtifacts();
                    updatePagination();
                    updateResultsCount();
                }
            };
            paginationContainer.appendChild(prevButton);

            // Page numbers
            const maxVisiblePages = 5;
            let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
            let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

            if (endPage - startPage < maxVisiblePages - 1) {
                startPage = Math.max(1, endPage - maxVisiblePages + 1);
            }

            // First page
            if (startPage > 1) {
                const firstPage = document.createElement('div');
                firstPage.className = 'page-item';
                firstPage.textContent = '1';
                firstPage.onclick = () => {
                    currentPage = 1;
                    displayArtifacts();
                    updatePagination();
                    updateResultsCount();
                };
                paginationContainer.appendChild(firstPage);

                if (startPage > 2) {
                    const dots = document.createElement('div');
                    dots.className = 'page-item disabled';
                    dots.textContent = '...';
                    paginationContainer.appendChild(dots);
                }
            }

            // Page numbers
            for (let i = startPage; i <= endPage; i++) {
                const pageButton = document.createElement('div');
                pageButton.className = `page-item ${i === currentPage ? 'active' : ''}`;
                pageButton.textContent = i;
                pageButton.onclick = () => {
                    currentPage = i;
                    displayArtifacts();
                    updatePagination();
                    updateResultsCount();
                };
                paginationContainer.appendChild(pageButton);
            }

            // Last page
            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    const dots = document.createElement('div');
                    dots.className = 'page-item disabled';
                    dots.textContent = '...';
                    paginationContainer.appendChild(dots);
                }

                const lastPage = document.createElement('div');
                lastPage.className = 'page-item';
                lastPage.textContent = totalPages;
                lastPage.onclick = () => {
                    currentPage = totalPages;
                    displayArtifacts();
                    updatePagination();
                    updateResultsCount();
                };
                paginationContainer.appendChild(lastPage);
            }

            // Next button
            const nextButton = document.createElement('div');
            nextButton.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
            nextButton.innerHTML = '<i class="fas fa-chevron-right"></i>';
            nextButton.onclick = () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    displayArtifacts();
                    updatePagination();
                    updateResultsCount();
                }
            };
            paginationContainer.appendChild(nextButton);
        }

        // Update results count
        function updateResultsCount() {
            const total = filteredArtifacts.length;
            const startIndex = (currentPage - 1) * itemsPerPage + 1;
            const endIndex = Math.min(currentPage * itemsPerPage, total);
            
            if (total === 0) {
                document.getElementById('resultsCount').textContent = 'No artifacts found';
            } else {
                document.getElementById('resultsCount').textContent = 
                    `Showing ${startIndex}-${endIndex} of ${total} Artifacts`;
            }
        }

        // Apply filters
        function applyFilters() {
            const searchTerm = document.getElementById('searchBox').value.toLowerCase();
            const categoryFilter = document.getElementById('categoryFilter').value;
            const locationFilter = document.getElementById('locationFilter').value;
            const periodFilters = Array.from(document.querySelectorAll('.period-filter:checked'))
            .map(cb => cb.value);

            filteredArtifacts = allArtifacts.filter(art => {
                // Search filter
                const matchesSearch = !searchTerm || 
                    art.Art_Name.toLowerCase().includes(searchTerm) ||
                    (art.Art_Description && art.Art_Description.toLowerCase().includes(searchTerm));

                // Category filter
                const matchesCategory = !categoryFilter || art.Cate_Name === categoryFilter;

                // Location filter
                const matchesLocation = !locationFilter || art.Loc_Name === locationFilter;

                // Period filter
                const matchesPeriod = periodFilters.length === 0 || 
                    periodFilters.some(period => art.Period && art.Period.includes(period));

                return matchesSearch && matchesCategory && matchesLocation && matchesPeriod;
            });

            currentPage = 1;
            displayArtifacts();
            updatePagination();
            updateResultsCount();
        }

        // Reset filters
        function resetFilters() {
            document.getElementById('searchBox').value = '';
            document.getElementById('categoryFilter').value = '';
            document.getElementById('locationFilter').value = '';
            document.querySelectorAll('.period-filter').forEach(cb => cb.checked = true);
            
            filteredArtifacts = [...allArtifacts];
            currentPage = 1;
            displayArtifacts();
            updatePagination();
            updateResultsCount();
        }

        // Sort artifacts
        function sortArtifacts() {
            const sortValue = document.getElementById('sortSelect').value;

            switch(sortValue) {
                case 'name':
                    filteredArtifacts.sort((a, b) => a.Art_Name.localeCompare(b.Art_Name));
                    break;
                case 'oldest':
                    filteredArtifacts.sort((a, b) => (a.Year || 0) - (b.Year || 0));
                    break;
                case 'newest':
                default:
                    filteredArtifacts.sort((a, b) => (b.Art_Id || 0) - (a.Art_Id || 0));
                    break;
            }

            currentPage = 1;
            displayArtifacts();
            updatePagination();
        }

        // Real-time search
        document.getElementById('searchBox').addEventListener('input', function() {
            applyFilters();
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }

            // Scroll to top button
            const scrollTop = document.getElementById('scrollTop');
            if (window.scrollY > 300) {
                scrollTop.classList.add('show');
            } else {
                scrollTop.classList.remove('show');
            }
        });

        // Scroll to top functionality
        document.getElementById('scrollTop').addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</body>
</html>