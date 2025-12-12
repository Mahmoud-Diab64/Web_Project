<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artifacts - Egyptian Heritage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Lato:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/Showart.css">
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
        <li class="nav-item"><a href="DashBoard.php" class="nav-link"><i class="fas fa-chart-line"></i><span>Dashboard</span></a></li>
        <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-users"></i><span>Manage Users</span></a></li>
        <li class="nav-item"><a href="Show_art.php" class="nav-link active"><i class="fas fa-monument"></i><span>Manage Artifacts</span></a></li>
        <li class="nav-item"><a href="Show_Catigries.php" class="nav-link"><i class="fas fa-th-large"></i><span>Manage Categories</span></a></li>
        <li class="nav-item"><a href="Location.php" class="nav-link"><i class="fas fa-map-marker-alt"></i><span>Manage Locations</span></a></li>
        <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-cog"></i><span>Settings</span></a></li>
    </ul>
    <button class="logout-btn" onclick="logout()"><i class="fas fa-sign-out-alt"></i><span>Logout</span></button>
</aside>

<button class="mobile-menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>

<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <h1><i class="fas fa-monument me-3"></i>Artifacts</h1>
            <p>Explore all Egyptian heritage artifacts</p>
        </div>

        <div class="controls">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search artifacts...">
                <i class="fas fa-search"></i>
            </div>
            <a href="Add_Artifacts.php" class="btn-add"><i class="fas fa-plus-circle"></i>Add New Artifact</a>
        </div>

        <div id="artifactsContainer">
            <div class="loading">
                <div class="spinner"></div>
                <p class="text-muted">Loading artifacts...</p>
            </div>
        </div>
    </div>
</div>

<script>
    // Mobile menu toggle
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    if (menuToggle) menuToggle.addEventListener('click', () => sidebar.classList.toggle('active'));

    function logout() {
        if (confirm('Are you sure you want to logout?')) window.location.href = 'login.php';
    }

    const API_URL = '../Php/Artifacts/ShowArtifacts.php';
    const UPLOAD_PATH = '../UploadsForArtifacts/';

    let allArtifacts = [];

    window.addEventListener('DOMContentLoaded', loadArtifacts);

    document.getElementById('searchInput').addEventListener('input', (e) => {
        const term = e.target.value.toLowerCase();
        const filtered = allArtifacts.filter(a => a.Name.toLowerCase().includes(term));
        displayArtifacts(filtered);
    });

    async function loadArtifacts() {
        try {
            const response = await fetch(API_URL);
            const data = await response.json();

            if(data.success && data.artifacts){
                allArtifacts = data.artifacts;
                displayArtifacts(allArtifacts);
            } else {
                showNoData();
            }
        } catch(err){
            console.error(err);
            showError();
        }
    }

    function displayArtifacts(artifacts){
        const container = document.getElementById('artifactsContainer');

        if(artifacts.length === 0){
            showNoData();
            return;
        }

        const html = `
        <div class="artifacts-grid">
            ${artifacts.map(a => `
            <div class="artifact-card">
                <img src="${UPLOAD_PATH}${a.Img}" 
                     alt="${a.Name}" 
                     class="artifact-image"
                     onerror="this.src='https://via.placeholder.com/280x220/667eea/ffffff?text=${encodeURIComponent(a.Name)}'">
                <div class="artifact-body">
                    <h3 class="artifact-name">${a.Name}</h3>
                    <p><strong>Category:</strong> ${a.Cate_Name}</p>
                    <p><strong>Location:</strong> ${a.Loc_Name}</p>
                    <p><strong>Description:</strong> ${a.Decrption}</p>
                    <p><strong>Short Desc:</strong> ${a.Short_Desc}</p>
                    <p><strong>Found At:</strong> ${a.FoundAt}</p>
                    <p><strong>Age:</strong> ${a.Art_Age} years</p>
                    <div class="artifact-actions">
                        <button class="btn-action btn-edit" onclick="editArtifact(${a.Art_Id})"><i class="fas fa-edit"></i> Edit</button>
                        <button class="btn-action btn-delete" onclick="deleteArtifact(${a.Art_Id}, '${a.Name}')"><i class="fas fa-trash"></i> Delete</button>
                    </div>
                </div>
            </div>`).join('')}
        </div>
        `;
        container.innerHTML = html;
    }

    function showNoData() {
        document.getElementById('artifactsContainer').innerHTML = `
            <div class="no-data">
                <i class="fas fa-inbox"></i>
                <h3>No Artifacts Found</h3>
                <p class="text-muted">Start by adding your first artifact</p>
            </div>
        `;
    }

    function showError() {
        document.getElementById('artifactsContainer').innerHTML = `
            <div class="no-data">
                <i class="fas fa-exclamation-triangle text-danger"></i>
                <h3>Error Loading Artifacts</h3>
                <p class="text-muted">Please try again later</p>
            </div>
        `;
    }

    function editArtifact(id){
        window.location.href = `Update_Artifacts.php?id=${id}`;
    }

    async function deleteArtifact(id, name){
        // if(!confirm(`Are you sure you want to delete "${name}"?`)) return;

        // try {
        //     const formData = new FormData();
        //     formData.append('Art_Id', id);

        //     const response = await fetch('../Php/Artifacts/delete_artifact.php', {
        //         method: 'POST',
        //         body: formData
        //     });

        //     const data = await response.json();
        //     if(data.success){
        //         alert('Artifact deleted successfully!');
        //         loadArtifacts();
        //     } else {
        //         alert('Error: ' + data.message);
        //     }
        // } catch(err){
        //     alert('Error deleting artifact');
        //     console.error(err);
        // }
        window.location.href = `Delete_Artifacts.php?id=${id}`;
    }
</script>
</body>
</html>
