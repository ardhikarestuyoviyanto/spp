# INSTALASI 
1. di cmd jalankan git clone https://github.com/ardhikarestuyoviyanto/spp.git atau download file zip nya (klik link tersebut -> get code -> download .ZIP)
2. didalam folder project yang tadi (spp) jalankan composer install (jika belum download composer silahkan download dulu : https://getcomposer.org/)
3. Buat database db_spp (atau boleh dengan nama yang lain)
4. import kan database_spp.sql (jika import database nya error gunakan file db_spp.sql) ke phpmyadmin atau sqlyog
5. masuk ke direktori spp/public/ -> di direktori tersebut extract kan file dist.zip (Download file dist.zip disini: https://drive.google.com/file/d/1ZaXZx2_k_fvgu57M42qyndu0SQMPcINd/view?usp=sharing)
6. buat file .env
7. copaskan isi file .env.example ke file .env
8. didalam project yang tadi (spp) Jalankan aplikasi dengan perintah php spark serve (pakai cmd)
9. akses di browser localhost:8080 

STRUKTUR PROJECT

![Capture](https://user-images.githubusercontent.com/61740978/146667969-efe48dcf-8984-4cf8-9636-9bde3fd6ce14.PNG)
