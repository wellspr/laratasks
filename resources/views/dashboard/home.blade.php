@extends('dashboard.page')

@section('title', 'Dashboard')

@section('main')

@section('page-header-menu-controls')
    <h1 class="page__header__misc__title">Dashboard</h1>
@endsection

<div class="dashboard">
    <div class="dashboard__content">
        <section class="section welcome">
            <h2 class="section__title">Welcome {{ auth()->user()->name }}</h2>
            <p class="section__text">
                You are logged in as {{ auth()->user()->email }}
            </p>
        </section>
    </div>
</div>

@endsection


{{--
<x-dashboard>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-dashboard>
 --}}
