<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Link to favicon -->
        <link rel="icon" href="../assets/logo.png" type="image/icon type">
        <!-- Link to Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Inter" rel="stylesheet">
        <!-- Link to Font Awesome for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <!-- Link to external CSS stylesheet -->
        <link rel="stylesheet" href="../assets/empupdate_style.css">
    <title>Update Employee</title>
</head>

<body>
    <!-- Top navigation bar -->
    <div class="topnav"> 
        <!-- Company logo -->
        <img id="logo" src="../assets/logo.png">
        <!-- Navigation links -->
        <a id="home" href="../homepage.html">HOME</a>
        <a id="employee" href="../employeePage.php">EMPLOYEE MANAGEMENT</a>
        <a id="appointment" href="../appointmentPage.php">APPOINTMENT SCHEDULING</a>
    </div>

    <!-- Search bar for employee lookup -->
    <div class="search-container"> 
        <form action="emp_update.php" method="GET"> 
            <!-- Search input field -->
            <input id="search" name="searchedName" type="search" placeholder="Search Employee..">
            <!-- Search button with icon -->
            <button type="submit" id="search-icon"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <!-- Include PHP script for search functionality -->
    <?php include 'search.php'; ?>

    <!-- Form for updating employee information -->
    <form action='update.php' method='post'>
        <div class="employee_information">
            <!-- Employee ID field -->
            <p id="id">Employee ID</p>
            <input id="emp_ID" type="text" name="empID" value="<?php echo htmlspecialchars($employee['empID'] ?? ''); ?>">
            
            <!-- Employee Name field -->
            <p id="name">Employee Name</p>
            <input id="emp_name" type="text" name="empName" value="<?php echo htmlspecialchars($employee['empName'] ?? ''); ?>">
            
            <!-- Employee Phone Number field -->
            <p id="number">Phone Number</p>
            <input id="emp_phonenum" type="text" name="empNumber" value="<?php echo htmlspecialchars($employee['empNumber'] ?? ''); ?>">
            
            <!-- Employee Status dropdown -->
            <p id="status">Employee Status</p>
            <select id="emp_status" name="empStatus">
                <option value=''>Select Status</option>
                <option value="Active" <?php echo (isset($employee['empStatus']) && $employee['empStatus'] == 'Active') ? 'selected' : ''; ?>>Active</option>
                <option value="Inactive" <?php echo (isset($employee['empStatus']) && $employee['empStatus'] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                <option value="Part Time" <?php echo (isset($employee['empStatus']) && $employee['empStatus'] == 'Part Time') ? 'selected' : ''; ?>>Part Time</option>
            </select>

            <!-- Submit button for updating employee information -->
            <input id="confirm" type="submit" value="CONFIRM UPDATE">
        </div>
    </form>
    
</body>
</html>
