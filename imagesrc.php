<?php

    $imgurl = $_POST['imgurl'];
    $frame = $_POST['frame'];

    $imgurl = str_replace(" ", '+', $imgurl);
    $filteredData=substr($imgurl, strpos($imgurl, ",")+1);

    $unencodedData= base64_decode($filteredData);

    //echo "unencodedData".$unencodedData;

    $fp = fopen( 'tmp/last.png', 'wb' );
    fwrite( $fp, $unencodedData);
    fclose( $fp );

?>