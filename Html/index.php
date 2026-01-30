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
    
    <link rel="stylesheet" href="../css/IndexStyle.css">
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
            
            <div class="row g-4" id="categoriesGrid">
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
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });

    let allCategories = [];

    const API_URL = '../Php/Category/ShowCategory.php';
    const UPLOAD_PATH = '../UploadsForCategory/';

    document.addEventListener('DOMContentLoaded', function () {
        loadCategories();
    });

    async function loadCategories() {
        const grid = document.getElementById('categoriesGrid');

        try {
            const response = await fetch(API_URL);
            const data = await response.json();

            console.log('API Response:', data);

            if (data.success && data.categories && data.categories.length > 0) {
                allCategories = data.categories;
                displayCategories(allCategories);
            } else {
                grid.innerHTML = `
                    <div class="col-12">
                        <div class="empty-state">
                            <h3>No Categories Found</h3>
                        </div>
                    </div>
                `;
            }
        } catch (error) {
            console.error('Error loading categories:', error);
            grid.innerHTML = `
                <div class="col-12">
                    <div class="empty-state">
                        <h3>Error Loading Categories</h3>
                    </div>
                </div>
            `;
        }
    }

    function displayCategories(categories) {
        const grid = document.getElementById('categoriesGrid');

        if (categories.length === 0) {
            grid.innerHTML = `
                <div class="col-12">
                    <div class="empty-state">
                        <h3>No Results Found</h3>
                    </div>
                </div>
            `;
            return;
        }

        grid.innerHTML = categories.map(category => {

            let imageHtml = '';

            if (category.Img && category.Img.trim() !== '') {
                imageHtml = `
                    <div class="card-img-wrapper">
                        <img src="${UPLOAD_PATH + category.Img}"
                            alt="${category.Cate_Name}">
                    </div>
                `;
            }

            return `
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="category-card">

                        ${imageHtml}

                        <div class="card-body">
                            <h3>${category.Cate_Name}</h3>
                            <p>${category.Cate_Description || ''}</p>

                            <a href="Home.php?category=${category.Cate_Id}" class="card-link">
                                View Artifacts
                            </a>
                        </div>
                    </div>
                </div>
            `;
        }).join('');
    }

    function searchCategories() {
        const searchTerm = document
            .getElementById('searchInput')
            .value
            .toLowerCase()
            .trim();

        if (searchTerm === '') {
            displayCategories(allCategories);
            return;
        }

        const filtered = allCategories.filter(category =>
            category.Cate_Name.toLowerCase().includes(searchTerm) ||
            (category.Cate_Description &&
             category.Cate_Description.toLowerCase().includes(searchTerm))
        );

        displayCategories(filtered);
    }

    window.addEventListener('scroll', function () {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }

        const scrollTop = document.getElementById('scrollTop');
        if (window.scrollY > 300) {
            scrollTop.classList.add('show');
        } else {
            scrollTop.classList.remove('show');
        }
    });

    document.getElementById('scrollTop').addEventListener('click', function () {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

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