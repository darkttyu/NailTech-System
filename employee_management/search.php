<?php
// Include database connection file
include('../database.php');

// Initialize employee variable
$employee = null;

// Check if it's a GET request with a search query
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['searchedName'])) {
    // Prepare search query with wildcard for partial matching
    $search_query = '%' . $_GET['searchedName'] . '%';

    // Prepare and execute SQL query to search for employee by name
    $get_emp = "SELECT * FROM EMPLOYEE WHERE empName LIKE ?";
    $get_userinfo = $conn->prepare($get_emp);
    $get_userinfo->bind_param("s", $search_query);
    $get_userinfo->execute();
    $employee_search = $get_userinfo->get_result();

    // Check if employee is found
    if ($employee_search->num_rows > 0) {
        // Fetch the first employee found (you might want to handle multiple results differently)
        $employee = $employee_search->fetch_assoc();
    } else {
        // Handle case where employee is not found
        echo "<script>
            alert('Employee not found.');
            window.location.href = 'emp_update.php';
        </script>";
        exit();
    }
}
?>