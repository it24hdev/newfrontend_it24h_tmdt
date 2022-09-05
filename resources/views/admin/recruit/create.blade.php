@extends('admin.layouts.main')
@section('subcontent')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
<h2 class="text-lg font-medium mr-auto">
    {{ $title }}
</h2>
<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
    @can('view', App\Models\Recruit::class)
    <a class="btn btn-primary shadow-md mr-2" href="{{ route('recruit.index') }}">Danh sách tuyển dụng</a>
    @endcan
</div>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
<div class="intro-y col-span-12">
    <form action="{{ route('recruit.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-12 gap-x-5">
            <div class="col-span-12 md:col-span-6">
                <div class="form-group mb-4">
                    <label>Khu vực</label>
                    <select name="location"  class="tom-select w-full" id="changeData">
                        <option value="AnGiang">An Giang</option>
                        <option value="BaRia">Bà Rịa - Vũng Tàu</option>
                        <option value="BacGiang">Bắc Giang</option>
                        <option value="BacKan">Bắc Kạn</option>
                        <option value="BacLieu">Bạc Liêu</option>
                        <option value="BacNinh">Bắc Ninh</option>
                        <option value="BenTre">Bến Tre</option>
                        <option value="BinhDinh">Bình Định</option>
                        <option value="BinhDuong">Bình Dương</option>
                        <option value="BinhPhuoc">Bình Phước</option>
                        <option value="BinhThuan">Bình Thuận</option>
                        <option value="CaMau">Cà Mau</option>
                        <option value="CaoBang">Cao Bằng</option>
                        <option value="ĐakLak">Đắk Lắk</option>
                        <option value="ĐakNong">Đắk Nông</option>
                        <option value="ĐienBien">Điện Biên</option>
                        <option value="ĐongNai">Đồng Nai</option>
                        <option value="ĐongThap">Đồng Tháp</option>
                        <option value="GiaLai">Gia Lai</option>
                        <option value="HaGiang">Hà Giang</option>
                        <option value="HaNam">Hà Nam</option>
                        <option value="HaTinh">Hà Tĩnh</option>
                        <option value="HaiDuong">Hải Dương</option>
                        <option value="HauGiang">Hậu Giang</option>
                        <option value="HoaBinh">Hòa Bình</option>
                        <option value="HungYen">Hưng Yên</option>
                        <option value="KhanhHoa">Khánh Hòa</option>
                        <option value="KienGiang">Kiên Giang</option>
                        <option value="KonTum">Kon Tum</option>
                        <option value="LaiChau">Lai Châu</option>
                        <option value="LamĐong">Lâm Đồng</option>
                        <option value="LangSon">Lạng Sơn</option>
                        <option value="LaoCai">Lào Cai</option>
                        <option value="LongAn">Long An</option>
                        <option value="NamĐinh">Nam Định</option>
                        <option value="NgheAn">Nghệ An</option>
                        <option value="NinhBinh">Ninh Bình</option>
                        <option value="NinhThuan">Ninh Thuận</option>
                        <option value="PhuTho">Phú Thọ</option>
                        <option value="QuangBinh">Quảng Bình</option>
                        <option value="QuangNgai">Quảng Ngãi</option>
                        <option value="QuangNinh">Quảng Ninh</option>
                        <option value="QuangTri">Quảng Trị</option>
                        <option value="SocTrang">Sóc Trăng</option>
                        <option value="SonLa">Sơn La</option>
                        <option value="TayNinh">Tây Ninh</option>
                        <option value="ThaiBinh">Thái Bình</option>
                        <option value="ThaiNguyen">Thái Nguyên</option>
                        <option value="ThanhHoa">Thanh Hóa</option>
                        <option value="ThuaThienHue">Thừa Thiên Huế</option>
                        <option value="TienGiang">Tiền Giang</option>
                        <option value="TraVinh">Trà Vinh</option>
                        <option value="TuyenQuang">Tuyên Quang</option>
                        <option value="VinhLong">Vĩnh Long</option>
                        <option value="VinhPhuc">Vĩnh Phúc</option>
                        <option value="YenBai">Yên Bái</option>
                        <option value="PhuYen">Phú Yên</option>
                        <option value="TpCanTho">Cần Thơ</option>
                        <option value="TpĐaNang">Đà Nẵng</option>
                        <option value="TpHaiPhong">Hải Phòng</option>
                        <option value="TpHaNoi">Hà Nội</option>
                        <option value="TPHCM">TPHCM</option>
                    </select>
                </div>
                <div class="form-group mb-4">
                    <label>Vị trí</label>
                    <input type="text" class="form-control" name='vacancies' value="{{old('vacancies')}}" required>
                    @error('vacancies')<span style="color: rgb(239 68 68);">{{ $message }}</span>@enderror
                </div>
                <div class="form-group mb-4">
                    <label>Phân loại</label>
                    <input type="text" class="form-control" name='type' value="{{old('type')}}" required>
                    @error('type')<span style="color: rgb(239 68 68);">{{ $message }}</span>@enderror
                </div>
                <div class="form-group mb-4">
                    <label>Số lượng</label>
                    <input type="number" class="form-control" name='quantum' value="{{old('quantum')}}" required>
                    @error('quantum')<span style="color: rgb(239 68 68);">{{ $message }}</span>@enderror
                </div>
                <div class="form-group mb-4">
                    <label>Thu nhập</label>
                    <input type="text" class="form-control" name='income' value="{{old('income')}}" required>
                    @error('income')<span style="color: rgb(239 68 68);">{{ $message }}</span>@enderror
                </div>
                <div class="form-group mb-4">
                    <label>Hạn nộp</label>
                    <input type="date" class="form-control" name='deadline' value="">
                    @error('deadline')<span style="color: rgb(239 68 68);">{{ $message }}</span>@enderror
                </div>
                <div class="form-group mb-4">
                    <label>Trạng thái</label><br>
                    <input type="checkbox" class="form-check-switch" name='status' checked="checked">
                </div>
                <input type="text" name="location_name" id="locationname" style="display:none;">
                <div class="modal-footer">
                    <a type="button" class="btn btn-default" href="{{ route('recruit.index')}}">Hủy</a>
                    <input type="submit" class="btn btn-primary " value="Cập nhật">
                </div>
            </div>
        </div>
    </form>
</div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {     
            $('#changeData').change(function(){
                var name =  $('#changeData option:selected').text();
                $('#locationname').val(name);
            })
        });
    </script>
@endsection