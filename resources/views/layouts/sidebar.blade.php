<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <img src="" alt="img_logo" class="img-fluid">
        
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ 'dashboard' == request()->path() ? 'active' : '' }}">
            <a href="{{ url('/dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">TABLEAU DE BORD</div>
            </a>
        </li>
        
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Formation & Inscription</span>
        </li>

        <li class="menu-item {{ 'formations' == request()->path() ? 'active' : '' }}">
            <a href="{{ route('formations.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-folder"></i>
                <div data-i18n="Tables">FORMATIONS</div>
            </a>
        </li>

        <li class="menu-item {{ 'sessions' == request()->path() ? 'active' : '' }}">
            <a href="{{ route('sessions.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-folder"></i>
                <div data-i18n="Tables">SESSIONS</div>
            </a>
        </li>

        <li class="menu-item {{ 'auditeurs' == request()->path() ? 'active' : '' }}">
            <a href="{{ route('auditeurs.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-folder"></i>
                <div data-i18n="Tables">AUDITEURS</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Finance</span>
        </li>
        <li class="menu-item {{ 'entrees' == request()->path() ? 'active' : '' }}">
            <a href="{{ route('entrees.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-folder-plus"></i>
                <div data-i18n="Tables">ENTREES</div>
            </a>
        </li>
        @if(Auth::user()->usertype === 'Admin')
        <li class="menu-item {{ 'depenses' == request()->path() ? 'active' : '' }}">
            <a href="{{ route('depenses.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-folder-minus"></i>
                <div data-i18n="Tables">DEPENSES</div>
            </a>
        </li>
        <li class="menu-item {{ 'caisses' == request()->path() ? 'active' : '' }}">
            <a href="{{ route('caisses.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-wallet"></i>
                <div data-i18n="Tables">CAISSE</div>
            </a>
        </li>
        @endif

        {{-- <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Utilisateurs</span>
        </li>
        <li class="menu-item {{ 'entrees' == request()->path() ? 'active' : '' }}">
            <a href="{{ route('entreprises.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-folder-plus"></i>
                <div data-i18n="Tables">ENTREPRISES</div>
            </a>
            <a href="" class="menu-link">
                <i class="menu-icon tf-icons bx bx-folder-plus"></i>
                <div data-i18n="Tables">SUPER ADMIN</div>
            </a>
        </li> --}}
        
    </ul>
</aside>