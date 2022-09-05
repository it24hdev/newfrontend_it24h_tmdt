@extends('frontend.layouts.base')

@section('title')
    <title>IT24H -  Tuyển dụng</title>
@endsection

@section('css')
    <link rel="stylesheet" href="asset/css/recruit.css">
@endsection

@section('header-home')
    @include('frontend.layouts.header-page', [$Sidebars, $Menus ,$active_menu])
@endsection

@section('header-mobile')
    @include('frontend.layouts.menu-mobile', [$Sidebars, $Menus])
@endsection

@section('content')

<div class="bg-white p-3">
      
<div class="tuyendung_2021">
<div class="container-page">
   <div class="row">
      <div class="col-8" id="an-di-ban-oi-1">
         <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            @foreach($list_location as $index => $listlocation)
            <li class="nav-item" role="presentation">
             <button class="nav-link {{ $index == 0 ? 'active' : '' }}" id="{{$listlocation->location}}" data-bs-toggle="pill" data-bs-target="#{{$listlocation->location}}1" type="button" role="tab" aria-controls="pills-home" aria-selected="true">{{$listlocation->location_name}}</button>
           </li>
           @endforeach
         </ul>
         <div class="tab-content" id="pills-tabContent">
            @foreach($list_location as $index => $listlocation)
           <div class="tab-pane fade show  {{ $index == 0 ? 'active' : '' }}" id="{{$listlocation->location}}1" role="tabpanel" aria-labelledby="{{$listlocation->location}}">
               <div class="job">
                  <div class="tab-content list_job job_hanoi current" >
                  <ul>
                     <li class="first-li-listjob">
                        <div class="row listjob listjob-header">
                           <div class="listjob-2 col-3">
                              <div class="name-job">
                                  Vị trí
                              </div>
                           </div>
                           <div class="listjob-3 col-6">
                              <div class="treatment">
                                  Thu nhập
                              </div>
                              <div class="quantity">
                                  Số lượng
                              </div>
                              <div class="deadline">
                                  Hạn nộp
                              </div>
                           </div>
                           <div class="listjob-1 col-3">
                           </div>
                        </div>
                     </li>
                   @foreach($list_vacancies as $listvacancies)
                   @if($listvacancies->location == $listlocation->location)
                   <li>
                     <div class="row listjob">
                        <div class="listjob-2 col-3">
                           <div class="name-job">
                              <div class="name-job-text"><a href="" target="_blank">{{$listvacancies->vacancies}}</a></div>
                              <div class="worktype">{{$listvacancies->type}}</div>
                           </div>
                        </div>
                        <div class="listjob-3 col-6">
                           <div class="treatment">
                             <div class="treatment-content">
                              {{$listvacancies->income}}
                             </div>
                           </div>
                           <div class="quantity">
                             <div class="quantity-content">
                              {{$listvacancies->quantum}}
                             </div>
                           </div>
                           <div class="deadline">
                             <div class="deadline-content">
                              {{$listvacancies->deadline}}
                             </div>
                           </div>
                        </div>
                        <div class="listjob-1 col-3">
                           <button type="button" class="b24-web-form-popup-btn-3 btn btn-primary jobapply js_show_form"  data-bs-toggle="modal" data-bs-target="#header-footer-modal-preview{{$listvacancies->id}}">
                            Ứng tuyển
                           </button>
                        </div>
                     </div>
                  </li>
                  @endif
                   @include('frontend.recruit_view')
                  @endforeach
               </ul>
               </div>
            </div>
           </div>
           @endforeach
         </div>
      </div>
      <div class="col-4" id="an-di-ban-oi-2">
         @if ($message = Session::get('error'))
             <div class="alert alert-success alert-dismissible show flex items-center mb-2 text-center" role="alert">
                 {{ $message }}
             </div>
         @endif
        <div class="ahuhu">Ứng tuyển nhanh</div>
         <div class="form_ungtuyen">
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
                     <input type="file" name="fileupload[]" accept=".pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" multiple="" style="display:none">Tải lên CV của bạn (.pdf, docx)
                     <div id="progress_1" class="progress" style="display:none">
                        <div class="progress-bar progress-bar-success"></div>
                     </div>
                  </label>
                  <div id="files" class="files"></div>
               </div>
               <input type="submit" class="evsriz"  value="Gửi đơn ứng tuyển">
            </form>
         </div>
      </div>
   </div>
</div>
<!-- Button trigger modal -->
   
</div>
</div>

@endsection

@section('footer')
    @include('frontend.layouts.footer', [$posts_footer])
@endsection

@section('js')
   <script>
   $(document).ready(function () {
      $(".js-tab").on("click", function() {
        var id = $(this).attr('data-id');
        id = "sub-"+id;
        $('#'+id).slideToggle();
      });
   });
   </script>
@endsection