<?php

function connectiondatabase(): mysqli
{
    return new mysqli("Localhost", "root", "", "system_online_shop");
}
?>