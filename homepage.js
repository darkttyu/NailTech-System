const express = require('express');
const bodyParser = require('body-parser');
const path = require('path')

const home = express();
const encoder = bodyParser.urlencoded({extended: true});

home.use("/assets", path.join(express.static("assets")));

home.get('/', function(req, res) {
    res.sendFile(path.join(__dirname, '/homepage.html'));
})

home.post('/', encoder, function(req, res) {
    var clickedButton = req.body.clickedButton;
    
    if (clickedButton === 'Employee') {
        res.redirect('/employee')
    } 
    else if (clickedButton === 'Appointment'){
        res.redirect('/appointment')
    }
    res.end();
})

home.get('/employee', function(req, res) {
    res.sendFile(path.join(__dirname, '/employee.html'))
})

home.get('/appointment', function(req, res) {
    res.sendFile(path.join(__dirname, '/appointment.html'))
})