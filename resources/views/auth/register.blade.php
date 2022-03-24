@extends('layouts.app')
@section('content')

        <div class="container">
        <div class="row">
        <div class="col-lg-4 offset-lg-4">
        <form method="POST" action="{{ route('register.handle') }}">
            @csrf

            <!-- Surname -->
            <div>
                <label for="surname" class="text-secondary">Фамилия</label>

                <input id="surname" class="form-control @error('surname') is-invalid @enderror" type="text" name="surname" value="{{old('surname')}}" autofocus />
            </div>

            <!-- Name -->
            <div class="mt-4">
                <label for="name" class="text-secondary">Имя</label>

                <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{old('name')}}" autofocus />
            </div>

            <!-- Patronymic -->
            <div class="mt-4">
                <label for="patronymic" class="text-secondary">Отчество</label>

                <input id="patronymic" class="form-control @error('patronymic') is-invalid @enderror" type="text" name="patronymic" value="{{old('patronymic')}}" autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <label for="email" class="text-secondary">Email</label>

                <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{old('email')}}" />
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <label for="phone" class="text-secondary">Номер телефона</label>

                <input id="phone" class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" value="{{old('phone')}}" autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="text-secondary">Пароль</label>

                <input id="password" class="form-control @error('password') is-invalid @enderror"
                                type="password"
                                name="password"
                                autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="password_confirmation" class="text-secondary">Повторите пароль</label>

                <input id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"
                                type="password"
                                name="password_confirmation"/>
            </div>
            <div class="mt-4 mb-4">
                <button type="submit" class="btn btn-secondary">
                    {{ __('Register') }}
                </button>
            </div>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
