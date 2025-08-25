<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media Campaigns</title>
    <link rel="stylesheet" type="text/css" 
          href="css/style.css?<?php echo time(); ?>">
</head>
<body class="campaign-page">

    <?php include 'header.php'; ?>
    <?php include 'menu.php'; ?>

    <br>
    <section class="campaign-overview">
        <div class="campaign-header">
            <h2>Social Media Campaigns: Overview, Strategies, and Success Stories</h2>
            <p>Explore our latest social media campaigns, designed to engage, inform, and inspire audiences across various platforms. Discover how we connect with our target audience, set goals, and measure success.</p>
        </div>

        <div class="campaign-content">
            <h3>Our Campaign Strategy</h3>
            <p>We develop targeted campaigns that resonate with our audience by leveraging data-driven insights and creative content strategies. Our campaigns aim to raise awareness, promote engagement, and drive positive change in social media behavior.</p>
            <ul class="campaign-strategy">
                <li><strong>Research and Planning:</strong> We identify key issues and tailor campaigns to address the needs of our audience.</li>
                <li><strong>Creative Content:</strong> Engaging visuals, videos, and interactive posts are at the heart of our strategy to capture attention.</li>
                <li><strong>Community Engagement:</strong> We foster meaningful connections through comments, live Q&A sessions, and user-generated content.</li>
                <li><strong>Measurement and Feedback:</strong> Analyzing campaign performance helps us refine our approach and maximize impact.</li>
            </ul>
            <img src="photos/campaigns/cam1.png" alt="Campaign Strategy" class="main-responsive-image">

            <h3>Recent Campaign Highlights</h3>
            <p>Here are some of our most impactful campaigns:</p>
            <ul class="campaign-highlights">
                <li><strong>#StaySafeOnline:</strong> A campaign focused on educating teenagers about online safety, privacy, and responsible social media use.</li>
                <li><strong>#DigitalDetox:</strong> Encouraging users to take regular breaks from social media to focus on mental health and real-life connections.</li>
                <li><strong>#SpreadKindness:</strong> Promoting positive interactions online through acts of kindness, supportive comments, and community challenges.</li>
            </ul>
            <img src="photos/campaigns/cam2.png" alt="Campaign Highlights" class="responsive-image">

            <h3>Success Stories</h3>
            <p>We measure our success by the positive impact we create. Here are some of our achievements:</p>
            <ul class="success-stories">
                <li><strong>Increased Engagement:</strong> Our campaigns have seen a 50% increase in audience interaction, with more users sharing and commenting on our posts.</li>
                <li><strong>Community Growth:</strong> We've built a thriving community of over 10,000 followers who actively participate in our initiatives.</li>
                <li><strong>Positive Feedback:</strong> Many users have reached out to share how our campaigns have helped them make safer choices online.</li>
            </ul>
            <img src="photos/campaigns/cam3.png" alt="Campaign Success Stories" class="responsive-image">

            <h3>Join Our Next Campaign</h3>
            <p>Want to be part of our next campaign? Contact us at <a href="mailto:campaigns@example.com">campaigns@example.com</a> for partnership opportunities or subscribe to our newsletter for updates.</p>
        </div>

        <!-- Participation Section -->
        <div class="campaign-participation">
            <h3>How to Participate</h3>
            <p>Get involved with our social media campaigns and make a difference! Here are ways you can participate:</p>
            <ul class="participation-list">
                <li><strong>Subscribe to Our Newsletter:</strong> Stay updated with the latest campaign news, tips, and exclusive content. <a href="#subscribe-form">Subscribe now</a>.</li>
                <li><strong>Join Our Contests:</strong> Participate in our social media challenges and contests for a chance to win exciting prizes.</li>
                <li><strong>Share Our Campaigns:</strong> Help spread the word by sharing our campaign posts on your social media accounts.</li>
                <li><strong>Become an Ambassador:</strong> Partner with us as a campaign ambassador and promote our message to your followers.</li>
                <li><strong>Submit Your Ideas:</strong> Have an idea for a campaign? We’d love to hear from you! Submit your suggestions below.</li>
            </ul>
            <img src="photos/campaigns/cam4.png" alt="Campaign Participation" class="responsive-image">

            <!-- Participation Form -->
            <h4>Sign Up to Participate</h4>
            <form action="campaigns_process.php" method="POST" class="participation-form">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="interest">How would you like to participate?</label>
                <select id="interest" name="interest">
                    <option value="newsletter">Subscribe to Newsletter</option>
                    <option value="contests">Join Contests</option>
                    <option value="ambassador">Become an Ambassador</option>
                    <option value="ideas">Submit Campaign Ideas</option>
                </select>

                <label for="message">Your Message (optional):</label>
                <textarea id="message" name="message" rows="4"></textarea>

                <button type="submit" name="submit" class="participate-button">Join Now</button>
            </form>
        </div>

        <div class="campaign-footer">
            <p>Stay updated with our latest social media campaigns by subscribing to our <a href="#newsletter">newsletter</a>.</p>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script type="text/javascript">
        document.getElementById('you_are_here').innerHTML = "<i>You are at <b>Campaigns page</b></i>";
    </script>

</body>
</html>
