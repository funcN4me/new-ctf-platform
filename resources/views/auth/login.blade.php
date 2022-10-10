@extends('layouts.app_base')

@section('content')
    <div class="container col-6">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card pt-2">
                    <div class="col-12 text-center h3 pt-3">CTF-Платформа</div>
                    <div class="col-8 text-center align-self-center">Войдите в ваш аккаунт, чтобы продолжить</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row mb-3 justify-content-center">
                                <div class="form-group col-9">
                                    <label for="email">Email</label>
                                    <input name="email" type="email" class="form-control" id="email" placeholder="example@mail.com">
                                </div>
                            </div>
                            <div class="row mb-3 justify-content-center">
                                <div class="form-group col-9">
                                    <label for="password">Пароль</label>
                                    <input name="password" type="password" class="form-control" id="password" placeholder="*******">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            Запомнить меня
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-9 text-center">
                                    <button type="submit" class="btn btn-primary col-12">
                                        Войти
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6 offset-md-4">
                                    <a href="{{ route('register') }}">Зарегистрироваться</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
