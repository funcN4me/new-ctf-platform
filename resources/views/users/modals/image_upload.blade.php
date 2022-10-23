<div class="modal fade" id="uploadAvatar" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('users.avatar.change', $user->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Изменить аватар</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="file" name="avatar" accept="image/jpeg, image/png, image/jpg">
                </div>
                <div class="modal-footer @if($user->avatar_path) justify-content-between @else justify-content-end @endif">
                    @if($user->avatar_path)
                        <a href="{{ route('users.avatar.delete', $user->id) }}" type="submit" class="btn btn-danger">Удалить</a>
                    @endif
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
