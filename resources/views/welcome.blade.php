<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaporPublik — Suarakan Masalah Fasilitas Publik</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">LaporPublik</h1>
            <div class="space-x-6">
                <a href="#fitur" class="hover:text-blue-600">Fitur</a>
                <a href="#tentang" class="hover:text-blue-600">Tentang</a>
                <a href="#kontak" class="hover:text-blue-600">Kontak</a>
                <a href="{{ route('login') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Masuk</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section
        class="h-[600px] item-center justify-center m-auto flex flex-col bg-gradient-to-br from-blue-600 to-blue-500 text-white text-center">
        <div class="max-w-3xl mx-auto px-6">
            <h2 class="text-4xl md:text-5xl font-extrabold mb-4">Suarakan Masalah Fasilitas Publik di Sekitar Anda</h2>
            <p class="text-lg text-blue-100 mb-8">Laporkan kerusakan jalan, lampu, jembatan, atau fasilitas umum lainnya
                dengan mudah dan cepat melalui aplikasi LaporPublik.</p>
            <div class="space-x-4">
                <a href="{{ route('login') }}"
                    class="bg-white text-blue-700 font-semibold px-6 py-3 rounded-xl shadow hover:bg-blue-100 transition">Laporkan
                    Masalah</a>
                <a href=""
                    class="border border-white px-6 py-3 rounded-xl font-semibold hover:bg-white hover:text-blue-700 transition">Lihat
                    Laporan</a>
            </div>
        </div>
    </section>

    <!-- Fitur Section -->
    <section id="fitur" class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold mb-10">Fitur Unggulan</h3>
            <div class="grid md:grid-cols-3 gap-10">
                <div class="p-6 bg-gray-50 rounded-2xl shadow-sm hover:shadow-lg transition">
                    <div class="text-blue-600 text-5xl mb-4">📸</div>
                    <h4 class="font-semibold text-xl mb-2">Unggah Foto Laporan</h4>
                    <p>Tambahkan bukti visual agar laporan lebih valid dan cepat ditindaklanjuti.</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-2xl shadow-sm hover:shadow-lg transition">
                    <div class="text-blue-600 text-5xl mb-4">📍</div>
                    <h4 class="font-semibold text-xl mb-2">Lokasi Otomatis</h4>
                    <p>Sistem mendeteksi lokasi Anda untuk mempermudah pelaporan area publik tertentu.</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-2xl shadow-sm hover:shadow-lg transition">
                    <div class="text-blue-600 text-5xl mb-4">⚡</div>
                    <h4 class="font-semibold text-xl mb-2">Pemrosesan Cepat</h4>
                    <p>Laporan langsung dikirim ke instansi terkait untuk ditindaklanjuti dengan cepat.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Section -->
    <section id="tentang" class="py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold mb-6">Tentang LaporPublik</h3>
            <p class="text-lg leading-relaxed text-gray-600">
                <strong>LaporPublik</strong> adalah platform digital untuk menampung aspirasi masyarakat terhadap
                fasilitas publik yang rusak, tidak berfungsi, atau membutuhkan perhatian pemerintah.
                Aplikasi ini dirancang agar masyarakat dapat berpartisipasi aktif menjaga lingkungan dan fasilitas umum
                dengan mudah.
            </p>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold mb-6">Hubungi Kami</h3>
            <p class="text-gray-600 mb-8">Ada pertanyaan atau kendala? Silakan hubungi kami melalui email di bawah ini.
            </p>
            <a href="mailto:support@laporpublik.test"
                class="text-blue-600 font-semibold text-lg hover:underline">support@laporpublik.test</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-6 text-center">
        <p>© {{ date('Y') }} LaporPublik. Semua Hak Dilindungi.</p>
    </footer>

</body>

</html>
