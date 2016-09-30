<?php

function getMwlisTags($account)
{
    $baseUrl = getenv('MW_ELASTIC_URL');

    $jsonUrl = sprintf("%s:%s", $baseUrl, $account['handle']);

    $username = 'readonly';  // authentication
    $password = getenv('MW_ELASTIC_PASSWORD');  // authentication

    $ch = curl_init($jsonUrl);

    $options = array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_USERPWD => $username . ":" . $password,   // authentication
        CURLOPT_HTTPHEADER => array('Content-type: application/json') ,
    );

    curl_setopt_array( $ch, $options );

    $result =  curl_exec($ch); // Getting jSON result string

    print_r($result);
    die();
    $data = json_decode($result, true);

    $total = $data['hits']['total'];

    return $total > 0 ? $toolsFlat = $data['hits']['hits'][0]['_source']['ToolsFlat'] : '';
}