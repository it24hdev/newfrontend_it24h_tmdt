<div id="edit-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto uppercase">Sửa</h2>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <form>
                        @csrf
                        <div class="grid grid-cols-12 gap-x-5">
                            <input type="text" class="hidden form-control" name='id_edit'>
                            <div class="col-span-12 xl:col-span-3">
                                <div class="form-group mb-4">
                                    <label>Tên hiển thị</label>
                                    <input type="text" class=" form-control" name='name_edit' required>
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-3">
                                <div class="form-group mb-4">
                                    <label>Hoạt động</label>
                                    <input type="text" class="form-control" name='activities_edit'>
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-3">
                                <div class="form-group mb-4">
                                    <label>Thuộc tính</label>
                                    <input type="text" class="form-control" name='attr_edit'>
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-3">
                                <div class="form-group mb-4">
                                    <label>Trạng thái</label><br>
                                    <input type="checkbox" name='status_edit' checked="checked" class="check_status form-check-switch mt-2">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-primary w-20 mr-1">Đóng</button>
                            <input id="update_recentactivity"  type="button" class="btn btn-sm btn-primary w-20 mr-1" value="Cập nhật">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

