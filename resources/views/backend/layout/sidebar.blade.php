  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

   <ul class="sidebar-nav" id="sidebar-nav">

     <li class="nav-item">
       <a class="nav-link " href="/dashboard">
         <i class="bi bi-grid"></i>
         <span>Dashboard</span>
       </a>
     </li><!-- End Dashboard Nav -->
     <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('admin.sales-report') }}">
        <i class="bi bi-bar-chart-line"></i>
        <span>Lap. Penjualan</span>
      </a>
    </li>
     <li class="nav-item">
      <a class="nav-link collapsed" href="/categories">
        <i class="bi bi-tags"></i>
        <span>Kategori</span>
      </a>
    </li>
     <li class="nav-item">
      <a class="nav-link collapsed" href="/products">
        <i class="bi bi-box-seam"></i>
        <span>Produk</span>
      </a>
    </li>
     <li class="nav-item">
       <a class="nav-link collapsed" href="/user">
         <i class="bi bi-person"></i>
         <span>User</span>
       </a>
     </li>
     <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('admin.orders.index') }}">
        <i class="bi bi-bag-check"></i>
        <span>Pesanan</span>
      </a>
    </li><!-- End Profile Page Nav -->

   </ul>

 </aside><!-- End Sidebar-->