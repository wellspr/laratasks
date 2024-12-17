@extends('tasks.page')

@section('title', $task->title)

@section('main')

@section('page-header-menu-controls')
    @if (session()->has('filter'))
        @if (session()->get('filter') == 'completed')
            <a class="btn btn-outline" href="{{ route('tasks.list.completed') }}">
                &LeftArrow; Back
            </a>
        @endif

        @if (session()->get('filter') == 'all')
            <a class="btn btn-outline" href="{{ route('tasks.list.all') }}">
                &LeftArrow; Back
            </a>
        @endif
    @elseif (session()->has('search'))
        <a class="btn btn-outline" href="{{ route('tasks.list.search', ['term' => session()->get('search')]) }}">
            &LeftArrow; Back
        </a>
    @else
        <a class="btn btn-outline" href="{{ route('tasks.list') }}">
            &LeftArrow; Back
        </a>
    @endif

    <h2>Task</h2>
@endsection

@section('page-header-menu-actions')
    <form action="{{ route('tasks.toggle-complete', ['task' => $task]) }}">
        @csrf
        @method('PUT')
        <button class="btn btn-success" type="submit">{{ $task->completed ? 'Retake task' : 'Mark as completed' }}</button>
    </form>
    <a class="btn btn-secondary" href="{{ route('tasks.edit', ['task' => $task->id]) }}">Edit</a>
@endsection

<div class="task">
    <h3 class="task__title">
        {{ $task->title }}
        @if ($task->completed)
            <span class="task__completed">&checkmark;</span>
        @endif
    </h3>
    <div class="task__date">
        <p>Created: {{ explode(' ', $task->created_at)[0] }} at {{ explode(' ', $task->created_at)[1] }}</p>
        <p>Updated: {{ explode(' ', $task->updated_at)[0] }} at {{ explode(' ', $task->updated_at)[1] }}</p>
    </div>
    <h4 class="task__description">{{ $task->description }}</h4>
    <p class="task__long-description">{{ $task->long_description }}</p>
</div>
<div class="task__delete-area">
    <form action="{{ route('tasks.destroy', ['task' => $task]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit">Delete</button>
    </form>
</div>
@endsection
