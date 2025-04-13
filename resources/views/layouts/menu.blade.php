        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">УМКА</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Bosh sahifa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="groups.html">
                    <i class="fas fa-fw fa-layer-group"></i> <!-- Guruhlar -->
                    <span>Guruhlar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-star"></i> <!-- Qiziqishlar -->
                    <span>Qiziqishlar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-briefcase"></i> <!-- Vakansiya -->
                    <span>Vakansiya</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-cash-register"></i> <!-- Kassa -->
                    <span>Kassa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-chart-line"></i> <!-- Moliya -->
                    <span>Moliya</span>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs(['vacancy_hodim','vacancy_hodim_show','vacancy_child']) ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#vakansiya" aria-expanded="true" aria-controls="vakansiya">
                    <i class="fas fa-fw fa-briefcase"></i>
                    <span>Vakansiya</span>
                </a>
                <div id="vakansiya" class="collapse {{ request()->routeIs(['vacancy_hodim','vacancy_hodim_show','vacancy_child']) ? 'show' : '' }}" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Vakansiya:</h6>
                        <a class="collapse-item {{ request()->routeIs(['vacancy_hodim','vacancy_hodim_show']) ? 'active' : '' }}" href="{{ route('vacancy_hodim') }}">Hodimlar Jurnali</a>
                        <a class="collapse-item {{ request()->routeIs(['vacancy_child']) ? 'active' : '' }}" href="{{ route('vacancy_child') }}">Bolalar Jurnali</a>
                    </div>
                </div>
            </li>
            <li class="nav-item {{ request()->routeIs(['meneger','tarbiyachi','oqituvchi','oshpaz','hodimlar']) ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Hodimlar" aria-expanded="true" aria-controls="Hodimlar">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Hodimlar</span>
                </a>
                <div id="Hodimlar" class="collapse {{ request()->routeIs(['meneger','tarbiyachi','oqituvchi','oshpaz','hodimlar']) ? 'show' : '' }}" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Hodimlar:</h6>
                        <a class="collapse-item {{ request()->routeIs(['meneger']) ? 'active' : '' }}" href="{{ route('meneger') }}">Menegerlar</a>
                        <a class="collapse-item {{ request()->routeIs(['tarbiyachi']) ? 'active' : '' }}" href="{{ route('tarbiyachi') }}">Tarbiyachilar</a>
                        <a class="collapse-item {{ request()->routeIs(['oqituvchi']) ? 'active' : '' }}" href="{{ route('oqituvchi') }}">O'qituvchilar</a>
                        <a class="collapse-item {{ request()->routeIs(['oshpaz']) ? 'active' : '' }}" href="{{ route('oshpaz') }}">Oshpazlar</a>
                        <a class="collapse-item {{ request()->routeIs(['hodimlar']) ? 'active' : '' }}" href="{{ route('hodimlar') }}">Boshqa hodimlar</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-chart-bar"></i> <!-- Statistika -->
                    <span>Statistika</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-file-alt"></i> <!-- Hisobot -->
                    <span>Hisobot</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-cogs"></i> <!-- Sozlamalar -->
                    <span>Sozlamalar</span>
                </a>
            </li>
            
        </ul>