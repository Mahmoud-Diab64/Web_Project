<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Artifact - Egyptian Heritage</title>

    <!-- Bootstrap & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Lato:wght@400;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../css/Add_Category.css">
</head>
<body>

<div class="form-container">
    <div class="form-header">
        <div class="icon">
            <i class="fas fa-ankh"></i>
        </div>
        <h2>Add New Artifact</h2>
        <p>Insert a new historical artifact</p>
    </div>

    <form action="../Php/Artifacts/artifacts.php" method="POST" enctype="multipart/form-data">

        <!-- Artifact Name -->
        <div class="mb-4">
            <label class="form-label"><i class="fas fa-tag"></i> Artifact Name <span class="required">*</span></label>
            <input type="text" class="form-control" name="Name" placeholder="Artifact Name" required>
        </div>

        <!-- Category Dropdown -->
        <div class="mb-4">
            <label class="form-label"><i class="fas fa-layer-group"></i> Category <span class="required">*</span></label>
            <select name="Cate_Id" id="category" class="form-control" required>
                <option>Loading...</option>
            </select>
        </div>

        <!-- Location Dropdown -->
        <div class="mb-4">
            <label class="form-label"><i class="fas fa-map-marker-alt"></i> Location <span class="required">*</span></label>
            <select name="Loc_Id" id="location" class="form-control" required>
                <option>Loading...</option>
            </select>
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label class="form-label"><i class="fas fa-align-left"></i> Description</label>
            <textarea class="form-control" name="Decrption" rows="3"></textarea>
        </div>

        <!-- Short Description -->
        <div class="mb-4">
            <label class="form-label"><i class="fas fa-quote-left"></i> Short Description</label>
            <input type="text" class="form-control" name="Short_Desc">
        </div>

        <!-- Found At -->
        <div class="mb-4">
            <label class="form-label"><i class="fas fa-map"></i> Found At</label>
            <input type="text" class="form-control" name="FoundAt">
        </div>

        <!-- Artifact Age -->
        <div class="mb-4">
            <label class="form-label"><i class="fas fa-hourglass-half"></i> Artifact Age</label>
            <input type="text" class="form-control" name="Art_Age">
        </div>

        <!-- Image Upload -->
        <div class="mb-4">
            <label class="form-label"><i class="fas fa-image"></i> Artifact Image <span class="required">*</span></label>
            <div class="upload-area" id="uploadArea">
                <i class="fas fa-cloud-upload-alt"></i>
                <p><strong>Click to upload</strong> or drag & drop</p>
                <p class="small text-muted">PNG, JPG up to 5MB</p>
                <div class="file-name" id="fileName"></div>
            </div>
            <input type="file" class="d-none" id="fileInput" name="Img" accept="image/*" required>
            <div class="image-preview" id="imagePreview">
                <img id="previewImg" src="" alt="Preview">
            </div>
        </div>

        <button type="submit" name="submit" class="btn-submit">
            <i class="fas fa-plus-circle"></i> Add Artifact
        </button>
    </form>

    <div class="back-link">
        <a href="Show_art.php">
            <i class="fas fa-arrow-left"></i> Back to Artifacts
        </a>
    </div>
</div>

<script>
// Fetch Categories & Locations
fetch("../Php/Category/ShowCategory.php")
    .then(res => res.json())
    .then(data => {
        const cat = document.getElementById("category");
        cat.innerHTML = '<option value="">Select Category</option>';
        data.categories.forEach(c => {
            cat.innerHTML += `<option value="${c.Cate_Id}">${c.Cate_Name} (${c.artifact_count})</option>`;
        });
    });

fetch("../Php/Location/get_all_Locations.php")
    .then(res => res.json())
    .then(data => {
        const loc = document.getElementById("location");
        loc.innerHTML = '<option value="">Select Location</option>';

        if(data.success && data.data){
            data.data.forEach(l => {
                loc.innerHTML += `<option value="${l.id}">${l.site}</option>`;
            });
        }
    });

// Image Upload Preview
const uploadArea = document.getElementById('uploadArea');
const fileInput = document.getElementById('fileInput');
const fileName = document.getElementById('fileName');
const imagePreview = document.getElementById('imagePreview');
const previewImg = document.getElementById('previewImg');

uploadArea.addEventListener('click', () => fileInput.click());
fileInput.addEventListener('change', handleFile);

uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadArea.classList.add('dragover');
});
uploadArea.addEventListener('dragleave', () => uploadArea.classList.remove('dragover'));
uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.classList.remove('dragover');

    const file = e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
        fileInput.files = e.dataTransfer.files;
        handleFile();
    }
});

function handleFile() {
    const file = fileInput.files[0];
    if (file) {
        fileName.textContent = file.name;
        fileName.style.display = 'block';
        const reader = new FileReader();
        reader.onload = (e) => {
            previewImg.src = e.target.result;
            imagePreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}
</script>

</body>
</html>
