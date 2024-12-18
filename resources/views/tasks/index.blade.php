@extends('tasks.app')
{{-- @extends('tasks.delete') --}}
@section('content')
    <div class="container">
        <h1>Danh sách nhiệm vụ</h1>
        @if (session('success'))
            <div class="text-success"> {{ session('success') }}</div>
        @endif
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Thêm mới</a>
        <table class="table">
            <thead>
                <tr>
                    <th class="col-1">STT</th>
                    <th class="col-3">Tiêu đề</th>
                    <th class="col-6">Mô tả</th>
                    <th class="col-1">Trạng thái</th>
                    <th class="col-1">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $index => $task)
                    <tr>
                        <td>{{ $index + 1 }}</td>
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
                                        class="bi bi-pencil-fill"></i> </a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $task->id }}"
                                    class="mx-2">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </div>
                        </td>
                    </tr>

                    <div class="modal fade" id="deleteModal{{ $task->id }}" tabindex="-1"
                        aria-labelledby="deleteModalLabel{{ $task->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $task->id }}">Xác nhận xóa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Bạn có chắc chắn muốn xóa nhiệm vụ: <strong>{{ $task->title }}</strong>?</p>
                                    <p>{{ $task->description }}</p>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Hủy</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
        <div class="paginastion">
            {{ $tasks->links() }}
        </div>
    </div>
@endsection
