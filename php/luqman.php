<?php
/******************* START VARIABLE *******************/
  $fakultas = array("FSRD");
  $prodi = array("179");
  $nama_kuliah = array("Bahasa Jepang");
  $dosen = array("...");
  $kode_kuliah = array("KU4072");
  $kelas = array("01");

  // ganti cookie di sini
  $cookie = "uitb=p81uFVgYY9K+eFsDD7twAg==; bahasa=id; PHPSESSID=a0jp7idpcultk30o33njmekcc5";
/******************* END OF VARIABLE *******************/

  $n = sizeof($fakultas);
  $udah = array();
  for ($i = 0; $i < $n; $i++) array_push($udah, false);

  while (true) {
    $changes = false;
    $response_all = shell_exec("
      curl \"https://ol.akademik.itb.ac.id/frs/displayJadwalMhs.php\" \
      -H \"Host: ol.akademik.itb.ac.id\" \
      -H \"User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:50.0) Gecko/20100101 Firefox/50.0\" \
      -H \"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\" \
      -H \"Accept-Language: en-US,en;q=0.5\" --compressed \
      -H \"Cookie: ".$cookie."\" \
      -H \"Connection: keep-alive\" \
      -H \"Cache-Control: max-age=0\"
    ");
    $pos = strpos($response_all, "You were redirected to");
    if ($pos) {
      echo "User dengan cookie ini ke-logout. Coba perbarui cookie.\n";
      exit();
    }

    $done = 0;
    for ($i = 0; $i < $n; $i++) {
      // check sudah diambil atau belum, kalo udah yaudah
      if ($udah[$i]) {
        $done++;
        continue;
      }
      $pos = strpos($response_all, $kode_kuliah[$i]);
      if ($pos) {
        $udah[$i] = true;
        continue;
      }

      // check kuliah penuh apa ga, kalo penuh yaudah
      // $string = shell_exec("
      //   curl \"https://ol.akademik.itb.ac.id/frs/editRencanaStudiProdi.php?fakultas=".$fakultas[$i]."&ps=".$prodi[$i]."\" \
      //   -H \"Host: ol.akademik.itb.ac.id\" \
      //   -H \"User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:50.0) Gecko/20100101 Firefox/50.0\" \
      //   -H \"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\" \
      //   -H \"Accept-Language: en-US,en;q=0.5\" --compressed \
      //   -H \"Referer: https://ol.akademik.itb.ac.id/frs/editRencanaStudiProdi.php?fakultas=".$fakultas[$i]."&ps=".$prodi[$i]."\" \
      //   -H \"Cookie: ".$cookie."\" \
      //   -H \"Connection: keep-alive\" \
      //   -H \"Cache-Control: max-age=0\"
      // ");
      // $check_penuh = $kelas[$i]." ".$dosen[$i]." (Penuh)";
      // $pos = strpos($string, $check_penuh);
      // if ($pos) {
      //   echo $nama_kuliah[$i]." penuh!";
      //   continue;
      // }

      // ambil kuliah
      $query =
        "curl \"https://ol.akademik.itb.ac.id/frs/editRencanaStudiProdi.php\" \
        -H \"Host: ol.akademik.itb.ac.id\" \
        -H \"User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:50.0) Gecko/20100101 Firefox/50.0\" \
        -H \"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\" \
        -H \"Accept-Language: en-US,en;q=0.5\" \
        -H \"Referer: https://ol.akademik.itb.ac.id/frs/editRencanaStudiProdi.php\" \
        -H \"Cookie: ".$cookie."\" \
        -H \"DNT: 1\" \
        -H \"Connection: keep-alive\" \
        -H \"Upgrade-Insecure-Requests: 1\" \
        --data \"all_mk\"%\"5B".$kode_kuliah[$i]."\"%\"5D=\
        &ambil\"%\"5B".$kode_kuliah[$i]."\"%\"5D=on\
        &kelas\"%\"5B".$kode_kuliah[$i]."\"%\"5D=".$kelas[$i]."\
        &submit=Ambil\"";
      //echo $query;
      shell_exec($query);

      $changes = true;
    }
    // save rencana kuliah
    if ($changes) {
      $string = shell_exec("
        curl \"https://ol.akademik.itb.ac.id/frs/simpanRencanaStudi.php\" \
        -H \"Host: ol.akademik.itb.ac.id\" \
        -H \"User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:47.0) Gecko/20100101 Firefox/47.0\" \
        -H \"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\" \
        -H \"Accept-Language: en-US,en;q=0.5\" --compressed \
        -H \"Referer: https://ol.akademik.itb.ac.id/frs/simpanRencanaStudi.php\" \
        -H \"Cookie: ".$cookie."\" \
        -H \"Connection: keep-alive\"
      ");
      $pos = strpos($string, "?save=");
      $save_id = substr($string, $pos + 6, 10);

      $query =
        "curl \"https://ol.akademik.itb.ac.id/frs/simpanRencanaStudi.php?save=".$save_id."\" \
        -H \"Host: ol.akademik.itb.ac.id\" \
        -H \"User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:47.0) Gecko/20100101 Firefox/47.0\" \
        -H \"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\" \
        -H \"Accept-Language: en-US,en;q=0.5\" --compressed \
        -H \"Referer: https://ol.akademik.itb.ac.id/frs/simpanRencanaStudi.php\" \
        -H \"Cookie: ".$cookie."\" \
        -H \"Connection: keep-alive\" \
        --data \"submit=Simpan+Rencana+Studi&catatan=\"";
      //echo $query;
      shell_exec($query);
    }
    if ($done == $n) break;
  }
  echo "DONE! SEMUA KULIAH SELESAI DIAMBIL! SELAMAT!";
?>
