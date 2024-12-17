@extends('layouts.app')

@section('page')
    <header class="page__header">
        <div class="page__header__menu">
            <div class="page__header__menu__controls">
                @yield('page-header-menu-controls')
            </div>
            <div class="page__header__menu__actions">
                @yield('page-header-menu-actions')
            </div>
        </div>
    </header>

    <div class="page__content">
        @yield('main')
    </div>
@endsection
