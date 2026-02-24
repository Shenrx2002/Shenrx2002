<?php

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $phone = htmlspecialchars($_POST['phone'] ?? '');
    $address = htmlspecialchars($_POST['address'] ?? '');
    $location = htmlspecialchars($_POST['location'] ?? '');
    $guests = htmlspecialchars($_POST['guests'] ?? '');
    $arrivals = htmlspecialchars($_POST['arrivals'] ?? '');
    $leaving = htmlspecialchars($_POST['leaving'] ?? '');
    
    // Your email address where you want to receive bookings
    $to_email = "sithumsanjana246@gmail.com"; // CHANGE THIS TO YOUR EMAIL
    
    // Email subject
    $subject = "New Booking Request from " . $name;
    
    // Email message content
    $message = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; }
            .booking-details { background: #f5f5f5; padding: 20px; border-radius: 5px; }
            .detail-row { margin: 10px 0; padding: 10px 0; border-bottom: 1px solid #ddd; }
            .label { font-weight: bold; color: #333; }
            .value { color: #666; }
        </style>
    </head>
    <body>
        <h2>New Booking Request</h2>
        <div class='booking-details'>
            <div class='detail-row'>
                <span class='label'>Name:</span>
                <span class='value'>" . $name . "</span>
            </div>
            <div class='detail-row'>
                <span class='label'>Email:</span>
                <span class='value'>" . $email . "</span>
            </div>
            <div class='detail-row'>
                <span class='label'>Phone:</span>
                <span class='value'>" . $phone . "</span>
            </div>
            <div class='detail-row'>
                <span class='label'>Address:</span>
                <span class='value'>" . $address . "</span>
            </div>
            <div class='detail-row'>
                <span class='label'>Destination:</span>
                <span class='value'>" . $location . "</span>
            </div>
            <div class='detail-row'>
                <span class='label'>Number of Guests:</span>
                <span class='value'>" . $guests . "</span>
            </div>
            <div class='detail-row'>
                <span class='label'>Arrival Date:</span>
                <span class='value'>" . $arrivals . "</span>
            </div>
            <div class='detail-row'>
                <span class='label'>Departure Date:</span>
                <span class='value'>" . $leaving . "</span>
            </div>
        </div>
        <p>Thank you for booking with us!</p>
    </body>
    </html>
    ";
    
    // Email headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: " . $email . "\r\n";
    
    // Send email to admin
    $mail_sent = mail($to_email, $subject, $message, $headers);
    
    // Send confirmation email to user
    $user_subject = "Booking Confirmation - Travel";
    $user_message = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; }
            .confirmation { background: #f5f5f5; padding: 20px; border-radius: 5px; }
        </style>
    </head>
    <body>
        <h2>Booking Confirmation</h2>
        <div class='confirmation'>
            <p>Hello " . $name . ",</p>
            <p>Thank you for your booking request! We have received your details and will contact you soon to confirm your booking.</p>
            <p><strong>Booking Details:</strong></p>
            <p>
                Destination: " . $location . "<br>
                Arrival: " . $arrivals . "<br>
                Departure: " . $leaving . "<br>
                Guests: " . $guests . "
            </p>
            <p>We will be in touch shortly at " . $phone . "</p>
            <p>Best regards,<br>Travel Team</p>
        </div>
    </body>
    </html>
    ";
    
    $user_headers = "MIME-Version: 1.0" . "\r\n";
    $user_headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
    $user_headers .= "From: " . $to_email . "\r\n";
    
    mail($email, $user_subject, $user_message, $user_headers);
    
    // Redirect or show success message
    if ($mail_sent) {
        // Show success message
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Booking Successful</title>
            <link rel="stylesheet" href="style.css">
            <style>
                body {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    min-height: 100vh;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 20px;
                }
                
                .success-container {
                    background: white;
                    padding: 3rem;
                    border-radius: 1rem;
                    text-align: center;
                    box-shadow: 0 1rem 3rem rgba(0,0,0,0.2);
                    max-width: 50rem;
                    animation: slideIn 0.5s ease;
                }
                
                @keyframes slideIn {
                    from {
                        opacity: 0;
                        transform: translateY(2rem);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
                
                .success-icon {
                    font-size: 4rem;
                    color: #34E0A1;
                    margin-bottom: 1rem;
                }
                
                .success-icon i {
                    animation: bounce 0.6s ease;
                }
                
                @keyframes bounce {
                    0%, 100% {
                        transform: translateY(0);
                    }
                    50% {
                        transform: translateY(-1rem);
                    }
                }
                
                .success-container h2 {
                    font-size: 2.5rem;
                    color: #333;
                    margin: 1rem 0;
                }
                
                .success-container p {
                    font-size: 1.6rem;
                    color: #666;
                    line-height: 1.8;
                    margin: 1.5rem 0;
                }
                
                .booking-details {
                    background: #f5f5f5;
                    padding: 2rem;
                    border-radius: 0.5rem;
                    margin: 2rem 0;
                    text-align: left;
                }
                
                .detail-item {
                    display: flex;
                    justify-content: space-between;
                    padding: 0.8rem 0;
                    border-bottom: 1px solid #ddd;
                }
                
                .detail-item:last-child {
                    border-bottom: none;
                }
                
                .detail-label {
                    font-weight: bold;
                    color: #333;
                }
                
                .detail-value {
                    color: #34E0A1;
                    font-weight: bold;
                }
                
                .back-btn {
                    display: inline-block;
                    background: #34E0A1;
                    color: white;
                    padding: 1rem 2.5rem;
                    border-radius: 0.5rem;
                    text-decoration: none;
                    font-size: 1.5rem;
                    margin-top: 2rem;
                    transition: background 0.3s ease;
                    border: none;
                    cursor: pointer;
                }
                
                .back-btn:hover {
                    background: #2bb57c;
                }
                
                .contact-info {
                    background: #e8f5e9;
                    padding: 1.5rem;
                    border-radius: 0.5rem;
                    margin: 1.5rem 0;
                    border-left: 4px solid #34E0A1;
                }
                
                .contact-info p {
                    font-size: 1.4rem;
                    margin: 0.5rem 0;
                }
            </style>
        </head>
        <body>
            <div class="success-container">
                <div class="success-icon">
                    ✓
                </div>
                
                <h2>Booking Submitted Successfully!</h2>
                
                <p style="font-size: 1.8rem; color: #34E0A1; font-weight: bold;">
                    Your booking has been submitted successfully!
                </p>
                
                <p>
                    We have received your booking request and will contact you soon to confirm your reservation.
                </p>
                
                <div class="contact-info">
                    <p>📞 <strong>We will call or message you at:</strong></p>
                    <p style="color: #333;">+<?php echo htmlspecialchars($phone); ?></p>
                    <p>or email you at: <?php echo htmlspecialchars($email); ?></p>
                </div>
                
                <div class="booking-details">
                    <h3 style="margin-top: 0; color: #333;">Your Booking Details:</h3>
                    <div class="detail-item">
                        <span class="detail-label">Name:</span>
                        <span class="detail-value"><?php echo htmlspecialchars($name); ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Destination:</span>
                        <span class="detail-value"><?php echo htmlspecialchars($location); ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Arrival:</span>
                        <span class="detail-value"><?php echo htmlspecialchars($arrivals); ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Departure:</span>
                        <span class="detail-value"><?php echo htmlspecialchars($leaving); ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Guests:</span>
                        <span class="detail-value"><?php echo htmlspecialchars($guests); ?></span>
                    </div>
                </div>
                
                <p style="color: #999; font-size: 1.3rem;">
                    You will receive a confirmation email shortly.
                </p>
                
                <a href="index.html" class="back-btn">Back to Home</a>
            </div>
        </body>
        </html>
        <?php
        exit();
    } else {
        echo "Error sending email. Please try again.";
    }
}

?>
