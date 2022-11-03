<div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto uppercase">Thêm mới</h2>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-4">
                                <div class="form-group mb-4">
                                    <label>Tên hiển thị</label>
                                    <input type="text" class=" form-control" name='label' value="{{old('label')}}">
                                </div>
                                <div class="form-group mb-4">
                                    <label>Vị trí</label>
                                    <select name="parent" class="form-control">
                                        <option value="0" selected="selected">Chọn</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-4">
                                <div class="form-group mb-4">
                                    <label>Mã</label>
                                    <input type="text" class=" form-control" name='ma' value="{{old('ma')}}">
                                    @error('ma') <span style="color: rgb(239 68 68);">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group mb-4">
                                    <label>STT</label>
                                    <input type="number" class="form-control" name='stt' value="{{old('stt')}}">
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-4">
                                <div class="form-group mb-4">
                                    <label>Icon</label>
                                    <div class="flex">
                                    <input type="text" class="form-control" name='class' value=" {{old('class')}}">
                                    <a type="button" class="btn w-32 btn-primary w-30 ml-6" href="https://fontawesome.com/v5/search" target="_blank">Lấy icon</a>
                                    </div>
                                </div>
                                <div class="form-group mb-4 flex-initial">
                                    <div class="form-group mb-2"><label>Trạng thái</label> <br>
                                        <input type="checkbox" name='status' checked="checked" class="form-check-switch">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-4 ">
                                <div class="form-group mb-4 flex">
                                    <label class="w-1/2 mt-2">Loại menu</label>
                                    <select class="form-control">
                                        <option value="0" selected="selected">Liên kết tự tạo</option>
                                        <option value="1">Danh mục sản phẩm</option>
                                        <option value="2">Danh mục bài viết</option>
                                        <option value="3">Bài viết</option>
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Danh mục sản phẩm</label>
                                    <select name="category_id" class="form-control">
                                        <option value="0" selected="selected">Chọn</option>
                                    </select>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-primary w-20 mr-1">Đóng</button>
                            <input type="submit" class="btn btn-sm btn-primary w-20 mr-1" value="Tạo mới">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

