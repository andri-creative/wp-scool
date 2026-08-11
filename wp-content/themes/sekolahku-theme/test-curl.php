<?php
$ch = curl_init('http://127.0.0.1:9000');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$res = curl_exec($ch);
if($res === false) {
    echo "cURL Error: " . curl_error($ch) . "\n";
} else {
    echo "cURL Success! HTTP Code: " . curl_getinfo($ch, CURLINFO_HTTP_CODE) . "\n";
}
curl_close($ch);
