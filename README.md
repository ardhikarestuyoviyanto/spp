# INSTALASI 
1. di cmd jalankan git clone https://github.com/ardhikarestuyoviyanto/spp.git atau download file zip nya (klik link tersebut -> get code -> download .ZIP)
2. didalam folder project yang tadi (spp) jalankan composer install (jika belum download composer silahkan download dulu : https://getcomposer.org/)
3. Buat database db_spp (atau boleh dengan nama yang lain)
4. import kan database_spp.sql (jika import database nya error gunakan file db_spp.sql -> UDAH ADA DI GRUB) ke phpmyadmin atau sqlyog
5. masuk ke direktori spp/public/ -> di direktori tersebut extract kan file dist.zip (ADA DI GRUB)
6. buat file .env
7. copaskan isi file .env.example ke file .env
8. didalam project yang tadi (spp) Jalankan aplikasi dengan perintah php spark serve (pakai cmd)
9. akses di browser localhost:8080 

STRUKTUR PROJECT

![Capture](https://user-images.githubusercontent.com/61740978/146667969-efe48dcf-8984-4cf8-9636-9bde3fd6ce14.PNG)

# MIDTRANS KONFIGURASI
1. Silahkan daftar dulu di midtrans (GRATIS KOK) : https://dashboard.midtrans.com/register 
2. Setelah daftar, dibagian sidebar midtrans atur enviroment nya menjadi SANDBOX, seperti gambar dibawah
![1](https://user-images.githubusercontent.com/61740978/147081798-10f80f80-54d0-44d1-be1f-3ea92c8d17d7.PNG)
3. Masuk ke menu Setting -> Access Key (di laman dashboard midtrans) seperti gambar dibawah :
![2](https://user-images.githubusercontent.com/61740978/147083141-ff637bef-d615-444b-94b1-660071aa621e.png)
4. di file .env settingkan konfigurasi sesuai Access Key anda di midtrans, seperti gambar dibawah :
![3](https://user-images.githubusercontent.com/61740978/147083349-4b8418d1-b6a8-4888-a126-acecbf8da4c7.PNG)

MIDTRANS_MERCH_ID='ISI SESUAI DI MIDTRANS'<br>
MIDTRANS_CLIENT_KEY='ISI SESUAI DI MIDTRANS'<br>
MIDTRANS_SERVER_KEY='ISI SESUAI DI MIDTRANS'<br>

