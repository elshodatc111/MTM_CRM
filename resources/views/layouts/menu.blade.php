        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">УМКА</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item {{ request()->routeIs(['home']) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Bosh sahifa</span>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs(['groups','groups_show']) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('groups') }}">
                    <i class="fas fa-fw fa-layer-group"></i>
                    <span>Guruhlar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-smile"></i>
                    <span>Bolalar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-cash-register"></i>
                    <span>Kassa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-chart-line"></i>
                    <span>Moliya</span>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs(['vacancy_hodim','vacancy_hodim_show']) ? 'active' : '' }}" >
                <a class="nav-link" href="{{ route('vacancy_hodim') }}">
                    <i class="fas fa-fw fa-briefcase"></i>
                    <span>Hodimlar Jurnali</span>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs(['vacancy_child','vacancy_child_show']) ? 'active' : '' }}" >
                <a class="nav-link" href="{{ route('vacancy_child') }}">
                    <i class="fas fa-fw fa-briefcase"></i>
                    <span>Bolalalar Jurnali</span>
                </a>
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
                    <i class="fas fa-fw fa-chart-bar"></i>
                    <span>Statistika</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-file-alt"></i>
                    <span>Hisobot</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>Sozlamalar</span>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs(['days','dayss']) ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Sozlamalar" aria-expanded="true" aria-controls="Sozlamalar">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>Sozlamalar</span>
                </a>
                <div id="Sozlamalar" class="collapse {{ request()->routeIs(['days','days']) ? 'show' : '' }}" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Hodimlar:</h6>
                        <a class="collapse-item {{ request()->routeIs(['days']) ? 'active' : '' }}" href="{{ route('days') }}">Dam olish kunlari</a>
                    </div>
                </div>
            </li>
        </ul>