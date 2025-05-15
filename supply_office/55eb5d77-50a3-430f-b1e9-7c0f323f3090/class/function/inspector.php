<?php
//////////////////////////////////////IAR CONFIG

if ($_SESSION['account_type'] !== 'Inspector') {
    echo '<meta http-equiv="refresh" content="0;url=../../../index.php">';
    exit; 
}

?>
