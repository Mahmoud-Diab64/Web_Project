<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Egyptian Heritage Explorer</title>
    
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
            overflow-x: hidden;
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

        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 8rem 0 6rem;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.1;
            background-image: 
                repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(255,255,255,.1) 35px, rgba(255,255,255,.1) 70px);
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-content h1 {
            font-family: 'Cinzel', serif;
            font-size: 3.5rem;
            font-weight: 900;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero-content p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.95;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-outline-light {
            border: 2px solid white;
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-light:hover {
            background: white;
            color: #667eea;
        }

        .categories-section {
            padding: 5rem 0;
            background: #f8f9fa;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-title h2 {
            font-family: 'Cinzel', serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 1rem;
        }

        .section-title p {
            font-size: 1.1rem;
            color: #718096;
        }

        .search-container {
            max-width: 600px;
            margin: 0 auto 3rem;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 1rem 1.5rem 1rem 3.5rem;
            border: 2px solid #e2e8f0;
            border-radius: 50px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .search-box i {
            position: absolute;
            left: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            color: #718096;
            font-size: 1.1rem;
        }

        .category-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .card-img-wrapper {
            position: relative;
            height: 250px;
            overflow: hidden;
        }

        .card-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .category-card:hover .card-img-wrapper img {
            transform: scale(1.1);
        }

        .card-img-overlay-icon {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255,255,255,0.9);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #667eea;
        }

        .artifact-badge {
            position: absolute;
            bottom: 1rem;
            left: 1rem;
            background: rgba(102, 126, 234, 0.95);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .card-body {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .card-body h3 {
            font-family: 'Cinzel', serif;
            font-size: 1.4rem;
            color: #2d3748;
            margin-bottom: 1rem;
        }

        .card-body p {
            color: #718096;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            flex: 1;
        }

        .card-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: gap 0.3s ease;
        }

        .card-link:hover {
            gap: 1rem;
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

        .loading-spinner {
            text-align: center;
            padding: 4rem 2rem;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
            color: #667eea;
        }

        footer {
            background: linear-gradient(135deg, #1a3a52 0%, #0f2537 100%);
            color: white;
            padding: 3rem 0 1rem;
        }

        .footer-title {
            font-family: 'Cinzel', serif;
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            color: #d4af37;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: #d4af37;
        }

        .social-icons {
            display: flex;
            gap: 1rem;
        }

        .social-icons a {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            background: #d4af37;
            transform: translateY(-3px);
        }

        .copyright {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.7);
        }

        .scroll-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 50px;
            height: 50px;
            background: #667eea;
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
            background: #764ba2;
            transform: translateY(-5px);
        }

        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }
            
            .hero-content p {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-landmark"></i>
                <span>Egyptian Heritage Explorer</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="Home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#categories">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about-us">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
                <button class="btn btn-custom"><a href="login.php" style="color: white; text-decoration: none;">Login</a></button>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="hero-pattern"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
                        <h1>Unearth the Stories of the Nile</h1>
                        <p>A unified digital guide to explore Egypt's Pharaonic, Roman, Islamic, Coptic, and modern heritage</p>
                        <div class="hero-buttons">
                            <a href="#categories" class="btn btn-custom">Explore Categories</a>
                            <a href="#about-us" class="btn btn-outline-light">About Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="categories-section" id="categories">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Eras of Civilization</h2>
                <p>Select a historical period to begin your journey</p>
            </div>
            
            <!-- Search Box -->
            <div class="search-container" data-aos="fade-up">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input 
                        type="text" 
                        id="searchInput" 
                        placeholder="Search categories..." 
                        onkeyup="searchCategories()"
                    >
                </div>
            </div>
            
            <!-- Categories Grid -->
            <div class="row g-4" id="categoriesGrid">
                <!-- Loading State -->
                <div class="col-12">
                    <div class="loading-spinner">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-3 text-muted">Loading categories...</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about-us" class="about-section">
        <footer>
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6" data-aos="fade-up">
                        <h4 class="footer-title">Egyptian Heritage Explorer</h4>
                        <p style="opacity: 0.8; line-height: 1.8;">
                            Preserving history for future generations through a unified and sophisticated digital experience
                        </p>
                    </div>
                    
                    <div class="col-lg-2 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <h4 class="footer-title">Explore</h4>
                        <ul class="footer-links">
                            <li><a href="#">Pharaonic</a></li>
                            <li><a href="#">Islamic</a></li>
                            <li><a href="#">Coptic</a></li>
                            <li><a href="#">Modern</a></li>
                        </ul>
                    </div>
                    
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <h4 class="footer-title">Connect</h4>
                        <ul class="footer-links">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Contact Team</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                        </ul>
                    </div>
                    
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <h4 class="footer-title">Follow Us</h4>
                        <div class="social-icons">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="copyright">
                    &copy; 2025 Egyptian Heritage Explorer. All Rights Reserved.
                </div>
            </div>
        </footer>
    </section>

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

        // Store categories globally for search
        let allCategories = []

        // API Configuration
        const API_URL = '../Php/Category/ShowCategory.php';
        const UPLOAD_PATH = '../UploadsForCategory/';

        // Category icons mapping
        const categoryIcons = {
            'pharaonic': 'fa-monument',
            'roman': 'fa-columns',
            'islamic': 'fa-mosque',
            'coptic': 'fa-cross',
            'modern': 'fa-city',
            'museum': 'fa-university',
            'default': 'fa-landmark'
        };

        // Category images (default fallbacks)
        const categoryImages = [
            'https://images.unsplash.com/photo-1503177119275-0aa32b3a9368?q=80&w=800',
            'https://images.unsplash.com/photo-1565594101833-286ae6163351?q=80&w=800',
            'https://images.unsplash.com/photo-1553913861-c0fddf26bc71?q=80&w=800',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR616L_yM-4eICl3P66r4yK5yQYwV3Cg7C3hA&s',
            'https://images.unsplash.com/photo-1572252009286-268acec5ca0a?q=80&w=800',
            'https://images.unsplash.com/photo-1590423021966-234237748873?q=80&w=800'
        ];

        // Load categories when page loads
        document.addEventListener('DOMContentLoaded', function() {
            loadCategories();
        });

        // Load Categories from API
        async function loadCategories() {
            const grid = document.getElementById('categoriesGrid');
            
            try {
                const response = await fetch(API_URL);
                const data = await response.json();
                
                console.log('API Response:', data); // For debugging
                
                if (data.success && data.categories && data.categories.length > 0) {
                    allCategories = data.categories;
                    displayCategories(allCategories);
                } else {
                    grid.innerHTML = `
                        <div class="col-12">
                            <div class="empty-state">
                                <i class="fas fa-folder-open"></i>
                                <h3>No Categories Found</h3>
                                <p>Check back later for new categories</p>
                            </div>
                        </div>
                    `;
                }
            } catch (error) {
                console.error('Error loading categories:', error);
                grid.innerHTML = `
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="fas fa-exclamation-triangle"></i>
                            <h3>Error Loading Categories</h3>
                            <p>Please try again later</p>
                        </div>
                    </div>
                `;
            }
        }

        // Display Categories
        function displayCategories(categories) {
            const grid = document.getElementById('categoriesGrid');
            
            if (categories.length === 0) {
                grid.innerHTML = `
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="fas fa-search"></i>
                            <h3>No Results Found</h3>
                            <p>Try a different search term</p>
                        </div>
                    </div>
                `;
                return;
            }
            
            grid.innerHTML = categories.map((category, index) => {
                const icon = getIconForCategory(category.Cate_Name);
                
                // Use image from database (Img column), fallback to default
                let image;
                if (category.Img && category.Img.trim() !== '') {
                    image = UPLOAD_PATH + category.Img;
                } else {
                    image = categoryImages[index % categoryImages.length];
                }
                
                const artifactCount = category.artifact_count || 0;
                
                return `
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="${(index % 3) * 100}">
                        <div class="category-card" data-category="${category.Cate_Name.toLowerCase()}">
                            <div class="card-img-wrapper">
                                <img src="${image}" 
                                     alt="${category.Cate_Name}" 
                                     onerror="this.onerror=null; this.src='${categoryImages[index % categoryImages.length]}';">
                                <div class="card-img-overlay-icon">
                                    <i class="fas ${icon}"></i>
                                </div>
                                <div class="artifact-badge">
                                    ${artifactCount} Artifacts
                                </div>
                            </div>
                            <div class="card-body">
                                <h3>${category.Cate_Name}</h3>
                                <p>${category.Cate_Description || 'Explore this fascinating period of Egyptian history'}</p>
                                <a href="artifacts.php?category=${category.Cate_Id}" class="card-link">
                                    View Artifacts <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        // Get icon for category
        function getIconForCategory(categoryName) {
            const name = categoryName.toLowerCase();
            
            for (const [key, icon] of Object.entries(categoryIcons)) {
                if (name.includes(key)) {
                    return icon;
                }
            }
            
            return categoryIcons.default;
        }

        // Search Categories
        function searchCategories() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase().trim();
            
            if (searchTerm === '') {
                displayCategories(allCategories);
                return;
            }
            
            const filtered = allCategories.filter(category => 
                category.Cate_Name.toLowerCase().includes(searchTerm) ||
                (category.Cate_Description && category.Cate_Description.toLowerCase().includes(searchTerm))
            );
            
            displayCategories(filtered);
        }
        
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
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#' && document.querySelector(href)) {
                    e.preventDefault();
                    document.querySelector(href).scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html>