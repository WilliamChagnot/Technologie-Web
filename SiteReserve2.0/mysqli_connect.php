<?php
/* this script connect to the database
and establishes the character set for communications. */

// Connect:
$dbc = mysqli_connect('localhost', 'root', '', 'myreservations');

// set the character set
mysqli_set_charset($dbc, 'utf8');
