<?php
require_once 'includes/page_header.php';

session_unset();
session_destroy();

header("location: index.php");

require 'includes/page_footer.php'
?>