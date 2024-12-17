@extends('tasks.page')

@section('title', isset($task) ? 'Edit Task' : 'Add Task')

@section('main')
    <form method="post" action={{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.create') }}>
        @csrf
        @isset($task)
            @method('PUT')
        @endisset
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Enter title"
                value="{{ $task->title ?? old('title') }}">
            @error('title')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" rows="3">{{ $task->description ?? old('description') }}</textarea>
            @error('description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="long_description">Long Description</label>
            <textarea class="form-control" name="long_description" id="long_description" rows="5">{{ $task->long_description ?? old('long_description') }}</textarea>
            @error('long_description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <input type="hidden" name="user_id" id="user_id" value="{{ $user_id }}">
        <button type="submit" class="btn btn-primary">{{ isset($task) ? 'Save Changes' : "Create" }}</button>
        <a href="{{ isset($task) ? route('tasks.show', ['task' => $task->id]) : route('tasks.list') }}" class="btn btn-danger">Cancel</a>
    </form>
@endsection
