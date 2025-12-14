<?php
$artId = isset($_GET['id']) ? $_GET['id'] : null;

if (!$artId) {
    echo "<script>alert('No artifact selected'); window.location='Show_Artifacts.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Artifact - Egyptian Heritage</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Lato:wght@400;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../css/Add_Category.css">
    
    <style>
        .delete-warning {
            background: linear-gradient(135deg, #ff6b6b 0%, #c92a2a 100%);
            color: white;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(201, 42, 42, 0.3);
        }
        
        .delete-warning i {
            font-size: 60px;
            margin-bottom: 15px;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        
        .artifact-details {
            background: rgba(212, 175, 55, 0.05);
            border: 2px solid #d4af37;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .artifact-details h4 {
            color: #d4af37;
            margin-bottom: 20px;
            font-family: 'Cinzel', serif;
        }
        
        .artifact-details .detail-row {
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid rgba(212, 175, 55, 0.2);
        }
        
        .artifact-details .detail-row:last-child {
            border-bottom: none;
        }
        
        .artifact-details .label {
            font-weight: 600;
            color: #d4af37;
            width: 150px;
        }
        
        .artifact-details .value {
            flex: 1;
            color: #1a1a1a;
        }
        
        .artifact-image-container {
            text-align: center;
            margin: 20px 0;
        }
        
        .artifact-image-container img {
            max-width: 300px;
            border-radius: 15px;
            border: 3px solid #d4af37;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .btn-delete {
            background: linear-gradient(135deg, #ff6b6b 0%, #c92a2a 100%);
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(201, 42, 42, 0.3);
            width: 100%;
        }
        
        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(201, 42, 42, 0.4);
        }
        
        .btn-cancel {
            background: linear-gradient(135deg, #868e96 0%, #495057 100%);
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(73, 80, 87, 0.3);
            width: 100%;
            margin-top: 15px;
        }
        
        .btn-cancel:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(73, 80, 87, 0.4);
        }
    </style>
</head>
<body>

<div class="form-container">
    <div class="form-header">
        <div class="icon" style="background: linear-gradient(135deg, #ff6b6b 0%, #c92a2a 100%);">
            <i class="fas fa-trash-alt"></i>
        </div>
        <h2>Delete Artifact</h2>
        <p>Permanently remove artifact from database</p>
    </div>

    <div class="delete-warning">
        <i class="fas fa-exclamation-triangle"></i>
        <h3>Warning!</h3>
        <p>This action cannot be undone. The artifact will be permanently deleted from the database.</p>
    </div>

    <div class="artifact-details">
        <h4><i class="fas fa-info-circle"></i> Artifact Information</h4>
        
        <div class="artifact-image-container">
            <img id="artifactImage" src="" alt="Artifact Image">
        </div>
        
        <div class="detail-row">
            <div class="label"><i class="fas fa-tag"></i> Name:</div>
            <div class="value" id="artifactName">Loading...</div>
        </div>
        
        <div class="detail-row">
            <div class="label"><i class="fas fa-layer-group"></i> Category:</div>
            <div class="value" id="artifactCategory">Loading...</div>
        </div>
        
        <div class="detail-row">
            <div class="label"><i class="fas fa-map-marker-alt"></i> Location:</div>
            <div class="value" id="artifactLocation">Loading...</div>
        </div>
        
        <div class="detail-row">
            <div class="label"><i class="fas fa-map"></i> Found At:</div>
            <div class="value" id="artifactFoundAt">Loading...</div>
        </div>
        
        <div class="detail-row">
            <div class="label"><i class="fas fa-hourglass-half"></i> Age:</div>
            <div class="value" id="artifactAge">Loading...</div>
        </div>
        
        <div class="detail-row">
            <div class="label"><i class="fas fa-align-left"></i> Description:</div>
            <div class="value" id="artifactDesc">Loading...</div>
        </div>
    </div>

    <form action="../Php/Artifacts/delete_artifact.php" method="POST">
        <input type="hidden" name="Art_Id" value="<?php echo $artId; ?>">
        <input type="hidden" name="Img" id="artifactImg">
        
        <button type="submit" name="submit" class="btn-delete">
            <i class="fas fa-trash-alt"></i> Confirm Delete
        </button>
    </form>
    
    <button onclick="window.location='Show_Artifacts.php'" class="btn-cancel">
        <i class="fas fa-times"></i> Cancel
    </button>

    <div class="back-link">
        <a href="Show_Artifacts.php">
            <i class="fas fa-arrow-left"></i> Back to Artifacts
        </a>
    </div>
</div>

<script>
const artId = <?php echo $artId; ?>;

fetch(`../Php/Artifacts/get_artifact.php?id=${artId}`)
    .then(res => res.json())
    .then(data => {
        if (data.success && data.artifact) {
            const art = data.artifact;
            
            document.getElementById('artifactName').textContent = art.Name || 'N/A';
            document.getElementById('artifactCategory').textContent = art.Cate_Name || 'N/A';
            document.getElementById('artifactLocation').textContent = art.Loc_Name || 'N/A';
            document.getElementById('artifactFoundAt').textContent = art.FoundAt || 'N/A';
            document.getElementById('artifactAge').textContent = art.Art_Age || 'N/A';
            document.getElementById('artifactDesc').textContent = art.Descrption || 'No description available';
            document.getElementById('artifactImg').value = art.Img || '';
            
            if (art.Img) {
                document.getElementById('artifactImage').src = `../../UploadsForArtifacts/${art.Img}`;
            }
        } else {
            alert('Artifact not found!');
            window.location = 'Show_Artifacts.php';
        }
    })
    .catch(err => {
        console.error('Error:', err);
        alert('Error loading artifact data');
    });
</script>

</body>
</html>