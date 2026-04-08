<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sensus Ekonomi 2026</title>

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

<style>
body{
  font-family:'Inter',sans-serif;
  background:#f8fafc;
}

:root{
--bps-orange:#E07A24;
--bps-orange-dark:#C76314;
--bps-cream:#F3E7DB;
}

.h1{font-size:46px;font-weight:900;line-height:1.1}
.h2{font-size:34px;font-weight:800}
.section{
  padding:90px 0;
}

@media(max-width:768px){
  .section{
    padding:60px 0;
  }
}

.card{
background:#fff;
border-radius:16px;
box-shadow:0 10px 22px rgba(0,0,0,.08);
}

/* ===== slider kategori ===== */
.slider-wrap{overflow:hidden}
.slider-track{
display:flex;
gap:28px;
animation:slideX 30s linear infinite;
}
@keyframes slideX{
0%{transform:translateX(0)}
100%{transform:translateX(-50%)}
}

.slider-pill{
min-width:320px;
background:#f3f4f6;
border-radius:999px;
padding:16px 28px;
display:flex;
align-items:center;
gap:18px;
font-weight:700;
color:#374151;
box-shadow:0 12px 26px rgba(0,0,0,.12);
}

.icon-round{
width:56px;height:56px;
border-radius:999px;
background:white;
display:flex;
align-items:center;
justify-content:center;
font-size:22px;
box-shadow:0 8px 18px rgba(0,0,0,.15);
}

/* ===== chatbot ===== */
.chat-box{
position:fixed;
bottom:110px;
right:30px;
width:320px;
background:white;
border-radius:22px;
box-shadow:0 30px 60px rgba(0,0,0,.18);
display:none;
flex-direction:column;
overflow:hidden;
z-index:99;
}
.chat-head{
background:var(--bps-orange);
color:white;
padding:16px;
font-weight:700;
}
.chat-msg{
padding:16px;
font-size:14px;
}

@media(max-width:768px){
.h1{font-size:30px}
.h2{font-size:24px}
.section{padding:70px 0}
}

/* ===== TAMBAHAN BUBBLE CHAT — TIDak mengubah kode lain ===== */

.msg{
padding:10px 14px;
border-radius:18px;
font-size:13px;
max-width:85%;
line-height:1.4;
position:relative;
animation:msgFade .25s ease;
word-wrap:break-word;
}

.msg.bot{
background:#f3f4f6;
border-bottom-left-radius:6px;
}

.msg.user{
background:#E07A24;
color:white;
margin-left:auto;
border-bottom-right-radius:6px;
}

/* ekor bubble kiri (bot) */
.msg.bot::after{
content:"";
position:absolute;
left:-6px;
bottom:6px;
width:12px;
height:12px;
background:#f3f4f6;
transform:rotate(45deg);
border-radius:2px;
}

/* ekor bubble kanan (user) */
.msg.user::after{
content:"";
position:absolute;
right:-6px;
bottom:6px;
width:12px;
height:12px;
background:#E07A24;
transform:rotate(45deg);
border-radius:2px;
}

/* animasi muncul */
@keyframes msgFade{
from{opacity:0; transform:translateY(6px);}
to{opacity:1; transform:translateY(0);}
}

/* ===== FRAME & SHADOW LOGO SENSUS ===== */

.logo-frame{
display:inline-block;
background:white;
padding:18px 26px;
border-radius:22px;
box-shadow:
0 12px 30px rgba(0,0,0,.12),
0 4px 10px rgba(224,122,36,.18);
border:1px solid rgba(0,0,0,.05);
transition:.3s ease;
}

.logo-frame:hover{
transform:translateY(-3px) scale(1.02);
box-shadow:
0 18px 40px rgba(0,0,0,.18),
0 8px 18px rgba(224,122,36,.25);
}

/* ===== PENYESUAIAN POSISI HERO AGAR LEBIH PRESISI ===== */
/* TIDAK mengubah struktur HTML — hanya visual offset */

@media(min-width:768px){
section[style*="--bps-cream"] .space-y-8{
transform:translateY(-85px);
}
}

/* ===== LOGIN MODAL ===== */
.login-overlay{
position:fixed;
inset:0;
background:rgba(0,0,0,.45);
display:none;
align-items:center;
justify-content:center;
z-index:200;
}

.login-card{
background:white;
border-radius:18px;
padding:40px;
width:100%;
max-width:420px;
box-shadow:0 12px 24px rgba(0,0,0,.25);
animation:fadeIn .25s ease;
}

@keyframes fadeIn{
from{opacity:0; transform:translateY(10px);}
to{opacity:1; transform:translateY(0);}
}

/* ===== DASHBOARD PANEL ===== */
#dashboardPanel{
display:none;
background:linear-gradient(
  180deg,
  var(--bps-cream) 0%,
  #f8fafc 45%,
  #ffffff 100%
);
}

