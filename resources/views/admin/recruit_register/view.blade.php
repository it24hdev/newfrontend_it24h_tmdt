<!-- BEGIN: Modal Content -->
<div id="header-footer-modal-preview-{{ $Recruit_register->id }}" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto uppercase">Chi tiết</h2>
            </div> <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <div class="modal-body">
                <div class="intro-y news p-5 box">
                    <!-- BEGIN: Blog Layout -->

                    <div class="grid grid-cols-12 gap-6 intro-y">
                        <div class="col-span-6">
                            <div class=" text-justify  sm:pt-2 pb-2 leading-relaxed" ><span class="pl-3 font-medium" style="font-weight: 1000;">Họ và tên:</span> {{ $Recruit_register->first_name }}
                            </div>
                            <div class=" text-justify  sm:pt-2 pb-2 leading-relaxed" ><span class="pl-3 font-medium" style="font-weight: 1000;">Vị trí ứng tuyển:</span> {{ $Recruit_register->vitriungtuyen }}
                            </div>
                            <div class=" text-justify  sm:pt-2 pb-2 leading-relaxed" ><span class="pl-3 font-medium" style="font-weight: 1000;">Số điện thoại:</span> {{ $Recruit_register->phone_number }}
                            </div>
                            <div class=" text-justify  sm:pt-2 pb-2 leading-relaxed" ><span class="pl-3 font-medium" style="font-weight: 1000;">Số điện thoại:</span> {{ $Recruit_register->email }}
                            </div>
                             <div class="mt-2 w-32">
                             <select name="status" class="tom-select w-full" id="status_register">
                                <option value="0" {{($Recruit_register->status == 0) ? 'selected' : ''}}>Chờ duyệt</option>
                                <option value="1" {{($Recruit_register->status == 1) ? 'selected' : ''}}>Duyệt</option>
                                <option value="2" {{($Recruit_register->status == 2) ? 'selected' : ''}}>Hoàn thành</option>
                                <option value="3" {{($Recruit_register->status == 3) ? 'selected' : ''}}>Hủy</option>
                            </select>
                            </div>
                            <input id="id_recruit_register" value="{{$Recruit_register->id}}" style="display: none;">
                        </div>
                    {{-- <div class="col-span-12">
                    CV
                    </div> --}}
        
                    <!-- END: Blog Layout -->
                </div>

            </div> <!-- END: Modal Body -->
            <!-- BEGIN: Modal Footer -->
            <div class="modal-footer text-right">
                <button type="button" id="save" class="btn btn-sm btn-primary w-20 mr-1">Lưu</button>
                <button type="button" data-dismiss="modal" class="btn btn-sm btn-primary w-20 mr-1">Đóng</button>
            </div>
            <!-- END: Modal Footer -->
        </div>
    </div>
</div> <!-- END: Modal Content -->

@section('js')
<script>
    $(document).ready(function () {
      $("#save").on("click", function() {
        var id = $("#id_recruit_register").val();
        var status = $("#status_register").val();
        $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        var data = {
                id: id,
                status: status
            };
         $.ajax({
                url: "{{ route('recruit_register.update') }}",
                method: "POST",
                data: data,
                dataType: "json",
                success: function(data) {
                    alert('Cập nhật thành công.');
                    window.location.replace("{{ route('recruit_register.index') }}");
                }
        });
      });
     
   });
</script>
@endsection