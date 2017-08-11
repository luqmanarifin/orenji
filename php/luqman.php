<?php
/********************* CONSTANTS *********************/
  $fakultas = array("STEI", "STEI");
  $prodi = array(135, 135);
  $id_kuliah_1 = array(34914, 34917);
  $id_kuliah_2 = array(124459, 124465);

  $nim = 13513024;
  $tahun_ajaran = 2017;
  $semester = 1;

  // ganti semua kredensial yang digunakan di bawah
  $id_user = 119339;
  $token = "ZecVaQyecsBThGPAic6u3O5bosXEmH8lXSNeN0Vvwy0";
  $cookie = "_ga=GA1.3.1178402783.1502422848; uitb=s1~CgoDC1mNJ0NyXlnaB8TGAg==; bahasa=id; PHPSESSID=ST-132725-tDlaaT1JoG2gupqzKTKz-loginitbacid; _gid=GA1.3.934585257.1502422848; _auth=ina; _gat=1";
/****************** END OF CONSTANTS ******************/

  $host = "akademik.itb.ac.id";
  $base_url = "https://$host/app/mahasiswa:$nim+$tahun_ajaran-$semester/registrasi/rencanastudi";
  $base_header = "-H 'Host: $host' \
                  -H 'User-Agent: Mozilla/5.0 (X11; Linux x86_64; rv:54.0) Gecko/20100101 Firefox/54.0' \
                  -H 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8' \
                  -H 'Accept-Language: en-US,en;q=0.5' --compressed \
                  -H 'Cookie: $cookie' \
                  -H 'Connection: keep-alive' \
                  -H 'Upgrade-Insecure-Requests: 1'";

  $n = sizeof($id_kuliah_1);
  $udah = array();
  for ($i = 0; $i < $n; $i++) array_push($udah, false);

  while (true) {
    $response_all = shell_exec("
      curl '$base_url' \
      $base_header \
      -H 'Referer: https://akademik.itb.ac.id/?context=mahasiswa%3A$nim'");
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

      // ambil kuliah
      $query =
        "curl '$base_url/$id_user/adddrop' \
        $base_header \
        -H 'Referer: https://akademik.itb.ac.id/app/mahasiswa:$nim+$tahun_ajaran-$semester/registrasi/$id_user/matakuliah/prodi?mata_kuliah_id=$id_kuliah_1[$i]&fakultas=$fakultas[$i]&prodi=$prodi[$i]' \
        -H 'Content-Type: application/x-www-form-urlencoded' \
        --data 'form%5Badd%3A$id_kuliah_2[$i]%5D=&form%5B_token%5D=$token'";

      $response = shell_exec($query);
      $pos = strpos($response, "Kelas penuh");
      if ($pos !== false) {
        $udah[$i] = true;        
      } else {
        echo "\n\nKelas penuh\n\n";
      }
    }

    if ($done == $n) break;
  }
  echo "DONE! SEMUA KULIAH SELESAI DIAMBIL! SELAMAT!";
?>