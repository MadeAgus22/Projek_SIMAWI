## **📌 SIMAWI (Sistem Manajemen Rumah Sakit)**
### **📖 Deskripsi Proyek**
**SIMAWI** adalah sistem manajemen rumah sakit berbasis web yang memungkinkan **admin dan dokter** untuk mengelola data pasien, mencatat rekam medis, serta mencari dan mencatat kode diagnosis ICD-10 dari WHO API.

## **📌 Penggunaan Aplikasi**
### **🔹 Login**
- **URL Admin & Dokter:**  
  ```
  http://149.129.246.226/simawi/
  ```
- **Akun Default:**
  - **Admin**  
    **Username:** `admin`  
    **Password:** `admin123`
  - **Dokter**  
    **Username:** `dokter1`  
    **Password:** `dokter123`

    ---

### **🔹Registrasi Pasien**
- **Admin dapat menambahkan pasien baru di menu "Registrasi Pasien".**
- **Nomor Rekam Medis (RM) otomatis dibuat berdasarkan pasien terakhir.**

### **🔹 Rekam Medis**
- **Dokter dapat melihat daftar pasien yang belum dilayani.**
- **Gunakan pencarian ICD-10 dengan mengetik minimal 2 huruf.**
- **Pilih kode ICD untuk melihat deskripsi penyakit.**

---

## **📌 1. Fitur Utama**
### 🔹 **1. Manajemen User**
- **Admin** dapat menambahkan, mengedit, dan menghapus pengguna (Admin & Dokter).
- **Dokter** hanya memiliki akses untuk melihat dan mengelola rekam medis pasien.

### 🔹 **2. Registrasi Pasien**
- **Admin** dapat mendaftarkan pasien baru dan lama.
- **Nomor Rekam Medis (RM)** dihasilkan otomatis berdasarkan urutan terakhir di database.

### 🔹 **3. Rekam Medis Pasien**
- **Dokter** dapat mencatat gejala, diagnosa awal, dan menggunakan **WHO ICD-10 API** untuk mencari kode penyakit.
- **Detail ICD-10** ditampilkan setelah memilih kode penyakit.

### 🔹 **4. Dashboard & Statistik**
- **Admin** dapat melihat statistik jumlah pasien dan daftar penyakit ICD-10 yang paling sering dicatat.
- **Dokter** dapat melihat daftar pasien yang belum dilayani.

---

## **📌 2. Instalasi dan Konfigurasi**
### **🔹 2.1. Persyaratan Sistem**
- PHP **7.4+** atau lebih baru
- MySQL **5.7+** atau lebih baru
- Apache **2.4+** (mod_rewrite harus aktif)
- CodeIgniter **3.1.13**
- Hosting yang mendukung **cPanel** atau **VPS**

---

### **🔹 2.2. Langkah Instalasi**
#### **1️⃣ Clone Repository**
```sh
git clone https://github.com/MadeAgus22/Projek_SIMAWI.git
```

#### **2️⃣ Buat Database & Import Struktur**
1. **Buka `phpMyAdmin` atau gunakan MySQL CLI**:
```sql
CREATE DATABASE simawi;
USE simawi;
```
2. **Import file SQL ke dalam database** (contoh: `simawi.sql` di dalam repository).

#### **3️⃣ Konfigurasi Database**
📌 **Edit `application/config/database.php`** dan sesuaikan dengan database yang dibuat:
```php
$db['default'] = array(
    'dsn'   => '',
    'hostname' => 'localhost',
    'username' => 'root',  // Ganti dengan user MySQL Anda
    'password' => '',      // Ganti dengan password MySQL Anda
    'database' => 'simawi',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
);
```

#### **4️⃣ Konfigurasi `base_url`**
📌 **Edit `application/config/config.php`**:
```php
$config['base_url'] = 'https://tonidev.my.id/'; // golive
$config['index_page'] = '';
$config['uri_protocol'] = 'REQUEST_URI';
```

