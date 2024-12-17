@extends('tasks.page')

@section('title', 'Tasks')

@section('main')

@section('page-header-menu-controls')
    <div class="page__filter">
        <a class="btn btn-secondary" href="{{ route('tasks.list.all') }}">All Tasks</a>
        <a class="btn btn-secondary" href="{{ route('tasks.list.completed') }}">Completed Tasks</a>
        <a class="btn btn-secondary" href="{{ route('tasks.list') }}">Clear Filter</a>
    </div>
@endsection
@section('page-header-menu-actions')
    <a href="{{ route('tasks.add') }}" class="btn btn-primary">Add task</a>
@endsection

<div class="search">
    <form class="search__form" action="{{ route('tasks.list.search') }}" method="get">
        <input class="search__input" type="text" name="term" placeholder="Search..."
            value="{{ request()->query('term') }}">
        <button class="btn btn-secondary" type="submit">Search</button>
    </form>
</div>

<p class="stats">Tasks count: {{ $count }}</p>

<ul class="tasks__list">
    @forelse ($tasks as $task)
        <li class="tasks__list__item">
            <form action="{{ route('tasks.toggle-complete', ['task' => $task]) }}" method="post">
                @csrf
                @method('PUT')

                @if ($task->completed)
                    <span class="tasks__checkmark">&checkmark;</span>
                @endif
            </form>
            <a href="{{ route('tasks.show', ['task' => $task->id]) }}"
                class="{{ $task->completed ? 'tasks__list__item--completed' : '' }}">
                {{ $task->title }}
            </a>
        </li>
    @empty
        <li class="tasks__list__item">No tasks!</li>
    @endforelse
</ul>

@if ($tasks->hasPages())
    <div class="tasks-pagination">
        {{ $tasks->links('tasks.pagination', ['tasks' => $tasks]) }}
    </div>
@endif
@endsection
