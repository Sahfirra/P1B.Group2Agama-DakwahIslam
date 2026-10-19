@extends('layouts.app')

@section('title', 'Dashboard | e-Masjid.id')

@section('content')
<!-- HEADER DASHBOARD -->
<section class="dashboard-hero">
   <div class="dashboard-hero-inner">

       <div class="dashboard-hero-copy">
           <span class="dashboard-kicker">
               ASSALAMUALAIKUM, SAHABAT MASJID
           </span>

           <h1>
               Lebih dekat dengan masjid.
               Lebih mudah beribadah.
           </h1>

           <p>
               Pantau waktu salat, temukan kegiatan keagamaan,
               dan ikuti dakwah Islam dalam satu platform.
           </p>

           <div class="dashboard-buttons">
               <a href="{{ route('jadwal.index') }}"
                  class="dashboard-button-primary">
                    Lihat Kegiatan →
                </a>

                <a href="{{ route('blog.index') }}"
                   class="dashboard-button-outline">
                    Jelajahi Dakwah
                </a>
           </div>
       </div>
       <div class="dashboard-clock">
           <span class="clock-label">WAKTU SEKARANG</span>
           <div id="live-clock">--:--:--</div>
           <p id="live-date">{{ $tanggal }}</p>
           <span class="clock-note">
               Waktu salat dan kegiatan mengacu pada zona waktu perangkat Anda.
           </span>
       </div>
   </div>
</section>

<!-- JADWAL SALAT -->
<section class="prayer-section">
   <div class="dashboard-section-heading">
       <div>
           <span class="section-kicker">WAKTU IBADAH</span>
           <h2>Jadwal Salat Hari Ini</h2>
           <p>Sesuaikan jadwal salat dengan lokasi perangkatmu.</p>
       </div>

       <span class="prayer-location" id="prayer-location">
           📍 Lokasi belum terdeteksi
       </span>
   </div>

   <div class="location-control">
       <p id="prayer-status">
           Aktifkan lokasi perangkat untuk memuat jadwal salat
           sesuai tempat kamu berada.
       </p>

       <button type="button"
               id="refresh-location"
               class="location-button">
           📍 Gunakan Lokasi Saya
       </button>
   </div>

   <div id="prayer-content" hidden>
       <div class="next-prayer-box">
           <div>
               <span class="next-prayer-label">
                   SALAT BERIKUTNYA
               </span>

               <h3 id="next-prayer-name">Menghitung...</h3>
           </div>

           <div class="next-prayer-timer">
               <span>Waktu menuju salat</span>
               <strong id="next-prayer-countdown">--:--:--</strong>
           </div>
       </div>

       <div class="prayer-time-grid">
           <div class="prayer-time-card" data-prayer="Subuh">
               <span class="prayer-icon">🌅</span>
               <span class="prayer-name">Subuh</span>
               <strong class="prayer-hour">--:--</strong>
               <span class="prayer-next-indicator">Salat berikutnya</span>
           </div>

           <div class="prayer-time-card" data-prayer="Zuhur">
               <span class="prayer-icon">☀️</span>
               <span class="prayer-name">Zuhur</span>
               <strong class="prayer-hour">--:--</strong>
               <span class="prayer-next-indicator">Salat berikutnya</span>
           </div>

           <div class="prayer-time-card" data-prayer="Asar">
               <span class="prayer-icon">🌤️</span>
               <span class="prayer-name">Asar</span>
               <strong class="prayer-hour">--:--</strong>
               <span class="prayer-next-indicator">Salat berikutnya</span>
           </div>

           <div class="prayer-time-card" data-prayer="Maghrib">
               <span class="prayer-icon">🌇</span>
               <span class="prayer-name">Maghrib</span>
               <strong class="prayer-hour">--:--</strong>
               <span class="prayer-next-indicator">Salat berikutnya</span>
           </div>

           <div class="prayer-time-card" data-prayer="Isya">
               <span class="prayer-icon">🌙</span>
               <span class="prayer-name">Isya</span>
               <strong class="prayer-hour">--:--</strong>
               <span class="prayer-next-indicator">Salat berikutnya</span>
           </div>
       </div>

       <p class="prayer-disclaimer">
           Jadwal merupakan hasil perhitungan API berdasarkan koordinat.
           Waktu dapat berbeda dari jadwal resmi masjid setempat.
       </p>
   </div>
</section>

