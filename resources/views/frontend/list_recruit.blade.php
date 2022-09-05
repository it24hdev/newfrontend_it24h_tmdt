<div class="tab-content list_job job_hanoi current" >
   <ul>
      <!-- Row tr -->
      <li class="first-li-listjob">
         <div class="row listjob listjob-header">
            <div class="listjob-2">
               <div class="name-job">
                   Vị trí
               </div>
            </div>
            <div class="listjob-3">
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
            <div class="listjob-1">
            </div>
         </div>
      </li>
      @foreach($list_vacancies as $listvacancies)
       <li>
         <div class="row listjob">
            <div class="listjob-2">
               <div class="name-job">
                  <div class="name-job-text"><a href="" target="_blank">{{$listvacancies->vacancies}}</a></div>
                  <div class="worktype">{{$listvacancies->type}}</div>
               </div>
            </div>
            <div class="listjob-3">
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
            <div class="listjob-1">
               <button type="button" class="b24-web-form-popup-btn-3 btn btn-primary jobapply js_show_form">
                 Ứng tuyển
               </button>
            </div>
         </div>
      </li>
      @endforeach
  </ul>
</div>