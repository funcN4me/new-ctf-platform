<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home') }}" class="nav-link">Главная</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('tasks.show') }}" class="nav-link">Задачи</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Обучение</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src="/theme/dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline">{{ auth()->user()->fioShort }} </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0;">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="/theme/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    <p>
                        {{ auth()->user()->fioShort . ' ' . '-' . ' ' . auth()->user()->group}}
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="{{ route('users.profile', auth()->user()->id) }}" class="btn btn-default btn-flat">Профиль</a>
                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right">Выйти</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
