@if(isset($type))
    <div id="respond" class="comment-respond">
    <span id="reply-title" class="comment-reply-title">
        @lang('lang.LeaveaReply')
        <small>
             <a href="javascript:;" id="cancel-comment-reply-link" onclick="closeReply(0,{{$post_id}})">
                 <i class="far fa-times-circle"></i>
             </a>
        </small>
    </span>
    <form id="commentform" action="{{route('commentPost')}}" method="post" class="comment-form">
        <p class="comment-notes">
            <span id="email-notes">@lang('lang.Youremailaddresswillnotbepublished').</span>
            <span class="required-field-message">@lang('lang.Requiredfieldsaremarked')
                <span class="required">*</span>
            </span>
        </p>
        <p class="comment-form-comment">
            <textarea id="comment" name="comment" cols="45" maxlength="65525" rows="4" required="required" placeholder="Comment"></textarea>
        </p>
        <p class="comment-form-author">
            <input id="author" name="author" type="text" placeholder="Your Name *" size="30" required="required">
        </p>
        <p class="comment-form-email">
            <input id="email" name="email" type="email" placeholder="Email Address *" size="30" required="required">
        </p>
        <p class="comment-form-cookies-consent">
            <input id="cookies-consent" name="cookies-consent" type="checkbox" value="yes">
            <label for="cookies-consent">@lang('lang.SavemynameemailandwebsiteinthisbrowserforthenexttimeIcomment').</label>
        </p>
        <p class="form-submit">
            <input type="hidden" name="comment_post" value="{{$post_id}}">
            <input type="hidden" name="comment_parent" value="{{$parent_id}}">
            <button name="submit" type="submit" id="submit" class="submit" value="Post Comment">@lang('lang.PostComment')</button>
        </p>
        @csrf
    </form>
</div>
@else
    <div id="respond" class="comment-respond">
    <span id="reply-title" class="comment-reply-title">
        @lang('lang.LeaveaReply')
    </span>
        <form id="commentform" action="{{route('commentPost')}}" method="post" class="comment-form">
            <p class="comment-notes">
                <span id="email-notes">@lang('lang.Youremailaddresswillnotbepublished').</span>
                <span class="required-field-message">@lang('lang.Requiredfieldsaremarked')
                <span class="required">*</span>
            </span>
            </p>
            <p class="comment-form-comment">
                <textarea id="comment" name="comment" cols="45" maxlength="65525" rows="4" required="required" placeholder="Comment"></textarea>
            </p>
            <p class="comment-form-author">
                <input id="author" name="author" type="text" placeholder="@lang('lang.Name') *" size="30" required="required">
            </p>
            <p class="comment-form-email">
                <input id="email" name="email" type="email" placeholder="@lang('lang.Email') *" size="30" required="required">
            </p>
            <p class="comment-form-cookies-consent">
                <input id="cookies-consent" name="cookies-consent" type="checkbox" value="yes">
                <label for="cookies-consent">@lang('lang.SavemynameemailandwebsiteinthisbrowserforthenexttimeIcomment').</label>
            </p>
            <p class="form-submit">
                <input type="hidden" name="comment_post" value="{{$post_id}}">
                <input type="hidden" name="comment_parent" value="{{$parent_id}}">
                <button name="submit" type="submit" id="submit" class="submit" value="Post Comment">@lang('lang.PostComment')</button>
            </p>
            @csrf
        </form>
    </div>
@endif