.dashboard-header{
background:rgba(255,255,255,.92);
backdrop-filter:blur(6px);
border-bottom:1px solid rgba(0,0,0,.06);
box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.dashboard-card{
background:white;
border-radius:18px;
padding:28px;
box-shadow:
0 14px 30px rgba(0,0,0,.08),
0 6px 12px rgba(224,122,36,.08);
border:1px solid rgba(0,0,0,.04);
}

.progress-bar{
height:14px;
border-radius:999px;
background:#f1f5f9;
overflow:hidden;
box-shadow:inset 0 2px 4px rgba(0,0,0,.08);
}

.progress-fill{
height:100%;
background:linear-gradient(90deg,var(--bps-orange),#f59e0b);
border-radius:999px;
}

/* KPI consistency */
#dashTotal{ color:var(--bps-orange); }
#dashSelesai{ color:#16a34a; }
#dashProses{ color:#f59e0b; }
#dashLapangan{ color:#2563eb; }


/* ===== MASKOT BUNG ITUNG DI SAMPING BANNER ===== */
.banner-wrap{
  position:relative;
}

.bung-itung{
  position:absolute;
  bottom: -20px;
  width:230px;
  z-index:6;
  filter: drop-shadow(0 14px 28px rgba(0,0,0,.3));
  transition:.35s ease;
}

.bung-itung.left{
  left:-70px;
}

.bung-itung.right{
  right:-70px;
  transform:scaleX(-1); /* biar saling hadap */
}

.bung-itung:hover{
  transform:translateY(-6px) scale(1.05);
}

/* sembunyikan di layar kecil */
@media(max-width:768px){
  .bung-itung{
    display:none;
  }
}

/* ===== ANIMASI MELAMBAI BUNG ITUNG ===== */
@keyframes wave{
  0%   { transform:rotate(0deg); }
  20%  { transform:rotate(6deg); }
  40%  { transform:rotate(-6deg); }
  60%  { transform:rotate(6deg); }
  80%  { transform:rotate(-3deg); }
  100% { transform:rotate(0deg); }
}

.bung-itung.wave{
  transform-origin: bottom center;
  animation: wave 3.8s ease-in-out infinite;
}

/* sedikit beda ritme biar natural */
.bung-itung.right.wave{
  animation-delay:1.2s;
}

/* ===== ANIMASI BUNG ITUNG TENGAH ===== */
@keyframes bungWave {
  0%   { transform: rotate(0deg); }
  20%  { transform: rotate(5deg); }
  40%  { transform: rotate(-5deg); }
  60%  { transform: rotate(5deg); }
  80%  { transform: rotate(-3deg); }
  100% { transform: rotate(0deg); }
}

.animate-bung-wave{
  animation: bungWave 4s ease-in-out infinite;
  transform-origin: bottom center;
}

/* ===== ANIMASI MELAMBAI (KHUSUS KIRI & KANAN) ===== */
@keyframes bungWaveSide {
  0%   { transform: rotate(0deg) translateY(0); }
  20%  { transform: rotate(4deg) translateY(-2px); }
  40%  { transform: rotate(-4deg) translateY(2px); }
  60%  { transform: rotate(4deg) translateY(-2px); }
  80%  { transform: rotate(-2deg) translateY(1px); }
  100% { transform: rotate(0deg) translateY(0); }
}

.bung-itung.wave{
  animation: bungWaveSide 4.5s ease-in-out infinite;
  transform-origin: bottom center;
}

/* ===== CARD JADWAL ORANYE ===== */
.card-jadwal{
  background: linear-gradient(
    135deg,
    #f8fafc 0%,
    #eef2f7 100%
  );
  color: #1f2937;
  border-left: 6px solid var(--bps-orange);
  box-shadow:
    0 12px 24px rgba(0,0,0,.08),
    0 4px 10px rgba(0,0,0,.06);
}

.card-jadwal:hover{
  transform: translateY(-4px);
  transition:.3s ease;
}

.card-jadwal:hover{
  transform: translateY(-4px);
  transition:.3s ease;
}

/* ===== PERBESAR FILOSOFI SEGANTI SETUNGGUAN ===== */
.filosofi-text{
  font-size: 1.35rem;        /* teks utama */
  line-height: 1.8;
}

.filosofi-title{
  font-size: 2.6rem;         /* SEganti / SEtungguan */
  letter-spacing: 0.5px;
}

@media (max-width: 768px){
  .filosofi-text{
    font-size: 1.15rem;
  }
  .filosofi-title{
    font-size: 2rem;
  }
}

/* ===== BACKGROUND FILOSOFI: GRADIENT + TEKSTUR ===== */
.bg-filosofi{
   background:
    url("/images/logo_sensus..png") no-repeat left top,
    radial-gradient(circle at 20% 10%, rgba(224,122,36,0.10), transparent 45%),
    linear-gradient(180deg, #fff7ef 0%, #ffffff 100%);
  background-size: 220px, auto, auto;
}


/* ===== BUNG ITUNG TENGAH (FILOSOFI) ===== */
.bung-itung-center{
  width: 360px;              /* default desktop */
  transform: translateY(-10px);
  filter: drop-shadow(0 26px 46px rgba(0,0,0,.35));
  transition: transform .35s ease;
}

.bung-itung-center:hover{
  transform: translateY(-18px) scale(1.05);
}

/* tablet */
@media (max-width: 1024px){
  .bung-itung-center{
    width: 300px;
  }
}

/* mobile */
@media (max-width: 768px){
  .bung-itung-center{
    width: 240px;
    transform: none;
  }
}

@keyframes floatBung {
  0%   { transform: translateY(-10px); }
  50%  { transform: translateY(-20px); }
  100% { transform: translateY(-10px); }
}

.bung-itung-center{
  animation: floatBung 5s ease-in-out infinite;
}

/* ===== INFOGRAFIS MANFAAT SENSUS (HORIZONTAL) ===== */
.manfaat-infografis{
  background:
    linear-gradient(180deg,#fff7ef,#ffffff);
  border-radius:32px;
  padding:48px 36px;
}

.manfaat-grid{
  display:grid;
  grid-template-columns: repeat(4, 1fr);
  gap:28px;
  margin-top:36px;
}

.manfaat-box{
  background:white;
  border-radius:26px;
  padding:28px 24px 32px;
  text-align:center;
  position:relative;
  box-shadow:0 18px 40px rgba(0,0,0,.08);
  transition:transform .35s ease;
}

.manfaat-box:hover{
  transform:translateY(-10px);
}

.manfaat-icon{
  width:64px;
  height:64px;
  margin:0 auto 18px;
  background:var(--bps-orange);
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
  color:white;
  font-size:28px;
  box-shadow:0 10px 22px rgba(224,122,36,.45);
}

.manfaat-title{
  font-weight:900;
  margin-bottom:12px;
  font-size:18px;
}

.manfaat-desc{
  font-size:14px;
  line-height:1.6;
  color:#4b5563;
}

/* Tablet */
@media(max-width:1024px){
  .manfaat-grid{
    grid-template-columns:repeat(2,1fr);
  }
}

/* Mobile */
@media(max-width:640px){
  .manfaat-grid{
    grid-template-columns:1fr;
  }
}

/* ===== FLOATING BUTTON STACK FIX (ANTI TUMPUK) ===== */

.floating-btn{
  position: fixed;
  right: 28px;
  z-index: 120;
}

/* WhatsApp paling atas */
.btn-wa{
  bottom: 110px;
}

/* Tombol buka chatbot */
.btn-chat-toggle{
  position: fixed;
  bottom: 40px;
  right: 28px;
  z-index: 120;
}

/* Chatbox muncul di atas tombol WA */
.chat-box{
  bottom: 170px; /* dinaikkan supaya tidak tabrakan WA */
  right: 28px;
}

/* ===== MOBILE ===== */
@media(max-width:768px){

  .btn-wa{
    bottom: 100px;
  }

  .btn-chat-toggle{
    bottom: 32px;
  }

  .chat-box{
    bottom: 160px;
  }
}

/* ===== BACKGROUND MOTIF HALUS GLOBAL ===== */
body{
  background:
    linear-gradient(rgba(255,255,255,0.75), rgba(255,255,255,0.75)),
    url("/images/download.png") repeat,
    radial-gradient(circle at 20% 10%, rgba(224,122,36,0.06), transparent 45%),
    radial-gradient(circle at 80% 30%, rgba(245,158,11,0.06), transparent 50%),
    radial-gradient(circle at 50% 90%, rgba(224,122,36,0.05), transparent 55%),
    linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
  
  background-size:
    900px auto,   /* ukuran motif gelombang (lebih besar) */
    auto,
    auto,
    auto,
    auto;
}

.bg-motif{
  background:
    repeating-linear-gradient(
      45deg,
      rgba(224,122,36,0.04),
      rgba(224,122,36,0.04) 2px,
      transparent 2px,
      transparent 12px
    ),
    linear-gradient(180deg, #fff7ef 0%, #ffffff 100%);
}

#dashboardPanel{
  background:
    radial-gradient(circle at top left, rgba(224,122,36,.08), transparent 45%),
    radial-gradient(circle at bottom right, rgba(245,158,11,.08), transparent 45%),
    linear-gradient(180deg, #fff7ef 0%, #ffffff 100%);
}

.kontak-right-grid{
  display: grid;
  grid-template-columns: 1fr auto;
  gap: 12px; /* lebih rapat */
  align-items: center;
}

.kontak-icon-big{
  width: 220px;      /* lebih besar */
  max-width: 100%;
  margin-left: auto; /* dorong ke kanan */
  filter: drop-shadow(0 12px 24px rgba(0,0,0,.3));
}

@keyframes waPulse {
  0% { box-shadow: 0 0 0 0 rgba(37,211,102,.5); }
  70% { box-shadow: 0 0 0 12px rgba(37,211,102,0); }
  100% { box-shadow: 0 0 0 0 rgba(37,211,102,0); }
}

.btn-wa{
  animation: waPulse 2.8s infinite;
}

.page-section{
  animation: fadeIn .3s ease;
}

@keyframes fadeIn{
  from{opacity:0; transform:translateY(10px);}
  to{opacity:1; transform:translateY(0);}
}

.page-section{
  display:none;
}

#hero{
  display:block;
}

nav a{
  position: relative;
}

nav a::after{
  content:"";
  position:absolute;
  left:0;
  bottom:-6px;
  width:0%;
  height:2px;
  background:#E07A24;
  transition:.3s;
}

nav a:hover::after{
  width:100%;
}

nav a.active{
  color: #E07A24;
}

nav a.active::after{
  width: 100%;
}

/* ===== FIX SCROLL CHAT ===== */
.chat-box{
  display:flex;
  flex-direction:column;
  height:420px; /* tinggi fix biar stabil */
}

.chat-body{
  flex:1;
  overflow-y:auto;
  scroll-behavior:smooth;
  padding-right:6px;
}

/* custom scrollbar biar keren */
.chat-body::-webkit-scrollbar{
  width:6px;
}
.chat-body::-webkit-scrollbar-thumb{
  background:#E07A24;
  border-radius:10px;
}

/* ===== FIX HEADER AGAR TIDAK KETIMPA ===== */
.chat-head{
  position:sticky;
  top:0;
  z-index:10;
}

/* ===== FIX INPUT AREA ===== */
.chat-box .p-3{
  position:sticky;
  bottom:0;
  background:white;
  z-index:10;
}

/* ===== BIAR TOMBOL CLOSE SELALU BISA DIKLIK ===== */
.chat-head button{
  position:relative;
  z-index:20;
  cursor:pointer;
}

</style>
</head>

<body>

<!-- ================= HEADER ================= -->
<header class="bg-white sticky top-0 z-50 border-b border-gray-200">
<div class="max-w-6xl mx-auto px-6 flex justify-between items-center h-[88px]">
<div class="flex items-center gap-4">
  <img src="/images/logo_bps1.png" class="h-12">
  <div class="leading-tight">
    <div class="font-semibold text-gray-800 text-sm">
      BADAN PUSAT STATISTIK
    </div>
    <div class="text-xs text-gray-500 tracking-wide">
      KABUPATEN LAHAT
    </div>
  </div>
</div>

<nav class="hidden md:flex items-center gap-8 text-[15px] font-semibold text-gray-700">

<a href="#" onclick="showPage('hero')" class="nav-link hover:text-orange-600 transition">
  Beranda
</a>

<a href="#" onclick="showPage('jadwal')" class="nav-link hover:text-orange-600 transition">
  Jadwal
</a>

<a href="#" onclick="showPage('dashboard')" class="nav-link hover:text-orange-600 transition">
  Dashboard
</a>

<a href="#" onclick="showPage('galeri')" class="nav-link hover:text-orange-600 transition">
  Galeri
</a>

  <!-- DROPDOWN SELENGKAPNYA -->
  <div class="relative group">

    <button class="flex items-center gap-1 hover:text-orange-600 transition">
      Selengkapnya
      <i class="fas fa-chevron-down text-xs mt-[2px]"></i>
    </button>

<div class="absolute top-full left-0 pt-2 w-56">
  <div class="bg-white rounded-xl shadow-xl opacity-0 invisible
              group-hover:opacity-100 group-hover:visible
              transition duration-200">

<a href="#" onclick="showPage('informasi-sensus')" class="nav-link block px-5 py-3 hover:bg-orange-50">
  Informasi Sensus
</a>

    <a href="#" onclick="showPage('informasi-pendukung')" class="nav-link block px-5 py-3 hover:bg-orange-50">
      Informasi Pendukung
    </a>

  </div>
</div>

  </div>

</nav>
</div>
</header>

<!-- ================= HERO ================= -->
<section id="hero" class="page-section bg-filosofi">

<!-- ===== BANNER FULL WIDTH (INI YANG DIPERBAIKI) ===== -->
<div class="max-w-6xl mx-auto px-20 pt-24 banner-wrap">

  <!-- Bung Itung Kiri -->
  <img
    src="/images/bung_itung.png"
    class="bung-itung left wave"
    alt="Maskot Bung Itung">

  <!-- Banner Utama -->
  <img
    src="/images/banner_se2026_lahat.png"
    class="w-full rounded-3xl shadow-2xl relative z-10">

  <!-- Bung Itung Kanan -->
  <img
    src="/images/bung_itung.png"
    class="bung-itung right wave"
    alt="Maskot Bung Itung">

</div>

<!-- ================= FILOSOFI SEGANTI SETUNGGUAN ================= -->
<section class="bg-orange py-16">

  <div class="max-w-4xl mx-auto px-6 text-center">

    <!-- BARIS FILOSOFI KIRI KANAN -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 md:gap-x-12 mb-4">

      <p class="italic font-semibold text-gray-900 text-lg md:text-xl md:text-right">
        Seia sekata, satu tujuan, satu tekad
      </p>

      <p class="italic font-semibold text-gray-900 text-lg md:text-xl md:text-left">
        Bersama-sama, bergandeng tangan
      </p>

    </div>

    <!-- KALIMAT PENEGAS -->
    <p class="italic text-gray-700 text-base md:text-lg max-w-2xl mx-auto leading-relaxed mb-3">
      Bersatu dalam niat, melangkah bersama dalam tindakan, dan saling menguatkan untuk tujuan bersama,
    </p>

    <!-- SLOGAN UTAMA -->
<h3 class="font-extrabold text-3xl md:text-4xl tracking-tight leading-tight">
  <span class="text-black">
    SUK<span class="text-orange-500 drop-shadow-[0_0_10px_rgba(255,140,0,0.8)]">SE</span>SNYA
  </span>
  <span class="text-orange-500 drop-shadow-[0_0_10px_rgba(255,140,0,0.8)]"> SE!</span>
</h3>

  </div>

</section>

    <!-- GRID ICON + KATA -->
    <div class="relative grid md:grid-cols-3 gap-1 items-center -mt-3">

      <!-- KIRI -->
      <div class="text-right space-y-3">
        <h3 class="font-extrabold text-orange-600 filosofi-title">
          SEganti
        </h3>

        <p class="text-gray-600 filosofi-text">
          <b>Sensus Ekonomi</b> dalam <b>Galeri, Aksi,</b> dan
          <b>Navigasi Terintegrasi</b>
        </p>
      </div>

      <!-- ICON TENGAH -->
      <div class="flex justify-center">
        <img
          src="/images/petugas_sensus.png"
          alt="Bung Itung"
          class="bung-itung-center"
        >
      </div>

      <!-- KANAN -->
      <div class="text-left space-y-3">
        <h3 class="font-extrabold text-orange-600 filosofi-title">
          SEtungguan
        </h3>

        <p class="text-gray-600 filosofi-text">
          <b>Sensus Ekonomi Terpadu</b> dan <b>Unggul</b>
          dalam <b>Aksi Kolaborasi</b> dan <b>Keterlibatan</b>
        </p>
      </div>

    </div>

  </div>

</section>

<!-- ===== HERO CONTENT (TETAP) ===== -->
<section id="jadwal" class="page-section section bg-white bg-motif">

<div class="max-w-6xl mx-auto px-6 py-16 section grid md:grid-cols-2 gap-10 items-center">

<div class="space-y-8 flex flex-col justify-center">
<h1 class="h1">
Sensus Ekonomi 2026 <br>
<span style="color:var(--bps-orange)">Mencatat Ekonomi Indonesia</span>
</h1>

<div class="card card-jadwal p-8 max-w-[480px]">
<p class="text-gray-500 text-sm mb-5 font-semibold">
Jadwal Pelaksanaan SE2026
</p>

<div class="space-y-5 text-[15px]">
<div>
<p class="font-extrabold text-lg text-orange-600">
📅 1 – 31 Mei 2026
</p>
<p>Pengisian Kuesioner SE2026 Online</p>
</div>

<div>
<p class="font-extrabold text-lg text-orange-600">
🏠 1 Juni – 31 Juli 2026
</p>
<p>Pendataan Lapangan (Door to Door)</p>
</div>
</div>
</div>
</div>

<div>
<img src="/images/hero_usaha.jpeg" class="rounded-3xl shadow-2xl">
</div>

</div>
</section>

<!-- ================= APA ITU ================= -->
<section id="informasi-sensus" class="page-section section text-white" style="background:var(--bps-orange)">
<div class="max-w-6xl mx-auto px-6 text-center">

<h2 class="h2 mb-5">Apa itu Sensus Ekonomi?</h2>

<p class="max-w-3xl mx-auto text-lg opacity-95 mb-14">
Sensus Ekonomi merupakan program pemerintah untuk menyediakan
<b>data dasar seluruh kegiatan ekonomi</b> yang mencakup berbagai kategori usaha.
</p>

<div class="slider-wrap">
<div class="slider-track">

<div class="slider-pill"><div class="icon-round">🏭</div>Industri Pengolahan</div>
<div class="slider-pill"><div class="icon-round">🏗</div>Konstruksi</div>
<div class="slider-pill"><div class="icon-round">🛒</div>Perdagangan</div>
<div class="slider-pill"><div class="icon-round">🍽</div>Akomodasi & Makan Minum</div>
<div class="slider-pill"><div class="icon-round">🚚</div>Transportasi</div>
<div class="slider-pill"><div class="icon-round">🏢</div>Real Estat</div>

<!-- duplicate loop -->
<div class="slider-pill"><div class="icon-round">🏭</div>Industri Pengolahan</div>
<div class="slider-pill"><div class="icon-round">🏗</div>Konstruksi</div>
<div class="slider-pill"><div class="icon-round">🛒</div>Perdagangan</div>
<div class="slider-pill"><div class="icon-round">🍽</div>Akomodasi & Makan Minum</div>
<div class="slider-pill"><div class="icon-round">🚚</div>Transportasi</div>
<div class="slider-pill"><div class="icon-round">🏢</div>Real Estat</div>

</div>
</div>

</div>
</section>

<!-- ================= PENTING ================= -->
<section id="manfaat" class="page-section section -mt-16">
  <div class="max-w-7xl mx-auto px-6">

    <!-- Judul -->
    <div class="card p-12 text-center">
      <h3 class="text-3xl font-extrabold mb-4">
        Mengapa Sensus Ini Penting?
      </h3>
      <p class="text-gray-600 text-lg max-w-3xl mx-auto">
        Data hasil <b>Sensus Ekonomi 2026</b> menjadi dasar
        perencanaan kebijakan, strategi usaha, penelitian,
        serta peningkatan kesejahteraan masyarakat.
      </p>
    </div>

    <!-- INFOGRAFIS -->
    <div class="manfaat-infografis mt-16">

      <h4 class="text-2xl font-extrabold text-center mb-4">
        Manfaat Sensus Ekonomi
      </h4>

      <div class="manfaat-grid">

        <div class="manfaat-box">
          <div class="manfaat-icon">🏛️</div>
          <div class="manfaat-title">Pemerintah</div>
          <div class="manfaat-desc">
            Dasar perencanaan kebijakan ekonomi,
            evaluasi program, dan pengambilan
            keputusan yang lebih tepat sasaran.
          </div>
        </div>

        <div class="manfaat-box">
          <div class="manfaat-icon">🏢</div>
          <div class="manfaat-title">Sektor Bisnis</div>
          <div class="manfaat-desc">
            Informasi pasar, peluang investasi,
            dan gambaran struktur usaha
            di berbagai wilayah.
          </div>
        </div>

        <div class="manfaat-box">
          <div class="manfaat-icon">🎓</div>
          <div class="manfaat-title">Akademisi & Peneliti</div>
          <div class="manfaat-desc">
            Data lengkap dan mutakhir
            untuk penelitian ekonomi,
            sosial, dan kebijakan publik.
          </div>
        </div>

        <div class="manfaat-box">
          <div class="manfaat-icon">👥</div>
          <div class="manfaat-title">Masyarakat</div>
          <div class="manfaat-desc">
            Manfaat tidak langsung melalui
            kebijakan pembangunan serta
            akses data hasil sensus.
          </div>
        </div>

      </div>
    </div>

  </div>
</section>

@php
$selesai = 0;
$proses = 0;
$belum = 0;
$wilayahList = [];

foreach($wilayah as $row){

    $namaWilayah = $row[0] ?? '';
    $status = strtolower(trim($row[1] ?? ''));
    $jumlah = (int) ($row[2] ?? 0);

    $wilayahList[] = $namaWilayah;

    if($status == 'selesai'){
        $selesai += $jumlah;
    } elseif($status == 'proses'){
        $proses += $jumlah;
    } elseif($status == 'belum'){
        $belum += $jumlah;
    }
}

$totalUMK = $umk_submitted + $umk_approved + $umk_rejected;

$totalWilayah = count(array_unique($wilayahList));
@endphp

<!-- ================= DASHBOARD ================= -->
<section id="dashboard" class="page-section py-16 bg-white bg-motif">
<div class="max-w-7xl mx-auto px-6">

<h2 class="text-3xl font-bold text-center mb-14 text-slate-800">
  Dashboard Monitoring
</h2>


<!-- ===================================================== -->
<!-- ================= MONITORING WILAYAH ================= -->
<!-- ===================================================== -->

<div class="mb-16">

  <h3 class="text-xl font-semibold text-slate-700 mb-6">
    Monitoring Wilayah
  </h3>

  <div class="grid md:grid-cols-4 gap-6">

    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-6 text-center border-l-4 border-green-500">
      <p class="text-slate-500 mb-2">Wilayah Selesai</p>
      <h3 class="text-4xl font-extrabold text-green-600">{{ $selesai }}</h3>
    </div>

    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-6 text-center border-l-4 border-yellow-500">
      <p class="text-slate-500 mb-2">Wilayah Proses</p>
      <h3 class="text-4xl font-extrabold text-yellow-500">{{ $proses }}</h3>
    </div> 

    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-6 text-center border-l-4 border-red-500">
      <p class="text-slate-500 mb-2">Wilayah Belum</p>
      <h3 class="text-4xl font-extrabold text-red-600">{{ $belum }}</h3>
    </div>

    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-6 text-center border-l-4 border-blue-600">
      <p class="text-slate-500 mb-2">Total Wilayah</p>
      <h3 class="text-4xl font-extrabold text-blue-700">{{ $totalWilayah }}</h3>
    </div>

  </div>
</div>



<!-- ===================================================== -->
<!-- ================= MONITORING USAHA ================== -->
<!-- ===================================================== -->

<div>

  <h3 class="text-xl font-semibold text-slate-700 mb-6">
    Monitoring Usaha
  </h3>

  <div class="grid md:grid-cols-3 gap-8">

    <!-- UMK -->
    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-8">
      <div class="flex items-center gap-4 mb-6">
        <div class="w-14 h-14 flex items-center justify-center rounded-full bg-blue-100 text-2xl">
          🏪
        </div>
        <div>
          <h4 class="font-bold text-slate-700">UMK</h4>
          <p class="text-sm text-slate-400">Usaha Mikro Kecil</p>
        </div>
      </div>

      <div class="space-y-3">
        <div class="flex justify-between">
          <span class="text-slate-500">Submitted</span>
          <span class="font-bold text-blue-600">{{ $umk_submitted }}</span>
        </div>

        <div class="flex justify-between">
          <span class="text-slate-500">Approved</span>
          <span class="font-bold text-green-600">{{ $umk_approved }}</span>
        </div>

        <div class="flex justify-between">
          <span class="text-slate-500">Rejected</span>
          <span class="font-bold text-red-600">{{ $umk_rejected }}</span>
        </div>

        <hr class="my-4">

        <div class="flex justify-between text-lg">
          <span class="font-semibold">Total UMK</span>
          <span class="font-extrabold text-indigo-700">{{ $totalUMK }}</span>
        </div>
      </div>
    </div>


    <!-- USAHA BESAR -->
    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-8">
      <div class="flex items-center gap-4 mb-6">
        <div class="w-14 h-14 flex items-center justify-center rounded-full bg-green-100 text-2xl">
          🏢
        </div>
        <div>
          <h4 class="font-bold text-slate-700">Usaha Besar</h4>
          <p class="text-sm text-slate-400">Perusahaan Besar</p>
        </div>
      </div>

      <div class="space-y-3">
        <div class="flex justify-between">
          <span class="text-slate-500">Submitted</span>
          <span class="font-bold text-blue-600">{{ $besar_submitted }}</span>
        </div>

        <div class="flex justify-between">
          <span class="text-slate-500">Approved</span>
          <span class="font-bold text-green-600">{{ $besar_approved }}</span>
        </div>

        <div class="flex justify-between">
          <span class="text-slate-500">Rejected</span>
          <span class="font-bold text-red-600">{{ $besar_rejected }}</span>
        </div>

        <hr class="my-4">

        <div class="flex justify-between text-lg">
          <span class="font-semibold">Total Usaha Besar</span>
          <span class="font-extrabold text-indigo-700">{{ $totalBesar }}</span>
        </div>
      </div>
    </div>


    <!-- GRAND TOTAL -->
    <div class="bg-gradient-to-br from-indigo-600 to-blue-600 text-white rounded-2xl shadow-xl p-8">
      <div class="flex items-center gap-4 mb-6">
        <div class="w-14 h-14 flex items-center justify-center rounded-full bg-white/20 text-2xl">
          📊
        </div>
        <div>
          <h4 class="font-bold">Grand Total</h4>
          <p class="text-sm opacity-80">Keseluruhan Usaha</p>
        </div>
      </div>

      <div class="space-y-3">
        <div class="flex justify-between">
          <span>Submitted</span>
          <span class="font-bold">{{ $grand_submitted }}</span>
        </div>

        <div class="flex justify-between">
          <span>Approved</span>
          <span class="font-bold">{{ $grand_approved }}</span>
        </div>

        <div class="flex justify-between">
          <span>Rejected</span>
          <span class="font-bold">{{ $grand_rejected }}</span>
        </div>

        <hr class="my-4 border-white/30">

        <div class="flex justify-between text-xl">
          <span class="font-semibold">Grand Total</span>
          <span class="font-extrabold">{{ $grand_total }}</span>
        </div>
      </div>
    </div>

  </div>
</div>

</div>
</section>

<!-- ================= GALERI INFORMASI ================= -->
<section id="galeri" class="page-section section" style="background:var(--bps-cream)">
  <div class="max-w-6xl mx-auto px-6">

    <h2 class="h2 text-center mb-14">
      Komitmen bersama Bupati Lahat dalam Menyukseskan Sensus Ekonomi 2026
    </h2>

    <div class="grid md:grid-cols-2 gap-14 items-center">

      <!-- KOLOM KIRI -->
      <div class="card p-6">
        <img
          src="/images/foto_komitmen.jpeg"
          alt="Informasi SE2026"
          class="rounded-2xl shadow-lg w-full"
        >
        <p class="mt-5 text-center text-gray-600 font-semibold">
          Penandatanganan Komitmen bersama Menyukseskan Sensus Ekonomi 2026
        </p>
      </div>

      <!-- KOLOM KANAN -->
      <div class="card p-6">
        <img
          src="/images/komitmen_se.png"
          alt="Manfaat SE2026"
          class="rounded-2xl shadow-lg w-full"
        >
        <p class="mt-5 text-center text-gray-600 font-semibold">
          Komitmen bersama Menyukseskan Sensus Ekonomi 2026
        </p>
      </div>

    </div>

  </div>
</section>

<!-- ================= DOKUMENTASI KEGIATAN ================= -->
<section id="dokumentasi" class="page-section section bg-white bg-motif">
  <div class="max-w-6xl mx-auto px-6">

    <h2 class="h2 text-center mb-6">
      Galeri Kegiatan Sensus Ekonomi 2026
    </h2>

    <p class="text-center text-gray-600 max-w-3xl mx-auto mb-14">
      Galeri kegiatan sosialisasi, pendataan, dan komitmen bersama
      dalam menyukseskan <b>Sensus Ekonomi 2026</b>.
    </p>

    <!-- GRID DOKUMENTASI -->
    <div class="grid md:grid-cols-3 gap-8">

      <!-- REELS 1 -->
      <div class="card p-4">
        <iframe
          src="https://www.instagram.com/reel/DUR_iv9jyGN/embed"
          class="w-full h-[420px] rounded-2xl"
          frameborder="0"
          scrolling="no"
          allowtransparency="true">
        </iframe>
        <p class="text-center mt-4 text-sm font-semibold text-gray-600">
          Ground Check Praprelist SE2026
        </p>
      </div>

      <!-- REELS 2 (Updated) -->
      <div class="card p-4">
        <iframe
          src="https://www.instagram.com/reel/DUABmyHj_eT/embed"
          class="w-full h-[420px] rounded-2xl"
          frameborder="0"
          scrolling="no"
          allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
        </iframe>
        <p class="text-center mt-4 text-sm font-semibold text-gray-600">
          Info Sensus Ekonomi 2026
        </p>
      </div>

      <!-- REELS 3 -->
      <div class="card p-4">
        <iframe
          src="https://www.instagram.com/reel/DT9x_0bkfg-/embed"
          class="w-full h-[420px] rounded-2xl"
          frameborder="0"
          scrolling="no"
          allowtransparency="true">
        </iframe>
        <p class="text-center mt-4 text-sm font-semibold text-gray-600">
          Kunjungan Bupati Kabupaten Lahat
        </p>
      </div>

    </div>

    <!-- GRID FOTO KEGIATAN -->
<div class="mt-16">

  <h3 class="text-xl font-bold text-center mb-8 text-gray-800">
    Dokumentasi Foto Kegiatan
  </h3>

  <div class="grid md:grid-cols-3 gap-8">

    <!-- FOTO 1 -->
    <div class="card overflow-hidden">
      <img 
        src="{{ asset('images/FOTO_1.jpeg') }}"
        class="w-full h-[260px] object-cover transition duration-500 hover:scale-105"
        alt="Sosialisasi SE2026">
      <p class="text-center py-3 text-sm font-semibold text-gray-600">
        Ground Check Pasar Lama
      </p>
    </div>

    <!-- FOTO 2 -->
    <div class="card overflow-hidden">
      <img 
        src="{{ asset('images/FOTO_2.jpeg') }}"
        class="w-full h-[260px] object-cover transition duration-500 hover:scale-105"
        alt="Pendataan SE2026">
      <p class="text-center py-3 text-sm font-semibold text-gray-600">
        Ground Check Citimall
      </p>
    </div>

    <!-- FOTO 3 -->
    <div class="card overflow-hidden">
      <img 
        src="{{ asset('images/FOTO_3.jpeg') }}"
        class="w-full h-[260px] object-cover transition duration-500 hover:scale-105"
        alt="Rakor SE2026">
      <p class="text-center py-3 text-sm font-semibold text-gray-600">
        Ground Check Manggul
      </p>
    </div>

  </div>

</div>

    <!-- TOMBOL GOOGLE DRIVE PROFESIONAL -->
<div class="text-center mt-16">
  <a
    href="https://drive.google.com/drive/folders/1bk0QDH86FP2pcEx7KCZyM9hAdBC_lL-z?usp=drive_link"
    target="_blank"
    class="inline-flex items-center gap-3 px-10 py-4 rounded-xl font-semibold text-white
           shadow-lg transition duration-300 hover:shadow-2xl hover:-translate-y-0.5
           focus:outline-none focus:ring-4 focus:ring-orange-200"
    style="background:linear-gradient(135deg,#E07A24,#f59e0b)">

    <!-- Icon Drive -->
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
      <path d="M7.71 3h8.58l4.71 8.16-4.29 7.43H7.29L3 11.16 7.71 3zM9.1 5.5 6 10.87l3.2 5.63h5.6l3.2-5.63L14.9 5.5H9.1z"/>
    </svg>

    <span>
      Lihat Selengkapnya di Sini
    </span>
  </a>
</div>

  </div>
</section>

<section class="page-section section bg-white bg-motif" id="informasi-pendukung">
  <div class="max-w-6xl mx-auto px-6">

    <div class="text-center mb-14">
      <h2 class="h2 mb-4 text-slate-800">
        Informasi Pendukung Sensus Ekonomi 2026
      </h2>
      <p class="text-gray-600 max-w-3xl mx-auto">
        Akses berbagai dokumen resmi, materi sosialisasi, paparan, serta jadwal
        kegiatan untuk mendukung pelaksanaan <b>Sensus Ekonomi 2026</b>.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

      <!-- Materi SE -->
      <a href="https://drive.google.com/drive/folders/1QabwNgOaQt7S5_2G-W4VtMQGLQeVuf-5?usp=drive_link"
         target="_blank"
         class="group bg-white rounded-2xl p-8 shadow-md hover:shadow-xl transition border border-gray-100">

        <div class="flex items-center justify-center w-16 h-16 rounded-full mb-6"
             style="background:rgba(224,122,36,.12)">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 6v6l4 2M20 12a8 8 0 11-16 0 8 8 0 0116 0z" />
          </svg>
        </div>

        <h3 class="text-lg font-extrabold text-slate-800 mb-2 group-hover:text-orange-600">
          Materi Sensus Ekonomi
        </h3>

        <p class="text-sm text-slate-600 leading-relaxed">
          Modul, panduan teknis, serta bahan pembelajaran resmi
          untuk pelaksanaan Sensus Ekonomi 2026.
        </p>

        <span class="inline-block mt-5 text-orange-600 font-semibold">
          Akses Dokumen →
        </span>
      </a>

      <!-- Paparan SE -->
      <a href="https://drive.google.com/drive/folders/1wWs9iDWhKV3GzieChPMKQXoThv4XPXWC?usp=drive_link"
         target="_blank"
         class="group bg-white rounded-2xl p-8 shadow-md hover:shadow-xl transition border border-gray-100">

        <div class="flex items-center justify-center w-16 h-16 rounded-full mb-6"
             style="background:rgba(22,163,74,.12)">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 17v-2a4 4 0 014-4h4" />
          </svg>
        </div>

        <h3 class="text-lg font-extrabold text-slate-800 mb-2 group-hover:text-green-600">
          Paparan dan Sosialisasi
        </h3>

        <p class="text-sm text-slate-600 leading-relaxed">
          Slide presentasi, bahan paparan, serta media sosialisasi
          resmi Sensus Ekonomi 2026.
        </p>

        <span class="inline-block mt-5 text-green-600 font-semibold">
          Akses Paparan →
        </span>
      </a>

      <!-- Timeline Kegiatan -->
      <a href="https://drive.google.com/drive/folders/1FS3Zc4zRq4kGDsb4kFzELwsskboF9Cud?usp=drive_link"
         target="_blank"
         class="group bg-white rounded-2xl p-8 shadow-md hover:shadow-xl transition border border-gray-100">

        <div class="flex items-center justify-center w-16 h-16 rounded-full mb-6"
             style="background:rgba(99,102,241,.12)">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
        </div>

        <h3 class="text-lg font-extrabold text-slate-800 mb-2 group-hover:text-indigo-600">
          Timeline dan Tahapan Kegiatan
        </h3>

        <p class="text-sm text-slate-600 leading-relaxed">
          Jadwal resmi, tahapan pelaksanaan, serta timeline kegiatan
          Sensus Ekonomi 2026.
        </p>

        <span class="inline-block mt-5 text-indigo-600 font-semibold">
          Lihat Timeline →
        </span>
      </a>

    </div>
  </div>
</section>

<!-- ================= KONTAK ================= -->
<section id="kontak" class="text-white section py-16" style="background:var(--bps-orange-dark)">
<div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">

<!-- KOLOM KIRI -->
<div>
<h3 class="text-2xl font-extrabold mb-8">
Badan Pusat Statistik Kabupaten Lahat
</h3>

<div class="space-y-3 text-[15px] leading-relaxed opacity-95">

<div class="flex gap-3">
<span class="w-28 font-semibold">Alamat</span>
<span>: Jl. Bandar Jaya LK III Kel.Bandar Jaya Kab.Lahat</span>
</div>

<div class="flex gap-3">
<span class="w-28 font-semibold">Telepon</span>
<span>: (0731) 321416</span>
</div>

<div class="flex gap-3">
<span class="w-28 font-semibold">Website</span>
<span>: 
<a href="https://lahatkab.bps.go.id/id" target="_blank" class="underline hover:text-orange-300">
lahatkab.bps.go.id
</a>
</span>
</div>

<div class="flex gap-3">
<span class="w-28 font-semibold">Email</span>
<span>: 
<a href="mailto:bps1604@bps.go.id" class="underline hover:text-orange-300">
bps1604@bps.go.id
</a>
</span>
</div>

</div>

<!-- SOCIAL ICON -->
<div class="flex gap-4 mt-8">

<a href="https://www.instagram.com/bpskablahat" target="_blank"
class="w-12 h-12 bg-pink-500 rounded-full flex items-center justify-center shadow-md hover:scale-110 transition">
<i class="fab fa-instagram text-white"></i>
</a>

<a href="https://www.facebook.com/bps1604" target="_blank"
class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center shadow-md hover:scale-110 transition">
<i class="fab fa-facebook-f text-white"></i>
</a>

<a href="https://www.youtube.com/@BPSKabupatenLahat" target="_blank"
class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center shadow-md hover:scale-110 transition">
<i class="fab fa-youtube text-white"></i>
</a>

</div>

</div>

<!-- KOLOM KANAN (BUNG ITUNG FULL) -->
<div class="flex justify-center md:justify-end">

<img
src="/images/bung_itung.png"
alt="Bung Itung"
class="w-80 md:w-[420px] lg:w-[480px] object-contain drop-shadow-xl hover:scale-105 transition duration-300"
/>

</div>

</div>
</section>

<footer class="bg-white text-center py-8 text-gray-500 text-sm">
© 2026 Badan Pusat Statistik — Sensus Ekonomi 2026
</footer>

<!-- ===== FLOATING WHATSAPP ADMIN (PROFESIONAL) ===== -->
<a href="https://wa.me/6285173160403"
   target="_blank"
   class="floating-btn btn-wa flex items-center gap-3
          px-5 py-3 rounded-xl
          text-white font-semibold text-sm tracking-wide
          shadow-xl transition duration-300
          hover:shadow-2xl hover:-translate-y-0.5
          border border-white/20 backdrop-blur-md"
   style="background:linear-gradient(135deg,#25D366,#1fa855)">

  <!-- Icon WhatsApp -->
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
       width="20" height="20" fill="currentColor">
    <path d="M19.11 17.37c-.27-.14-1.62-.8-1.87-.89-.25-.09-.43-.14-.61.14-.18.27-.7.89-.86 1.07-.16.18-.32.2-.59.07-.27-.14-1.15-.42-2.19-1.34-.81-.72-1.35-1.6-1.51-1.87-.16-.27-.02-.42.12-.56.13-.13.27-.32.41-.48.14-.16.18-.27.27-.45.09-.18.05-.34-.02-.48-.07-.14-.61-1.48-.84-2.02-.22-.54-.45-.47-.61-.48-.16-.01-.34-.01-.52-.01-.18 0-.48.07-.73.34-.25.27-.95.93-.95 2.27 0 1.34.98 2.63 1.12 2.82.14.18 1.93 2.95 4.68 4.13.65.28 1.15.45 1.54.57.65.21 1.25.18 1.72.11.52-.08 1.62-.66 1.85-1.3.23-.64.23-1.18.16-1.3-.07-.11-.25-.18-.52-.32z"/>
    <path d="M16 3C9.38 3 4 8.38 4 15c0 2.64.86 5.08 2.32 7.06L4 29l7.18-2.26A11.94 11.94 0 0 0 16 27c6.62 0 12-5.38 12-12S22.62 3 16 3z"/>
  </svg>

  <div class="leading-tight">
    <div class="text-xs opacity-80">
      Layanan Informasi
    </div>
    <div class="font-bold">
      Admin SE2026
    </div>
  </div>

</a>

<!-- ================= CHATBOT ================= -->
<div class="chat-box flex flex-col" id="chatBox">

<div class="chat-head flex justify-between items-center gap-2">
  <span>🤖 Bung Itung</span>

  <div class="flex gap-2">

    <button onclick="toggleChat()">✕</button>
  </div>
</div>

<div id="chatBody" class="chat-body flex-1 p-4 space-y-2">
<div class="msg bot">
Halo! Saya Bung Itung. Siap membantu pertanyaan Sensus Ekonomi 2026.
</div>
</div>

<div class="p-3 border-t flex gap-2">
<input id="chatText"
class="flex-1 border rounded-full px-3 py-2 text-sm"
placeholder="Tulis pertanyaan..."
onkeydown="if(event.key==='Enter') sendChat()">

<button onclick="sendChat()"
class="bg-orange-500 text-white px-4 py-2 rounded-full text-sm font-semibold">
Kirim
</button>
</div>

</div>

<button onclick="toggleChat()"
class="btn-chat-toggle bg-orange-500 text-white px-7 py-3 rounded-full shadow-2xl font-semibold">
💬 Tanya Bung Itung
</button>

<script>
function toggleChat(){
let c=document.getElementById('chatBox');
c.style.display = (c.style.display==='flex') ? 'none' : 'flex';
}

function addMsg(t,type){
  let b=document.getElementById('chatBody');
  let d=document.createElement('div');
  d.className='msg '+type;
  d.innerText=t;
  b.appendChild(d);

  // auto scroll ke bawah
  setTimeout(()=>{
    b.scrollTop = b.scrollHeight;
  },50);
}

function norm(t){
return t.toLowerCase().replace(/[^\w\s]/g,'');
}

function has(q,words){
return words.some(w => q.includes(w));
}

function reply(q){
q = norm(q);

if(has(q,['halo','hai','hi','selamat']))
return "Halo! Saya Bung Itung. Tanyakan info SE2026 — jadwal, pengisian online, atau pendataan lapangan.";

if(has(q,['jadwal','kapan','tanggal']))
return "Pengisian online 1-31 Mei 2026, lapangan 1 Juni – 31 Juli 2026.";

if(has(q,['apa itu','pengertian']))
return "Program pemerintah untuk menyediakan data dasar seluruh kegiatan ekonomi yang dilaksanakan 10 tahun sekali.";

if(has(q,['online','kuesioner']))
return "Pengisian Kuesioner SE2026 Online, pada periode ini perusahaan besar akan mendapatkan email untuk mengisi kuesioner secara mandiri (Online).";

if(has(q,['lapangan','petugas']))
return "Pendataan Lapangan (Door to Door), Bagi semua usaha/perusahaan yang belum memperoleh email untuk pengisian secara mandiri, maka pendataan akan dilakukan secara langsung oleh petugas SE2026.";

if(has(q,['tujuan','manfaat','penting']))
return "Mendukung perencanaan dan keputusan strategis, Memotret tren perekonomian terkini, dan Membantu pelaku usaha mengidentifikasi peluang dan tantangan bisnis. ";

if(has(q,['kontak','email']))
return "Email: bps1604@bps.go.id";

if(has(q,['bagaimana']))
return "Melalui Pengisian Kuesioner SE2026 Online dan Pendataan Lapangan (Door to Door).";

return "Saya siap bantu info SE2026. Bisa tanya jadwal, cara pengisian, atau kontak.";
}

function sendChat(){
let i=document.getElementById('chatText');
let v=i.value.trim();
if(!v) return;
addMsg(v,'user');
i.value='';
setTimeout(()=>addMsg(reply(v),'bot'),450);
}

// pastikan chatbot tersembunyi saat halaman pertama kali load
document.addEventListener("DOMContentLoaded", function(){
  document.getElementById('chatBox').style.display = 'none';
});

/* ===== LOGIN LOGIC ===== */
function openLogin(){
  document.getElementById("loginOverlay").style.display = "flex";
}

function closeLogin(){
  document.getElementById("loginOverlay").style.display = "none";
}

function openRegister(){
  document.getElementById("loginOverlay").style.display = "none";
  document.getElementById("registerOverlay").style.display = "flex";
}

function closeRegister(){
  document.getElementById("registerOverlay").style.display = "none";
}

document.getElementById("loginForm").addEventListener("submit", function(e){
  e.preventDefault();

  const user = document.getElementById("username").value.trim();
  const pass = document.getElementById("password").value.trim();
  const msg  = document.getElementById("loginMsg");

  // SIMULASI LOGIN (tanpa backend)
  if(user === "bpsadmin" && pass === "se2026"){
    msg.textContent = "✅ Login berhasil. Membuka dashboard...";
    msg.className = "text-center text-sm font-semibold text-green-600";
    msg.classList.remove("hidden");

    setTimeout(()=>openDashboard(), 900);
  } else {
    msg.textContent = "❌ Username atau password salah.";
    msg.className = "text-center text-sm font-semibold text-red-600";
    msg.classList.remove("hidden");
  }
});

document.getElementById("registerForm").addEventListener("submit", function(e){
  e.preventDefault();
  const msg = document.getElementById("registerMsg");
  msg.textContent = "✅ Registrasi berhasil (simulasi). Silakan login.";
  msg.className = "text-center text-sm font-semibold text-green-600";
  msg.classList.remove("hidden");

  setTimeout(()=>{
    closeRegister();
    openLogin();
  }, 1200);
});

/* ===== DASHBOARD LOGIC ===== */
function openDashboard(){
  document.getElementById("loginOverlay").style.display = "none";
  document.getElementById("dashboardPanel").style.display = "block";
  loadDashboardData();
}

function logoutDashboard(){
  document.getElementById("dashboardPanel").style.display = "none";
}

/* ===== GOOGLE SHEET DATA (CSV PUBLIC) ===== */
const SHEET_URL = "https://docs.google.com/spreadsheets/d/e/2PACX-1vSqzstxDlaEIZCbOhBQ9jHnEZQ_2vloz4eqLNHs3XwnJKZeExxhRaHdxAmFFZ8ZPbDwx045soTv6QEt/pub?gid=1370004871&single=true&output=csv";

/* ===== SETTING GLOBAL CHART.JS ===== */
Chart.defaults.color = "#374151";
Chart.defaults.font.family = "Inter";
Chart.defaults.font.weight = "600";

let chartHarian, chartTarget;

function loadDashboardData(){
fetch(SHEET_URL)
.then(res => res.text())
.then(csvText => {

  const rows = csvText.trim().split("\n");
  const headers = rows.shift().split(",");

  const data = rows.map(row => {
    const cols = row.split(",");
    let obj = {};
    headers.forEach((h, i) => {
      obj[h.trim()] = cols[i] ? cols[i].trim() : "";
    });
    return obj;
  });

  const labels = data.map(r => r[headers[0]]);
  const total = data.map(r => Number(r[headers[1]]) || 0);
  const selesai = data.map(r => Number(r[headers[2]]) || 0);
  const proses = data.map(r => Number(r[headers[3]]) || 0);
  const lapangan = data.map(r => Number(r[headers[4]]) || 0);

  const totalAkhir = total.at(-1) || 0;
  const selesaiAkhir = selesai.at(-1) || 0;
  const prosesAkhir = proses.at(-1) || 0;
  const lapanganAkhir = lapangan.at(-1) || 0;

  // Update KPI
  document.getElementById("dashTotal").innerText = totalAkhir.toLocaleString();
  document.getElementById("dashSelesai").innerText = selesaiAkhir.toLocaleString();
  document.getElementById("dashProses").innerText = prosesAkhir.toLocaleString();
  document.getElementById("dashLapangan").innerText = lapanganAkhir.toLocaleString();

  // Progress bar
  const persen = totalAkhir ? Math.round((selesaiAkhir / totalAkhir) * 100) : 0;
  document.getElementById("progressFill").style.width = persen + "%";
  document.getElementById("progressText").innerText = persen + "%";

  // Grafik Harian
  if(chartHarian) chartHarian.destroy();
  chartHarian = new Chart(document.getElementById("chartHarian"), {
  type: "line",
  data: {
    labels: labels,
    datasets: [{
      label: "Realisasi Harian",
      data: selesai,
      tension: 0.4,
      fill: true,
      backgroundColor: "rgba(224,122,36,.25)",
      borderColor: "#E07A24",
      borderWidth: 3,
      pointBackgroundColor: "#E07A24",
      pointRadius: 4
    }]
  }
});


  // Grafik Target vs Realisasi
  if(chartTarget) chartTarget.destroy();
  chartTarget = new Chart(document.getElementById("chartTarget"), {
  type: "bar",
  data: {
    labels: labels,
    datasets: [
      {
        label: "Total Target",
        data: total,
        backgroundColor: "rgba(100,116,139,.25)",
        borderColor: "#64748b",
        borderWidth: 2,
        borderRadius: 6
      },
      {
        label: "Realisasi",
        data: selesai,
        backgroundColor: "rgba(224,122,36,.35)",
        borderColor: "#E07A24",
        borderWidth: 2,
        borderRadius: 6
      }
    ]
  }
});


})
.catch(err => console.error("Gagal memuat data Google Sheet:", err));
}


async function loadDashboard() {

  const sheetID = "1CfD_F0TSA6r24ZUI5zPkqgAiqDmDoxNg28RKZsMWjaY";
  const apiKey = "AIzaSyCsFx26sVYJbjoVoDJ37XYb8zfpP3vrvTg";
  const sheetName = "Usaha"; // GANTI jika nama sheet berbeda

  const url = `https://sheets.googleapis.com/v4/spreadsheets/${sheetID}/values/${sheetName}?key=${apiKey}`;

  try {
    const response = await fetch(url);
    const data = await response.json();

    if (!data.values) {
      console.log("Data tidak ditemukan");
      return;
    }

    const rows = data.values.slice(1); // skip header

    let selesai = 0;
    let proses = 0;
    let belum = 0;

    rows.forEach(row => {
      const status = row[3]; // ⚠️ kolom status (ubah jika beda)

      if (status === "Selesai") selesai++;
      else if (status === "Proses") proses++;
      else if (status === "Belum") belum++;
    });

    // === USAHA ===
    document.getElementById("dashSelesai").innerText = selesai;
    document.getElementById("dashProses").innerText = proses;
    document.getElementById("dashBelum").innerText = belum;

    // === WILAYAH ===
    const wilayahList = rows.map(r => r[1]); // ⚠️ kolom wilayah
    const uniqueWilayah = [...new Set(wilayahList)];

    document.getElementById("dashWilTotal").innerText = uniqueWilayah.length;

  } catch (error) {
    console.error("Error:", error);
  }
}

function showPage(id){

  // ===== RESET ACTIVE NAV =====
  document.querySelectorAll('.nav-link').forEach(link=>{
    link.classList.remove('active');
  });

  // ===== SET ACTIVE =====
  const activeLink = document.querySelector(`[onclick="showPage('${id}')"]`);
  if(activeLink){
    activeLink.classList.add('active');
  }

  // ===== SEMBUNYIKAN SEMUA =====
  document.querySelectorAll('.page-section').forEach(sec=>{
    sec.style.display = 'none';
  });

  // ===== TAMPILKAN =====
  if(id === 'hero'){
    document.getElementById('hero').style.display = 'block';
  }
  else if(id === 'jadwal'){
    document.getElementById('jadwal').style.display = 'block';
  }
  else if(id === 'informasi-sensus'){
  document.getElementById('informasi-sensus').style.display = 'block';
  document.getElementById('manfaat').style.display = 'block'; // ✅ TAMBAHAN
}
  else{
    const el = document.getElementById(id);
    if(el) el.style.display = 'block';

    if(id === 'galeri'){
      document.getElementById('dokumentasi').style.display = 'block';
    }
  }

  document.getElementById('kontak').style.display = 'block';

  window.scrollTo({ top:0, behavior:'smooth' });
}

document.addEventListener("DOMContentLoaded", function(){

  // langsung set beranda + active
  showPage('hero');

  loadDashboard();
});

</script>

</body>
</html>
