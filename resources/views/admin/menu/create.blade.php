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
                                    <input type="text" class=" form-control" name='label' value="{{old('label')}}" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Vị trí</label>
                                    <select name="parent" class="form-control">
                                        <option value="0" selected="selected">=============  Chọn  ============</option>
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
                        <div class="grid grid-cols-12 gap-x-5 mt-4">
                            <div class="col-span-12 xl:col-span-12">
                                <div class="form-group mb-2.5 flex">
                                    <label class="w-20 mt-2">Liên kết</label>
                                    <input id="link_web" type="text" class="form-control" name='link' placeholder="https://">
                                </div>
                            </div>
                        </div>
                        <div class="border-t mt-4">
                            <div class="grid grid-cols-12 gap-x-5 mt-4">
                                <div class="col-span-12 xl:col-span-4">
                                    <div class="form-group mb-2.5 flex">
                                        <label class="w-1/2 mt-2">Loại menu</label>
                                        <select name="type_menu" class="form-control type_menu">
                                            <option value="0" selected="selected">Liên kết tự tạo</option>
                                            <option value="1">Danh mục sản phẩm</option>
                                            <option value="2">Danh mục bài viết</option>
                                            <option value="3">Bài viết</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-12 gap-x-5 mb-16">
                                <div class="col-span-12 xl:col-span-4">
                                    <div class="form-group mb-3 categories_product hidden">
                                        <label>Danh mục</label>
                                        <select name="categories_product" class="form-control cat_product">
                                            <option value="0" selected="selected">=============  Chọn  ============</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3 categories_post hidden">
                                        <label>Danh mục</label>
                                        <select name="categories_post" class="form-control cat_post">
                                            <option value="0" selected="selected">=============  Chọn  ============</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3 post hidden">
                                        <label>Bài viết</label>
                                        <select name="post" class="form-control post_single">
                                            <option value="0" selected="selected">=============  Chọn  ============</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-span-12 xl:col-span-4">
                                    <div class="form-group mb-4 filter_by hidden">
                                        <label>Lọc theo</label>
                                        <select name="filter_by" id="filter_by" class="form-control">
                                            <option value="0" selected="selected">=============  Chọn  ============</option>
                                            <option value="1">Thuộc tính</option>
                                            <option value="2">Giá</option>
                                            <option value="3">Thương hiệu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-span-12 xl:col-span-4">
                                    <div class="form-group mb-4 filter_value hidden" >
                                        <label>Giá trị</label>
                                        <div class="flex">
                                            <div class="property mr-4 w-1/2 hidden">
                                            <select name="property" class="form-control attributes">
                                                <option value="0" selected="selected">Thuộc tính</option>
                                            </select>
                                            </div>
                                            <div class="detailproperty w-1/2 hidden">
                                                <select name="detailproperty" class="form-control detail_attr">
                                                    <option value="0" selected="selected">Chi tiết</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="price hidden">
                                            <input type="number" class="form-control mb-4" id="price_from" name='price_from' placeholder="Giá từ">
                                            <input type="number" class="form-control" id="price_to" name='price_to' placeholder="Đến">
                                        </div>
                                        <div class="brand hidden">
                                        <select name="brand" class="form-control" id="brand">
                                            <option value="0" selected="selected">=============  Chọn  ============</option>
                                        </select>
                                        </div>
                                    </div>
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

