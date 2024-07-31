<?php 

include ('../database.php');

$employee_query = "SELECT empID FROM EMPLOYEE";
// Create a prepared statement
$get_employee = $conn->prepare($employee_query);
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
} 

/*
// Checks if the employees are present in the array
echo '<pre>';
print_r($employees);
echo '</pre>';
*/

?>
