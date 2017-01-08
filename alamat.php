<?php
  $query = "curl \"https://ol.akademik.itb.ac.id/frs/validasiAlamatTelepon.php\" \
        -H \"Host: ol.akademik.itb.ac.id\" \
        -H \"User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:50.0) Gecko/20100101 Firefox/50.0\" \
        -H \"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\" \
        -H \"Accept-Language: en-US,en;q=0.5\" -compressed \
        -H \"Cookie: uitb=p81uFVgYY9K+eFsDD7twAg==; bahasa=id; PHPSESSID=v13s4htukdfd9rhmr2f31gmg97\" \
        -H \"Connection: keep-alive\" \
        -H \"Cache-Control: max-age=0\" \
        --data \"nama=Luqman+Arifin+Siswanto\
        &nama_lengkap=Luqman+Arifin+Siswanto\
        &ttl=Surabaya,+4+Oktober+1996\
        &alamat_bdg=Jalan+Ir.+H.+Juanda+484\
        &provinsi_bdg=32\
        &kabupaten_bdg=736\
        &kdpos_bdg=40135\
        &telepon_bdg=085725490950\
        &no_hp=\
        &alamat_drt=Kedinding+Lor+Gang+Teratai+38\
        &provinsi_drt=35\
        &kabupaten_drt=785\
        &kdpos_drt=60129\
        &telepon_drt=08113452007\
        &ekstensi_drt=\
        &alamat_pj=Kedinding+Lor+Gang+Teratai+38\
        &provinsi_pj=35\
        &kabupaten_pj=777\
        &kdpos_pj=60129\
        &telepon_pj=08113452007\
        &ekstensi_pj=\
        &simpan=Simpan\"";

  $string = shell_exec($query);
?>
