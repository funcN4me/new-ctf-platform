<div class="modal fade" id="showTaskModal">
    <div class="modal-dialog modal-lg modal-default">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ $task->name }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('tasks.submit', ['task' => $task->id]) }}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <p>{{ $task->description }}</p>

                            @if($task->url)
                                <p>Ссылка на задание: <a href="{{ $task->url }}">{{ $task->url }}</a></p>
                            @endif

                            @if($task->files->isNotEmpty())
                                <div class="col-12">
                                    <div class="row mb-3 justify-content-center task-attachments">
                                        @foreach($task->files as $file)
                                            <a target="_blank" href="{{ $file->downloadUrl }}" class="col-3 d-flex align-items-center justify-content-center btn btn-primary">
                                                {{ Str::limit($file->name, 10) }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="flag">Флаг:</label>
                                <input class="form-control" type="text" name="flag" id="flag" placeholder="GUMRF{}" required>
                            </div>
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
