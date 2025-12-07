<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category - Egyptian Heritage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Lato:wght@400;600&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="../css/Add_Category.css">
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <div class="icon">
                <i class="fas fa-layer-group"></i>
            </div>
            <h2>Add New Category</h2>
            <p>Create a new heritage category</p>
        </div>

        <form action="../Php/Category/category.php" method="POST" enctype="multipart/form-data">
            <!-- Category Name -->
            <div class="mb-4">
                <label class="form-label">
                    <i class="fas fa-tag"></i>
                    Category Name <span class="required">*</span>
                </label>
                <input type="text" 
                       class="form-control" 
                       name="Name" 
                       placeholder="e.g. Pharaonic Statues" 
                       required>
            </div>

            <!-- Image Upload -->
            <div class="mb-4">
                <label class="form-label">
                    <i class="fas fa-image"></i>
                    Category Image <span class="required">*</span>
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
                       accept="image/*" 
                       required>
                
                <div class="image-preview" id="imagePreview">
                    <img id="previewImg" src="" alt="Preview">
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" name="submit" class="btn-submit">
                <i class="fas fa-plus-circle"></i>
                Add Category
            </button>
        </form>

        <div class="back-link">
            <a href="Show_Catigries.php#">
                <i class="fas fa-arrow-left"></i> Back to Categories
            </a>
        </div>
    </div>

    <script>
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('fileInput');
        const fileName = document.getElementById('fileName');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');

        // Click to upload
        uploadArea.addEventListener('click', () => fileInput.click());

        // File input change
        fileInput.addEventListener('change', handleFile);

        // Drag and drop
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
                // Show file name
                fileName.textContent = file.name;
                fileName.style.display = 'block';

                // Show preview
                const reader = new FileReader();
                reader.onload = (e) => {
                    previewImg.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }

        // Form validation
        document.querySelector('form').addEventListener('submit', (e) => {
            const nameInput = document.querySelector('input[name="Name"]');
            const fileInput = document.getElementById('fileInput');

            if (!nameInput.value.trim()) {
                e.preventDefault();
                alert('Please enter category name');
                nameInput.focus();
                return;
            }

            if (!fileInput.files.length) {
                e.preventDefault();
                alert('Please select an image');
                return;
            }

            // Check file size (5MB)
            if (fileInput.files[0].size > 5 * 1024 * 1024) {
                e.preventDefault();
                alert('Image size should be less than 5MB');
                return;
            }
        });
    </script>
</body>
</html>