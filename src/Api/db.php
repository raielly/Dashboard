<?php
$conn = new mysqli("localhost", "root", "", "archintel");
if (!$conn) {
    echo "Error! Db Not Found";
}
