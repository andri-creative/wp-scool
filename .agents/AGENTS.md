# Aturan Pengembangan Tema SekolahKu

## Aturan Penting tentang UI/Desain

- **DILARANG MERUSAK ATAU MENGUBAH UI/DESAIN**: Jangan mengubah tata letak, warna, gaya (CSS/JS), atau struktur visual dari tema `sekolahku-theme` kecuali ada instruksi eksplisit dari pengguna.
- **Konsistensi Desain**: Semua perubahan fungsional atau perbaikan bug harus tetap mempertahankan tampilan antarmuka (UI) asli yang sudah ada. Jangan menghapus atau mengubah style utama di `style.css` atau `assets/css/main.css`.
- **Modifikasi PHP**: Jika melakukan modifikasi kode PHP, pastikan elemen HTML dan kelas CSS (class names) yang digunakan untuk styling tidak diubah atau dihapus agar tampilan tidak berantakan (broken).

## ⚠️ ATURAN WAJIB: PLAN DULU, BARU BUILD

- **WAJIB MODE PLAN TERLEBIH DAHULU**: Setiap kali pengguna memberikan instruksi atau permintaan apapun — baik fitur baru, perbaikan bug, perubahan UI, maupun revisi kecil sekalipun — AI **HARUS** selalu membuat rencana implementasi (implementation plan) terlebih dahulu dan menunggu persetujuan eksplisit dari pengguna sebelum melakukan perubahan kode apapun.
- **DILARANG LANGSUNG BUILD**: Tidak boleh langsung mengeksekusi/menulis perubahan kode tanpa menyusun rencana implementasi terlebih dahulu dan mendapatkan persetujuan pengguna.
- **BERLAKU KAPAN SAJA**: Aturan ini berlaku untuk semua sesi, semua waktu (hari ini, besok, kapanpun), dan untuk semua AI yang membaca file ini. Tidak ada pengecualian.
- **ALUR WAJIB**: `Terima instruksi → Buat rencana → Tunggu persetujuan → Baru build/eksekusi`
