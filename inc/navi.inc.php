<?php

include './config/personalIDs.php';

foreach ($personalIDs as $value) {
    $db = new DB();
    $ma = $db->getMitarbeiter($value);
    if ($ma == false) {
        echo '<a class="btn btn-lg btn-danger" href="index.php?id='.$value.'" role="button">Mitarbeiter ' . $value . '</a>';
    } else {
        echo '<a class="btn btn-lg btn-success" onclick="loadMitarbeiter('.$value.')" role="button">Mitarbeiter ' . $value . '</a>';
    }
}
?>



