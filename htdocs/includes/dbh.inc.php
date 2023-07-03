<?php
    // DEFINE = KONSTANTE VARIABLE -> KANN IM GEGENSATZ ZU EINER NORMALEN VARIABLE NICHT MEHR VERAENDERT WERDEN
    define( "DB", [ // DB = ARRAYNAME
        "dbhost" => "localhost",
        "dbuser" => "root",
        "dbpassword" => "",
        "db" => "dbname",
    ]);

    // $conn IST EINE INSTANZ DER 'mysqli' KLASSE -> DARIN WIRD DIE CONNECTION GESPEICHERT
    $conn = new mysqli(DB["dbhost"], DB["dbuser"], DB["dbpassword"], DB["db"]);
?>