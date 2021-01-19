<?php

require(dirname(__FILE__) . '/DB.php');

    $request = 'SELECT * FROM user WHERE id = 15';
    $response = DB::executeRequest($request);
    var_dump($response);
?>