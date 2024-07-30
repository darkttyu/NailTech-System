<?php
// Include the database connection file
include('database.php');

// Check if the request method is POST (form submission)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect username and password from the form data, sanitizing them
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Prepare a SQL statement to select username and password from the ADMIN table where username matches the input
    $get_userinfo = $conn->prepare("SELECT username, password FROM ADMIN WHERE username = ?");
    // Bind the username parameter to the prepared statement
    $get_userinfo->bind_param("s", $username);
    // Execute the prepared statement
    $get_userinfo->execute();
    // Get the result set from the executed statement
    $result = $get_userinfo->get_result();

    // Check if a user was found (result set has rows)
    if ($result->num_rows > 0) {
        // Fetch the user data as an associative array
        $user_login = $result->fetch_assoc();

        // Compare the entered password with the stored password
        if ($password === $user_login['password']) {
            // Successful login, redirect to homepage
            header("Location: homepage.html");
            exit();
        } else {
            // Invalid password, display error and redirect to login page
            echo "<script>
                alert('Invalid Login. Try again!')
                window.location.href='login.html';
                </script>";
            exit();
        }
    } else {
        // User not found, display error and redirect to login page
        echo "<script>
            alert('User not Found!') 
            window.location.href='login.html';
            </script>";
        exit();
    }

    // Close the prepared statement and database connection
    $get_userinfo->close();
    $conn->close();
}
?>