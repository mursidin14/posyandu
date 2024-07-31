## Layanan Sistem Informasi Posyandu Melati II

Fitur Sistem:
- Dashboard
- Data Balita
- Data Ibu
- Data Ayah
- Data Imunisasi 
- Data Penimbangan
- Data Kelahiran
- Data Jadwal Pelayanan
- Laporan

Sistem Ini Terbagi Menjadi 2 Role, Admin dan Kader:

- Admin
email: admin@gmail.com
pass: 1234

- Kader
email: kader@gmail.com
pass: 12345678

tata cara instal
download / git clone -> composer install -> cp .env.example .env -> php artisan key:generate -> php artisan migrate:refresh -> php artisan db:seed -> php artisan serve