<!-- AYAT DAN PETA MASJID -->
<section class="dashboard-feature-grid">
   <article class="verse-card">
       <span class="section-kicker">INSPIRASI HARI INI</span>
       <h2>Yuk, Makmurkan Masjid!</h2>
       <p class="verse-arabic" dir="rtl" lang="ar">
           إِنَّمَا يَعْمُرُ مَسَاجِدَ اللَّهِ مَنْ آمَنَ بِاللَّهِ
           وَالْيَوْمِ الْآخِرِ وَأَقَامَ الصَّلَاةَ وَآتَى الزَّكَاةَ
           وَلَمْ يَخْشَ إِلَّا اللَّهَ
       </p>

       <p class="verse-translation">
           "Sesungguhnya yang (pantas) memakmurkan masjid-masjid
           Allah hanyalah orang yang beriman kepada Allah dan hari
           Akhir, mendirikan salat, menunaikan zakat, serta tidak
           takut kepada siapa pun selain Allah."
       </p>

       <span class="verse-reference">QS. At-Taubah: 18</span>

       <p class="verse-message">
           Masjid bukan hanya tempat beribadah, tetapi juga ruang
           belajar, berbagi, dan bertumbuh bersama. Yuk, jadikan
           masjid bagian dari keseharian kita!
       </p>
   </article>

   <article class="mosque-card">
       <span class="section-kicker">LOKASI MASJID</span>
       <h2>{{ $profilMasjid['nama'] }}</h2>
       <p class="mosque-address">
           📍 {{ $profilMasjid['alamat'] }}
       </p>

       <div class="mosque-map">
           <iframe
               src="{{ $profilMasjid['maps_embed'] }}"
               title="Peta lokasi masjid"
               loading="lazy"
               allowfullscreen>
           </iframe>
       </div>

       <a href="{{ $profilMasjid['maps'] }}"
          target="_blank"
          rel="noopener noreferrer"
          class="mosque-map-button">
           Lihat Lokasi di Google Maps →
       </a>
   </article>
</section>

<!-- MENU UTAMA -->
<section class="dashboard-quick-section">
   <div class="dashboard-section-heading">
       <div>
           <span class="section-kicker">JELAJAHI WEBSITE</span>
           <h2>Mulai dari Sini</h2>
           <p>Temukan informasi yang kamu butuhkan.</p>
       </div>
   </div>

   <div class="quick-access-grid">
       <a href="{{ route('jadwal.index') }}" class="quick-access-card">
           <span class="quick-icon">📅</span>
           <h3>Jadwal Kegiatan</h3>
           <p>Temukan pengajian, kajian, dan sholawat.</p>
           <span class="quick-link">Lihat Jadwal →</span>
       </a>

       <a href="{{ route('blog.index') }}" class="quick-access-card">
           <span class="quick-icon">📖</span>
           <h3>Dakwah Islam</h3>
           <p>Tonton video dakwah dan baca rangkuman materi.</p>
           <span class="quick-link">Jelajahi Dakwah →</span>
       </a>

       <a href="{{ route('tentang') }}" class="quick-access-card">
           <span class="quick-icon">🕌</span>
           <h3>Tentang Kami</h3>
           <p>Kenali tujuan dan informasi website masjid.</p>
           <span class="quick-link">Selengkapnya →</span>
       </a>
   </div>
</section>

