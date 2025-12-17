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
    <link rel="stylesheet" href="../css/art_detail.css">
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
            const location = artifact.Loc_Name || 'Unknown Location';
            const discoveryDate = artifact.FoundAt || 'Unknown';
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