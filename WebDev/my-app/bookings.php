<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "beauty_services";

// Create a new MySQLi instance
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];             
$email = $_POST['email'];
$service = $_POST['service'];
$date = $_POST['date'];
$time = $_POST['time'];
$payment_method = $_POST['payment'];
$total_cost = $_POST['totalCost'];

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}

// Validate date and time
$current_date = new DateTime();
$booking_date = new DateTime($date);
$booking_time = new DateTime($date . ' ' . $time);

if ($booking_date < $current_date->setTime(0, 0)) {
    die("Booking date cannot be in the past.");
}

$start_time = new DateTime('09:00:00');
$end_time = new DateTime('19:00:00');
if ($booking_time < $start_time || $booking_time > $end_time) {
    die("Booking time must be within working hours (09:00 - 19:00).");
}

// Prepare and bind the SQL statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO bookings (name, email, services, payment_method, total_cost, booking_date, booking_time) VALUES ($name, $email, $service, $date, $time, $payment, $totalCost)");
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("sssssss", $name, $email, $service, $payment_method, $total_cost, $date, $time);

// Execute the statement
if ($stmt->execute()) {
    // Send email for location details
    $to = $email;
    $subject = "Shee Beauty Palace - Location Details Required";
    $message = "Dear $name,\n\nThank you for your booking! Please provide your location details for the home service.\n\nBest Regards,\nShee Beauty Palace";
    $headers = "From: no-reply@sheebeauty.com";

    if (mail($to, $subject, $message, $headers)) {
        echo "New booking recorded successfully and email sent.";
    } else {
        echo "New booking recorded successfully but email sending failed.";
    }
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
