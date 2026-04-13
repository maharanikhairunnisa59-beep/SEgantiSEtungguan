<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Monitoring Sensus Ekonomi 2026 - BPS</title>

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.4.1/papaparse.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

</head>

<body class="bg-slate-100 font-sans text-slate-800">

<div id="dashboardContent" class="max-w-7xl mx-auto px-6 py-10">

  <!-- HEADER -->
  <div class="flex items-center gap-4 mb-10">
    <img src="{{ asset('images/logo_bps1.png') }}" class="h-12">
    <div>
      <h1 class="text-3xl font-extrabold text-[#0f4c81]">
        Dashboard Monitoring Sensus Ekonomi 2026
      </h1>
      <p class="text-slate-600">Badan Pusat Statistik</p>
    </div>
  </div>

  <div class="flex justify-end items-center gap-3 mb-4">

  <!-- LOGOUT BUTTON -->
  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit"
      class="bg-slate-600 hover:bg-slate-700 text-white px-4 py-2 rounded-lg font-semibold shadow flex items-center gap-2 transition">

      <!-- Icon -->
      <svg xmlns="http://www.w3.org/2000/svg"
           class="h-4 w-4"
           fill="none"
           viewBox="0 0 24 24"
           stroke="currentColor"
           stroke-width="2">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1"/>
      </svg>

      Logout
    </button>
  </form>

  <!-- EXPORT BUTTON -->
  <button id="btnExport"
        onclick="exportPDF()"
        class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg font-semibold shadow flex items-center gap-2">

  <span id="btnExportText">📄 Ekspor PDF</span>

  <svg id="btnExportSpinner"
       class="hidden animate-spin h-4 w-4 text-white"
       xmlns="http://www.w3.org/2000/svg"
       fill="none"
       viewBox="0 0 24 24">
    <circle class="opacity-25" cx="12" cy="12" r="10"
            stroke="currentColor" stroke-width="4"></circle>
    <path class="opacity-75" fill="currentColor"
          d="M4 12a8 8 0 018-8v8z"></path>
  </svg>

</button>

<button id="btnExcel"
  onclick="exportExcel()"
  class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg font-semibold shadow flex items-center gap-2">

  <span id="btnExcelText">📊 Download Excel</span>

  <svg id="btnExcelSpinner"
       class="hidden animate-spin h-4 w-4 text-white"
       xmlns="http://www.w3.org/2000/svg"
       fill="none"
       viewBox="0 0 24 24">
    <circle class="opacity-25" cx="12" cy="12" r="10"
            stroke="currentColor" stroke-width="4"></circle>
    <path class="opacity-75" fill="currentColor"
          d="M4 12a8 8 0 018-8v8z"></path>
  </svg>

</button>

</div>

  <!-- TAB MENU -->
  <div class="flex justify-center gap-3 mb-10">
    <button onclick="showTab(event,'wilayah')" class="tab-btn active">Wilayah</button>
    <button onclick="showTab(event,'petugas')" class="tab-btn">Petugas</button>
    <button onclick="showTab(event,'usaha')" class="tab-btn">Usaha</button>
  </div>

<!-- ================= WILAYAH ================= -->
<div id="wilayah" class="tab">
  <h2 class="section-title">Progres Wilayah</h2>

  <select id="wilayahFilter" class="filter mb-4" onchange="filterWilayah()"></select>

  <div class="progress-card">
    <div class="flex justify-between mb-2">
      <span class="font-semibold">Capaian Wilayah</span>
      <span id="wilayahPercent" class="font-bold">0%</span>
    </div>
    <div class="progress-bg">
      <div id="wilayahBarPercent" class="progress-bar bg-blue-600"></div>
    </div>
  </div>

  <!-- LABEL KETERANGAN -->
  <div class="mt-2 text-sm text-slate-500">
    <span id="wilayahLabel">Semua Wilayah</span>
  </div>

  <div class="grid md:grid-cols-2 gap-6">
    <div class="card"><canvas id="wilayahPie"></canvas></div>
    <div class="card"><canvas id="wilayahBar"></canvas></div>
  </div>

  <!-- TABLE (SAMA DENGAN GRAFIK) -->
  <div class="table-card">
    <table class="data-table">
      <thead>
        <tr>
          <th>Wilayah</th>
<th>Selesai</th>
<th>Proses</th>
<th>Belum</th>
<th>Jumlah</th>
        </tr>
      </thead>
      <tbody id="wilayahTable"></tbody>
    </table>
  </div>
</div>

  <!-- ================= PETUGAS ================= -->
  <div id="petugas" class="tab hidden">
    <h2 class="section-title">Progres Petugas</h2>

    <div class="grid md:grid-cols-3 gap-4 mb-4">

<select id="filterPetugasSelect" class="filter">
  <option value="ALL">Semua Petugas</option>
</select>

<select id="filterKecamatanSelect" class="filter">
  <option value="ALL">Semua Kecamatan</option>
</select>

</div>

    <div class="progress-card">
      <div class="flex justify-between mb-2">
        <span class="font-semibold">Capaian Petugas</span>
        <span id="petugasPercent" class="font-bold">0%</span>
      </div>
      <div class="progress-bg">
        <div id="petugasBarPercent" class="progress-bar bg-blue-600"></div>
      </div>
    </div>

    <div class="grid grid-cols-1 gap-6">

<div class="grid md:grid-cols-2 gap-6">

  <div id="cardPiePetugas" class="card">
    <canvas id="piePetugas"></canvas>
  </div>

  <div id="cardPieKecamatan" class="card">
    <canvas id="pieKecamatan"></canvas>
  </div>

  <div id="cardBarPetugas" class="card">
    <canvas id="barPetugas"></canvas>
  </div>

  <div id="cardBarKecamatan" class="card">
    <canvas id="barKecamatan"></canvas>
  </div>

</div>


    <div class="table-card">
  <table class="data-table">
<thead>
  <tr>
    <th>Petugas</th>
    <th>Kecamatan</th>
    <th>Open</th>
    <th>Submitted</th>
    <th>Approved</th>
    <th>Rejected</th>
    <th>Realisasi</th>
  </tr>
</thead>
        <tbody id="petugasTable"></tbody>
      </table>
    </div>
  </div>
</div>

  <!-- ================= USAHA ================= -->
