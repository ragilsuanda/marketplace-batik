@extends('backend.layout.app')

@section('content')
   <div class="pagetitle">
     <h1>Dashboard</h1>
     <nav>
       <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="#">Home</a></li>
         <li class="breadcrumb-item active">Dashboard</li>
       </ol>
     </nav>
   </div>

   <section class="section dashboard">
     <div class="row g-3">
       <div class="col-lg-4 col-md-6">
         <div class="card info-card sales-card">
           <div class="card-body">
             <h5 class="card-title">Laporan Masuk</h5>
             <div class="d-flex align-items-center">
               <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                 <i class="bi bi-file-earmark-text"></i>
               </div>
               <div class="ps-3">
                 <h6>{{ $totalReports }}</h6>
                 <span class="text-muted small"> laporan yang masuk</span>
               </div>
             </div>
           </div>
         </div>
       </div>

       <div class="col-lg-4 col-md-6">
         <div class="card info-card revenue-card">
           <div class="card-body">
             <h5 class="card-title">Laporan Disetujui</h5>
             <div class="d-flex align-items-center">
               <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                 <i class="bi bi-check-circle"></i>
               </div>
               <div class="ps-3">
                 <h6>{{ $approvedReports }}</h6>
                 <span class="text-muted small"> laporan yang disetujui</span>
               </div>
             </div>
           </div>
         </div>
       </div>

       <div class="col-lg-4 col-md-6">
         <div class="card info-card customers-card">
           <div class="card-body">
             <h5 class="card-title">Waktu Sekarang</h5>
             <div class="d-flex align-items-center">
               <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                 <i class="bi bi-clock"></i>
               </div>
               <div class="ps-3">
                 <h6 id="currentTime" class="small fw-bold"></h6>
                 <span class="text-muted small">Jam & Tanggal</span>
               </div>
             </div>
           </div>
         </div>
       </div>
       <div class="col-12">
         <div class="card">
           <div class="card-body">
             <h5 class="card-title">Jumlah Laporan per Bulan</h5>
             <canvas id="barChart" style="max-height: 400px;"></canvas>
           </div>
         </div>
       </div>

     </div>
   </section>

   <script>
     function updateTime() {
         let now = new Date();
         let timeString = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
         let dateString = now.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
         document.getElementById("currentTime").innerHTML = `<span style="font-size: 12px;">${timeString} - ${dateString}</span>`;
     }
     setInterval(updateTime, 1000);
     updateTime();

     document.addEventListener("DOMContentLoaded", () => {
         new Chart(document.querySelector("#barChart"), {
             type: "bar",
             data: {
                 labels: {!! json_encode($months) !!}, // Nama bulan
                 datasets: [{
                     label: "Jumlah Laporan",
                     data: {!! json_encode($reportCounts) !!}, // Data laporan per bulan
                     backgroundColor: [
                         'rgba(255, 99, 132, 0.2)',
                         'rgba(255, 159, 64, 0.2)',
                         'rgba(255, 205, 86, 0.2)',
                         'rgba(75, 192, 192, 0.2)',
                         'rgba(54, 162, 235, 0.2)',
                         'rgba(153, 102, 255, 0.2)',
                         'rgba(201, 203, 207, 0.2)',
                         'rgba(50, 168, 82, 0.2)',
                         'rgba(128, 0, 128, 0.2)',
                         'rgba(255, 165, 0, 0.2)',
                         'rgba(0, 255, 127, 0.2)',
                         'rgba(70, 130, 180, 0.2)'
                     ],
                     borderColor: [
                         'rgb(255, 99, 132)',
                         'rgb(255, 159, 64)',
                         'rgb(255, 205, 86)',
                         'rgb(75, 192, 192)',
                         'rgb(54, 162, 235)',
                         'rgb(153, 102, 255)',
                         'rgb(201, 203, 207)',
                         'rgb(50, 168, 82)',
                         'rgb(128, 0, 128)',
                         'rgb(255, 165, 0)',
                         'rgb(0, 255, 127)',
                         'rgb(70, 130, 180)'
                     ],
                     borderWidth: 1
                 }]
             },
             options: {
                 responsive: true,
                 scales: {
                     y: {
                         beginAtZero: true
                     }
                 }
             }
         });
     });
   </script>
@endsection
