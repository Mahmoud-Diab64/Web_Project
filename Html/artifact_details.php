<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artifact Details - Egyptian Heritage Explorer</title>
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
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: #fff;
            min-height: 100vh;
        }

        .navbar {
            background: rgba(26, 26, 46, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            box-shadow: 0 2px 20px rgba(0,0,0,0.3);
        }

        .navbar-brand {
            font-family: 'Cinzel', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #d4af37 !important;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-brand i {
            font-size: 1.8rem;
        }

        .nav-link {
            color: rgba(255,255,255,0.8) !important;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: all 0.3s;
        }

        .nav-link:hover {
            color: #d4af37 !important;
        }

        .btn-custom {
            background: linear-gradient(135deg, #d4af37 0%, #aa8a2e 100%);
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.4);
        }

        .details-section {
            padding: 4rem 0;
            min-height: calc(100vh - 200px);
        }

        .details-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        }

        .artifact-image-section {
            position: relative;
            height: 600px;
            overflow: hidden;
            background: #000;
        }

        .artifact-main-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.3s;
        }

        .artifact-main-image:hover {
            transform: scale(1.05);
        }

        .image-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #d4af37 0%, #aa8a2e 100%);
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }

        .artifact-info-section {
            padding: 3rem;
        }

        .artifact-category {
            display: inline-block;
            background: rgba(212, 175, 55, 0.2);
            color: #d4af37;
            padding: 0.3rem 1rem;
            border-radius: 15px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .artifact-title {
            font-family: 'Cinzel', serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: #d4af37;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .artifact-description {
            font-size: 1.1rem;
            line-height: 1.8;
            color: rgba(255,255,255,0.9);
            margin-bottom: 2rem;
            text-align: justify;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.05);
            padding: 1.5rem;
            border-radius: 15px;
            border: 1px solid rgba(212, 175, 55, 0.2);
            transition: all 0.3s;
        }

        .info-card:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.2);
        }

        .info-card-icon {
            font-size: 2rem;
            color: #d4af37;
            margin-bottom: 0.5rem;
        }

        .info-card-label {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.6);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }

        .info-card-value {
            font-size: 1.2rem;
            font-weight: 600;
            color: #fff;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            border: 1px solid rgba(212, 175, 55, 0.3);
        }

        .back-button:hover {
            background: rgba(212, 175, 55, 0.2);
            color: #d4af37;
            transform: translateX(-5px);
        }

        .loading-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 60vh;
            gap: 1rem;
        }

        .spinner {
            width: 60px;
            height: 60px;
            border: 4px solid rgba(212, 175, 55, 0.2);
            border-top-color: #d4af37;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .error-container {
            text-align: center;
            padding: 4rem 2rem;
        }

        .error-icon {
            font-size: 5rem;
            color: #e74c3c;
            margin-bottom: 1rem;
        }

        .error-title {
            font-size: 2rem;
            font-family: 'Cinzel', serif;
            margin-bottom: 1rem;
        }

        .error-message {
            font-size: 1.1rem;
            color: rgba(255,255,255,0.7);
            margin-bottom: 2rem;
        }

        footer {
            background: rgba(26, 26, 46, 0.95);
            padding: 2rem 0;
            text-align: center;
            margin-top: 4rem;
            border-top: 1px solid rgba(212, 175, 55, 0.2);
        }

        .scroll-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #d4af37 0%, #aa8a2e 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }

        .scroll-top.show {
            opacity: 1;
            visibility: visible;
        }

        .scroll-top:hover {
            transform: translateY(-5px);
        }

        @media (max-width: 768px) {
            .artifact-image-section {
                height: 400px;
            }

            .artifact-info-section {
                padding: 2rem 1.5rem;
            }

            .artifact-title {
                font-size: 1.8rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
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
                        <a class="nav-link" href="index.php">Categories</a>
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

    <section class="details-section">
        <div class="container">
            <div id="contentArea">
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
        AOS.init({
            duration: 1000,
            once: true
        });

        const API_URL = '../Php/Artifacts/get_artifact.php';
        const UPLOAD_PATH = '../UploadsForArtifacts/';

        const params = new URLSearchParams(window.location.search);
        const artifactId = params.get('id');

        document.addEventListener('DOMContentLoaded', function() {
            if (!artifactId) {
                showError('No Artifact Selected', 'Please select an artifact to view details.');
                return;
            }

            loadArtifact(artifactId);
        });

        async function loadArtifact(id) {
            const contentArea = document.getElementById('contentArea');
            
            contentArea.innerHTML = `
                <div class="loading-container">
                    <div class="spinner"></div>
                    <p style="font-size: 1.1rem; color: rgba(255,255,255,0.7);">Loading artifact details...</p>
                </div>
            `;

            try {
                const response = await fetch(`${API_URL}?id=${id}`);
                const data = await response.json();

                console.log('Artifact Response:', data);

                if (data.success && data.artifact) {
                    displayArtifact(data.artifact);
                } else {
                    showError('Artifact Not Found', data.message || 'The requested artifact could not be found.');
                }
            } catch (error) {
                console.error('Error loading artifact:', error);
                showError('Error Loading Artifact', 'An error occurred while loading the artifact. Please try again later.');
            }
        }

        function displayArtifact(artifact) {
            const contentArea = document.getElementById('contentArea');
            
            const imageUrl = artifact.Img && artifact.Img.trim() !== '' 
                ? UPLOAD_PATH + artifact.Img 
                : 'https://via.placeholder.com/800x600?text=No+Image';

            const category = artifact.Cate_Name || 'Unknown Category';
            const period = artifact.Art_Age || 'Unknown Period';
            const location = artifact.Site || 'Unknown Location';
            const discoveryDate = artifact.FoundAt || 'Unknown';
            const material = artifact.Material || 'Unknown';
            const dimensions = artifact.Dimensions || 'Not specified';
            const description = artifact.Descrption || 'No description available for this artifact.';

            contentArea.innerHTML = `
                <a href="javascript:history.back()" class="back-button mb-4" data-aos="fade-right">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Artifacts</span>
                </a>

                <div class="details-container" data-aos="fade-up">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="artifact-image-section">
                                <img src="${imageUrl}" 
                                     alt="${artifact.Name}" 
                                     class="artifact-main-image"
                                     onerror="this.src='https://via.placeholder.com/800x600?text=No+Image'">
                                <span class="image-badge">${period}</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="artifact-info-section">
                                <span class="artifact-category">
                                    <i class="fas fa-tag"></i> ${category}
                                </span>
                                
                                <h1 class="artifact-title">${artifact.Name}</h1>
                                
                                <p class="artifact-description">${artifact.Descrption}</p>

                                <div class="info-grid">
                                    <div class="info-card" data-aos="fade-up" data-aos-delay="100">
                                        <div class="info-card-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="info-card-label">Location</div>
                                        <div class="info-card-value">${location}</div>
                                    </div>

                                    <div class="info-card" data-aos="fade-up" data-aos-delay="200">
                                        <div class="info-card-icon">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                        <div class="info-card-label">Discovery Date</div>
                                        <div class="info-card-value">${discoveryDate}</div>
                                    </div>

                                    <div class="info-card" data-aos="fade-up" data-aos-delay="300">
                                        <div class="info-card-icon">
                                            <i class="fas fa-gem"></i>
                                        </div>
                                        <div class="info-card-label">Material</div>
                                        <div class="info-card-value">${material}</div>
                                    </div>

                                    <div class="info-card" data-aos="fade-up" data-aos-delay="400">
                                        <div class="info-card-icon">
                                            <i class="fas fa-ruler-combined"></i>
                                        </div>
                                        <div class="info-card-label">Dimensions</div>
                                        <div class="info-card-value">${dimensions}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            AOS.refresh();
        }

        function showError(title, message) {
            const contentArea = document.getElementById('contentArea');
            contentArea.innerHTML = `
                <div class="error-container" data-aos="fade-up">
                    <div class="error-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h2 class="error-title">${title}</h2>
                    <p class="error-message">${message}</p>
                    <a href="javascript:history.back()" class="back-button">
                        <i class="fas fa-arrow-left"></i>
                        <span>Go Back</span>
                    </a>
                </div>
            `;
        }

        window.addEventListener('scroll', function() {
            const scrollTop = document.getElementById('scrollTop');
            if (window.scrollY > 300) {
                scrollTop.classList.add('show');
            } else {
                scrollTop.classList.remove('show');
            }
        });

        document.getElementById('scrollTop').addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</body>
</html>