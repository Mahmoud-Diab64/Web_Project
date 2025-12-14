<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category - Egyptian Heritage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Lato:wght@400;600&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="../css/Edit_Catigory.css">
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <div class="icon">
                <i class="fas fa-edit"></i>
            </div>
            <h2>Edit Category</h2>
            <p>Update category information</p>
        </div>

        <div id="loadingState" class="loading-state">
            <div class="spinner"></div>
            <p class="text-muted">Loading category data...</p>
        </div>

        <div id="formContent" style="display: none;">
            <form id="editForm" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="cate_id" id="cateId">
                <input type="hidden" name="old_img" id="oldImg">

                <div class="current-image" id="currentImageDiv">
                    <p class="fw-bold mb-2">Current Image:</p>
                    <img id="currentImage" src="" alt="Current Category Image">
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="fas fa-tag"></i>
                        Category Name <span class="required">*</span>
                    </label>
                    <input type="text" 
                           class="form-control" 
                           name="Name" 
                           id="cateName"
                           placeholder="e.g. Pharaonic Statues" 
                           required>
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="fas fa-image"></i>
                        Change Image (Optional)
                    </label>
                    
                    <div class="upload-area" id="uploadArea">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p><strong>Click to upload</strong> or drag and drop</p>
                        <p class="small text-muted">PNG, JPG up to 5MB</p>
                        <div class="file-name" id="fileName"></div>
                    </div>
                    
                    <input type="file" 
                           class="d-none" 
                           id="fileInput" 
                           name="Img" 
                           accept="image/*">
                    
                    <div class="image-preview" id="imagePreview">
                        <img id="previewImg" src="" alt="Preview">
                    </div>
                </div>

                <button type="submit" name="submit" class="btn-submit">
                    <i class="fas fa-save"></i>
                    Update Category
                </button>
            </form>
        </div>

        <div class="back-link">
            <a href="Show_Catigries.php#">
                <i class="fas fa-arrow-left"></i> Back to Categories
            </a>
        </div>
    </div>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const categoryId = urlParams.get('id');

        if (!categoryId) {
            alert('No category ID provided!');
            window.location.href = 'Show_Catigries.php#';
        }

       
        window.addEventListener('DOMContentLoaded', loadCategoryData);

        async function loadCategoryData() {
            try {
                const response = await fetch(`../Php/Category/GetCategoryById.php?id=${categoryId}`);
                const data = await response.json();

                if (data.success && data.category) {
                    const cat = data.category;
                    
                    
                    document.getElementById('cateId').value = cat.Cate_Id;
                    document.getElementById('cateName').value = cat.Cate_Name;
                    document.getElementById('oldImg').value = cat.Img;
                    
           
                    document.getElementById('currentImage').src = `../UploadsForCategory/${cat.Img}`;
                    
         
                    document.getElementById('loadingState').style.display = 'none';
                    document.getElementById('formContent').style.display = 'block';
                } else {
                    alert('Category not found!');
                    window.location.href = 'Show_Catigries.php#';
                }
            } catch (error) {
                console.error('Error loading category:', error);
                alert('Error loading category data');
                window.location.href = 'Show_Catigries.php#';
            }
        }

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

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('dragover');
        });

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

        document.getElementById('editForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const formData = new FormData(e.target);
            
            try {
                const response = await fetch('../Php/Category/UpdateCatigory.php', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    alert('Category updated successfully! ✅');
                    window.location.href = 'Show_Catigries.php#';
                } else {
                    alert('Error: ' + data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error updating category');
            }
        });
    </script>
</body>
</html>