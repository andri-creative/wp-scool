# Panduan Lengkap MinIO API & Manajemen Server

Dokumentasi ini diletakkan di sini agar Anda tidak lupa tentang cara kerja MinIO di server ini.

## 1. Akses & Kredensial
- **URL Web Console (Manusia/Browser):** `https://minio-console.andri-creative.my.id`
- **URL API S3 (Mesin/Koding):** `https://minio.andri-creative.my.id` (JANGAN BUKA DI BROWSER)
- **Access Key:** `minio`
- **Secret Key:** `admin123`

---

## 2. Kenapa MinIO Susah Dibuat Publik via Web?
MinIO versi terbaru mengunci fitur *Public* di tampilan Web Console mereka demi keamanan tingkat enterprise. Tombol "Public" tidak akan muncul saat Anda membuat bucket baru di web. Anda harus mengaturnya via **Terminal** atau **Kode Aplikasi (SDK)**.

---

## 3. Cara Mengelola Bucket via Terminal
Jika Anda sedang membuka terminal server ini, berikut adalah perintah wajib untuk mengelola bucket tanpa harus pusing dengan Web Console MinIO:

**A. Hubungkan ke MinIO (Lakukan Sekali Saja)**
```bash
docker exec mini_minio mc alias set myminio http://127.0.0.1:9000 minio admin123
```

**B. Membuat Bucket Baru (Contoh: "galeri-klien")**
```bash
docker exec mini_minio mc mb myminio/galeri-klien
```

**C. Menjadikan Bucket Publik (PENTING AGAR GAMBAR BISA DI-GET BROWSER)**
```bash
docker exec mini_minio mc anonymous set download myminio/galeri-klien
```

---

## 4. Cara Menggunakan API (POST, GET, DELETE) di Kodingan
MinIO menggunakan **Protokol AWS S3**. Anda WAJIB menggunakan library `aws-sdk` di aplikasi Anda (contoh di bawah ini menggunakan NodeJS). Aplikasi Anda yang akan otomatis membuat bucket publik & upload gambar.

```javascript
const AWS = require('aws-sdk');

// Konfigurasi Server MinIO Anda
const s3 = new AWS.S3({
    endpoint: 'https://minio.andri-creative.my.id',
    accessKeyId: 'minio',
    secretAccessKey: 'admin123',
    s3ForcePathStyle: true, // WAJIB TRUE!
    signatureVersion: 'v4'
});

const namaBucket = 'galeri-otomatis';

// 1. Fungsi Membuat Bucket & Langsung Jadi Publik!
async function buatBucket() {
    await s3.createBucket({ Bucket: namaBucket }).promise();
    
    const policy = {
        Version: "2012-10-17",
        Statement: [{
            Effect: "Allow",
            Principal: "*",
            Action: ["s3:GetObject"],
            Resource: [`arn:aws:s3:::${namaBucket}/*`]
        }]
    };
    await s3.putBucketPolicy({ Bucket: namaBucket, Policy: JSON.stringify(policy) }).promise();
}

// 2. Fungsi Upload Gambar (POST)
async function uploadGambar(bufferGambar, namaFile) {
    await s3.putObject({
        Bucket: namaBucket,
        Key: namaFile,
        Body: bufferGambar,
        ContentType: 'image/jpeg'
    }).promise();
    
    // URL Gambar yang bisa diakses publik (GET)
    console.log(`URL: https://minio.andri-creative.my.id/${namaBucket}/${namaFile}`);
}

// 3. Fungsi Hapus Gambar (DELETE)
async function hapusGambar(namaFile) {
    await s3.deleteObject({ Bucket: namaBucket, Key: namaFile }).promise();
}
```
