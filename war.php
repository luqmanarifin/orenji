<?php
  $isFull = true;
  while ($isFull) {
    $string = shell_exec("curl \"https://ol.akademik.itb.ac.id/frs/editRencanaStudiProdi.php?fakultas=FSRD&ps=174\" -H \"Host: ol.akademik.itb.ac.id\" -H \"User-Agent: YOUR USER AGENT\" -H \"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\" -H \"Accept-Language: en-US,en;q=0.5\" —compressed -H \"Referer: https://ol.akademik.itb.ac.id/frs/editRencanaStudiProdi.php?fakultas=STEI&ps=174\" -H \"Cookie: YOUR COOKIE\" -H \"Connection: keep-alive\" -H \"Cache-Control: max-age=0\"");

    $pos = strpos($string, "02 Fadillah (Penuh)");

    if ($pos) {
      echo "Penuh\n";
    } else {
      shell_exec("curl \"https://ol.akademik.itb.ac.id/frs/editRencanaStudiProdi.php?fakultas=FSRD&ps=174\" -H \"Host: ol.akademik.itb.ac.id\" -H \"User-Agent: YOUR USER AGENT\" -H \"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\" -H \"Accept-Language: en-US,en;q=0.5\" —compressed -H \"Referer: https://ol.akademik.itb.ac.id/frs/editRencanaStudiProdi.php?fakultas=FSRD&ps=174\" -H \"Cookie: YOUR COOKIE\" -H \"Connection: keep-alive\" -H \"Cache-Control: max-age=0\" —data \"all_mk\"%\"5BDK3016\"%\"5D=&ambil\"%\"5BDK3016\"%\"5D=on&kelas\"%\"5BDK3016\"%\"5D=02&submit=Ambil\"");

      $simpanrencana = "curl 'https://ol.akademik.itb.ac.id/frs/simpanRencanaStudi.php?save=1470883662' -H 'Host: ol.akademik.itb.ac.id' -H 'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:47.0) Gecko/20100101 Firefox/47.0' -H 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8' -H 'Accept-Language: en-US,en;q=0.5' —compressed -H 'Referer: https://ol.akademik.itb.ac.id/frs/simpanRencanaStudi.php?save=1470883667' -H 'Cookie: YOUR COOKIE' -H 'Connection: keep-alive' —data 'submit=Simpan+Rencana+Studi&catatan='";

      shell_exec($simpanrencana);
      $isFull = false;
      exit();
    }
  }
?>
