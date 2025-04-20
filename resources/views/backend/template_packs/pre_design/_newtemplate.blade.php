<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Undangan Pernikahan</title>
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }} " rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }} " rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <style>
        * {
            font-family: 'Playfair Display', 'Georgia', serif; box-sizing: border-box;
        }
        body, html {
            margin: 0; padding: 0; height: 100%; color: #333; scroll-behavior: smooth;
        }
        .container { 
            max-width: 560px; margin: 0 auto; padding: 0 15px;
        }
        .content-wrapper {
            background-color: #d5e9eb; padding: 10px;
        }
        .cover-section {
            background: linear-gradient(to top, #9ed0ec, #d5e9eb); height: 100vh; display: flex; align-items: flex-end; justify-content: center; padding: 0 20px 60px; position: relative; overflow: hidden; text-align: center;
        }
        .cover-section::before {
            content: ""; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(255,255,255,0.6), transparent 70%); animation: rotateBg 20s linear infinite; z-index: 0;
        }
        @keyframes rotateBg {
            from { transform: rotate(0deg); } to { transform: rotate(360deg); }
        }
        .cover-content {
            position: relative; z-index: 1;
        }
        .cover-title {
            font-size: 1rem; color: #04345f; letter-spacing: 1px;
        }
        .couple-names {
            font-family: 'Great Vibes', cursive; font-size: 1.5rem; font-weight: normal; color: #0a2a54; margin: 10px 0; text-shadow: 2px 2px 3px rgba(0,0,0,0.1);
        }
        .sub-couple-names {
            font-family: 'Great Vibes', cursive; font-size: 2rem; font-weight: bold; margin: 10px 0; text-shadow: 2px 2px 3px rgba(0,0,0,0.1);
        }
        .guest-name {
            font-size: 1.1rem; color: #162c4b; margin-bottom: 20px;
        }
        .open-btn {
            padding: 5px 20px; font-size: 1rem; background-color: #2a317c; color: white; border: none; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.2); transition: all 0.3s ease;
        }
        .open-btn:hover {
            background-color: #171c51; transform: scale(1.05);
        }
        .invitation-sections {
            visibility: hidden; opacity: 0;height: 0; overflow: hidden; transition: all 0.5s ease;
        }
        .invitation-sections.show {
            visibility: visible; opacity: 1; height: auto; overflow: visible;
        }
        .section {
            background: #ffffff; padding: 25px 20px; border-radius: 16px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08); text-align: center; transition: transform 0.3s ease; margin-bottom: 20px;
        }
        .section:hover {
            transform: translateY(-4px);
        }
        .section h3, .section h4 {
            color: #04345f; margin-bottom: 10px; font-weight: 600;
        }
        @media (max-width: 560px) {
            .couple-names { font-size: 2.3rem; } .open-btn { font-size: 1rem; padding: 8px 16px; } .section { padding: 15px; }
            #countdown {
                gap: 10px;
                justify-content: center;
            }
            .count-box {
                padding: 8px 12px;
                min-width: 60px;
            }
            .count-box span {
                font-size: 1.5rem;
            }
            .count-box .label {
                font-size: 0.8rem;
            }
        }
        .gallery-section .row {
            display: flex; flex-wrap: wrap; gap: 10px; justify-content: center;
        }
        .gallery-section img {
            width: 100%; max-width: 150px; height: auto; border-radius: 10px; object-fit: cover; box-shadow: 0 4px 8px rgba(0,0,0,0.1); transition: transform 0.3s;
        }
        .gallery-section img:hover {
            transform: scale(1.05);
        }
        .rsvp-section {
            background-color: #f9f9f9; padding: 40px; border-radius: 15px; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .attendance-stats {
            margin-bottom: 40px; display: flex; justify-content: space-around; gap: 20px;
        }
        .stats-box-attend {
            background-color: #178245; color: white; padding: 15px; border-radius: 10px; width: 120px; text-align: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .stats-box-notattend {
            background-color: #af2626; color: white; padding: 15px; border-radius: 10px; width: 120px; text-align: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .stats-box h5 {
            font-size: 1.2rem; margin-bottom: 5px;
        }
        .attendance-number {
            font-size: 1.5rem; font-weight: bold;
        }
        .rsvp-form input, .rsvp-form select, .rsvp-form textarea {
            border-radius: 8px; border: 1px solid #ddd; padding: 12px; font-size: 1rem;
        }
        .rsvp-form button {
            background-color: #153170; color: white; font-size: 1.1rem; border: none; padding: 12px; border-radius: 8px; cursor: pointer;
        }
        .rsvp-form button:hover {
            background-color: #004080;
        }
        .section.fade-out {
            opacity: 0; transform: translateY(20px); transition: all 0.5s ease;
        }
        #countdown {
            padding: 20px 0; text-align: center; flex-wrap: wrap; gap: 16px;
        }
        .count-box {
            background-color: #153170; border-radius: 12px; padding: 2px; width: 70px; text-align: center; box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .count-box span {
            font-size: 1rem; font-weight: bold; color: #ffffff; display: block;
        }
        .count-box .label {
            font-size: 0.55rem; color: #ffffff;
        }
        #save-the-date h2 {
            font-family: 'Great Vibes', cursive; font-size: 2rem; color: #24448f;
        }
        #amplop-digital h2 {
            font-family: 'Great Vibes', cursive; font-size: 2rem; color: #24448f;
        }
        #galeri-foto h2 {
            font-family: 'Great Vibes', cursive; font-size: 2rem; color: #24448f;
        }
        #love-story h2 {
            font-family: 'Great Vibes', cursive; font-size: 2rem; color: #24448f;
        }
        #rsvp h2 {
            font-family: 'Great Vibes', cursive; font-size: 2rem; color: #24448f;
        }
        .mandiri-card {
            width: 280px; height: 175px; background: linear-gradient(135deg, #dcdcdc, #a9a9a9); border-radius: 16px; color: #000; padding: 16px; box-shadow: 0 6px 14px rgba(0,0,0,0.2); font-family: 'Segoe UI', sans-serif; position: relative; overflow: hidden;
        }
        .mandiri-logo {
            position: absolute; top: 10px; right: 16px; width: 80px; opacity: 0.9;
        }
        .mandiri-chip {
            width: 40px; height: 30px; background: #c0c0c0; border-radius: 6px; margin-top: 30px; margin-bottom: 12px;
        }
        .mandiri-number {
            font-size: 1rem; letter-spacing: 2px; margin-bottom: 16px;
        }
        .mandiri-info {
            display: flex; justify-content: space-between; align-items: flex-end; font-size: 0.8rem;
        }
        .glossy-layer {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(120deg, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0) 60%); z-index: 0;
        }
        .gift-card {
            width: 280px; height: 175px; background: linear-gradient(135deg, #f5f5f5, #d3d3d3); border-radius: 16px; color: #000; padding: 16px; box-shadow: 0 6px 14px rgba(0,0,0,0.2); position: relative; overflow: hidden; display: flex; flex-direction: column; justify-content: center; gap: 4px; font-size: 0.9rem; margin-bottom: 10px;
        }
        .music-toggle-wrapper {
            position: fixed; top: 20px; right: 20px; z-index: 50;
        }
        #playPauseButton {
            position: fixed;
            bottom: 20px;
            right: 20px;
            font-size: 1rem;
            padding: 10px 20px;
            background-color: #153170;
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            z-index: 9999;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
        }
        #playPauseButton:hover {
            background-color: #1a438a;
        }
        #playPauseIcon {
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <audio id="bgMusic" loop>
        <source src="{{ asset($wedding->music->file_path) }}" type="audio/mp3">
    </audio>
