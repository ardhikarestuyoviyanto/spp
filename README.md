# INSTALASI 
1. di cmd jalankan git clone https://github.com/ardhikarestuyoviyanto/spp.git atau download file zip nya (klik link tersebut -> get code -> download .ZIP)
2. didalam folder project yang tadi (spp) jalankan composer install (jika belum download composer silahkan download dulu : https://getcomposer.org/)
3. Buat database db_spp (atau boleh dengan nama yang lain)
4. import kan database spp.sql (jika import database nya error gunakan file db_spp.sql -> UDAH ADA DI GRUB) ke phpmyadmin atau sqlyog
5. masuk ke direktori spp/public/ -> di direktori tersebut extract kan file dist.zip (ADA DI GRUB)
6. buat file .env
7. copaskan isi file .env.example ke file .env
8. didalam project yang tadi (spp) Jalankan aplikasi dengan perintah php spark serve (pakai cmd)
9. akses di browser localhost:8080 

STRUKTUR PROJECT

![Capture](https://user-images.githubusercontent.com/61740978/146667940-8f4b8bbf-9a58-4e76-93d5-43f934fef727.PNG)
