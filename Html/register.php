<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/registerAndLoginStyle.css">
    <title>Register</title>
</head>
<body>
    <nav class="border-bottom">
        <div class="px-5 d-flex justify-content-between align-items-center py-2">
            <div class="d-flex align-items-center ">
                <i class="fa-solid fa-building-columns orange-color fs-5 me-2"></i>
                <h1 class="fs-5 font ">Heirtage</h1>
            </div>
            <!-- هنربط صفحة تسجيل الدخول هنا -->
            <a href="login.php" class="link-offset-2 link-underline link-underline-opacity-0 "><button class="btn  button-color rounded font text-white">Log In</button></a>
        </div>
    </nav>
    <section class="py-4">
        <div class="width m-auto border rounded shadow py-4 px-4 ">
            <h2 class="font fs-2 text-center"><b>Create Your Account</b></h2>
            <p class="font my-2 text-secondary text-center">Save your favorite artifacts and create collections.</p>
            <form  method="Post" action="../Php/User_DB/Register.php" >
                <label for="username">Username</label>
                <input type="text" name="Name" id="username" class="form-control mt-1 mb-3" placeholder="e.g., history_enthusiate" required>
                <label for="email">Email Address</label>
                <input type="email" name="Email" id="email" class="form-control mt-1 mb-3" placeholder="e.g., yourname@example.com" required>
                <label for="password">Password</label>
                <input type="password" name="Password" id="password" class="form-control mt-1 mb-3" placeholder="Enter your password" required>
                <label for="confirm-password">Confirm Password</label>
                <input type="password" name="ConfirmPassword" id="confirm-password" class="form-control mt-1 mb-3" placeholder="Confirm your password" required>
                <input type="text" name="Role" value="user" hidden>
                <button name="submit" type="submit" class=" border border-white rounded py-2 button-color w-100 mt-3 font">Register</button>
                <!-- هنربط صفحة تسجيل الدخول هنا -->
                <p class="text-center text-secondary mt-3">Already have an account? <a href="login.php" class="link-offset-2 link-underline link-underline-opacity-0 orange-color">Log in</a></p>
            </form>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>