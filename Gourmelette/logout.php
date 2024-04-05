<?php
//end session when logout
session_start();
session_unset();
session_destroy();


header("Location: home.html");