<div id="usaha" class="tab hidden">
  <h2 class="section-title">Progres Usaha</h2>

  <div class="flex gap-4 mb-6">
    <select id="usahaKategori" class="filter" onchange="filterUsaha()">
      <option value="ALL">Semua</option>
      <option value="UMK">UMK</option>
      <option value="UB">Usaha Besar</option>
    </select>
  </div>

  <div id="usahaContainer" class="grid md:grid-cols-2 gap-6">
    <div id="colUMK" class="card bg-white p-4 rounded-xl shadow">
      <h3 class="font-bold text-lg mb-4 text-[#0f4c81]">UMK</h3>
      <div style="height: 300px;">
        <canvas id="usahaPieUMK"></canvas>
      </div>
  <div id="searchBoxUMK" class="mt-4 mb-2 hidden">
  <input 
    type="text"
    id="searchUMK"
    placeholder="Cari Kecamatan / Usaha..."
    class="w-full p-2 border rounded-lg"
    onkeyup="searchTable('usahaTableUMK', this.value)">
</div>
      <div class="table-card mt-4">
        <table class="data-table w-full text-left">
          <thead>
            <tr class="border-b">
              <th class="p-2">Kecamatan/Usaha</th>
              <th class="p-2">Submitted</th>
              <th class="p-2">Approved</th>
              <th class="p-2">Rejected</th>
            </tr>
          </thead>
          <tbody id="usahaTableUMK"></tbody>
        </table>
      </div>
    </div>

    <div id="colUB" class="card bg-white p-4 rounded-xl shadow">
      <h3 class="font-bold text-lg mb-4 text-[#0f4c81]">Usaha Besar</h3>
      <div style="height: 300px;">
        <canvas id="usahaPieUB"></canvas>
      </div>
      <div id="searchBoxUB" class="mt-4 mb-2 hidden">
  <input 
    type="text"
    id="searchUB"
    placeholder="Cari Kecamatan / Usaha..."
    class="w-full p-2 border rounded-lg"
    onkeyup="searchTable('usahaTableUB', this.value)">
</div>
      <div class="table-card mt-4">
        <table class="data-table w-full text-left">
          <thead>
            <tr class="border-b">
              <th class="p-2">Kecamatan/Usaha</th>
              <th class="p-2">Submitted</th>
              <th class="p-2">Approved</th>
              <th class="p-2">Rejected</th>
            </tr>
          </thead>
          <tbody id="usahaTableUB"></tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>

async function showTab(evt, tabId){

  document.querySelectorAll('.tab')
    .forEach(t => t.classList.add('hidden'));

  const targetTab = document.getElementById(tabId);
  if(!targetTab) return;

  document.querySelectorAll('.tab-btn')
    .forEach(b => b.classList.remove('active'));

  if(evt && evt.currentTarget){
    evt.currentTarget.classList.add('active');
  }

  targetTab.classList.remove('hidden');

  // ===== TAB YANG PERLU RENDER DATA =====
  if(tabId === "petugas" || tabId === "usaha"){

    showLoading();

    // Tunggu 1 frame agar DOM benar-benar visible
    await new Promise(resolve => requestAnimationFrame(resolve));

    if(tabId === "petugas" && !petugasRendered){
      await filterPetugas();
      petugasRendered = true;
    }

    if(tabId === "usaha" && !usahaRendered){
      await filterUsaha();
      usahaRendered = true;
    }

    hideLoading();
  }
}

async function exportExcel(){

  setExcelLoading(true);

  try{

    const activeTab = document.querySelector(".tab:not(.hidden)");

    if(!activeTab){
      alert("Tidak ada data");
      return;
    }

    let tables = activeTab.querySelectorAll("table");

    if(!tables.length){
      alert("Tabel tidak ditemukan");
      return;
    }

    let html = "";

    tables.forEach(t => {
      html += t.outerHTML + "<br><br>";
    });

    // 🔥 kasih delay biar loading kelihatan smooth
    await new Promise(resolve => setTimeout(resolve, 800));

    let url = 'data:application/vnd.ms-excel,' + encodeURIComponent(html);

    let a = document.createElement("a");

    let tabName = activeTab.id || "Dashboard";
    tabName = tabName.charAt(0).toUpperCase() + tabName.slice(1);

    a.href = url;
    a.download = `Dashboard_${tabName}_SE2026.xls`;

    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);

  }catch(err){
    console.error(err);
    alert("Gagal export Excel");
  }

  setExcelLoading(false);
}

function setExcelLoading(isLoading){

  const btn = document.getElementById("btnExcel");
  const text = document.getElementById("btnExcelText");
  const spinner = document.getElementById("btnExcelSpinner");

  if(isLoading){
    btn.disabled = true;
    btn.classList.add("opacity-70","cursor-not-allowed");
    text.innerText = "Memproses...";
    spinner.classList.remove("hidden");
  } else {
    btn.disabled = false;
    btn.classList.remove("opacity-70","cursor-not-allowed");
    text.innerText = "📊 Download Excel";
    spinner.classList.add("hidden");
  }
}

</script>

<script>
  
let charts = {};
let petugasRendered = false;
let usahaRendered = false;

const filterPetugasSelect = document.getElementById("filterPetugasSelect");
const filterKecamatanSelect = document.getElementById("filterKecamatanSelect");


const wilayahFilter = document.getElementById("wilayahFilter");
const usahaKategori = document.getElementById("usahaKategori");

const colUMK = document.getElementById("colUMK");
const colUB = document.getElementById("colUB");
const usahaContainer = document.getElementById("usahaContainer");

const wilayahPercent = document.getElementById("wilayahPercent");
const wilayahBarPercent = document.getElementById("wilayahBarPercent");
const petugasPercent = document.getElementById("petugasPercent");
const petugasBarPercent = document.getElementById("petugasBarPercent");
const wilayahLabel = document.getElementById("wilayahLabel");

const CSV_WILAYAH = "https://docs.google.com/spreadsheets/d/e/2PACX-1vR0OhtbwxSfJIqD-oEgiJziMaPut-xnUY4eXUBL0bELFZjvM3wM-JjtXzCjfVByqa1IUYqP6yceat4L/pub?gid=383145356&single=true&output=csv";
const CSV_PETUGAS = "https://docs.google.com/spreadsheets/d/e/2PACX-1vR0OhtbwxSfJIqD-oEgiJziMaPut-xnUY4eXUBL0bELFZjvM3wM-JjtXzCjfVByqa1IUYqP6yceat4L/pub?gid=832853981&single=true&output=csv";
const CSV_USAHA_UMK = "https://docs.google.com/spreadsheets/d/e/2PACX-1vR0OhtbwxSfJIqD-oEgiJziMaPut-xnUY4eXUBL0bELFZjvM3wM-JjtXzCjfVByqa1IUYqP6yceat4L/pub?gid=326734621&single=true&output=csv";
const CSV_USAHA_UB  = "https://docs.google.com/spreadsheets/d/e/2PACX-1vR0OhtbwxSfJIqD-oEgiJziMaPut-xnUY4eXUBL0bELFZjvM3wM-JjtXzCjfVByqa1IUYqP6yceat4L/pub?gid=1745670724&single=true&output=csv";


