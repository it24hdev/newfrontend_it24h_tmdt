<li class="detail-comment">
    <div class="avatar">
        <img src="{{asset('asset/images/avatar-comment.png')}}" alt="">
    </div>
    <div class="wp-content-comment">
        <div class="rating2">
            <div class="rating-upper" style="width: {{$item->level * 20}}%">
                <span>
                    <i class="fas fa-star">
                    </i>
                </span>
                <span>
                    <i class="fas fa-star">
                    </i>
                </span>
                <span>
                    <i class="fas fa-star">
                    </i>
                </span>
                <span>
                    <i class="fas fa-star">
                    </i>
                </span>
                <span>
                    <i class="fas fa-star">
                    </i>
                </span>
            </div>
            <div class="rating-lower">
                <span>
                    <i class="fal fa-star">
                    </i>
                </span>
                <span>
                    <i class="fal fa-star">
                    </i>
                </span>
                <span>
                    <i class="fal fa-star">
                    </i>
                </span>
                <span>
                    <i class="fal fa-star">
                    </i>
                </span>
                <span>
                    <i class="fal fa-star">
                    </i>
                </span>
            </div>
        </div>
        <div class="author">
            <span class="name">{{$item->name_user}}</span>
            <span class="date">{{\App\Helpers\CommonHelper::convertDateToDMY($item->created_at)}}</span>
        </div>
        <div class="content-comment">
            {{$item->comment}}
        </div>
    </div>                                        
</li>