<?php

function s($conn,$string) {
    return mysqli_real_escape($conn,$string);
}

?>