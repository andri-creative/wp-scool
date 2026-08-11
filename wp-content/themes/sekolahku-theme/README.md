# Tema WordPress "SekolahKu"

Tema orisinal untuk website sekolah, dibuat manual dengan PHP, HTML, CSS, dan JS murni (tanpa framework/page builder). Terinspirasi dari konsep tema sekolah pada umumnya (hero, statistik, berita, galeri, PPDB), namun seluruh kode dan desain dibuat dari nol — bukan hasil salinan tema premium mana pun.

## Cara Instalasi

1. Kompres folder `sekolahku-theme` menjadi file `.zip` (jika belum).
2. Masuk ke **Dashboard WordPress > Appearance > Themes > Add New > Upload Theme**.
3. Unggah file zip tersebut, lalu klik **Activate**.

## Setelah Aktivasi

1. **Menu Utama**
   Buka `Appearance > Menus`, buat menu baru, tambahkan halaman (Beranda, Profil Sekolah, Berita, Galeri, PPDB & Kontak), lalu set lokasi menu ke **Menu Utama**.

2. **Buat Halaman & Pasang Template**
   Buat 3 halaman baru di `Pages > Add New`, lalu di panel kanan **Page Attributes > Template**, pilih:
   - Halaman "Profil Sekolah" → Template **Profil Sekolah**
   - Halaman "Galeri" → Template **Galeri Sekolah**
   - Halaman "PPDB & Kontak" → Template **PPDB & Kontak**

3. **Set Halaman Depan**
   Buka `Settings > Reading`, pilih **"A static page"**, dan set Homepage ke halaman manapun (tema otomatis memakai `front-page.php` sebagai homepage).

4. **Isi Berita**
   Gunakan menu **Posts** bawaan WordPress untuk menulis berita/kegiatan sekolah. Jangan lupa set Featured Image agar tampil di kartu berita.

5. **Isi Konten via Custom Post Type**
   Di sidebar dashboard akan muncul beberapa menu baru untuk mengisi konten khusus website sekolah:
   - **Pengumuman** — info resmi sekolah (tampil di Beranda & punya halaman arsip sendiri)
   - **Agenda** — jadwal kegiatan. Saat menambah agenda baru, isi juga kotak "Detail Agenda" (tanggal, jam, lokasi) di sisi kanan editor
   - **Program Keahlian** — daftar jurusan/program studi, lengkapi dengan Featured Image
   - **Staf & Guru** — profil pengajar, gunakan kolom Excerpt untuk jabatan singkat (mis. "Guru Bahasa Indonesia")
   - **Fasilitas Sekolah** — sarana/prasarana sekolah
   - **Ekstrakurikuler** — isi juga kotak "Detail Ekstrakurikuler" (nama pembina, jumlah anggota) di sisi kanan editor
   - **Testimoni** — isi kesan/pesan di kolom Editor, dan nama/status pemberi testimoni di kolom Judul
   - **Galeri Sekolah** — foto dokumentasi kegiatan

6. **Isi Berita**
   Gunakan menu **Posts** bawaan WordPress untuk menulis berita/kegiatan sekolah. Jangan lupa set Featured Image agar tampil di kartu berita.

7. **Atur Hero, Statistik, Sambutan, dan Kontak**
   Buka `Appearance > Customize`:
   - **Hero Beranda** — judul, subjudul, gambar latar
   - **Statistik Sekolah** — akreditasi, jumlah siswa, guru, ekstrakurikuler, jurusan
   - **Sambutan Kepala Sekolah** — foto, teks sambutan, nama kepala sekolah
   - **Info Kontak & PPDB** — alamat, telepon, email, jam layanan
   - **Sosial Media** — link Facebook, Instagram, YouTube, WhatsApp (tampil di top bar & footer)
   - **Colors** — warna utama tema

8. **Logo**
   Atur logo sekolah lewat `Appearance > Customize > Site Identity > Logo`.

## Struktur File

```
sekolahku-theme/
├── style.css                     # Header tema + design tokens
├── functions.php                 # Setup tema, menu, CPT, form kontak
├── header.php / footer.php
├── front-page.php                # Homepage
├── page.php                      # Halaman biasa (tanpa template khusus)
├── single.php / archive.php      # Detail & daftar Berita
├── search.php / index.php        # Fallback
├── sidebar.php
├── page-templates/
│   ├── template-profil.php       # Template: Profil Sekolah
│   ├── template-galeri.php       # Template: Galeri Sekolah
│   └── template-kontak.php       # Template: PPDB & Kontak
├── template-parts/
│   └── content-card.php          # Partial kartu berita
├── inc/
│   ├── customizer.php            # Opsi di Appearance > Customize
│   └── template-tags.php         # Fungsi bantuan (breadcrumb, meta)
└── assets/
    ├── css/main.css
    └── js/main.js
```

## Catatan Penting

- **Form kontak** memakai `wp_mail()` bawaan WordPress. Pastikan hosting mendukung pengiriman email, atau gunakan plugin SMTP (misalnya WP Mail SMTP) agar email tidak masuk folder spam. Untuk validasi/anti-spam lebih matang, pertimbangkan plugin form seperti Contact Form 7.
- **Peta lokasi** di halaman Kontak masih memakai contoh embed Google Maps — ganti `src` iframe dengan lokasi sekolah Anda.
- Tema ini belum menyertakan `screenshot.png` (opsional, hanya tampil di halaman pilih tema) — silakan tambahkan gambar 1200x900px bernama `screenshot.png` di folder root tema jika diinginkan.