#### **5️⃣ Konfigurasi WHO ICD API**
📌 **Edit `application/controllers/ICD_API.php`**, lalu tambahkan API Key:
```php
private $client_id = "YOUR_CLIENT_ID";
private $client_secret = "YOUR_CLIENT_SECRET";
```
📌 **Dapatkan API Key di WHO ICD API:**  
🔗 [https://icd.who.int/icdapi](https://icd.who.int/icdapi)

saat ini masih gagal mendapatkan kode ICD10

---

## **📌 3. Deployment ke Hosting**
### 🔹 **3.1. Upload ke cPanel**
1. **Masuk ke cPanel** → **File Manager** → **public_html/**.
2. **Upload semua file CodeIgniter ke `public_html/`.**
3. **Pastikan `index.php` dan `.htaccess` ada di `public_html/`.**

### 🔹 **3.2. Konfigurasi `.htaccess`**
📌 **Buka `public_html/.htaccess`**, lalu tambahkan:
```apache
RewriteEngine On
RewriteBase /

# Hapus index.php dari URL
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]
```

---

## **📌 5. API Endpoint (Opsional)**
Jika ingin mengakses data pasien melalui API:
```
GET https://tonidev.my.id/api/patients
```
### **🔹 Response Example**
```json
{
    "id": 1,
    "name": "Budi Santoso",
    "medical_record_number": "RM0001",
    "age": 30,
    "gender": "male",
    "phone": "08123456789",
    "address": "Jl. Merdeka No. 10, Jakarta",
    "icd_code": "J00",
    "icd_description": "Nasopharyngitis akut [flu biasa]"
}
```
✔ **Tambahkan autentikasi untuk keamanan API jika dibutuhkan.**

---

## **📌 6. Troubleshooting**
**❓ Masalah:** **404 Not Found saat membuka `https://tonidev.my.id/admin/register_patient`**  
✔ **Solusi:**  
- Pastikan function **`register_patient()`** ada di **`Admin.php`**.
- Pastikan file **`register_patient.php`** ada di **`application/views/admin/`**.
- Tambahkan route di **`routes.php`**:
```php
$route['admin/register_patient'] = 'admin/register_patient';
```
- Jika masih error, coba akses dengan:
  ```
  https://tonidev.my.id/index.php/admin/register_patient
  ```
  Jika ini berhasil, `.htaccess` belum dikonfigurasi dengan benar.

---

## **📌 7. Teknologi yang Digunakan**
- **CodeIgniter 3** – Framework PHP MVC
- **MySQL** – Database pasien & rekam medis
- **Bootstrap 5** – Tampilan UI responsif
- **WHO ICD-10 API** – Untuk pencarian kode penyakit
- **Ngrok (Opsional)** – Untuk akses dari internet ke localhost

---

## **📌 8. Kontribusi**
1. **Fork repo ini** di GitHub.
2. **Buat branch baru:**  
   ```sh
   git checkout -b feature-nama-fitur
   ```
3. **Commit perubahan:**  
   ```sh
   git commit -m "Menambahkan fitur baru"
   ```
4. **Push ke GitHub dan buat Pull Request.**

---

## **📌 9. Lisensi**
Proyek ini dilindungi di bawah **MIT License**.  
Silakan gunakan dan kembangkan sesuai kebutuhan. 🚀

---

🚀 **Coba sekarang dan beri tahu saya jika masih ada kendala!** 🚀
## Menu Dashboard
<img width="995" height="611" alt="image" src="https://github.com/user-attachments/assets/84848564-1b90-4301-9fc7-4fee5124c97c" />

## Menu Regristrasi Pasien
<img width="953" height="603" alt="image" src="https://github.com/user-attachments/assets/210bff1e-c562-4bf5-a97e-a7871b900abb" />

## Menu Manajemen User
<img width="984" height="605" alt="image" src="https://github.com/user-attachments/assets/998609d6-e181-491c-81e8-f0faaf28f589" />
<img width="991" height="414" alt="image" src="https://github.com/user-attachments/assets/c597ba7d-7399-497e-bcbf-69df657d2acc" />

## Menu Dokter (Rekam Medis)
<img width="999" height="586" alt="image" src="https://github.com/user-attachments/assets/d9aa1943-7cb6-449a-87f7-d4679d93f128" />
<img width="1056" height="572" alt="image" src="https://github.com/user-attachments/assets/43d62a37-daa2-4189-afe8-105b2caff672" />
<img width="983" height="544" alt="image" src="https://github.com/user-attachments/assets/fac31980-fade-41f6-a44c-a323da9fbd25" />
<img width="985" height="501" alt="image" src="https://github.com/user-attachments/assets/793b74b8-73d1-4579-a48c-30f6df1cb012" />









