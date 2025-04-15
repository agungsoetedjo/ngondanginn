<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
        * {
            font-family: 'Georgia', serif;
        }

        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow-x: hidden;
            background: #f8f9fa;
        }

        .container {
            width: 100%;
            max-width: 560px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .section {
            padding: 20px;
            text-align: center;
            width: 100%;
            background: #fff;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        .cover-section {
            background: linear-gradient(to bottom right, #e0e0e0, #ffffff);
            height: 100vh;
            position: relative;
            display: flex;
            align-items: flex-end;
            padding: 0 20px 60px;
        }

        .invitation-sections {
            background: linear-gradient(to bottom right, #e0e0e0, #ffffff);
            min-height: 100vh;
            padding: 40px 20px 60px;
            display: flex;
            flex-direction: column;
            align-items: center;
            display: none; /* Sembunyikan bagian undangan awalnya */
        }

        .cover-content {
            text-align: left;
        }

        .cover-title {
            font-size: 2rem;
            color: #555;
            margin-bottom: 10px;
        }

        .couple-names {
            font-size: 2.8rem;
            font-weight: bold;
            color: #c2185b;
            margin-bottom: 10px;
        }

        .guest-name {
            font-size: 1.1rem;
            color: #444;
            margin-bottom: 20px;
        }

        .open-btn {
            padding: 8px 10px;
            font-size: 1.2rem;
            background-color: #6a1b9a;
            color: white;
            border: none;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .open-btn:hover {
            background-color: #4a148c;
        }

        @media (max-width: 560px) {
            .couple-names {
                font-size: 2.2rem;
            }

            .guest-name {
                font-size: 1rem;
            }

            .section {
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Cover Section (Tanpa AOS) -->
        <div class="cover-section">
            <div class="cover-content" data-aos="zoom-in-up" data-aos-delay="300">
                <div class="cover-title">The Wedding of</div>
                <div class="couple-names">{{ $wedding->bride_name }} & {{ $wedding->groom_name }}</div>
                <div class="guest-name">
                    Kepada Bapak/Ibu/Saudara/i<br><strong>{{ request()->get('to') ?? 'Nama Tamu' }}</strong>
                </div>
                <button class="open-btn" onclick="openInvitation()">Buka Undangan</button>
            </div>
        </div>

        <!-- Wrapper for other sections -->
        <div class="invitation-sections">
            <!-- Second Section: Save the Date -->
            <div class="section save-the-date">
                <h3>Kami berharap Anda menjadi bagian dari hari istimewa kami!</h3>
                <p>Save the Date: {{ \Carbon\Carbon::parse($wedding->reception_date)->translatedFormat('d F Y') }}</p>
            </div>

            <!-- Third Section: Kata Pengantar -->
            <div class="section kata-pengantar">
                <h3>Dengan penuh suka cita, kami mengundang Anda untuk hadir dalam pernikahan kami.</h3>
                <p>
                    Kami, <strong>{{ $wedding->bride_name }}</strong> dan <strong>{{ $wedding->groom_name }}</strong>, 
                    bersama dengan keluarga besar, yaitu 
                    <strong>{{ $wedding->bride_parent_name }}</strong> (Orang Tua Mempelai Wanita) dan 
                    <strong>{{ $wedding->groom_parent_name }}</strong> (Orang Tua Mempelai Pria), 
                    dengan bahagia mengundang Anda untuk menjadi saksi kebahagiaan kami.
                </p>
            </div>

            <!-- Fourth Section: Akad Nikah & Resepsi -->
            <div class="section akad-section" data-aos="fade-up">
                <h4>Akad Nikah</h4>
                <p>{{ \Carbon\Carbon::parse($wedding->akad_date)->translatedFormat('d F Y H:i') }}</p>
                <h4>Resepsi</h4>
                <p>{{ \Carbon\Carbon::parse($wedding->reception_date)->translatedFormat('d F Y H:i') }}</p>
                <p>Lokasi: {{ $wedding->location }}</p>
            </div>

            <!-- Fifth Section: Amplop Digital -->
            <div class="section amplop-section" data-aos="fade-up">
                <h3>Amplop Digital</h3>
                <p>Untuk memberikan hadiah secara digital, klik tombol di bawah ini:</p>
                <button class="btn btn-success">Beri Hadiah</button>
            </div>

            <!-- Sixth Section: Galeri Foto -->
            <div class="section gallery-section" data-aos="fade-up">
                <h3>Galeri Foto</h3>
                <p>Berikut adalah beberapa foto dari pernikahan kami:</p>
                <div class="row">
                    @foreach($wedding->galleries as $gallery)
                    <div class="col-md-4 mb-3">
                        <img src="{{ asset($gallery->image) }}" alt="Gallery Image">
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Seventh Section: Love Story -->
            <div class="section love-story-section" data-aos="fade-up">
                <h3>Cerita Cinta Kami</h3>
                <p>{{ $wedding->love_story }}</p>
            </div>

            <!-- Eighth Section: RSVP -->
            <div class="section rsvp-section" data-aos="fade-up">
                <h3>RSVP</h3>
                <p>Apakah Anda akan hadir?</p>
                <form action="" method="POST">
                    @csrf
                    <button class="btn btn-primary" name="attendance" value="Yes">Hadir</button>
                    <button class="btn btn-secondary" name="attendance" value="No">Tidak Hadir</button>
                </form>
            </div>

            <!-- Ninth Section: Terima Kasih -->
            <div class="section thank-you" data-aos="fade-up">
                <h3>Terima Kasih</h3>
                <p>Kami sangat menghargai kehadiran Anda di hari istimewa kami.</p>
                <p><em>Salam hangat,</em></p>
                <p><strong>{{ $wedding->bride_name }} & {{ $wedding->groom_name }}</strong></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000, // Durasi animasi
            once: true // Animasi hanya terjadi sekali
        });

        function openInvitation() {
            // Memunculkan seluruh section dengan animasi
            document.querySelector('.cover-section').style.display = 'none';
            document.querySelector('.invitation-sections').style.display = 'flex';
            
            // Menginisialisasi kembali AOS setelah semua section dimunculkan
            AOS.refresh();
        }
    </script>
</body>
</html>
