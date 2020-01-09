<?php

require_once('db_credentials.php');

function db_connect()
{
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    confirm_db_connect();
    return $conn;
}

function db_disconnect()
{
    if (isset($conn)) {
        mysqli_close($conn);
    }
}

function db_escape($conn, $string)
{
    return mysqli_real_escape_string($conn, $string);
}

function confirm_db_connect()
{
    if (mysqli_connect_errno()) {
        $msg = "Database failed to connect: ";
        $msg .= mysqli_connect_error();
        $msg .= " (" . mysqli_connect_errno() . ")";
        exit($msg);
    }
}

function confirm_query_result($result_set)
{
    if (!$result_set) {
        exit("Database query result failed.");
    }
}
