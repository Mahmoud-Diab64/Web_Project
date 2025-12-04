<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Artifact</title>

    <style>
        body {
            font-family: Arial;
            margin: 40px;
            background: #f2f2f2;
        }
        form {
            background: white;
            padding: 25px;
            width: 450px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #aaa;
            border-radius: 5px;
        }
        button {
            padding: 12px;
            width: 100%;
            background: #008cff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 17px;
            cursor: pointer;
        }
        button:hover {
            background: #006fd0;
        }
    </style>
</head>
<body>

<h2>Add New Artifact</h2>

<form action="../Php/Artifacts/addArtifact.php" method="POST" enctype="multipart/form-data">

    <?php  
        require_once "../Php/Config/config.php";

        // GET Categories
        $cats = $conn->query("SELECT Cate_Id, Cate_Name FROM categories");

        // GET Locations
        $locs = $conn->query("SELECT Loc_Id, site FROM location");
    ?>

    <label>Artifact Name:</label>
    <input type="text" name="Name" required>

    <label>Select Category:</label>
    <select name="Cate_Id" required>
        <option value="">-- Select Category --</option>
        <?php while($c = $cats->fetch_assoc()) { ?>
            <option value="<?= $c['Cate_Id'] ?>"><?= $c['Cate_Name'] ?></option>
        <?php } ?>
    </select>

    <label>Select Location:</label>
    <select name="Loc_Id" required>
        <option value="">-- Select Location --</option>
        <?php while($l = $locs->fetch_assoc()) { ?>
            <option value="<?= $l['Loc_Id'] ?>"><?= $l['site'] ?></option>
        <?php } ?>
    </select>

    <label>Description:</label>
    <textarea name="Decrption" rows="3" required></textarea>

    <label>Short Description:</label>
    <textarea name="Short_Desc" rows="2"></textarea>

    <label>Found At:</label>
    <input type="text" name="FoundAt">

    <label>Artifact Age:</label>
    <input type="number" name="Art_Age">

    <label>Upload Image:</label>
    <input type="file" name="Img" accept="image/*" required>

    <button type="submit" name="submit">Add Artifact</button>

</form>

</body>
</html>
