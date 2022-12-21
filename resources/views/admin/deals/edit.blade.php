<div id="edit_product" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="form_edit">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto uppercase">Chỉnh sửa</h2>
            </div>
            <div class="modal-body">
                <div class="grid grid-cols-12 gap-x-5">
                    <div class="col-span-12 md:col-span-4">
                        <div class="form-group mb-4">
                            <label>Tiêu đề của Deal</label>
                            <input type="text" class="form-control" name='name_deal' value="">
                        </div>
                        <div class="form-group mb-4">
                            <label>Giá deal</label>
                            <input type="number" class="form-control" name='price_deal' value="">
                        </div>
                        <div class="form-group mb-4">
                            <label>Số lượng bán</label>
                            <input type="number" class="form-control" name='quantity_deal' value="">
                        </div>
                        <label>Thời gian hiệu lực</label>
                        <div class="form-group mb-4 mt-2">
                            <label>Bắt đầu</label>
                            <div class="flex">
                                <input type="date" name="start_time" class="form-control mb-2 mr-2" value="">
                                <input type="time" name="start_time_hour" class="form-control mb-2" value="">
                            </div>
                            <label>Kết thúc</label>
                            <div class="flex">
                                <input type="date" name="end_time" class="form-control mr-2" value="">
                                <input type="time" name="end_time_hour" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-4">
                        <div class="form-group mb-4">
                            <label>Thứ tự hiển thị</label>
                            <input type="number" class="form-control" name='order_display' value="">
                        </div>
                        <div class="form-group mb-2">
                            <label>Mô tả</label>
                            <textarea class="form-control h-28" name='describe' value=""></textarea>
                        </div>
                        <div class="form-group mb-4">
                            <label>Trạng thái</label><br>
                            <input type="checkbox" class="form-check-switch mt-1" name='status_deal'>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-4">
                        <div class="form-group mb-4">
                            <label>Tên sản phẩm</label>
                            <input type="text" class="form-control" name='product_name' value="" disabled>
                        </div>
                        <div class="form-group mb-4">
                            <label>Giá sản phẩm</label>
                            <input type="number" class="form-control" name='price' value="" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-right">
                <input type="button" name="update" data-dismiss="modal" value="Cập nhật" data-target="" class="btn btn-update btn-sm btn-primary w-20 mr-1">
                <button type="button" data-dismiss="modal" class="btn btn-sm btn-primary w-20 mr-1">Đóng</button>
            </div>
            </form>
        </div>
    </div>
</div>
