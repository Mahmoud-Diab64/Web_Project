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
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Lato', sans-serif;
            background: #f8f9fa;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            box-shadow: 0 5px 30px rgba(0,0,0,0.15);
        }

        .navbar-brand {
            font-family: 'Cinzel', serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: #2d3748;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .navbar-brand i {
            color: #d4af37;
            font-size: 1.8rem;
        }

        .nav-link {
            color: #4a5568;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: color 0.3s ease;
        }

        .nav-link:hover, .nav-link.active {
            color: #d4af37;
        }

        .btn-custom {
            background: linear-gradient(135deg, #d4af37 0%, #c19b2f 100%);
            color: white;
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(212, 175, 55, 0.4);
        }

        .page-header {
            background: linear-gradient(135deg, #d4af37 0%, #c19b2f 100%);
            padding: 4rem 0 3rem;
            color: white;
            text-align: center;
        }

        .page-header h1 {
            font-family: 'Cinzel', serif;
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .breadcrumb {
            background: transparent;
            justify-content: center;
            margin: 0;
        }

        .breadcrumb-item.active {
            color: rgba(255,255,255,0.8);
        }

        .content-section {
            padding: 3rem 0;
        }

        .search-container {
            max-width: 800px;
            margin: 0 auto 3rem;
        }

        .search-box-wrapper {
            position: relative;
        }

        .search-box-wrapper input {
            width: 100%;
            padding: 1rem 1.5rem 1rem 3.5rem;
            border: 2px solid #e2e8f0;
            border-radius: 50px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-box-wrapper input:focus {
            outline: none;
            border-color: #d4af37;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }

        .search-box-wrapper i {
            position: absolute;
            left: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            color: #718096;
            font-size: 1.1rem;
        }

        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding: 1rem 0;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .results-count {
            font-weight: 600;
            color: #2d3748;
            font-size: 1.1rem;
        }

        .sort-select {
            padding: 0.6rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.95rem;
            cursor: pointer;
            background: white;
        }

        .sort-select:focus {
            outline: none;
            border-color: #d4af37;
        }

        .artifact-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .artifact-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .artifact-img-container {
            position: relative;
            height: 250px;
            overflow: hidden;
        }

        .artifact-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .artifact-card:hover .artifact-img {
            transform: scale(1.1);
        }

        .artifact-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(212, 175, 55, 0.95);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .artifact-body {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .artifact-title {
            font-family: 'Cinzel', serif;
            font-size: 1.3rem;
            color: #2d3748;
            margin-bottom: 1rem;
        }

        .artifact-desc {
            color: #718096;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .btn-view {
            background: #d4af37;
            color: white;
            padding: 0.7rem 1.5rem;
            border-radius: 10px;
            text-decoration: none;
            text-align: center;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-view:hover {
            background: #c19b2f;
            color: white;
            transform: translateY(-2px);
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 3rem;
        }

        .page-item {
            padding: 0.6rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
            min-width: 40px;
            text-align: center;
        }

        .page-item:hover:not(.disabled) {
            border-color: #d4af37;
            color: #d4af37;
        }

        .page-item.active {
            background: #d4af37;
            color: white;
            border-color: #d4af37;
        }

        .page-item.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .empty-state i {
            font-size: 5rem;
            color: #cbd5e0;
            margin-bottom: 1.5rem;
        }

        .empty-state h3 {
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: #718096;
        }

        footer {
            background: linear-gradient(135deg, #1a3a52 0%, #0f2537 100%);
            color: white;
            padding: 2rem 0;
            text-align: center;
            margin-top: 4rem;
        }

        .scroll-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 50px;
            height: 50px;
            background: #d4af37;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .scroll-top.show {
            opacity: 1;
            visibility: visible;
        }

        .scroll-top:hover {
            background: #c19b2f;
            transform: translateY(-5px);
        }

        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 2rem;
            }
            
            .results-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="Home.php">
                <i class="fas fa-landmark"></i>
                <span>Egyptian Heritage Explorer</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="Home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="artifacts.php">Artifacts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
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
        <div class="container">
            <h1 id="categoryTitle">All Artifacts</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="Home.php" style="color: rgba(255,255,255,0.8); text-decoration: none;">Home</a></li>
                    <li class="breadcrumb-item active" id="categoryBreadcrumb">Artifacts</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="content-section">
        <div class="container">
            <div class="search-container" data-aos="fade-up">
                <div class="search-box-wrapper">
                    <i class="fas fa-search"></i>
                    <input 
                        type="text" 
                        id="searchBox" 
                        placeholder="Search artifacts by name or description..." 
                        onkeyup="applySearch()"
                    >
                </div>
            </div>

            <div class="results-header" data-aos="fade-up">
                <span class="results-count" id="resultsCount">Loading artifacts...</span>
                <select class="sort-select" id="sortSelect" onchange="sortArtifacts()">
                    <option value="newest">Sort by: Newest First</option>
                    <option value="oldest">Sort by: Oldest First</option>
                    <option value="name">Sort by: Name A-Z</option>
                </select>
            </div>

            <div class="row g-4" id="artifactsGrid">
                <div class="col-12">
                    <div class="text-center py-5">
                        <div class="spinner-border" style="color: #d4af37;" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-3 text-muted">Loading artifacts...</p>
                    </div>
                </div>
            </div>

            <div class="pagination" id="paginationContainer" style="display: none;"></div>
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
        AOS.init({ duration: 1000, once: true, offset: 100 });

        const API_URL = '../Php/Artifacts/ShowArtifacts.php';
        const UPLOAD_PATH = '../UploadsForArtifacts/';
        
        let allArtifacts = [];
        let filteredArtifacts = [];
        let currentPage = 1;
        const itemsPerPage = 9;

        const params = new URLSearchParams(window.location.search);
        const categoryId = params.get('category');

        document.addEventListener('DOMContentLoaded', function() {
            loadArtifacts();
        });

        async function loadArtifacts() {
            const grid = document.getElementById('artifactsGrid');
            
            try {
                const response = await fetch(API_URL);
                const data = await response.json();

                console.log('API Response:', data);

                if (data.success && data.artifacts && data.artifacts.length > 0) {
                    allArtifacts = data.artifacts;
                    
                    if (categoryId) {
                        allArtifacts = allArtifacts.filter(art => art.Cate_Id == categoryId);
                        if (allArtifacts.length > 0) {
                            const categoryName = allArtifacts[0].Cate_Name || 'Category';
                            document.getElementById('categoryTitle').textContent = categoryName;
                            document.getElementById('categoryBreadcrumb').textContent = categoryName;
                        }
                    }
                    
                    filteredArtifacts = [...allArtifacts];
                    displayArtifacts();
                    updatePagination();
                    updateResultsCount();
                } else {
                    showEmptyState('No artifacts found', 'There are no artifacts available at the moment.');
                }
            } catch (error) {
                console.error('Error:', error);
                showEmptyState('Error Loading Artifacts', 'Please try again later.');
            }
        }

        function displayArtifacts() {
            const grid = document.getElementById('artifactsGrid');

            if (filteredArtifacts.length === 0) {
                showEmptyState('No Results', 'Try a different search term.');
                document.getElementById('paginationContainer').style.display = 'none';
                return;
            }

            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginatedArtifacts = filteredArtifacts.slice(startIndex, endIndex);

            grid.innerHTML = paginatedArtifacts.map((art, index) => {
                console.log('Artifact data:', art);
                
                const image = art.Img && art.Img.trim() !== '' 
                    ? UPLOAD_PATH + art.Img 
                    : 'https://via.placeholder.com/400x300/d4af37/ffffff?text=No+Image';
                
                const name = art.Name || art.Artifact_Name || art.name || 'Unnamed Artifact';
                
                const description = art.Short_Desc || art.Artifact_Description || art.description || 'No description available';
                
                const period = art.Art_Age || art.Artifact_Era || art.era || 'Unknown Period';

                return `
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="${(index % 3) * 100}">
                        <div class="artifact-card">
                            <div class="artifact-img-container">
                                <img src="${image}" 
                                     alt="${name}" 
                                     class="artifact-img"
                                     onerror="this.src='https://via.placeholder.com/400x300/d4af37/ffffff?text=No+Image'">
                                <span class="artifact-badge">${period}</span>
                            </div>
                            <div class="artifact-body">
                                <h3 class="artifact-title">${name}</h3>
                                <p class="artifact-desc">${description}</p>
                                <a href="artifact_details.php?id=${art.Art_Id}" class="btn-view">
                                    View Details <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');

            AOS.refresh();
        }

        function showEmptyState(title, message) {
            const grid = document.getElementById('artifactsGrid');
            grid.innerHTML = `
                <div class="col-12">
                    <div class="empty-state">
                        <i class="fas fa-search"></i>
                        <h3>${title}</h3>
                        <p>${message}</p>
                    </div>
                </div>
            `;
            document.getElementById('resultsCount').textContent = 'No artifacts found';
        }

        function updatePagination() {
            const totalPages = Math.ceil(filteredArtifacts.length / itemsPerPage);
            const container = document.getElementById('paginationContainer');

            if (totalPages <= 1) {
                container.style.display = 'none';
                return;
            }

            container.style.display = 'flex';
            container.innerHTML = '';

            const prevButton = document.createElement('div');
            prevButton.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
            prevButton.innerHTML = '<i class="fas fa-chevron-left"></i>';
            prevButton.onclick = () => {
                if (currentPage > 1) {
                    currentPage--;
                    displayArtifacts();
                    updatePagination();
                    updateResultsCount();
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            };
            container.appendChild(prevButton);

            for (let i = 1; i <= totalPages; i++) {
                const pageButton = document.createElement('div');
                pageButton.className = `page-item ${i === currentPage ? 'active' : ''}`;
                pageButton.textContent = i;
                pageButton.onclick = () => {
                    currentPage = i;
                    displayArtifacts();
                    updatePagination();
                    updateResultsCount();
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                };
                container.appendChild(pageButton);
            }

            const nextButton = document.createElement('div');
            nextButton.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
            nextButton.innerHTML = '<i class="fas fa-chevron-right"></i>';
            nextButton.onclick = () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    displayArtifacts();
                    updatePagination();
                    updateResultsCount();
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            };
            container.appendChild(nextButton);
        }

        function updateResultsCount() {
            const total = filteredArtifacts.length;
            const startIndex = (currentPage - 1) * itemsPerPage + 1;
            const endIndex = Math.min(currentPage * itemsPerPage, total);
            
            document.getElementById('resultsCount').textContent = 
                total === 0 ? 'No artifacts found' : `Showing ${startIndex}-${endIndex} of ${total} Artifacts`;
        }

        function applySearch() {
            const searchTerm = document.getElementById('searchBox').value.toLowerCase().trim();

            filteredArtifacts = allArtifacts.filter(art => {
                const name = art.Name || '';
                const description = art.Decrption || '';
                const shortDesc = art.Short_Desc || '';
                
                return !searchTerm || 
                    name.toLowerCase().includes(searchTerm) ||
                    description.toLowerCase().includes(searchTerm) ||
                    shortDesc.toLowerCase().includes(searchTerm);
            });

            currentPage = 1;
            displayArtifacts();
            updatePagination();
            updateResultsCount();
        }

        function sortArtifacts() {
            const sortValue = document.getElementById('sortSelect').value;

            switch(sortValue) {
                case 'name':
                    filteredArtifacts.sort((a, b) => {
                        const nameA = a.Name || '';
                        const nameB = b.Name || '';
                        return nameA.localeCompare(nameB);
                    });
                    break;
                case 'oldest':
                    filteredArtifacts.sort((a, b) => (a.Art_Id || 0) - (b.Art_Id || 0));
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

        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            navbar.classList.toggle('scrolled', window.scrollY > 50);

            const scrollTop = document.getElementById('scrollTop');
            scrollTop.classList.toggle('show', window.scrollY > 300);
        });

        document.getElementById('scrollTop').addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</body>
</html>