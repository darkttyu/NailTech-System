<?php 
// Checks if the request method is a POST request
if ($_SERVER['REQUEST_METHOD'] && isset($_POST['Set'])) {
    // If the 'Add' button is clicked, redirect to the employee add page
    header("Location: appointments/setAppointment.php");
    // Stop further execution
    exit();
} else if ($_SERVER['REQUEST_METHOD'] && isset($_POST['Update'])) {
    // If the 'Update' button is clicked, redirect to the employee update page
    header("Location: appointments/updateAppointment.php");
    // Stop further execution
    exit();
} else if ($_SERVER['REQUEST_METHOD'] == 'POST' & isset($_POST['Cancel'])) {
    header("Location: appointments/cancelAppointment.html");
    exit();
}
?>