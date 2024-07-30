<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to favicon -->
    <link rel="icon" href="assets/logo.png" type="image/icon type">
    <!-- Link to Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Inter" rel="stylesheet">
    <!-- Link to Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Link to external CSS stylesheet -->
    <link rel="stylesheet" href="assets/employee_style.css">
    <title>Employee Management</title>
</head>
<body>
    <!-- Top navigation bar -->
    <div class="topnav">
        <!-- Logo -->
        <img id="logo" src="/assets/logo.png">
        <!-- Navigation links -->
        <a id="home" href="homepage.html">HOME</a>
        <a id="employee" href="employeePage.php">EMPLOYEE MANAGEMENT</a>
        <a id="appointment" href="appointmentPage.html">APPOINTMENT SCHEDULING</a>
    </div>
    
    <!-- Form for Add and Update buttons -->
    <form action='checkEmpButton.php' method='post'> 
        <div class="buttons">
            <!-- Add Employee button -->
            <button id="add" name='Add'>ADD AN EMPLOYEE</button>
            <!-- Update Employee button -->
            <button id="update" name='Update'>UPDATE EMPLOYEE</button>
        </div>
    </form>
    
    <!-- Search form for employee lookup -->
    <form action="employeePage.php" method="GET">
        <!-- Search input field -->
        <input id="search" name="searchedName" type="search" placeholder="Search Employee..">
        <!-- Search button with icon -->
        <button type='submit' id='search-icon'><i class="fas fa-search"></i></button>
    </form>
        
    <!-- Table container to display employee data -->
    <div class='table-container'>
        <!-- Include PHP script to retrieve employee data -->
        <?php include 'retrieve_employee.php'; ?>
        <!-- Employee data table -->
        <table id="emp_table">
            <thead id='table-header'>
                <tr>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Employee Phone Number</th>
                    <th>Employee Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through each employee and display their data in a table row -->
                <?php foreach($employees as $employee): ?>
                <tr id='table-row'>
                    <!-- Employee ID -->
                    <td data-emp-id="<?php echo htmlspecialchars($employee['empID']); ?>"><?php echo htmlspecialchars($employee['empID']); ?></td>
                    <!-- Employee Name -->
                    <td data-emp-name="<?php echo htmlspecialchars($employee['empName']); ?>"><?php echo htmlspecialchars($employee['empName']); ?></td>
                    <!-- Employee Phone Number -->
                    <td data-emp-number="<?php echo htmlspecialchars($employee['empNumber']); ?>"><?php echo htmlspecialchars($employee['empNumber']); ?></td>
                    <!-- Employee Status -->
                    <td data-emp-status="<?php echo htmlspecialchars($employee['empStatus']); ?>"><?php echo htmlspecialchars($employee['empStatus']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
