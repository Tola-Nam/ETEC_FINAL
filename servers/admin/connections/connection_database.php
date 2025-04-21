<?php

function connection_database(): mysqli
{
    return new mysqli("Localhost", "root", "", "system_online_shop");
}
?>