let dataPetugasStruktur = [];
let dataUsaha   = [];
let dataWilayah = [];

function resetPetugasView(){
  [
    "piePetugas",
    "barPetugas",
    "pieKecamatan",
    "barKecamatan"
  ].forEach(id => {
    const canvas = document.getElementById(id);
    if(canvas){
      const chart = Chart.getChart(canvas);
      if(chart) chart.destroy();
    }
  });
}

function showLoading(){
  const loader = document.getElementById("loadingOverlay");
  if(loader) loader.style.display = "flex";
}

function hideLoading(){
  const loader = document.getElementById("loadingOverlay");
  if(loader) loader.style.display = "none";
}

/* ===== LOAD CSV WILAYAH ===== */
async function loadWilayah(){

  dataWilayah = [];

 const res = await fetch(CSV_WILAYAH, { cache: "force-cache" });
  const text = await res.text();

  const delimiter = text.includes(";") ? ";" : ",";
  const rows = text.trim().split("\n");

  const headers = rows.shift()
    .split(delimiter)
    .map(h => h.replace(/"/g,"").trim());

  rows.forEach(r => {

    const cols = r.split(delimiter)
      .map(v => v.replace(/"/g,"").trim());

    const wilayah = cols[0];

    if(!wilayah) return;

    // Loop status pivot
    for(let i=1;i<headers.length;i++){

      const status = headers[i];

      // ❗ Skip kolom jumlah
      if(status.toLowerCase() === "jumlah") continue;

      const jumlah = Number(cols[i] || 0);

      dataWilayah.push({
        a: wilayah,
        label: status,
        jumlah: jumlah
      });

    }

  });

  initWilayah();

dataWilayah.sort((a,b)=>{
  const urut = ["selesai","proses","belum"];
  return urut.indexOf(a.label.toLowerCase()) - urut.indexOf(b.label.toLowerCase());
});

}

async function loadPetugas(){

  dataPetugasStruktur = [];

  const res = await fetch(CSV_PETUGAS, { cache: "force-cache" });
  const text = await res.text();

  const delimiter = text.includes(";") ? ";" : ",";
  const rows = text.trim().split("\n");

  const headers = rows.shift().split(delimiter).map(h=>h.trim());

  // 🔥 DETEKSI OTOMATIS NAMA KOLOM
  const colPetugas  = headers.find(h => h.toLowerCase().includes("petugas"));
  const colKecamatan = headers.find(h => h.toLowerCase().includes("kec"));

  rows.forEach(r=>{

    const cols = r.split(delimiter);
    const row = {};

    headers.forEach((h,i)=>{

      let value = (cols[i] || "").replace(/"/g,"").trim();

      if(
        h.toLowerCase().includes("open") ||
        h.toLowerCase().includes("submitted") ||
        h.toLowerCase().includes("approved") ||
        h.toLowerCase().includes("rejected") ||
        h.toLowerCase().includes("realisasi")
      ){
        row[h] = parseInt(value.replace(/[^0-9]/g,"")) || 0;
      }
      else{
        row[h] = value;
      }

    });

    // 🔥 SAMAKAN KEY AGAR KONSISTEN
    row["Petugas"] = row[colPetugas];
    row["NamaKec"] = row[colKecamatan];

    dataPetugasStruktur.push(row);

  });

  initDropdownPetugas();
  filterPetugas();
}

function hitungProgressPetugas(role){

  let key = "";

  if(role==="KOSEKA") key = "Nama KOSEKA";
  if(role==="PML") key = "Nama PML";
  if(role==="PPL") key = "Nama PPL";

  const hasil = {};

  dataPetugasStruktur.forEach(p => {

    const nama = p[key];

    if(!nama) return;

    if(!hasil[nama]){
      hasil[nama] = {
        total: 0,
        selesai: 0
      };
    }

    hasil[nama].total++;

    // contoh sederhana: semua dianggap selesai
    hasil[nama].selesai++;
  });

  return hasil;
}

function initDropdownPetugas(){

  const petugasList = [...new Set(
    dataPetugasStruktur
      .map(d => bersihNama(d["Petugas"]))   // pastikan kolom sesuai sheet
      .filter(Boolean)
  )];

  const kecamatanList = [...new Set(
    dataPetugasStruktur
      .map(d => bersihNama(d["NamaKec"]))
      .filter(Boolean)
  )];

  petugasList.sort();
  kecamatanList.sort();

petugasList.forEach(n=>{
  filterPetugasSelect.innerHTML += `<option value="${n}">${n}</option>`;
});

  kecamatanList.forEach(n=>{
    filterKecamatanSelect.innerHTML += `<option value="${n}">${n}</option>`;
  });
}

async function loadUsaha(){
  try{

    const [umkRes, ubRes] = await Promise.all([
      fetch(CSV_USAHA_UMK),
      fetch(CSV_USAHA_UB)
    ]);

    const umkText = await umkRes.text();
    const ubText  = await ubRes.text();

    const umkParsed = Papa.parse(umkText.trim(), {
      skipEmptyLines:true
    });

    const ubParsed = Papa.parse(ubText.trim(), {
      skipEmptyLines:true
    });

    const umkHeaders = umkParsed.data[0].map(h =>
      h.toString().toLowerCase().trim()
    );

    const ubHeaders = ubParsed.data[0].map(h =>
      h.toString().toLowerCase().trim()
    );

    console.log("UMK Headers:", umkHeaders);
    console.log("UB Headers:", ubHeaders);

    // ===== FLEXIBLE MATCH =====
    const idxKecamatan = umkHeaders.findIndex(h => h.includes("kec"));
    const idxSubmitted = umkHeaders.findIndex(h => h.includes("submit"));
    const idxApproved  = umkHeaders.findIndex(h => h.includes("approve"));
    const idxRejected  = umkHeaders.findIndex(h => h.includes("reject"));

    const idxNama      = ubHeaders.findIndex(h => h.includes("nama"));
    const idxSubUB     = ubHeaders.findIndex(h => h.includes("submit"));
    const idxAppUB     = ubHeaders.findIndex(h => h.includes("approve"));
    const idxRejUB     = ubHeaders.findIndex(h => h.includes("reject"));

    if(idxKecamatan === -1 || idxNama === -1){
      console.error("Header tetap tidak terbaca!");
      dataUsaha = { UMK:[], UB:[] };
      return;
    }

    dataUsaha = { UMK:[], UB:[] };

// ===== DATA UMK =====
umkParsed.data.slice(1).forEach(row=>{

  const nama = row[idxKecamatan];

  if(!nama) return;
  if(nama.toUpperCase().includes("TOTAL")) return; // 🔥 BUANG TOTAL

  dataUsaha.UMK.push({
    nama      : nama,
    submitted : Number(row[idxSubmitted]) || 0,
    approved  : Number(row[idxApproved])  || 0,
    rejected  : Number(row[idxRejected])  || 0
  });
});

// ===== DATA UB =====
ubParsed.data.slice(1).forEach(row=>{

  const namaRaw = row[idxNama];
  const nama = (namaRaw || "").toString().trim();

  const submitted = Number(row[idxSubUB]) || 0;
  const approved  = Number(row[idxAppUB]) || 0;
  const rejected  = Number(row[idxRejUB]) || 0;

  // 🔥 FILTER LEBIH KETAT
  if(!nama) return;                      // kosong
  if(nama.length < 3) return;            // terlalu pendek
  if(nama.toUpperCase().includes("TOTAL")) return;
  if(nama.toUpperCase().includes("JUMLAH")) return;

  // 🔥 JIKA SEMUA ANGKA 0 → ANGGAP BUKAN DATA
  if(submitted === 0 && approved === 0 && rejected === 0) return;

  dataUsaha.UB.push({
    nama,
    submitted,
    approved,
    rejected
  });

});

    console.log("UMK Loaded:", dataUsaha.UMK.length);
    console.log("UB Loaded:", dataUsaha.UB.length);

  }catch(err){
    console.error("Gagal load usaha:", err);
    dataUsaha = { UMK:[], UB:[] };
  }
}

function toNumber(val){
  if(!val) return 0;

  return parseInt(
    val
      .toString()
      .replace(/\./g,"")      // hapus titik ribuan
      .replace(/,/g,"")       // hapus koma ribuan
      .replace(/[^0-9]/g,"")  // hapus selain angka
  ) || 0;
}

function getTotal(data){

  const filtered = data.filter(d =>
    d.nama?.toUpperCase() !== "TOTAL"
  );

  const totalSubmitted = filtered.reduce((s,d)=>s+d.submitted,0);
  const totalApproved  = filtered.reduce((s,d)=>s+d.approved,0);
  const totalRejected  = filtered.reduce((s,d)=>s+d.rejected,0);

  return [totalSubmitted, totalApproved, totalRejected];
}

function hitungProgressReal(nama, kolomNama){

  const total = dataPetugasStruktur.filter(wil =>
    bersihNama(wil[kolomNama]) === nama
  ).length;

  return {
    total: total,
    selesai: total
  };
}

/* ===== CHART ===== */

const petugasColors = [
  "#0f4c81",
  "#3b82f6",
  "#16a34a",
  "#f59e0b",
  "#dc2626",
  "#8b5cf6",
  "#06b6d4",
  "#ef4444",
  "#10b981",
  "#f97316"
];

function drawChart(id, type, labels, data){

  if (charts[id]) charts[id].destroy();

  charts[id] = new Chart(document.getElementById(id), {
    type,
    data: {
      labels,
      datasets: [{
        label: "Jumlah Data",   // ← TAMBAHKAN INI
        data,
        backgroundColor: labels.map((l, i) => {

  const label = l.toLowerCase();

  // ===== USAHA =====
  if(label.includes("submitted")) return "#3b82f6";
  if(label.includes("approved"))  return "#16a34a";
  if(label.includes("rejected"))  return "#dc2626";

  // ===== WILAYAH =====
  if (label.includes("selesai")) return "#16a34a";
  if (label.includes("proses")) return "#f59e0b";
  if (label.includes("belum")) return "#dc2626";

  // ===== PETUGAS (default selain di atas) =====
  return petugasColors[i % petugasColors.length];
})
      }]
    },
   options: {
  responsive: true,
  maintainAspectRatio: false,
  animation: false,
  plugins: {
    legend: {
      display: type === "pie",
      position: "bottom"
    },
    tooltip: {
      callbacks: {
        label: function(ctx){
          const total = ctx.dataset.data.reduce((a,b)=>a+b,0);
          const val = ctx.raw;
          const pct = total ? ((val/total)*100).toFixed(1) : 0;
          return `${ctx.label}: ${val} (${pct}%)`;
        }
      }
    }
  },
  scales: type === "bar" ? {
    x: {
      ticks: {
        autoSkip: false,
        maxRotation: 60,
        minRotation: 45
      }
    },
    y: {
      beginAtZero: true
    }
  } : {}
}
});
}


/* ===== TABLE ===== */
function fillTable(tbodyId,data){

  const tbody = document.getElementById(tbodyId);
  tbody.innerHTML = "";

  let total = 0;

  data.forEach(d => {

    total += d.jumlah;

    tbody.innerHTML += `
      <tr>
        <td>${d.a}</td>
        <td>${warnaStatus(d.label)}</td>
        <td>${d.jumlah}</td>
      </tr>`;
  });

  tbody.innerHTML += `
    <tr class="font-bold bg-slate-50">
      <td colspan="2">Total</td>
      <td>${total}</td>
    </tr>`;
}

function fillTableWilayahPivot(filteredData){

  const tbody = document.getElementById("wilayahTable");
  tbody.innerHTML = "";

  const pivot = {};

  filteredData.forEach(d => {

    if(!pivot[d.a]){
      pivot[d.a] = {
        selesai: 0,
        proses: 0,
        belum: 0
      };
    }

    const status = d.label.toLowerCase();

    if(status.includes("selesai")) pivot[d.a].selesai += d.jumlah;
    if(status.includes("proses")) pivot[d.a].proses += d.jumlah;
    if(status.includes("belum")) pivot[d.a].belum += d.jumlah;

  });

  // ===== ISI TABEL =====
  Object.keys(pivot).forEach(wilayah => {

    const selesai = pivot[wilayah].selesai;
    const proses  = pivot[wilayah].proses;
    const belum   = pivot[wilayah].belum;
    const total   = selesai + proses + belum;

    tbody.innerHTML += `
      <tr>
        <td>${wilayah}</td>
        <td>${selesai}</td>
        <td>${proses}</td>
        <td>${belum}</td>
        <td>${total}</td>
      </tr>
    `;
  });

  // ===== TOTAL KESELURUHAN =====
  let grandS = 0;
  let grandP = 0;
  let grandB = 0;

  Object.values(pivot).forEach(p=>{
    grandS += p.selesai;
    grandP += p.proses;
    grandB += p.belum;
  });

  tbody.innerHTML += `
  <tr class="font-bold bg-slate-50">
    <td>Total</td>
    <td>${grandS}</td>
    <td>${grandP}</td>
    <td>${grandB}</td>
    <td>${grandS + grandP + grandB}</td>
  </tr>
  `;
}

function warnaStatus(status){
  status = status.toLowerCase();

  if(status.includes("selesai"))
    return `<span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs">${status}</span>`;

  if(status.includes("proses"))
    return `<span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs">${status}</span>`;

  return `<span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs">${status}</span>`;
}

function fillTablePetugasBaru(data){

  const tbody = document.getElementById("petugasTable");
  tbody.innerHTML = "";

  data.forEach(d=>{

    tbody.innerHTML += `
      <tr>
        <td>${d["Petugas"]}</td>
        <td>${d["NamaKec"]}</td>
        <td>${d["Open"]}</td>
        <td>${d["Submitted"]}</td>
        <td>${d["Approved"]}</td>
        <td>${d["Rejected"]}</td>
        <td>${d["Realisasi"]}</td>
      </tr>
    `;
  });
}

/* ===== PROGRESS ===== */
function updateProgress(data){
  const total = data.reduce((a,b)=>a+b.jumlah,0);
  const selesai = data
    .filter(d => d.label.toLowerCase().includes("selesai"))
    .reduce((a,b)=>a+b.jumlah,0);

  const percent = total ? Math.round((selesai/total)*100) : 0;
  wilayahPercent.innerText = percent + "%";
  wilayahBarPercent.style.width = percent + "%";
}

/* ===== FILTER ===== */
function initWilayah(){
  wilayahFilter.innerHTML="";

  // opsi default
  wilayahFilter.innerHTML += `<option value="ALL">Semua Wilayah</option>`;

  const wilayahList = [...new Set(dataWilayah.map(d=>d.a))];

  wilayahList.forEach(w=>{
    wilayahFilter.innerHTML+=`<option value="${w}">${w}</option>`;
  });

  wilayahFilter.value = "ALL";
  filterWilayah();
}

async function filterWilayah(){
  showLoading();
  await delayFrame();

  let f;

  if (wilayahFilter.value === "ALL") {
    f = dataWilayah;
  } else {
    f = dataWilayah.filter(d=>d.a===wilayahFilter.value);
  }

  /* ===== PIVOT DATA PER KECAMATAN ===== */

  const pivot = {};

  f.forEach(d => {

    if(!pivot[d.a]){
      pivot[d.a] = {
        selesai: 0,
        proses: 0,
        belum: 0
      };
    }

    const status = d.label.toLowerCase();

    if(status.includes("selesai")) pivot[d.a].selesai += d.jumlah;
    if(status.includes("proses"))  pivot[d.a].proses  += d.jumlah;
    if(status.includes("belum"))   pivot[d.a].belum   += d.jumlah;

  });

  const labels = Object.keys(pivot);
  const selesaiData = labels.map(k=>pivot[k].selesai);
  const prosesData  = labels.map(k=>pivot[k].proses);
  const belumData   = labels.map(k=>pivot[k].belum);

  /* ===== PIE (TOTAL STATUS) ===== */

  const totalS = selesaiData.reduce((a,b)=>a+b,0);
  const totalP = prosesData.reduce((a,b)=>a+b,0);
  const totalB = belumData.reduce((a,b)=>a+b,0);

  drawChart("wilayahPie","pie",
    ["Selesai","Proses","Belum"],
    [totalS,totalP,totalB]
  );

  /* ===== BAR (PER KECAMATAN) ===== */

  if (charts["wilayahBar"]) charts["wilayahBar"].destroy();

  charts["wilayahBar"] = new Chart(document.getElementById("wilayahBar"), {
  type: "bar",
  data: {
    labels: labels,
    datasets: [
      {
        label: "Selesai",
        data: selesaiData,
        backgroundColor: "#16a34a"
      },
      {
        label: "Proses",
        data: prosesData,
        backgroundColor: "#f59e0b"
      },
      {
        label: "Belum",
        data: belumData,
        backgroundColor: "#dc2626"
      }
    ]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,   // 🔥 penting agar tinggi ikut CSS
    plugins: {
      legend: {
        position: "bottom"
      }
    },
    scales: {
      x: {
        ticks: {
          autoSkip: false,
          maxRotation: 60,
          minRotation: 45
        }
      },
      y: {
        beginAtZero: true
      }
    }
  }
});

  updateProgress(f);
  fillTableWilayahPivot(f);

  wilayahLabel.innerText =
    wilayahFilter.value === "ALL"
      ? "Semua Wilayah"
      : wilayahFilter.value;

      await delayFrame();
hideLoading();
}

function bersihNama(nama){
  return (nama || "")
    .toString()
    .replace(/"/g,"")        // hapus tanda petik
    .replace(/\s+/g," ")     // rapikan spasi
    .trim()
    .toUpperCase();
}

async function filterPetugas(){

  if(!dataPetugasStruktur) return;

  let data = dataPetugasStruktur;

  /* =========================
     FILTER DATA
  ========================== */

  if(filterPetugasSelect && filterPetugasSelect.value !== "ALL"){
    data = data.filter(d =>
      bersihNama(d["Petugas"]) === 
      bersihNama(filterPetugasSelect.value)
    );
  }

  if(filterKecamatanSelect && filterKecamatanSelect.value !== "ALL"){
    data = data.filter(d =>
      bersihNama(d["NamaKec"]) === 
      bersihNama(filterKecamatanSelect.value)
    );
  }

  /* =========================
     HITUNG PROGRESS PETUGAS
  ========================== */

  const progressPetugas = {};

  data.forEach(p => {

    const nama = bersihNama(p["Petugas"]);
    if(!nama) return;

    if(!progressPetugas[nama]){
      progressPetugas[nama] = { total:0, selesai:0 };
    }

    const real = hitungProgressReal(nama, "Petugas");

    progressPetugas[nama].total   = real.total;
    progressPetugas[nama].selesai = real.selesai;
  });

  const labelsPetugas = Object.keys(progressPetugas);
  const valuesPetugas = labelsPetugas.map(n => 
    progressPetugas[n].selesai
  );

  /* =========================
     HITUNG PROGRESS KECAMATAN
  ========================== */

  const progressKecamatan = {};

  data.forEach(p => {

    const kec = bersihNama(p["NamaKec"]);
    if(!kec) return;

    if(!progressKecamatan[kec]){
      progressKecamatan[kec] = { total:0, selesai:0 };
    }

    const real = hitungProgressReal(kec, "NamaKec");

    progressKecamatan[kec].total   = real.total;
    progressKecamatan[kec].selesai = real.selesai;
  });

  const labelsKecamatan = Object.keys(progressKecamatan);
  const valuesKecamatan = labelsKecamatan.map(k => 
    progressKecamatan[k].selesai
  );

  /* =========================
     UPDATE PERSENTASE GLOBAL
  ========================== */

  const totalAll = data.reduce((s,d)=> 
    s + (parseInt(d.Open||0) + 
         parseInt(d.Submitted||0) + 
         parseInt(d.Approved||0) + 
         parseInt(d.Rejected||0)), 0);

  const selesaiAll = data.reduce((s,d)=> 
    s + parseInt(d.Realisasi||0), 0);

  const pct = totalAll ? 
    Math.round((selesaiAll/totalAll)*100) : 0;

  petugasPercent.innerText = pct + "%";
  petugasBarPercent.style.width = pct + "%";

  /* =========================
     RESET VIEW
  ========================== */

  resetPetugasView();

  ["piePetugas","pieKecamatan",
   "barPetugas","barKecamatan"]
  .forEach(id=>{
    if(charts[id]){
      charts[id].destroy();
      delete charts[id];
    }
  });

  /* =========================
     TAMPILKAN CARD
  ========================== */

  const cardPiePetugas     = document.getElementById("cardPiePetugas");
  const cardPieKecamatan   = document.getElementById("cardPieKecamatan");
  const cardBarPetugas     = document.getElementById("cardBarPetugas");
  const cardBarKecamatan   = document.getElementById("cardBarKecamatan");

  if(cardPiePetugas)   cardPiePetugas.style.display = "block";
  if(cardPieKecamatan) cardPieKecamatan.style.display = "block";
  if(cardBarPetugas)   cardBarPetugas.style.display = "block";
  if(cardBarKecamatan) cardBarKecamatan.style.display = "block";

  /* =========================
     RENDER CHART
  ========================== */

  if(labelsPetugas.length){
    drawChart("piePetugas","pie",
      labelsPetugas, valuesPetugas
    );
    drawChart("barPetugas","bar",
      labelsPetugas, valuesPetugas
    );
  }

  if(labelsKecamatan.length){
    drawChart("pieKecamatan","pie",
      labelsKecamatan, valuesKecamatan
    );
    drawChart("barKecamatan","bar",
      labelsKecamatan, valuesKecamatan
    );
  }

  /* =========================
     UPDATE TABLE
  ========================== */

fillTablePetugasBaru(data);

}

async function filterUsaha(){

  const kategori = usahaKategori.value;
  const umk = dataUsaha.UMK;
  const ub  = dataUsaha.UB;

  const searchUMKBox = document.getElementById("searchBoxUMK");
  const searchUBBox  = document.getElementById("searchBoxUB");

  usahaContainer.className = "grid md:grid-cols-2 gap-6";

  // 🔹 Cek data kosong
  if(!umk.length && !ub.length){
    colUMK.innerHTML = "<p class='text-slate-500 text-center py-20'>Data UMK kosong</p>";
    colUB.innerHTML = "<p class='text-slate-500 text-center py-20'>Data UB kosong</p>";
    return;
  }

  // 🔹 Filter SEMUA
  if(kategori === "ALL"){

    colUMK.style.display = "block";
    colUB.style.display  = "block";

    // sembunyikan search
    searchUMKBox.classList.add("hidden");
    searchUBBox.classList.add("hidden");

    drawChart("usahaPieUMK","pie", ["Submitted","Approved","Rejected"], getTotal(umk));
    drawChart("usahaPieUB","pie", ["Submitted","Approved","Rejected"], getTotal(ub));

    fillTableTotalOnly("usahaTableUMK", umk);
    fillTableTotalOnly("usahaTableUB", ub);

  }

  // 🔹 Filter UMK
  else if(kategori === "UMK"){

    usahaContainer.className = "grid grid-cols-1 usaha-single";

    colUMK.style.display = "block";
    colUB.style.display  = "none";

    // tampilkan search UMK
    searchUMKBox.classList.remove("hidden");
    searchUBBox.classList.add("hidden");

    drawChart("usahaPieUMK","pie", ["Submitted","Approved","Rejected"], getTotal(umk));
    fillTableDetail("usahaTableUMK",umk);

  }

  // 🔹 Filter UB
  else if(kategori === "UB"){

    usahaContainer.className = "grid grid-cols-1 usaha-single";

    colUMK.style.display = "none";
    colUB.style.display  = "block";

    // tampilkan search UB
    searchUMKBox.classList.add("hidden");
    searchUBBox.classList.remove("hidden");

    drawChart("usahaPieUB","pie", ["Submitted","Approved","Rejected"], getTotal(ub));
    fillTableDetail("usahaTableUB",ub);

  }

}

function fillTableDetail(id, data){

  const tbody = document.getElementById(id);
  tbody.innerHTML = "";

  // 🔥 Buang baris TOTAL dari sheet kalau ada
  const filtered = data.filter(d =>
    d.nama?.toUpperCase() !== "TOTAL"
  );

  let totalSubmitted = 0;
  let totalApproved  = 0;
  let totalRejected  = 0;

  filtered.forEach(d=>{

    totalSubmitted += d.submitted;
    totalApproved  += d.approved;
    totalRejected  += d.rejected;

    tbody.innerHTML += `
      <tr>
        <td>${d.nama}</td>
        <td>${d.submitted}</td>
        <td>${d.approved}</td>
        <td>${d.rejected}</td>
      </tr>
    `;
  });

  // ✅ TAMBAHKAN 1 TOTAL SAJA
  tbody.innerHTML += `
    <tr class="font-bold bg-gray-100">
      <td>Total</td>
      <td>${totalSubmitted}</td>
      <td>${totalApproved}</td>
      <td>${totalRejected}</td>
    </tr>
  `;
}

function fillTableTotalOnly(id, data){

  const tbody = document.getElementById(id);
  tbody.innerHTML = "";

  // 🔥 Pakai getTotal agar konsisten
  const [totalSubmitted, totalApproved, totalRejected] = getTotal(data);

  tbody.innerHTML = `
    <tr class="font-bold">
      <td>Kabupaten Lahat</td>
      <td>${totalSubmitted}</td>
      <td>${totalApproved}</td>
      <td>${totalRejected}</td>
    </tr>
  `;
}

function searchTable(tableId, keyword){

  const filter = keyword.toLowerCase();
  const rows = document
      .getElementById(tableId)
      .getElementsByTagName("tr");

  for(let i=0;i<rows.length;i++){

    const text = rows[i].innerText.toLowerCase();

    if(text.includes(filter)){
      rows[i].style.display = "";
    } else {
      rows[i].style.display = "none";
    }

  }
}

async function initDashboard(){
  showLoading();

  try {
    await loadWilayah();
    await loadPetugas();
    await loadUsaha();

    await delayFrame();

    document.getElementById("dashboardContent").classList.remove("hidden");

// Default tetap Wilayah
showTab(null, "wilayah");

  } catch(e){
    console.error("INIT ERROR:", e);

    document.getElementById("dashboardContent").innerHTML = `
      <div class="bg-red-50 text-red-700 p-6 rounded-xl">
        <h2 class="font-bold text-lg mb-2">Gagal Memuat Data</h2>
        <p>Periksa koneksi internet atau akses Google Sheet.</p>
      </div>
    `;
  }

  hideLoading();
}

async function exportPDF(){

  setExportLoading(true);

  try {

    const { jsPDF } = window.jspdf;
    const pdf = new jsPDF("p","mm","a4");

    const activeTab = document.querySelector(".tab:not(.hidden)");

    const pageWidth = 210;
    const pageHeight = 297;

    const margin = 20;
    const headerHeight = 40;
    const contentWidth = pageWidth - (margin * 2);
    const contentHeight = pageHeight - headerHeight - 20;

    /* ===== LOAD LOGO ===== */
    const logoImg = await loadImage("{{ asset('images/logo_bps1.png') }}");

    function formatTanggal(){
      const now = new Date();
      const bulan = [
        "Januari","Februari","Maret","April","Mei","Juni",
        "Juli","Agustus","September","Oktober","November","Desember"
      ];
      return `${now.getDate()} ${bulan[now.getMonth()]} ${now.getFullYear()} | ${now.getHours().toString().padStart(2,"0")}:${now.getMinutes().toString().padStart(2,"0")} WIB`;
    }

    function header(page){

      pdf.setFont("helvetica","bold");
      pdf.setFontSize(14);
      pdf.text("Dashboard Monitoring Sensus Ekonomi 2026", margin + 25, 18);

      pdf.setFont("helvetica","normal");
      pdf.setFontSize(10);
      pdf.text("Badan Pusat Statistik", margin + 25, 23);

      pdf.setFontSize(9);
      pdf.text("Tanggal Cetak: " + formatTanggal(), pageWidth - margin - 70, 23);

      pdf.addImage(logoImg, "PNG", margin, 12, 18, 18);

      pdf.setDrawColor(180);
      pdf.line(margin, headerHeight - 2, pageWidth - margin, headerHeight - 2);

      pdf.setFontSize(9);
      pdf.text("Halaman " + page, pageWidth - margin - 20, pageHeight - 10);
    }

    /* ===== CLONE CONTENT ===== */
    const wrapper = document.createElement("div");
    wrapper.style.width = "1000px";
    wrapper.style.background = "white";
    wrapper.style.padding = "30px";
    wrapper.style.position = "absolute";
    wrapper.style.left = "-9999px";

    const clonedTab = activeTab.cloneNode(true);
    wrapper.appendChild(clonedTab);
    document.body.appendChild(wrapper);

    /* ===================================================== */
    /* 🔥 BAGIAN FILTER UNTUK PDF 🔥 */
    /* ===================================================== */

    if(activeTab.id === "petugas"){

      const petugasValue   = filterPetugasSelect.value;
      const kecamatanValue = filterKecamatanSelect.value;

      const label = document.createElement("div");
      label.style.marginBottom = "15px";
      label.style.fontWeight = "bold";

      let text = "Filter: ";

      if(petugasValue !== "ALL"){
        text += "Petugas - " + petugasValue;
      }
      else if(kecamatanValue !== "ALL"){
        text += "Kecamatan - " + kecamatanValue;
      }
      else{
        text += "Semua Data";
      }

      label.innerText = text;
      clonedTab.insertBefore(label, clonedTab.firstChild);
    }

    /* ===== GANTI CANVAS JADI IMAGE ===== */
    const originalCanvas = activeTab.querySelectorAll("canvas");
    const cloneCanvas = wrapper.querySelectorAll("canvas");

    cloneCanvas.forEach((canvasClone,i)=>{
      if(originalCanvas[i]){
        const img = document.createElement("img");
        img.src = originalCanvas[i].toDataURL("image/png");
        img.style.width = "100%";
        canvasClone.replaceWith(img);
      }
    });

    /* ===== CAPTURE HTML ===== */
    const canvas = await html2canvas(wrapper,{scale:2});
    document.body.removeChild(wrapper);

    let y = 0;
    let page = 1;

    while(y < canvas.height){

      const pageCanvas = document.createElement("canvas");
      const ctx = pageCanvas.getContext("2d");

      const pageHeightPx = Math.floor(
        contentHeight * canvas.width / contentWidth
      );

      pageCanvas.width = canvas.width;
      pageCanvas.height = Math.min(pageHeightPx, canvas.height - y);

      ctx.drawImage(
        canvas,
        0, y,
        canvas.width, pageCanvas.height,
        0, 0,
        canvas.width, pageCanvas.height
      );

      if(page > 1) pdf.addPage();

      header(page);

      const finalHeight = pageCanvas.height * contentWidth / pageCanvas.width;

      pdf.addImage(
        pageCanvas.toDataURL("image/png"),
        "PNG",
        margin,
        headerHeight + 5,
        contentWidth,
        finalHeight
      );

      y += pageHeightPx;
      page++;
    }

    let tabName = activeTab.id || "Dashboard";
    tabName = tabName.charAt(0).toUpperCase() + tabName.slice(1);

    const now = new Date();
    const tanggal = now.getFullYear() + 
                    (now.getMonth()+1).toString().padStart(2,"0") +
                    now.getDate().toString().padStart(2,"0");

    pdf.save(`Dashboard_${tabName}_SE2026_${tanggal}.pdf`);

  } catch(err){

    console.error(err);
    alert("Gagal membuat PDF");

  }

  setExportLoading(false);
}

function loadImage(url){
  return new Promise((resolve,reject)=>{
    const img = new Image();
    img.crossOrigin = "Anonymous";
    img.onload = ()=>resolve(img);
    img.onerror = reject;
    img.src = url;
  });
}

function setExportLoading(isLoading){

  const btn = document.getElementById("btnExport");
  const text = document.getElementById("btnExportText");
  const spinner = document.getElementById("btnExportSpinner");

  if(isLoading){
    btn.disabled = true;
    btn.classList.add("opacity-70","cursor-not-allowed");
    text.innerText = "Memproses...";
    spinner.classList.remove("hidden");
  } else {
    btn.disabled = false;
    btn.classList.remove("opacity-70","cursor-not-allowed");
    text.innerText = "📄 Ekspor PDF";
    spinner.classList.add("hidden");
  }
}

filterPetugasSelect.addEventListener("change", () => {

  if(filterPetugasSelect.value !== "ALL"){
    filterKecamatanSelect.value = "ALL";
  }

  filterPetugas();
});

filterKecamatanSelect.addEventListener("change", () => {

  if(filterKecamatanSelect.value !== "ALL"){
    filterPetugasSelect.value = "ALL";
  }

  filterPetugas();
});

function showLoading(){
  const el = document.getElementById("loadingOverlay");
  if(el){
    el.classList.remove("hidden");
    startLoadingText();
  }
}

function hideLoading(){

  const el = document.getElementById("loadingOverlay");
  if(!el) return; // 🔥 TAMBAHAN WAJIB

  setTimeout(()=>{
    el.style.opacity = "0";

    setTimeout(()=>{
      el.classList.add("hidden");
      el.style.opacity = "1";
      stopLoadingText();
    },300);

  },200);
}

function delayFrame(){
  return new Promise(resolve => requestAnimationFrame(resolve));
}

let loadingInterval;

function startLoadingText(){
  const textEl = document.getElementById("loadingText");
  let dots = 0;

  loadingInterval = setInterval(()=>{
    dots = (dots + 1) % 4;
    textEl.innerText = "Sedang mengambil dan memproses data" + ".".repeat(dots);
  }, 500);
}

function stopLoadingText(){
  clearInterval(loadingInterval);
}

document.addEventListener("DOMContentLoaded", function () {
  initDashboard();
});

</script>

<style>
.tab-btn{padding:10px 22px;border-radius:999px;background:#e3f2fd;color:#0f4c81;font-weight:600}
.tab-btn.active{background:#0f4c81;color:white}
.section-title{font-size:1.25rem;font-weight:700;color:#0f4c81;margin-bottom:1rem}
.filter{padding:12px;border-radius:12px;border:1px solid #cbd5e1;background:white}
.card,.progress-card,.table-card{background:white;border-radius:14px;padding:1rem;box-shadow:0 4px 12px rgba(15,76,129,.08);margin-bottom:1.5rem}
.progress-bg{background:#e5e7eb;height:14px;border-radius:999px}
.progress-bar{height:14px;border-radius:999px;transition:.4s}
.data-table{width:100%;border-collapse:collapse}
.data-table th,.data-table td{padding:10px;border-bottom:1px solid #e5e7eb}
.data-table th{text-align:left;background:#f1f5f9;color:#0f4c81}
.data-table th,.data-table td{
  padding:10px;
  border-bottom:1px solid #e5e7eb;
}

tr{
  page-break-inside: avoid;
}

.data-table td{
  max-width:220px;
  word-wrap:break-word;
}

/* Default ukuran chart */
#usaha canvas{
  max-height: 320px;
}

/* Jika 1 kolom (UMK saja atau UB saja) */
.usaha-single canvas{
  max-height: 220px !important;
}

/* ===== WILAYAH CHART SIZE FIX ===== */

#wilayahPie{
  max-height: 260px;   /* perkecil pie */
}

#wilayahBar{
  height: 500px !important;   /* perbesar bar */
}

/* agar label kecamatan banyak tetap muat */
#wilayahBar {
  overflow-x: auto;
}

/* ===== PETUGAS CHART FIX ===== */

#petugasPie{
  max-height: 300px;
}

#petugasBar{
  height: 650px !important;
}

#petugasBar canvas{
  min-width: 1200px;
}

#barKoseka,
#barPML,
#barPPL{
  height: 350px !important;
}

#pieKoseka,
#piePML,
#piePPL{
  max-height: 280px;
}

#loadingOverlay{
  transition: opacity .3s ease;
}

/* Jika chart kosong tetap ada minimum height */
#usahaPieUMK, #usahaPieUB,
#usahaPieUMK canvas, #usahaPieUB canvas {
  min-height: 200px;
}

/* ===== WARNA LIST TABLE ===== */

.data-table tbody tr:nth-child(odd){
  background-color:#fff7ed;
}

.data-table tbody tr:nth-child(even){
  background-color:#ffffff;
}

.data-table tbody tr:hover{
  background-color:#fed7aa;
  transition:0.2s;
}

</style>

<!-- ===== LOADING OVERLAY ===== -->
<div id="loadingOverlay" class="fixed inset-0 bg-white/80 backdrop-blur-sm flex items-center justify-center z-50 hidden">

  <div class="flex flex-col items-center gap-4 text-center">

    <!-- Spinner -->
    <div class="w-14 h-14 border-4 border-blue-200 border-t-blue-600 rounded-full animate-spin"></div>

    <!-- Judul -->
    <h2 class="text-xl font-bold text-[#0f4c81]">
      Sedang Memuat Data
    </h2>

    <!-- Sub text dinamis -->
    <p id="loadingText" class="text-slate-600">
      Mohon tunggu sebentar...
    </p>

  </div>

</div>

</body>
</html>

