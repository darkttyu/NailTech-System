// Import the necessary modules
const mysql = require('mysql'); // MySQL module to interact with a MySQL database
const express = require('express'); // Express module to create the web server
const bodyParser = require('body-parser'); // Body-parser module to parse incoming request bodies

// Create an encoder for URL-encoded bodies
const encoder = bodyParser.urlencoded({ extended: true}); // Encoder for parsing URL-encoded bodies

// Initialize the Express application
const app = express(); // Express application instance

// Serve static files from the "assets" directory
app.use("/assets", express.static("assets")); // Middleware to serve static files

// Create a MySQL connection
const connection = mysql.createConnection({
    host: 'localhost', // Database host
    user: 'root', // Database user
    password: "DroU9HPwqRHnzOC", // Database password
    database: 'nail_tech' // Database name
});

// Connect to the MySQL database
connection.connect(function(error) {
    if (error) throw error; // If there's an error, throw it
    else console.log("Connected to System!"); // Log a success message if connected
});

// Handle GET request to the root URL
app.get('/', function(req, res) {
    // Send the login HTML file as a response
    res.sendFile(__dirname + "/login.html"); // Serve the login.html file
});

// Handle POST request to the root URL
app.post('/', encoder, function(req, res) {
    // Retrieve the username and password from the request body
    var username = req.body.username; // Get username from the request body
    var password = req.body.password; // Get password from the request body

    // Query the database to check if the username and password match
    connection.query("SELECT * FROM ADMIN WHERE username = ? AND password = ?", [username, password], function(error, results, fields) {
        if(results.length > 0) {
            // If a matching user is found, redirect to the homepage page
            res.redirect("/homepage"); // Redirect to the homepage page if login is successful
        } else {
            // If no matching user is found, redirect back to the login page
            res.redirect('/'); // Redirect back to the login page if login fails
        }
        res.end(); // End the response
    });
});

// Handle GET request to the "/homepage" URL
app.get("/homepage", function(req, res) {
    // Send the welcome HTML file as a response
    res.sendFile(__dirname + "/homepage.html"); // Serve the homepage.html file
});

// Start the Express server on port 4500
app.listen(4500); // Start the server and listen on port 4500
