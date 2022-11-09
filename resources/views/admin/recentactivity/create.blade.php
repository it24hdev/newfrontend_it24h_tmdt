<div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto uppercase">Thêm mới</h2>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <form action="{{ route('recentactivity.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-3">
                                <div class="form-group mb-4">
                                    <label>Tên hiển thị</label>
                                    <input type="text" class=" form-control" name='name' value="{{old('name')}}" required>
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-3">
                                <div class="form-group mb-4">
                                    <label>Hoạt động</label>
                                    <input type="text" class="form-control" name='activities' value="{{old('activities')}}">
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-3">
                                <div class="form-group mb-4">
                                    <label>Thuộc tính</label>
                                        <input type="text" class="form-control" name='attr' value=" {{old('attr')}}">
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-3">
                                <div class="form-group mb-4">
                                <label>Trạng thái</label><br>
                                <input type="checkbox" name='status' checked="checked" class="form-check-switch mt-2">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-primary w-20 mr-1">Đóng</button>
                            <input  type="submit" class="btn btn-sm btn-primary w-20 mr-1" value="Tạo mới">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

