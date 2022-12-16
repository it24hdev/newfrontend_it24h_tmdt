<div id="add_new_voucher" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto uppercase">Thêm mới</h2>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <form action="{{ route('vouchers.store')}}"  method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-6">
                                <div class="form-group">
                                    <label>Tên voucher</label>
                                    <input type="text" class="form-control" name='name' value="{{old('name')}}" required>
                                </div>
                                <div class="form-group mt-2">
                                        <label>Mã voucher</label>
                                    <div class="flex">
                                        <input type="text" class="form-control mr-2" name='code' value="{{old('code')}}" required>
                                        <input type="button" class="btn btn-primary form-control w-20" value="Sinh mã" id="create_code">
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-4">
                                <div class="form-group">
                                    <label>Giá trị tiền</label>
                                    <input type="number" class=" form-control" min="0" max="1000000000"  name='value' value="{{old('value')}}">
                                </div>
                                <div class="form-group mt-2">
                                    <label>Giá trị PT(%)</label>
                                    <input type="number" class="form-control" min="0" max="100" name='percent' value="{{old('percent')}}">
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-2">
                                <div class="form-group">
                                    <label>Trạng thái</label><br>
                                    <input type="checkbox" class="form-check-switch" name='status' checked>
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-12">
                                <div class="form-group mt-2">
                                    <label>Mô tả</label>
                                    <textarea class="form-control" name="describe" rows="4">{{ old('describe')}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-sm btn-primary w-20 mr-3" value="Tạo mới">
                            <input type="button" class="btn btn-sm btn-primary w-20 mr-3" onclick="this.form.reset();" value="Làm mới">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-primary w-20 mr-1">Đóng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@section('js')
    <script>
        $(document).ready(function (){
            $(document).on('click', '#create_code', function (){
                let r = (Math.random().toString(36).substring(2,15)).toUpperCase();
                $('input[name="code"]').val(r);
            });
        });
    </script>
@endsection
