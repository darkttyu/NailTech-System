PHP
<?php 
// Checks if the request method is a POST request
if ($_SERVER['REQUEST_METHOD'] && isset($_POST['Add'])) {
    // If the 'Add' button is clicked, redirect to the employee add page
    header("Location: employee_management/emp_add.html");
    // Stop further execution
    exit();
} else if ($_SERVER['REQUEST_METHOD'] && isset($_POST['Update'])) {
    // If the 'Update' button is clicked, redirect to the employee update page
    header("Location: employee_management/emp_update.php");
    // Stop further execution
    exit();
}
?>