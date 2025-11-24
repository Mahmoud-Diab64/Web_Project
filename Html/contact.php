<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONTACT US</title>
    <link rel="stylesheet" href="../css/contactSTYLE.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <header>
        <a href="#" class="logo">
            <i class="fa-solid fa-building-columns"></i>
            <p>Heritage</p>
        </a>
        <nav class="list">
            <a href="#" class="action">Home</a>
            <a href="#" class="action">Collection</a>
            <a href="#" class="action">Exhibits</a>
            <a href="#" class="action">About</a>
            <a href="#" class="action">Contact Us</a>
        </nav>
    </header>


    <section class="welsec">
        <div class="content">
            <h1>Contact Us</h1>
            <p>We'd love to hear from you. Please fill out the form below or use our contact details to get in touch.</p>
        </div>
    </section>


    <section class="contact-section">
        <div class="contact-container">

            <div class="contact-form">
                <h2 class="form-title">Send Us a Message</h2>
                
                <form>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input type="text" id="fullName" placeholder="Enter your full name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" placeholder="Enter your email address">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Heritage Museum</label>
                        <select id="subject">
                            <option value="" disabled selected>Please select a subject</option>
                            <option value="general">General Inquiry</option>
                            <option value="visit">Plan a Visit</option>
                            <option value="group">Group Tour</option>
                            <option value="event">Events</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea id="message" placeholder="Write your message here..."></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">Send Message</button>
                </form>
            </div>
            

            <div class="contact-info">
                <h2 class="info-title">Our Information</h2>
                
                <div class="info-item">
                    <div class="info-icon"><i class="fa-solid fa-location-dot"></i></div>
                    <div class="info-details">
                        <h4>Address</h4>
                        <p>123 Arrington Lane, History City, NC 12345</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon"><i class="fa-solid fa-phone"></i></div>
                    <div class="info-details">
                        <h4>Phone</h4>
                        <p>+1 (555) 123-4567</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon"><i class="fa-solid fa-envelope"></i></div>
                    <div class="info-details">
                        <h4>Email</h4>
                        <p>info@heritagemuseum.org</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon"><i class="fa-solid fa-clock"></i></div>
                    <div class="info-details">
                        <h4>Hours</h4>
                        <p>Tuesday - Sunday: 10am - 6pm</p>
                        <p>Monday: Closed</p>
                    </div>
                </div>
                
                <!-- <div class="info-item">
                    <h3 class="info-title">Find Us</h3>
                    <div class="map-placeholder">
                        [Museum Location Map]
                    </div>
                </div> -->
            </div>
        </div>
    </section>


    <footer>
        <div class="footer-content">
            <div class="logo">
                <i class="fa-solid fa-building-columns"></i>
                <span>Heritage Museum</span>
            </div>
            <div class="copyright">© 2023 Heritage Museum All rights Reserved</div>
        </div>
    </footer>
</body>
</html>