@extends('layouts.app')

@section('title', 'Пользователи')

@section('header')
    <h1 class="m-0 text-dark">Список пользователей
        <i class="my-icon-hover nav-icon fas fa-plus-circle" data-toggle="modal" data-target="#createUserModal"></i>
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="users" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID">ID</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Фамилия</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Имя</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Отчество</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Email</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Группа</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Дата регистрации</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->surname }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->patronymic }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->group }}</td>
                                                <td class="text-center">{{ $user->created_at->format('d.m.Y') }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('users.profile', $user->id) }}" class="btn btn-primary">Профиль</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="createUserModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Создать пользователя</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('users.store') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="surname">Фамилия</label>
                                <input id="surname" name="surname" type="text" class="form-control" required value="{{ old('surname') }}">
                            </div>
                            <div class="form-group col-4">
                                <label for="name">Имя</label>
                                <input id="name" name="name" type="text" class="form-control" required value="{{ old('name') }}">
                            </div>
                            <div class="form-group col-4">
                                <label for="patronymic">Отчество</label>
                                <input id="patronymic" name="patronymic" type="text" class="form-control" value="{{ old('patronymic') }}">
                            </div>
                            <div class="form-group col-6">
                                <label for="group">Группа</label>
                                <input id="group" name="group" type="text" class="form-control" value="{{ old('group') }}">
                            </div>
                            <div class="form-group col-6">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email" class="form-control" required value="{{ old('email') }}">
                            </div>
                            <div class="form-group col-12">
                                <label for="password">Пароль</label>
                                <input id="password" name="password" type="password" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('custom-styles')
    <link rel="stylesheet" href="/css/custom-css/users/users.css">
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
    <script>
        $('#users').DataTable({
            "paging": true,
            "language": {
                "lengthMenu": "Показать _MENU_ записей на странице",
                "zeroRecords": "Ничего не найдено",
                "info": "Показано _PAGE_ из _PAGES_",
                "infoEmpty": "Нет доступных записей",
                "infoFiltered": "(отфильтровано из _MAX_ записей)",
                "search": "Поиск:",
                "paginate": {
                    "first": "Первая",
                    "last": "Последняя",
                    "next": "Следующая",
                    "previous": "Предыдущая"
                }
            },
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    </script>
@endsection
