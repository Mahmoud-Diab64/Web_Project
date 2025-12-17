<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Artifact - Egyptian Heritage</title>

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

    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success" role="alert">
            <i class="fas fa-check-circle"></i> <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger" role="alert">
            <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <form action="../Php/Artifacts/artifacts.php" method="POST" enctype="multipart/form-data" id="artifactForm">

        <div class="mb-4">
            <label class="form-label"><i class="fas fa-tag"></i> Artifact Name <span class="required">*</span></label>
            <input type="text" class="form-control" name="Name" placeholder="Enter artifact name" required minlength="2" maxlength="30">
        </div>

        <div class="mb-4">
            <label class="form-label"><i class="fas fa-layer-group"></i> Category <span class="required">*</span></label>
            <select name="Cate_Id" id="category" class="form-control" required>
                <option value="">Loading...</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="form-label"><i class="fas fa-map-marker-alt"></i> Location <span class="required">*</span></label>
            <select name="Loc_Id" id="location" class="form-control" required>
                <option value="">Loading...</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="form-label"><i class="fas fa-align-left"></i> Description</label>
            <textarea class="form-control" name="desc" rows="4" placeholder="Enter detailed description (max 2000 characters)" maxlength="2000"></textarea>
            <small class="text-muted">Characters: <span id="descCount">0</span>/2000</small>
        </div>

        <div class="mb-4">
            <label class="form-label"><i class="fas fa-quote-left"></i> Short Description</label>
            <input type="text" class="form-control" name="Short_Desc" placeholder="Brief description (max 100 characters)" maxlength="100">
            <small class="text-muted">Characters: <span id="shortDescCount">0</span>/100</small>
        </div>

        <div class="mb-4">
            <label class="form-label"><i class="fas fa-map"></i> Found At</label>
            <input type="text" class="form-control" name="FoundAt" placeholder="e.g., Valley of the Kings">
        </div>

        <div class="mb-4">
            <label class="form-label"><i class="fas fa-hourglass-half"></i> Artifact Age (years)</label>
            <input type="number" class="form-control" name="Art_Age" placeholder="e.g., 3000" min="0" max="10000">
        </div>

        <div class="mb-4">
            <label class="form-label"><i class="fas fa-image"></i> Artifact Image <span class="required">*</span></label>
            <div class="upload-area" id="uploadArea">
                <i class="fas fa-cloud-upload-alt"></i>
                <p><strong>Click to upload</strong> or drag & drop</p>
                <p class="small text-muted">PNG, JPG, GIF (max 5MB)</p>
                <div class="file-name" id="fileName"></div>
            </div>
            <input type="file" class="d-none" id="fileInput" name="Img" accept="image/jpeg,image/jpg,image/png,image/gif" required>
            <div class="image-preview" id="imagePreview">
                <img id="previewImg" src="" alt="Preview">
                <button type="button" class="btn-remove-image" id="removeImage" style="display:none;">
                    <i class="fas fa-times"></i> Remove
                </button>
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
fetch("../Php/Category/ShowCategory.php")
    .then(res => res.json())
    .then(data => {
        const cat = document.getElementById("category");
        cat.innerHTML = '<option value="">-- Select Category --</option>';
        if(data.success && data.categories) {
            data.categories.forEach(c => {
                cat.innerHTML += `<option value="${c.Cate_Id}">${c.Cate_Name} (${c.artifact_count || 0} artifacts)</option>`;
            });
        }
    })
    .catch(err => {
        console.error('Error loading categories:', err);
        document.getElementById("category").innerHTML = '<option value="">Error loading categories</option>';
    });

fetch("../Php/Location/get_all_Locations.php")
    .then(res => res.json())
    .then(data => {
        const loc = document.getElementById("location");
        loc.innerHTML = '<option value="">-- Select Location --</option>';
        if(data.success && data.data){
            data.data.forEach(l => {
                loc.innerHTML += `<option value="${l.id}">${l.site}</option>`;
            });
        }
    })
    .catch(err => {
        console.error('Error loading locations:', err);
        document.getElementById("location").innerHTML = '<option value="">Error loading locations</option>';
    });

document.querySelector('textarea[name="desc"]').addEventListener('input', function() {
    document.getElementById('descCount').textContent = this.value.length;
});

document.querySelector('input[name="Short_Desc"]').addEventListener('input', function() {
    document.getElementById('shortDescCount').textContent = this.value.length;
});


const uploadArea = document.getElementById('uploadArea');
const fileInput = document.getElementById('fileInput');
const fileName = document.getElementById('fileName');
const imagePreview = document.getElementById('imagePreview');
const previewImg = document.getElementById('previewImg');
const removeImage = document.getElementById('removeImage');

uploadArea.addEventListener('click', () => fileInput.click());
fileInput.addEventListener('change', handleFile);
removeImage.addEventListener('click', clearImage);

uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadArea.classList.add('dragover');
});

uploadArea.addEventListener('dragleave', () => {
    uploadArea.classList.remove('dragover');
});

uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.classList.remove('dragover');

    const file = e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        fileInput.files = dataTransfer.files;
        handleFile();
    } else {
        alert('Please drop an image file!');
    }
});

function handleFile() {
    const file = fileInput.files[0];
    if (file) {
        if(file.size > 5 * 1024 * 1024) {
            alert('Image size must be less than 5MB!');
            clearImage();
            return;
        }

        fileName.textContent = file.name;
        fileName.style.display = 'block';
        
        const reader = new FileReader();
        reader.onload = (e) => {
            previewImg.src = e.target.result;
            imagePreview.style.display = 'block';
            removeImage.style.display = 'inline-block';
        };
        reader.readAsDataURL(file);
    }
}

function clearImage() {
    fileInput.value = '';
    fileName.textContent = '';
    fileName.style.display = 'none';
    previewImg.src = '';
    imagePreview.style.display = 'none';
    removeImage.style.display = 'none';
}

document.getElementById('artifactForm').addEventListener('submit', function(e) {
    const category = document.getElementById('category').value;
    const location = document.getElementById('location').value;
    
    if(!category || category === '') {
        e.preventDefault();
        alert('Please select a category!');
        return false;
    }
    
    if(!location || location === '') {
        e.preventDefault();
        alert('Please select a location!');
        return false;
    }
    
    if(!fileInput.files || fileInput.files.length === 0) {
        e.preventDefault();
        alert('Please select an image!');
        return false;
    }
    
    return true;
});
</script>

<style>
.btn-remove-image {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(239, 68, 68, 0.9);
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    cursor: pointer;
    font-size: 0.9rem;
    transition: all 0.3s;
}

.btn-remove-image:hover {
    background: rgba(220, 38, 38, 1);
}

.image-preview {
    position: relative;
}

.alert {
    margin-bottom: 1.5rem;
    padding: 1rem;
    border-radius: 10px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.alert-success {
    background: rgba(16, 185, 129, 0.1);
    color: #059669;
    border-left: 4px solid #10b981;
}

.alert-danger {
    background: rgba(239, 68, 68, 0.1);
    color: #dc2626;
    border-left: 4px solid #ef4444;
}
</style>

</body>
</html>