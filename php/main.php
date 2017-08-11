<?php
/******************* START VARIABLE *******************/
  $fakultas = array("FSRD", "FSRD");
  $prodi = array(179, 179);
  $id_kuliah_1 = array(35374, 35375);
  $id_kuliah_2 = array(119506, 119502);

  $base_url = "https://akademik.itb.ac.id/app/mahasiswa:13513004+2017-1/registrasi/rencanastudi/35257/adddrop";

  $nim = 13513004;
  $tahun_ajaran = 2017;
  $semester = 1;

  // ganti semua kredensial yang digunakan di bawah
  $id_user = 35257;
  $token = "NjgbGSNWLENSmfFwDnvkoxX2dl1sVNkGgMTYKlHUUgo";
  $cookie = "_ga=GA1.3.388042450.1487818730; uitb=YXIvbFjKVjwvpW2gFTVRAg==; bahasa=id; PHPSESSID=ST-125735-3R5eBvwtyxPChXxyQ2x7-loginitbacid; _gid=GA1.3.494822017.1502342723; _auth=ina; _gat=1";
/******************* END OF VARIABLE *******************/


  $n = sizeof($id_kuliah_1);
  $udah = array();
  for ($i = 0; $i < $n; $i++) array_push($udah, false);

  while (true) {
    // $response_all = shell_exec("
    //   curl \"https://ol.akademik.itb.ac.id/frs/displayJadwalMhs.php\" \
    //   -H \"Host: ol.akademik.itb.ac.id\" \
    //   -H \"User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:50.0) Gecko/20100101 Firefox/50.0\" \
    //   -H \"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\" \
    //   -H \"Accept-Language: en-US,en;q=0.5\" --compressed \
    //   -H \"Cookie: ".$cookie."\" \
    //   -H \"Connection: keep-alive\" \
    //   -H \"Cache-Control: max-age=0\"
    // ");
    // $pos = strpos($response_all, "You were redirected to");
    // if ($pos) {
    //   echo "User dengan cookie ini ke-logout. Coba perbarui cookie.\n";
    //   exit();
    // }

    $done = 0;
    for ($i = 0; $i < $n; $i++) {
      // check sudah diambil atau belum, kalo udah yaudah
      if ($udah[$i]) {
        $done++;
        continue;
      }

      // ambil kuliah
      $query =
        "curl 'https://akademik.itb.ac.id/app/mahasiswa:$nim+$tahun_ajaran-$semester/registrasi/rencanastudi/35257/adddrop' \
        -H 'Host: akademik.itb.ac.id' \
        -H 'User-Agent: Mozilla/5.0 (X11; Linux x86_64; rv:54.0) Gecko/20100101 Firefox/54.0' \
        -H 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8' \
        -H 'Accept-Language: en-US,en;q=0.5' --compressed \
        -H 'Content-Type: application/x-www-form-urlencoded' \
        -H 'Referer: https://akademik.itb.ac.id/app/mahasiswa:$nim+$tahun_ajaran-$semester/registrasi/$id_user/matakuliah/prodi?mata_kuliah_id=$id_kuliah_1[$i]&fakultas=$fakultas[$i]&prodi=$prodi[$i]' \
        -H 'Cookie: $cookie' \
        -H 'Connection: keep-alive' \
        -H 'Upgrade-Insecure-Requests: 1' --data 'form%5Badd%3A$id_kuliah_2[$i]%5D=&form%5B_token%5D=$token'";

      // echo $query;
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
<!-- 
curl 'https://akademik.itb.ac.id/app/mahasiswa:13513004+2017-1/registrasi/rencanastudi/35257/adddrop' -H 'Host: akademik.itb.ac.id' -H 'User-Agent: Mozilla/5.0 (X11; Linux x86_64; rv:54.0) Gecko/20100101 Firefox/54.0' -H 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8' -H 'Accept-Language: en-US,en;q=0.5' --compressed -H 'Content-Type: application/x-www-form-urlencoded' -H 'Referer: https://akademik.itb.ac.id/app/mahasiswa:13513004+2017-1/registrasi/35257/matakuliah/prodi?mata_kuliah_id=35374&fakultas=FSRD&prodi=179' -H 'Cookie: _ga=GA1.3.388042450.1487818730; uitb=YXIvbFjKVjwvpW2gFTVRAg==; bahasa=id; PHPSESSID=ST-125735-3R5eBvwtyxPChXxyQ2x7-loginitbacid; _gid=GA1.3.494822017.1502342723; _auth=ina; _gat=1' -H 'Connection: keep-alive' -H 'Upgrade-Insecure-Requests: 1' --data 'form%5Badd%3A%5D=&form%5B_token%5D=NjgbGSNWLENSmfFwDnvkoxX2dl1sVNkGgMTYKlHUUgo'

curl 'https://akademik.itb.ac.id/app/mahasiswa:13513004+2017-1/registrasi/rencanastudi/35257/adddrop' -H 'Host: akademik.itb.ac.id' -H 'User-Agent: Mozilla/5.0 (X11; Linux x86_64; rv:54.0) Gecko/20100101 Firefox/54.0' -H 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8' -H 'Accept-Language: en-US,en;q=0.5' --compressed -H 'Content-Type: application/x-www-form-urlencoded' -H 'Referer: https://akademik.itb.ac.id/app/mahasiswa:13513004+2017-1/registrasi/35257/matakuliah/prodi?mata_kuliah_id=35375&fakultas=FSRD&prodi=179' -H 'Cookie: ' -H 'Connection: keep-alive' -H 'Upgrade-Insecure-Requests: 1' --data 'form%5Badd%3A%5D=&form%5B_token%5D=' -->