<div class="container">
    <div class="music-toggle-wrapper">
        <button id="playPauseButton">
            <i id="playPauseIcon" class="bi bi-play-circle"></i>
        </button>
    </div>
    <div class="cover-section">
        <div class="cover-content" data-aos="zoom-in-up" data-aos-delay="300">
            <div class="cover-title">The Wedding of</div>
            <div class="couple-names">{{ $wedding->bride_name }} <br>&<br> {{ $wedding->groom_name }}</div>
            <div class="guest-name">
                Kepada Bapak/Ibu/Saudara/i<br><strong>{{ request()->get('to') ?? 'Nama Tamu' }}</strong>
            </div>
            <button class="open-btn" onclick="openInvitation()">Buka Undangan</button>
        </div>
    </div>
    <div class="invitation-sections" id="invitationContent">
        <div class="content-wrapper">
            <section id="intro" class="section" data-aos="fade-up" data-aos-delay="100">
                <h7>THE WEDDING OF</h7>
                <div class="sub-couple-names">{{ $wedding->bride_name }} <br>&<br> {{ $wedding->groom_name }}</div>
                <p style="font-size: 1rem;">Kami berharap Anda menjadi bagian dari hari istimewa kami!</p>
                <div id="countdown" class="d-flex justify-content-center flex-wrap gap-3">
                    <div class="count-box"><span id="days">00</span><div class="label">Hari</div></div>
                    <div class="count-box"><span id="hours">00</span><div class="label">Jam</div></div>
                    <div class="count-box"><span id="minutes">00</span><div class="label">Menit</div></div>
                    <div class="count-box"><span id="seconds">00</span><div class="label">Detik</div></div>
                </div>
                <p style="margin-top: 4px; font-weight:bold; ">{{ \Carbon\Carbon::parse($wedding->akad_date)->translatedFormat('l, d F Y') }}</p>
                <a class="btn btn-primary text-white" style="background-color: #153170;" href="#save-the-date">Save The Date</a>
            </section>
        
            <section id="perkenalan-keluarga" class="section" data-aos="fade-up" data-aos-delay="200">
                <p style="font-family: 'Amiri', serif; font-size: 2rem; color: #153170;">
                    بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ
                </p>
                <p style="font-family: 'Great Vibes', cursive; font-size: 1.5rem; color: #153170;">
                    Assalamu'alaikum Wr. Wb.
                </p>
                <p style="color: #153170; font-size: 0.95rem;">
                    Tanpa mengurangi rasa hormat.<br>
                    Kami mengundang Bapak/Ibu/Saudara/i<br>
                    serta Kerabat sekalian untuk menghadiri<br>
                    acara pernikahan kami :
                </p>
                <div class="sub-couple-names">{{ $wedding->bride_name }}</div>
                {{ $wedding->bride_parents_info }}
                <div>
                    &
                </div>
                <div class="sub-couple-names">{{ $wedding->groom_name }}</div>
                {{ $wedding->groom_parents_info }}
            </section>
        
            <section id="save-the-date" class="section" data-aos="fade-up" data-aos-delay="300">
                <h2 class="mb-4">Save The Date</h2>
                <p class="text-center">
                    "Dan segala sesuatu Kami ciptakan berpasang-pasangan agar kamu mengingat (kebesaran Allah).“
                </p>
                <p class="text-center">
                (QS. Az Zariyat: 49)
                </p>
                <h2>Akad Nikah</h2>
                <p style="font-weight: bold;">
                    {{ \Carbon\Carbon::parse($wedding->akad_date)->translatedFormat('l, d F Y') }} pukul {{ \Carbon\Carbon::parse($wedding->akad_date)->translatedFormat('H:i') }}
                </p>
                <h2>Resepsi</h2>
                <p style="font-weight: bold;">
                    {{ \Carbon\Carbon::parse($wedding->reception_date)->translatedFormat('l, d F Y') }} pukul {{ \Carbon\Carbon::parse($wedding->reception_date)->translatedFormat('H:i') }}
                </p>
                <p><i>Tempat: {{ $wedding->place_name }}</i></p>
                <p><i>Alamat: {{ $wedding->location }}</i></p>
            </section>
        
            <section id="amplop-digital" class="section" data-aos="fade-up" data-aos-delay="400">
                <h2 class="mb-4">Amplop Digital</h2>
                <p>Doa Restu Anda merupakan<br>
                    karunia yang sangat berarti bagi kami.</p>
                <p>Dan jika memberi adalah ungkapan tanda kasih<br>
                    Anda, Anda dapat memberi kado secara cashless.</p>
                    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#mandiriCard" aria-expanded="false" aria-controls="mandiriCard">
                        <i class="bi bi-gift"></i> Klik Disini
                    </button>

                    <div class="collapse" id="mandiriCard">
                        <div class="d-flex justify-content-center align-items-center" style="min-height: 300px;">
                            <div class="mandiri-card position-relative overflow-hidden">
                                <!-- Efek Glossy -->
                                <div class="glossy-layer"></div>
                                <img src="{{ asset('assets/img/Bank_Mandiri_logo.svg') }}" alt="Mandiri Logo" class="mandiri-logo">
                                <div class="mandiri-chip"></div>
                                <div class="mandiri-number">1234 5678 9012 3456</div>
                                <div class="mandiri-info">
                                    <div class="mandiri-name">NAMA ANDA</div>
                                    <div class="mandiri-valid">Valid Thru<br><strong>12/29</strong></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="gift-card">
                                <i class="bi bi-gift-fill"></i>
                                <h6 class="mb-1">Kirim Hadiah</h6>
                                <div><strong>Nama Penerima:</strong> Ahmad Wijaya</div>
                                <div><strong>No. HP:</strong> 0812-3456-7890</div>
                                <div><strong>Alamat:</strong> Jl. Kenangan No. 123, Jakarta Selatan</div>
                            </div>
                        </div>
                    </div>
            </section>

            <section id="galeri-foto" class="section gallery-section" data-aos="fade-up" data-aos-delay="500">
                <h2 class="mb-4">Galeri Foto</h2>
                <p class="text-center">Tidak ada yang spesial dalam cerita kami. Tapi kami sangat spesial untuk satu sama lain. Dan Kami bersyukur, dipertemukan Allah diwaktu terbaik, Kini kami menanti hari istimewa kami.</p>
                <div class="row">
                    @foreach($wedding->galleries as $gallery)
                        <div class="col-md-4 mb-3">
                            <img src="{{ asset($gallery->image) }}" alt="Gallery Image" class="img-fluid rounded shadow-sm">
                        </div>
                    @endforeach
                </div>
            </section>
        
            <section id="love-story" class="section" data-aos="fade-up" data-aos-delay="600">
                <h2 class="mb-4">Love Story</h2>
                <p>{{ $wedding->description }}</p>
            </section>
        
            <section id="rsvp" class="section rsvp-section" data-aos="fade-up" data-aos-delay="700">
                <h2 class="mb-4">Ucapkan Sesuatu</h2>
            
                <div class="attendance-stats d-flex justify-content-around mb-4">
                    <div class="stats-box-attend">
                        <p class="attendance-number" id="attending-count">{{ $attendingCount }}</p>
                        <h5>Hadir</h5>
                    </div>
                    <div class="stats-box-notattend">
                        <p class="attendance-number" id="not-attending-count">{{ $notAttendingCount }}</p>
                        <h5>Tidak Hadir</h5>
                    </div>
                </div>
                
                <form id="rsvp-form" method="POST" action="{{ route('rsvp.store', $wedding->slug) }}" class="rsvp-form">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control" id="name" name="nama_tamu" placeholder="Masukkan Nama Anda" required>
                    </div>
                
                    <div class="mb-3">
                        <textarea style="resize: vertical;" class="form-control" id="message" name="ucapan" rows="3" placeholder="Tulis Ucapan Anda..." required></textarea>
                    </div>
                
                    <div class="mb-3">
                        <select class="form-select" id="kehadiran" name="kehadiran" required>
                            <option value="">--Kehadirannya--</option>
                            <option value="yes">Hadir</option>
                            <option value="no">Tidak Hadir</option>
                        </select>
                    </div>
                
                    <div class="mb-3" id="reason-field" style="display: none;">
                        <textarea class="form-control" id="alasan" name="alasan" rows="3" placeholder="Tulis Alasan Anda"></textarea>
                    </div>
                
                    <button type="submit" class="btn btn-primary w-100">Kirim Konfirmasi</button>
                </form>
                
                <!-- Tempat untuk notifikasi -->
                <div id="form-response" class="mt-3"></div>

            </section>

            <section class="section" data-aos="fade-up" data-aos-delay="800">
                <p>Merupakan suatu kehormatan dan kebahagiaan bagi kami, apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu. Atas kehadiran dan doa restunya, kami mengucapkan terima kasih.</p>
                <p style="font-family: 'Great Vibes', cursive; font-size: 1.5rem; color: #153170;">
                    Wassalamu'alaikum Wr. Wb.
                </p>
                <div class="sub-couple-names">{{ $wedding->bride_name }} <br>&<br> {{ $wedding->groom_name }}</div>
            </section>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script>
    const form = document.getElementById('rsvp-form');
    const submitBtn = form.querySelector('button[type="submit"]');

    // cegah klik tombol submit rsvp berkali-kali
    document.addEventListener("DOMContentLoaded", function () {
    form.addEventListener('submit', function (e) {
            // Cegah klik ganda
            submitBtn.disabled = true;
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        // DOM element
        const attendanceSelect = document.getElementById('kehadiran');
        const reasonField = document.getElementById('reason-field');
        const reasonInput = document.getElementById('alasan');
        const responseDiv = document.getElementById('form-response');

        // Validasi alasan hadir/tidak
        if (attendanceSelect) {
            attendanceSelect.addEventListener('change', function () {
                if (this.value === 'no') {
                    reasonField.style.display = 'block';
                    reasonInput.setAttribute('required', 'required');
                } else {
                    reasonField.style.display = 'none';
                    reasonInput.removeAttribute('required');
                }
            });
        }

        // Submit AJAX RSVP
        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(form);
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                formData.forEach((value, key) => {
                    console.log(key + ": " + value);  // Debug log
                });

                fetch("{{ route('rsvp.store', ['slug' => $wedding->slug]) }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        responseDiv.innerHTML = `<div class="alert alert-success alert-dismissible fade show" role="alert">${data.message}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`;
                        submitBtn.disabled = false;
                        form.reset();
                        document.getElementById('attending-count').textContent = data.attending_count;
                        document.getElementById('not-attending-count').textContent = data.not_attending_count;
                        reasonField.style.display = 'none'; // sembunyikan alasan setelah reset
                    } else {
                        responseDiv.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">${data.message}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    responseDiv.innerHTML = `<div class="alert alert-danger">Terjadi kesalahan. Silakan coba lagi.</div>`;
                });
            });
        } else {
            console.error("Form RSVP tidak ditemukan.");
        }
    });

    // beri efek AOS
    AOS.init({ duration: 1000, once: false });

    let lastScrollTop = 0;

    function openInvitation() {
        playPauseButton.innerHTML = '<i id="playPauseIcon" class="bi bi-pause-circle"></i>';
        document.getElementById('bgMusic').play().catch(e => console.log(e));
        document.querySelector('.cover-section').style.display = 'none';
        const content = document.querySelector('.invitation-sections');
        content.classList.add('show');
        window.scrollTo({ top: 0, behavior: 'smooth' });
        setTimeout(() => {
            AOS.refresh();
        }, 300);
    }

    window.addEventListener('scroll', () => {
        let currentScroll = window.scrollY || document.documentElement.scrollTop;

        document.querySelectorAll('.section').forEach(section => {
            const rect = section.getBoundingClientRect();
            const isVisible = rect.top < window.innerHeight && rect.bottom >= 0;

            if (isVisible) {
                if (currentScroll < lastScrollTop) {
                    section.classList.add('fade-out');
                } else {
                    section.classList.remove('fade-out');
                }
            }
        });

        lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
    });

    // hitungan mundur hari nikah
    const akadDate = new Date("{{ $wedding->akad_date }}").getTime();

    const countdown = setInterval(() => {
        const now = new Date().getTime();
        const distance = akadDate - now;

        if (distance < 0) {
            clearInterval(countdown);
            document.getElementById("countdown").innerHTML = "<strong>Sudah Dimulai!</strong>";
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("days").innerText = days.toString().padStart(2, '0');
        document.getElementById("hours").innerText = hours.toString().padStart(2, '0');
        document.getElementById("minutes").innerText = minutes.toString().padStart(2, '0');
        document.getElementById("seconds").innerText = seconds.toString().padStart(2, '0');
    }, 1000);

        // tombol play pause musik latar
        const audio = document.getElementById('bgMusic');
        const playPauseButton = document.getElementById('playPauseButton');
        const playPauseIcon = document.getElementById('playPauseIcon');

    playPauseButton.addEventListener('click', () => {
        if (audio.paused) {
            audio.play().then(() => {
                playPauseIcon.classList.replace('bi-play-circle', 'bi-pause-circle');
                playPauseButton.innerHTML = '<i id="playPauseIcon" class="bi bi-pause-circle"></i>';
            }).catch(e => console.log(e));
        } else {
            audio.pause();
                playPauseIcon.classList.replace('bi-pause-circle', 'bi-play-circle');
            playPauseButton.innerHTML = '<i id="playPauseIcon" class="bi bi-play-circle"></i>';
        }
    });
</script>
</body>
</html>