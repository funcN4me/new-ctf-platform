@extends('layouts.app')

@section('title', 'Профиль')

@section('header')
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Профиль</h1>
    </div>
@endsection

@section('breadcrumbs')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('users.list') }}">Пользователи</a></li>
            <li class="breadcrumb-item active">Профиль</li>
        </ol>
    </div>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center image-upload" data-toggle="modal" data-target="#uploadAvatar">
                                @if($user->avatar_path)
                                    <img class="profile-user-img img-fluid img-circle" src="{{ $user->avatar }}" alt="User profile picture">
                                @else
                                    <div class="profile-user-img img-fluid img-circle bg-cyan">
                                        <p style="font-weight: bold; font-size: 45px;">{{ $user->initials }}</p>
                                    </div>
                                @endif
                            </div>
                            <h3 class="profile-username text-center">{{ $user->fioShort }}</h3>
                            <p class="text-muted text-center">{{ $user->group }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Дата регистрации</b> <a class="float-right">{{ $user->created_at->format('d.m.Y') }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Решёных задач</b> <a class="float-right">{{ $user->tasks->count() }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Прочитано обучающих ресурсов</b> <a class="float-right">{{ $user->resources->count() }}</a>
                                </li>
                            </ul>
                            @if(auth()->user()->isAdmin() && $user->id !== auth()->user()->id)
                                @if($user->is_active)
                                    <button id="changeUserStatus" data-id="{{ $user->id }}" data-is-active="{{ $user->is_active }}" class="btn btn-danger btn-block">Заблокировать</button>
                                @else
                                    <button id="changeUserStatus" data-id="{{ $user->id }}" data-is-active="{{ $user->is_active }}" class="btn btn-success btn-block">Разблокировать</button>
                                @endif
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Информация</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Активность</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Таймлайн</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane" id="activity">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Избранные категории</h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="row justify-content-center">
                                                <div class="col-md-5">
                                                    <div class="chart-responsive">
                                                        <canvas id="pieChart" height="150"></canvas>
                                                    </div>
                                                    <!-- ./chart-responsive -->
                                                </div>
                                                <!-- /.col -->
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Решенные задачи</h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table id="users" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                                            <thead>
                                                            <tr role="row">
                                                                <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID">П.Н.</th>
                                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Название</th>
                                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Категория</th>
                                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Дата и время</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($user->tasks as $task)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ $task->name }}</td>
                                                                        <td>{{ $task->category->name }}</td>
                                                                        <td>
                                                                            @isset($task->pivot->created_at)
                                                                                {{ $task->pivot->created_at->format('d.m.Y H:i')  }}
                                                                            @else
                                                                                Нет данных
                                                                            @endisset
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">График решения задач</h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart">
                                                <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="timeline">
                                    <!-- The timeline -->
                                    <div class="timeline timeline-inverse">
                                        @foreach($actions as $date => $dateActions)
                                            <div class="time-label">
                                                <span class="bg-success">
                                                    {{ $date }}
                                                </span>
                                            </div>
                                            @foreach($dateActions as $action)
                                                <div>
                                                    <i class="fas {{ $action->actionIcon }} bg-info"></i>

                                                    <div class="timeline-item">
                                                        <span class="time"><i class="far fa-clock"></i> {{ $action->created_at->format('H:i') }}</span>
                                                        <h3 class="timeline-header border-0">
                                                            <a>{{ $action->user->fioShort }}</a>
                                                            {{ $action->actionType . ' ' . $action->actionTargetName->name }}
                                                        </h3>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endforeach
                                        <div>
                                            <i class="far fa-clock bg-gray"></i>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="active tab-pane" id="settings">
                                    <form class="form-horizontal" action="{{ route('users.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <div class="form-group row">
                                            <label for="surname" class="col-sm-2 col-form-label">Фамилия</label>
                                            <div class="col-sm-10">
                                                <input required name="surname" type="text" class="form-control" id="surname" value="{{ $user->surname }}" placeholder="Фамилия">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-2 col-form-label">Имя</label>
                                            <div class="col-sm-10">
                                                <input required name="name" type="text" class="form-control" id="name" value="{{ $user->name }}" placeholder="Имя">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="patronymic" class="col-sm-2 col-form-label">Отчество</label>
                                            <div class="col-sm-10">
                                                <input name="patronymic" type="text" class="form-control" id="patronymic" value="{{ $user->patronymic }}" placeholder="Отчество">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input required name="email" type="email" class="form-control" id="email" value="{{ $user->email }}" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="group" class="col-sm-2 col-form-label">Группа</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="group" class="form-control" id="group" value="{{ $user->group }}" placeholder="Группа">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    <div class="modal fade" id="deleteUser" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('users.status.change', $user->id) }}">
                    @csrf
                    @method('delete')
                    <div class="modal-header">
                        <h4 class="modal-title">Заблокировать пользователя?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Пользователь будет заблокирован в системе</p>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="submit" class="btn btn-danger ">Заблокировать</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @include('users.modals.image_upload')
@endsection

@section('custom-scripts')
    <script src="/theme/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/theme/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/theme/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/theme/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/theme/plugins/jszip/jszip.min.js"></script>
    <script src="/theme/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="/theme/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="/theme/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/theme/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/theme/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="/theme/plugins/chart.js/Chart.min.js"></script>
    <script src="/theme/plugins/chart.js/Chart.bundle.js"></script>
    <script src="/js/custom-scripts/users/profile.js"></script>
    <script src="/js/custom-scripts/dashboards.js"></script>

    <script>
        $('#users').DataTable({
            "paging": true,
            "language": {
                "lengthMenu": "Показать _MENU_ записей на странице",
                "zeroRecords": "Ничего не найдено",
                "info": "Показано _PAGE_ из _PAGES_",
                "infoFiltered": "(отфильтровано из _MAX_ записей)",
                "search": "Поиск:",
                "paginate": {
                    "first": "Первая",
                    "last": "Последняя",
                    "next": "Следующая",
                    "previous": "Предыдущая"
                }
            },
            "pageLength": 5,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
        });
    </script>
@endsection
