<?php


//$origensPermitidas = ['http://localhost:3000', 'https://familia-gouveia-0f628f261ee1.herokuapp.com', 'http://localhost:8000'];


    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Origin: *' );
    header('Access-Control-Allow-Methods: OPTIONS,PATCH,DELETE,POST,PUT,GET');
    header('Access-Control-Allow-Headers: X-CSRF-Token, X-Requested-With, Accept, Accept-Version, Content-Length, Content-MD5, Content-Type, Date, X-Api-Version, Authorization');
    header('Content-Type: application/json');



?>
