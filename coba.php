<?php
  $isFull = true;
  while ($isFull) {
    $add = "jadwal.php?v13s4htukdfd9rhmr2f31gmg97";
    $query = "curl \"https://ol.akademik.itb.ac.id/".$add."\" \
          -H \"Host: ol.akademik.itb.ac.id\" \
          -H \"User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:50.0) Gecko/20100101 Firefox/50.0\" \
          -H \"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\" \
          -H \"Accept-Language: en-US,en;q=0.5\" -compressed \
          -H \"Cookie: uitb=p81uFVgYY9K+eFsDD7twAg==; bahasa=id; PHPSESSID=v13s4htukdfd9rhmr2f31gmg97\" \
          -H \"Connection: keep-alive\" \
          -H \"Cache-Control: max-age=0\"";


    $string = shell_exec($query);

    $pos = strpos($string, "Akses e-Journal dan e-Books di");
    echo $string;
  }
?>
