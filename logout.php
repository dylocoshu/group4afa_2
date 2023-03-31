<?php
session_start();
session_destroy();
echo 'You have been logged out. <a href="venues.php">Go back</a>';