<!-- JAM, LOKASI DAN COUNTDOWN -->
<script>
   const prayerApiUrl = @json(route('dashboard.prayer-times'));

   const statusElement = document.getElementById('prayer-status');
   const locationButton = document.getElementById('refresh-location');
   const prayerContent = document.getElementById('prayer-content');
   const nextPrayerName = document.getElementById('next-prayer-name');
   const nextPrayerCountdown = document.getElementById('next-prayer-countdown');

   let prayerTimezone = 'Asia/Jakarta';
   let tomorrowFajr = null;

   function updateClock() {
       document.getElementById('live-clock').textContent =
           new Intl.DateTimeFormat('id-ID', {
               timeZone: prayerTimezone,
               hour: '2-digit',
               minute: '2-digit',
               second: '2-digit',
               hourCycle: 'h23'
           }).format(new Date());

       document.getElementById('live-date').textContent =
           new Intl.DateTimeFormat('id-ID', {
               timeZone: prayerTimezone,
               weekday: 'long',
               day: 'numeric',
               month: 'long',
               year: 'numeric'
           }).format(new Date());
   }

   updateClock();
   setInterval(updateClock, 1000);


   function dateForZone(timeZone, offsetDays = 0) {
       const parts = new Intl.DateTimeFormat('en-GB', {
           timeZone: timeZone,
           day: '2-digit',
           month: '2-digit',
           year: 'numeric'
       }).formatToParts(new Date());

       const values = {};

       parts.forEach(function (part) {
           values[part.type] = part.value;
       });

       const date = new Date(Date.UTC(
           Number(values.year),
           Number(values.month) - 1,
           Number(values.day) + offsetDays,
           12
       ));

       return new Intl.DateTimeFormat('en-GB', {
           timeZone: 'UTC',
           day: '2-digit',
           month: '2-digit',
           year: 'numeric'
       }).format(date).replace(/\//g, '-');
   }


   async function fetchPrayerTimes(coords, date) {
       const url = new URL(prayerApiUrl, window.location.origin);

       url.searchParams.set('latitude', coords.latitude);
       url.searchParams.set('longitude', coords.longitude);
       url.searchParams.set('date', date);

       const response = await fetch(url, {
           headers: { 'Accept': 'application/json' }
       });

       const data = await response.json();

       if (!response.ok) {
           throw new Error(
               data.message || 'Jadwal salat gagal dimuat.'
           );
       }

       return data;
   }


   function displayPrayerTimes(data) {
       document.querySelectorAll('.prayer-time-card').forEach(function (card) {
           card.classList.remove('is-next');
           const name = card.dataset.prayer;
           const time = data.timings[name];

           card.dataset.time = time || '';

           if (!time) {
               card.querySelector('.prayer-hour').textContent = '--:--';
               return;
           }

           const date = new Date(time);
           card.querySelector('.prayer-hour').textContent =
               new Intl.DateTimeFormat('id-ID', {
                   timeZone: prayerTimezone,
                   hour: '2-digit',
                   minute: '2-digit',
                   hourCycle: 'h23'
               }).format(date);
       });

       prayerContent.hidden = false;
       updateNextPrayer();
   }


   function updateNextPrayer() {
       const now = Date.now();
       const cards = Array.from(
           document.querySelectorAll('.prayer-time-card')
       );

       let next = null;

       cards.forEach(function (card) {
           card.classList.remove('is-next');
           if (!card.dataset.time) return;
           const time = new Date(card.dataset.time).getTime();
           if (time > now && (!next || time < next.time)) {
               next = {
                   name: card.dataset.prayer,
                   time: time,
                   card: card
               };
           }
       });

       if (!next && tomorrowFajr) {
           const time = new Date(tomorrowFajr).getTime();
           const subuh = cards.find(card => card.dataset.prayer === 'Subuh');
           if (time > now) {
               next = {
                   name: 'Subuh',
                   time: time,
                   card: subuh
               };
           }
       }

       if (!next) {
           nextPrayerName.textContent = 'Jadwal belum tersedia';
           nextPrayerCountdown.textContent = '--:--:--';
           return;
       }

       if (next.card) next.card.classList.add('is-next');
       nextPrayerName.textContent = 'Salat ' + next.name;

       const seconds = Math.max(
           0,
           Math.floor((next.time - now) / 1000)
       );

       const hours = Math.floor(seconds / 3600);
       const minutes = Math.floor((seconds % 3600) / 60);
       const secs = seconds % 60;

       nextPrayerCountdown.textContent =
           String(hours).padStart(2, '0') + ':' +
           String(minutes).padStart(2, '0') + ':' +
           String(secs).padStart(2, '0');
   }

   setInterval(updateNextPrayer, 1000);


   locationButton.addEventListener('click', function () {
       if (!navigator.geolocation) {
           statusElement.textContent =
               'Browser kamu tidak mendukung fitur lokasi.';
           return;
       }

       locationButton.disabled = true;
       locationButton.textContent = 'Mendeteksi lokasi...';
       statusElement.textContent =
           'Sedang mengambil lokasi dan jadwal salat...';

       navigator.geolocation.getCurrentPosition(
           async function (position) {
               const coords = {
                   latitude: position.coords.latitude,
                   longitude: position.coords.longitude
               };

               try {
                   const deviceTimezone =
                       Intl.DateTimeFormat().resolvedOptions().timeZone ||
                       'Asia/Jakarta';

                   let data = await fetchPrayerTimes(
                       coords,
                       dateForZone(deviceTimezone)
                   );

                   prayerTimezone = data.timezone || deviceTimezone;

                   if (dateForZone(prayerTimezone) !==
                       dateForZone(deviceTimezone)) {
                       data = await fetchPrayerTimes(
                           coords,
                           dateForZone(prayerTimezone)
                       );
                   }

                   prayerTimezone = data.timezone || prayerTimezone;
                   tomorrowFajr = null;

                   try {
                       const tomorrow = await fetchPrayerTimes(
                           coords,
                           dateForZone(prayerTimezone, 1)
                       );

                       tomorrowFajr = tomorrow.timings.Subuh;
                   } catch (error) {
                       // Countdown hari ini tetap bisa berjalan.
                   }

                   displayPrayerTimes(data);
                   updateClock();

                   document.getElementById('prayer-location').textContent =
                       '📍 ' + coords.latitude.toFixed(3) +
                       ', ' + coords.longitude.toFixed(3);
                   statusElement.textContent =
                       'Jadwal berhasil dimuat berdasarkan lokasi perangkat.';
                   locationButton.textContent = '↻ Perbarui Lokasi';
               } catch (error) {
                   statusElement.textContent =
                       error.message || 'Jadwal salat gagal dimuat.';
                   locationButton.textContent = 'Coba Lagi';
               } finally {
                   locationButton.disabled = false;
               }
           },
           function (error) {
               if (error.code === 1) {
                   statusElement.textContent =
                       'Akses lokasi ditolak. Izinkan lokasi melalui pengaturan browser.';
               } else if (error.code === 2) {
                   statusElement.textContent =
                       'Lokasi perangkat tidak terdeteksi. Aktifkan layanan lokasi.';
               } else {
                   statusElement.textContent =
                       'Waktu pencarian lokasi habis. Tekan Coba Lagi.';
               }

               locationButton.disabled = false;
               locationButton.textContent = 'Coba Lagi';
           },
           {
               enableHighAccuracy: true,
               timeout: 15000,
               maximumAge: 60000
           }
       );
   });
</script>

@endsection