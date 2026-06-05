<header id="header" class="header fixed-top d-flex align-items-center">

   <div class="d-flex align-items-center justify-content-between">
     <a href="index.html" class="logo d-flex align-items-center">
       <span class="d-none d-lg-block">BeSafe</span>
     </a>
     <i class="bi bi-list toggle-sidebar-btn"></i>
   </div><!-- End Logo -->

   <nav class="header-nav ms-auto">
     <ul class="d-flex align-items-center">

       <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-person-circle fs-4 text-primary"></i>
          <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
      </a>

         <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
           <li>
           </li>
           <li>
             <hr class="dropdown-divider">
           </li>

           <li>
            <a class="dropdown-item d-flex align-items-center" href="{{ route('user.edit', Auth::user()->id) }}">
                <i class="bi bi-gear"></i>
                <span>Account Settings kontol </span>
            </a>
          </li>
           <li>
             <hr class="dropdown-divider">
           </li>
           <li>
             <hr class="dropdown-divider">
           </li>

           <li>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="dropdown-item d-flex align-items-center border-0 bg-transparent">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </button>
            </form>
          </li>

         </ul><!-- End Profile Dropdown Items -->
       </li><!-- End Profile Nav -->

     </ul>
   </nav><!-- End Icons Navigation -->

 </header>