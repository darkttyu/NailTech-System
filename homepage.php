<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check for specific POST data and redirect accordingly
    if (isset($_POST['Employee'])) {
        header("Location: employeePage.php");
        exit;
    } elseif (isset($_POST['Appointment'])) {
        header("Location: appointmentPage.html");
        exit;
    } elseif (isset($_POST['Logout'])) {
        header("Location: login.html");
        exit;
    } else {
        // Handle unexpected POST data or error
        echo "<script>
        alert('Encountered an Unexpected Error');
        window.location.href='homepage.html';
        </script>";
    }
}