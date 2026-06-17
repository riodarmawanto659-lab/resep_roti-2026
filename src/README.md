# Roti Mix - Sistem Resep Roti

Project Laravel + Filament untuk mengelola resep roti, kategori, bahan, detail takaran, dan tampilan katalog resep.

## Perubahan desain

- Tema warna baru: cream, karamel, golden brown, dan cokelat agar sesuai dengan karakter roti mix.
- Layout frontend dibuat ulang menggunakan Blade layout, partial navbar, footer, dan recipe card.
- Animasi ditambahkan untuk hero, reveal on scroll, counter statistik, parallax halus, tombol simpan resep, dan back to top.
- Halaman katalog, kategori, detail resep, dan beranda dibuat konsisten.

## Perubahan logic

- Query database di Blade dipindahkan ke controller.
- Resep draft tidak ditampilkan di frontend karena memakai scope `published()`.
- Search resep lebih fleksibel karena mencari nama resep, deskripsi, dan kategori.
- Filter kategori dirapikan dengan selected state.
- Related recipes diproses di controller, bukan di view.
- Seeder dibuat lebih lengkap dan idempotent menggunakan `updateOrCreate()`.

## Cara menjalankan

```bash
cp src/.env.example src/.env
# sesuaikan konfigurasi database di .env

docker compose up -d --build
docker compose exec php composer install
docker compose exec php php artisan key:generate
docker compose exec php php artisan migrate:fresh --seed
docker compose exec php php artisan storage:link
```

Frontend memakai Tailwind CDN dan asset `public/front`, jadi tampilan publik tetap berjalan tanpa harus build Vite. Admin Filament tetap mengikuti konfigurasi project Laravel yang sudah ada.
