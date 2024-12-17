@extends('tasks.app')
@extends('tasks.delete')
@section('content')
    <div class="container">
        <h1>Danh sách nhiệm vụ</h1>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Thêm mới</a>
        <table class="table">
            <thead>
                <tr>
                    <th class="col-1">STT</th>
                    <th class="col-3">Tiêu đề</th>
                    <th class="col-6">Mô tả</th>
                    <th class="col-1">Trạng thái</th>
                    <th class="col-1"">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>
                            <span class="{{ $task->completed ? 'text-success' : 'text-danger' }}">
                                {{ $task->completed ? 'Hoàn thành' : 'Chưa hoàn thành' }}
                            </span>
                        </td>

                        <td>
                            <div class="d-flex align-items-center" style="height: 100%;"> <a
                                    href="{{ route('tasks.show', $task) }}" class="mx-2"> <i class="bi bi-eye-fill"></i>
                                </a> <a href="{{ route('tasks.edit', $task) }}" class="mx-2"> <i
                                        class="bi bi-pencil-fill"></i> </a> <a href="#" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" class="mx-2"> <i class="bi bi-trash-fill"></i> </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="paginastion">
            {{ $tasks->links() }}
        </div>
    </div>
@endsection
