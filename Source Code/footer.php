<!-- Footer Start -->
<footer style="background-color: #000; color: #fff; padding: 60px 0; font-family: Arial, sans-serif;">
    <div style="
        max-width: 1200px;
        margin: auto;
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 30px;
    ">

<?php
include('admin/includes/config.php');
$settings_res = mysqli_query($conn, "SELECT * FROM site_settings LIMIT 1");
$settings = mysqli_fetch_assoc($settings_res);
?>

<!-- FOOTER -->
<div class="container footer mt-5">
    <div class="row">

        <!-- Business Time -->
        <div class="col-md-3 footer-box">
            <h4 class="footer-title">Business Time</h4>
            <ul class="footer-list">
                <li><?php echo nl2br($settings['business_time']); ?></li>
            </ul>
        </div>

        <!-- Social Media -->
        <div class="col-md-3 footer-box">
            <h4 class="footer-title">Social Media</h4>
            <p>Follow us on:</p>
            <div class="social-icons">
                <a href="<?php echo $settings['social_google']; ?>"><i class="fab fa-google"></i></a>
                <a href="<?php echo $settings['social_whatsapp']; ?>"><i class="fab fa-whatsapp"></i></a>
                <a href="<?php echo $settings['social_instagram']; ?>"><i class="fab fa-instagram"></i></a>
                <a href="<?php echo $settings['social_twitter']; ?>"><i class="fab fa-twitter"></i></a>
                <a href="<?php echo $settings['social_facebook']; ?>"><i class="fab fa-facebook"></i></a>
            </div>
        </div>

        <!-- About SubjiVilla -->
        <div class="col-md-3 footer-box">
            <h4 class="footer-title">About SubjiVilla</h4>
            <p><?php echo $settings['about_text']; ?></p>
        </div>

        <!-- Contact Us -->
        <div class="col-md-3 footer-box">
            <h4 class="footer-title">Contact Us</h4>
            <p><i class="fas fa-map-marker-alt"></i> <?php echo $settings['contact_address']; ?></p>
            <p><i class="fas fa-phone-square"></i> 
                <a href="tel:<?php echo $settings['contact_phone']; ?>" class="footer-link">
                    <?php echo $settings['contact_phone']; ?>
                </a>
            </p>
            <p><i class="fas fa-envelope"></i> 
                <a href="mailto:<?php echo $settings['contact_email']; ?>" class="footer-link">
                    <?php echo $settings['contact_email']; ?>
                </a>
            </p>
        </div>

    </div>
</div>

</footer>

<!-- Footer CSS -->
<style>
    /* Reusable box style */
    .footer-box {
        flex: 1;
        min-width: 250px;
        animation: fadeInUp 1s ease forwards;
        opacity: 0;
    }

    /* Section title */
    .footer-title {
        color: #cde750;
        margin-bottom: 15px;
        font-size: 20px;
        border-bottom: 2px solid #cde750;
        padding-bottom: 5px;
    }

    /* List */
    .footer-list {
        list-style: none;
        padding: 0;
        line-height: 1.8;
    }

    /* Social Icons */
    .social-icons a {
        font-size: 18px;
        color: white;
        background-color: #333;
        padding: 10px;
        margin-right: 8px;
        border-radius: 5px;
        transition: 0.4s ease;
        display: inline-block;
    }

    .social-icons a:hover {
        background-color: #cde750;
        color: black;
        transform: scale(1.1);
    }

    /* Contact links */
    .footer-link {
        color: #fff;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer-link:hover {
        color: #cde750;
    }

    /* Fade-in animation */
    @keyframes fadeInUp {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* Responsive Design */
    @media screen and (max-width: 768px) {
        footer > div {
            flex-direction: column !important;
            align-items: flex-start;
        }

        .footer-box {
            animation-delay: 0s !important;
        }
    }
</style>

<!-- Scroll Animation Trigger Script -->
<script>
    // Simple animation trigger on scroll
    const boxes = document.querySelectorAll(".footer-box");
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = 1;
                entry.target.style.animationDelay = `${Array.from(boxes).indexOf(entry.target) * 0.2}s`;
            }
        });
    }, { threshold: 0.3 });

    boxes.forEach(box => observer.observe(box));
</script>
