<?php
// Include the database connection file
include('database.php');

// Prepare a SQL query to retrieve all employees from the database
$employee_query = "SELECT * FROM EMPLOYEE";
// Execute the query and store the result in $emp_result
$emp_result = $conn->query($employee_query);

// Initialize an empty array to store employee data
$employees = [];

// Check if there are any employees returned from the query
if ($emp_result->num_rows > 0) {
    // Iterate through each row of the result set
    while ($row = $emp_result->fetch_assoc()) {
        // Add the current employee data to the $employees array
        $employees[] = $row;
    }
}

// Check if a search term is provided in the GET request
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['searchedName'])) {
    // Prepare the search term with wildcards
    $search_emp = "%" . $_GET['searchedName'] . "%";

    // Prepare a SQL query to search for employees based on the search term
    $employee_query = "SELECT * FROM EMPLOYEE WHERE EMPNAME LIKE ?";
    // Create a prepared statement
    $get_employee = $conn->prepare($employee_query);
    // Bind the search term to the prepared statement
    $get_employee->bind_param("s", $search_emp);
    // Execute the prepared statement
    $get_employee->execute();
    // Get the result set from the prepared statement
    $employee = $get_employee->get_result();

    // Initialize an empty array to store search results
    $employees = [];

    // Check if there are any search results
    if ($employee->num_rows > 0) {
        // Iterate through each search result
        while ($row = $employee->fetch_assoc()) {
            // Add the current employee data to the $employees array
            $employees[] = $row;
        }
    } else {
        // Display an error message and redirect to employee page
        echo "<script>
            alert('Employee not Found!');
            window.location.href = 'employeePage.php'; 
            </script>";
    }
}

// Close the database connection
$conn->close();
?>