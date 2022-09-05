<!-- BEGIN: Modal Content -->
<div id="header-footer-modal-preview{{$listvacancies->id}}"  class="modal fade"  tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 400px;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="intro-y news box">
                    <!-- BEGIN: Blog Layout -->

                    <div class=" intro-y">
                        <form action="{{ route('recruit_register')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                           <div class="deleteform"><i class="fal fa-times"></i></div>
                           <div class=" jMouwh">
                              <label class=" bYSDpc">Họ tên <span class="required">*</span></label>
                              <input type="text" name="first_name" value="" class=" eSumex" required>
                           </div>
                           <div class=" jMouwh">
                              <label class=" bYSDpc">Số điện thoại <span class="required">*</span></label>
                              <input type="number" name="phone_number" value="" class=" eSumex" required>
                           </div>
                           <div class=" jMouwh">
                              <label class="bYSDpc">Email <span class="required">*</span></label>
                              <input type="email" name="email" value="" class=" eSumex" required>
                           </div>
                           <div class=" jMouwh">
                              <label class=" bYSDpc">Vị trí ứng tuyển <span class="required">*</span></label>
                              <input type="text" name="vitriungtuyen" value="" class=" eSumex" required>
                           </div>
                           <div class=" gyDNhS" style="display:none;">
                              <label class=" kcAUjf">
                                 <div id="display_file_upload_list">
                                    <!--
                                       Upload thành công: file-name-1
                                       Upload thành công: file-name-2
                                       ...
                                       -->
                                 </div>
                                 <div id="all_file_upload_url">
                                    <!--
                                       <input type="hidden"  name="info[files][]" value="file-url-1"/>
                                       <input type="hidden"  name="info[files][]" value="file-url-2"/>
                                       ...
                                       -->
                                 </div>
                                 <input  type="file" name="fileupload[]" accept=".pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" multiple="" style="display:none">Tải lên CV của bạn (.pdf, docx)
                                 <div id="progress_1" class="progress" style="display:none">
                                    <div class="progress-bar progress-bar-success"></div>
                                 </div>
                              </label>
                              <div id="files" class="files"></div>
                           </div>
                           <input type="submit" class="evsriz"  value="Gửi đơn ứng tuyển">
                        </form>

                    </div>
                    <!-- END: Blog Layout -->
                </div>

            </div> <!-- END: Modal Body -->
            <!-- BEGIN: Modal Footer -->
            <div class="modal-footer text-right">
                <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-primary w-20 mr-1">Đóng</button>
            </div>
            <!-- END: Modal Footer -->
        </div>
    </div>
</div> <!-- END: Modal Content -->
