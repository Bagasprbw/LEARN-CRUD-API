# 🧩 Laravel + Vue 3 CRUD Produk

Proyek ini adalah aplikasi **CRUD Produk (Create, Read, Update, Delete)** menggunakan **Laravel (Backend API)** dan **Vue 3 (Frontend SPA)**.

---

## 🚀 Fitur Utama

✅ Menampilkan daftar produk  
✅ Menambah produk baru  
✅ Mengedit data produk  
✅ Menghapus produk  
✅ Menyimpan kategori produk  
✅ Komunikasi antara frontend dan backend via REST API (Axios)

---

## 🗂️ Struktur Proyek

📦 project-root/
├── be-lrv/ # Folder Laravel API
│ ├── app/
│ ├── routes/
│ ├── database/
│ └── ...
│
└── fe-vue/ # Folder Vue 3
├── src/
├── public/
└── ...


---

## ⚙️ 1. Persiapan

### Pastikan kamu sudah menginstal:
- [Node.js](https://nodejs.org/) (versi 18+)
- [Composer](https://getcomposer.org/)
- [PHP 8+](https://www.php.net/)
- [MySQL](https://www.mysql.com/) atau database lain yang didukung Laravel

---

## 🖥️ 2. Setup Backend (Laravel API)

Masuk ke folder `backend`:

```bash
cd be-lrv

🔹 Install dependensi
composer install

🔹 Salin file environment
cp .env.example .env

🔹 Generate key Laravel
php artisan key:generate

🔹 Atur koneksi database di file .env

Contoh:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crud_vue_laravel
DB_USERNAME=root
DB_PASSWORD=

🔹 Jalankan migrasi dan seeder (opsional)
php artisan migrate

🔹 Jalankan server Laravel
php artisan serve


Laravel akan berjalan di:

http://127.0.0.1:8000


Pastikan endpoint tes API bisa diakses di browser:

http://127.0.0.1:8000/api/test


Jika muncul pesan "API is working fine!", berarti backend siap. ✅

💻 3. Setup Frontend (Vue 3)

Masuk ke folder frontend:

cd frontend

🔹 Install dependensi
npm install

🔹 Jalankan server pengembangan
npm run dev


Frontend biasanya berjalan di:

http://localhost:5173

🔗 4. Hubungkan Frontend & Backend

Pastikan file frontend/src/services/api.js berisi base URL ke Laravel API:

import axios from "axios";

const api = axios.create({
  baseURL: "http://127.0.0.1:8000/api", // Pastikan sama dengan URL Laravel kamu
});

export default api;

📦 5. Struktur Frontend (Vue)
src/
 ├── views/
 │   ├── ProductList.vue   # Menampilkan daftar produk
 │   └── ProductForm.vue   # Form tambah/edit produk
 │
 ├── services/
 │   └── api.js            # Axios instance
 │
 └── router/
     └── index.js          # Routing Vue
