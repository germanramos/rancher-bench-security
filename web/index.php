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
    <?php
    for ($i = 0; $i <= 50; $i++) {
      $ip = CallApi("GET", "rancher-metadata.rancher.internal/2015-12-19/self/service/containers/" . $i . "/primary_ip");
      if ( trim($ip) == "Not found" ) break;
    ?>
    <li><a href="#" class="tablinks" onclick="openCity(event, '<?php echo $ip ?>')"><?php echo $ip ?></a></li>
    <?php } ?>
  </ul>
  <?php
  for ($i = 0; $i <= 50; $i++) {
    $ip = CallApi("GET", "rancher-metadata.rancher.internal/2015-12-19/self/service/containers/" . $i . "/primary_ip");
    if ( trim($ip) == "Not found" ) break;
  ?>
  <div id="<?php echo $ip ?>" class="tabcontent">
    <pre><?php echo str_replace(array_keys($dictionary), $dictionary, CallApi("GET", $ip . "/report.txt")); ?></pre>
  </div>
  <?php } ?>
</body>
