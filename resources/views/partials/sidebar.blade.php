<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">CTF-Платформа</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(auth()->user()->avatar_path)
                    <img src="{{ auth()->user()->avatar }}" class="user-image img-circle elevation-2" alt="User Image">
                @else
                    <img src="/img/person.png" class="user-image img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="{{ route('users.profile', ['user' => auth()->user()->id]) }}" class="d-block" id="userSidebar">{{ auth()->user()->fioShort }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Главная
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tasks.show') }}" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Задачи
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('tasks.show') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Список задач</p>
                            </a>
                        </li>
                        @if(auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a href="{{ route('tasks.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Создать задачу</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Обучающие ресурсы
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('resources.show') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Список ресурсов</p>
                            </a>
                        </li>
                        @if(auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a href="{{ route('resources.create.show') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Создать ресурс</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item">
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('users.list') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Пользователи
                            </p>
                        </a>
                    @endif
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
