<?php

session_start();

session_destroy();


header("Location: ../bienvenida.html");

exit();

?>