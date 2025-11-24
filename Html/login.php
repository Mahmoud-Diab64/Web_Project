<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/registerAndLoginStyle.css">
    <title>Login</title>
</head>

<body>
    <section class="row g-0">
        <div class="right-side col-lg-6 d-none d-lg-block py-4">
            <div class=" rounded m-auto bg-img">
            </div>
        </div>
        <div class="col-sm-12 col-lg-6 py-4 px-5 position-relative">
            <header class="d-flex">
                <i class="fa-solid fa-building-columns orange-color fs-5 me-2"></i>
                <h1 class="fs-5 font "><b>Heirtage</b></h1>
            </header>
            <section class="form ">
                <h2 class="font "><b>Welcom Back</b></h2>
                <p class="text-secondary">Log in to continue your journey through history</p>
                <form method="Post" action="../Php/User_DB/Login.php">
                    <label for="email">Email or Username</label>
                    <input type="email" name="Email" id="email" class="form-control mt-1 mb-3"
                        placeholder="Enter your email or username" required>
                    <label for="password">Password</label>
                    <input type="password" name="Password" id="password" class="form-control mt-1 mb-3"
                        placeholder="Enter your password" required>
                    <button type="submit" name="submit" class=" border border-white rounded py-2 button-color w-100 mt-3 font">Log
                        In</button>
                        <!-- هنربط صفحة Register  -->
                    <p class="text-center text-secondary mt-3">Don't have an account?
                        <a href="register.php" class="link-offset-2 link-underline link-underline-opacity-0 orange-color">Sign
                            Up</a>
                    </p>
                </form>
            </section>
            <footer class="text-secondary py-3 position-absolute bottom-0 start-50 translate-middle-x">
                Privacy Policy . Terms of Service
            </footer>
        </div>
    </section>
</body>

</html>