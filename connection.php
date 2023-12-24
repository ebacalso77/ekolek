<?php
$con=mysqli_connect("localhost","root","","e-kolek");
// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}