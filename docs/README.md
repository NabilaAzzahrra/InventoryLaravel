![](/images/lan.jpg ':size=1300')
---

# Deskripsi Umum

>Inventory Application Web ini merupakan aplikasi yang digunakan untuk mengatur, mengolah, serta memantau ketersediaan dan penggunaan inventaris yang ada di Politeknik LP3I Kampus Tasikmalaya secara real-time. Aplikasi ini menyediakan fitur yang lengkap untuk Administrator Inventaris Kampus serta Administrator Koleksi Perpustakaan.

---

## Fitur

**1. Manajemen Database Inventory**

Fitur ini digunakan untuk **mengelola data inventory**, baik **inventory masuk** ataupun **inventory keluar**.

- Search Data / Filter Data
- Detail inventory
- Faktur pembelian inventory
- Excel Generator (.xlsx)
- Print Qr-Code inventory
- Peminjaman barang (inventory)
- Validasi WhatsApp Bot

**2. Manajemen Database Koleksi Perpustakaan**

Fitur ini digunakan untuk **mengelola data koleksi**, baik **koleksi keluar** ataupun **koleksi masuk**.

- Search Data / Filter Data
- Detail koleksi
- Detail anggota kelompok (Koleksi Kuliah Kerja Nyata)
- Excel Generator (.xlsx)
- Print Qr-Code koleksi

**3. Manajemen Akun**

Fitur ini digunakan untuk **mengelola akun** administrator inventory dan administrator koleksi perpustakaan

- Authentication Laravel (Session)

---

## Penunjang

1. PHP versi V 8.0.19,
2. Composer,
3. NodeJs versi minimal v.18.13.0-x64.msi keatas atau [Klik disini](https://nodejs.org/en ':target=_blank')
4. Axios, untuk install cukup ketik ``npm i axios`` pada terminal project yang ditentukan

---

## Database

Database sudah dibuatkan melalui ``migration laravel``. Silahkan untuk melihat di folder ``database/migrations``.

---

## Instalasi

1. Clone aplikasi dari Github
  ```bash
  git clone https://github.com/NabilaAzzahrra/InventoryLaravel
  ```
2. Lakukan ``composer install`` untuk mengunduh **vendor**.
  ```bash
  cd InventoryLaravel
  composer install
  ```
3. Lakukan ``npm install`` untuk mengunduh **node_modules**.
  ```bash
  npm install
  ```
4. Ubah file ``.env`` dan ubah database beserta username dan passwordnya.
5. Lakukan migration dan seeding untuk membuat table di database dan data dummy.
  ```bash
  php artisan migrate
  php artisan db:seed
  ```

---

# User Interface

---

## Landing

![](/images/Landing.jpg ':size=1300')

---

## Administrator Inventory Kampus

![](/images/inven.jpg ':size=1300')

---

## Administrator Koleksi Perpustakaan

![](/images/koleksi.jpg ':size=1300')

---

# License

Aplikasi ini adalah perangkat lunak berpemilik dan tidak bersifat open source. Semua hak dilindungi. [nabilaaazzahrraa@gmail.com](mailto:nabilaaazzahrraa@gmail.com).
