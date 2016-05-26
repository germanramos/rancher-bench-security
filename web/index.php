<?php

$dictionary = array(
    '[1;31m' => '<span style="color:red">',
    '[1;32m' => '<span style="color:green">',
    '[1;33m' => '<span style="color:yellow">',
    '[1;34m' => '<span style="color:blue">',
    '[0m'   => '</span>' ,
);

function CallAPI($method, $url, $data = false)
{
    $curl = curl_init();
    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "username:password");
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}
?>

<head>
  <link rel="stylesheet" href="index.css">
  <script src="index.js"></script>
</head>
<body>
  <ul class="tab">
    <li><a href="#" class="tablinks" onclick="openCity(event, 'London')">London</a></li>
    <li><a href="#" class="tablinks" onclick="openCity(event, 'Paris')">Paris</a></li>
    <li><a href="#" class="tablinks" onclick="openCity(event, 'Tokyo')">Tokyo</a></li>
  </ul>
  <div id="London" class="tabcontent">
    <h3>London</h3>
    <pre>
    <?php echo str_replace(array_keys($dictionary), $dictionary, CallApi("GET", "127.0.0.1/report.txt")); ?>
    </pre>
  </div>

  <div id="Paris" class="tabcontent">
    <h3>Paris</h3>
    <p>Paris is the capital of France.</p>
  </div>

  <div id="Tokyo" class="tabcontent">
    <h3>Tokyo</h3>
    <p>Tokyo is the capital of Japan.</p>
  </div>
</body>
