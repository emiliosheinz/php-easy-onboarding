<?php

namespace App\Infra\Db;

$conn_string = "host=db dbname=easy-onboarding user=admin password=easyonboarding123";
$db_connection = pg_connect($conn_string) or die("Connection with database failed");
