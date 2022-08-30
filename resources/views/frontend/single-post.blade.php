@extends('frontend.layouts.base')

@section('title')
    <title>{{$post->title}}</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('asset/css/single-post.css')}}">
@endsection

@section('header-home')
    @include('frontend.layouts.header-page', [$Sidebars, $Menus])
@endsection

@section('header-mobile')
    @include('frontend.layouts.menu-mobile', [$Sidebars, $Menus])
@endsection

@section('content')
    <div id="content">
        <div class="breadcrumb-wrap">
            <section class="breadcrumb">
                <div class="breadcrumb_default">
                    <div class="breadcrumb_populated">
                        <div class="breadcrumb_title"></div>
                        <nav class="breadcrumb_list">
                            <a href="{{route('user')}}">@lang('lang.Home')</a>
                            <i class="fas fa-angle-right"></i>
                            <a href="{{route('categoryBlogs')}}">@lang('lang.Blog')</a>
                            <i class="fas fa-angle-right"></i>
                            {{$post->title}}
                        </nav>
                    </div>
                </div>
            </section>
        </div>
        <div class="site-content">
            <div class="content_default">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main">
                        <article>
                            <div class="single-content">
                                <header class="entry-header">
                                    <div class="categories-link-box">
                                        @foreach($post->getCategoryRela as $category)
                                            <a href="{{route('categoryBlog',['slug'=>$category->getCategory->slug])}}">{{$category->getCategory->name}}</a>
                                        @endforeach
                                    </div>
                                    <h1 class="entry-title">{{$post->title}}</h1>
                                    <div class="entry-meta">
                                        <div class="post-author">
                                            <i class="far fa-user"></i>
                                            <span>@lang('lang.By') </span>
                                            <a href="javascript:;">{{$post->getUser->name}}</a>
                                        </div>
                                        <div class="posted-on">
                                            <i class="far fa-calendar"></i>
                                            <span>{{\App\Helpers\CommonHelper::convertDateToDMY($post->created_at)}}</span>
                                        </div>
                                    </div>
                                </header>
                                <div class="post-thumbnail">
                                    <img width="1070" height="510" src="{{asset('upload/images/post/large').'/'.$post->thumb}}">
                                </div>
                                <div class="entry-content">
                                    {!!$post->content!!}
                                </div>

                                <aside class="entry-taxonomy">
                                    {{--<div class="tags-links">--}}
                                        {{--<a href="#">Television</a>--}}
                                    {{--</div>--}}
                                </aside>
                                <nav class="post-navigation">
                                    <div class="nav-links">
                                        @if(!is_null($post_pre))
                                        <div class="nav-previous">
                                            <a href="{{route('singlePost',['slug'=>$post_pre->slug])}}">
                                                <img width="108" height="74" src="{{asset('upload/images/post/thumb').'/'.$post_pre->thumb}}">
                                                <span class="nav-content">
                                                    <span class="reader-text">
                                                        <i class="fas fa-angle-left"></i>
                                                        @lang('lang.Prew')
                                                    </span>
                                                    <span class="title">{{$post_pre->title}}</span>
                                                </span>
                                            </a>
                                        </div>
                                        @endif
                                        @if(!is_null($post_next))
                                        <div class="nav-next">
                                            <a href="{{route('singlePost',['slug'=>$post_next->slug])}}">
                                                <span class="nav-content">
                                                    <span class="reader-text">
                                                        @lang('lang.Next')
                                                        <i class="fas fa-angle-right"></i>
                                                    </span>
                                                    <span class="title">{{$post_next->title}}</span>
                                                </span>
                                                <img width="108" height="74" src="{{asset('upload/images/post/thumb').'/'.$post_next->thumb}}">
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </nav>
                                <section id="comments" class="comments-area">
                                    <div class="comment-list-wrap">
                                        <h2 class="comments-title"> {{$count_vote}} @lang('lang.Comments')</h2>
                                        <ol class="comment-list">
                                            @foreach($votes as $vote)
                                                <li class="comment">
                                                    <div class="comment-body" id="vote-{{$vote->id}}">
                                                        <div class="comment-author">
                                                            <img width="50" height="50" class="avatar" src="{{asset('asset/images/avatar-comment.png')}}">
                                                        </div>
                                                        <div class="comment-content">
                                                            <div class="comment-head">
                                                                <div class="comment-meta">
                                                                    <cite class="fn">{{$vote->name_user}}</cite>
                                                                    <div class="comment-date">{{\App\Helpers\CommonHelper::convertDateToDMY($vote->created_at)}}</div>
                                                                </div>
                                                                <div class="reply">
                                                                    <a href="javascript:;" class="comment-reply-link" onclick="formVote({{$vote->id}},{{$post->id}})">
                                                                        <i class="fal fa-reply"></i>
                                                                        @lang('lang.Reply')
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="comment-text">
                                                                <p>{{$vote->comment}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @foreach($vote->parentID as $item)
                                                        <ol class="children">
                                                        <li class="comment">
                                                            <div class="comment-body">
                                                                <div class="comment-author">
                                                                    <img width="50" height="50" class="avatar" src="{{asset('asset/images/avatar-comment.png')}}">
                                                                </div>
                                                                <div class="comment-content">
                                                                    <div class="comment-head">
                                                                        <div class="comment-meta">
                                                                            <cite class="fn">{{$item->name_user}}</cite>
                                                                            <div class="comment-date">{{\App\Helpers\CommonHelper::convertDateToDMY($item->created_at)}}</div>
                                                                        </div>
                                                                        <div class="reply"></div>
                                                                    </div>
                                                                    <div class="comment-text">
                                                                        <p>{{$item->comment}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ol>
                                                    @endforeach
                                                </li>
                                            @endforeach

                                        </ol>
                                    </div>
                                    <div id="respond" class="comment-respond">
                                        <span id="reply-title" class="comment-reply-title">
                                            @lang('lang.LeaveaReply')
                                        </span>
                                        <form id="commentform" action="{{route('commentPost')}}" method="post" class="comment-form">
                                            <p class="comment-notes">
                                                <span id="email-notes"> @lang('lang.Youremailaddresswillnotbepublished').</span>
                                                <span class="required-field-message">
                                                    @lang('lang.Requiredfieldsaremarked')
                                                    <span class="required">*</span>
                                                </span>
                                            </p>
                                            <p class="comment-form-comment">
                                                <textarea id="comment" name="comment" cols="45" maxlength="65525" rows="4" required="required" placeholder="@lang('lang.Comments')"></textarea>
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
                                                <input type="hidden" name="comment_post" value="{{$post->id}}">
                                                <input type="hidden" name="comment_parent" value="0">
                                                <button name="submit" type="submit" id="submit" class="submit" value="Post Comment">@lang('lang.PostComment')</button>
                                            </p>
                                            @csrf
                                        </form>
                                    </div>
                                </section>
                            </div>
                        </article>
                    </main>
                </div>
                <div id="secondary" class="widget-area">
                    <div class="widget_search">
                        <span class="widget_title">
                            <span>@lang('lang.Search')</span>
                        </span>
                        <form method="GET" action="{{ url('bai-viet') }}">
                            <i class="fal fa-search"></i>
                            <label class="w-100">
                                <span class="screen-reader-text">@lang('lang.Searchfor'):</span>
                                <input type="search" name="tim-kiem" value="{{(request()->input('tim-kiem')) ? request()->input('tim-kiem') : ''}}" class="search-field" placeholder="Search ...">
                            </label>
                            <input type="submit" class="search-submit">
                        </form>
                    </div>
                    <div class="widget_categories">
                        <span class="widget_title">
                            <span>@lang('lang.BlogCategories')</span>
                        </span>
                        <ul>
                            @foreach($arrCategory as $item)
                                <li class="cat-item">
                                    <i class="fas fa-angle-right"></i>
                                    <a href="{{route('categoryBlog',[$item->slug])}}">
                                     @if($locale=='vi')   {{$item->name}}
                                     @else {{$item->name2}}
                                     @endif
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget_recent_entries">
                        <span class="widget_title">
                            <span>@lang('lang.LatestPost')</span>
                        </span>
                        <ul>
                            @foreach($latest_blog as $item)
                                <li>
                                    <div class="recent-posts-thumbnail">
                                        <a href="{{route('singlePost',['slug'=>$item->slug])}}">
                                            <img width="150" height="150" src="{{asset('upload/images/post/thumb').'/'.$item->thumb}}">
                                        </a>
                                    </div>
                                    <div class="recent-post-info">
                                        <h4 class="post-title">
                                            <a href="{{route('singlePost',['slug'=>$item->slug])}}">{{$item->title}}</a>
                                        </h4>
                                        <span class="post-date">
                                        <i class="far fa-calendar"></i>{{\App\Helpers\CommonHelper::convertDateToDMY($item->created_at)}}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget_tag_cloud">
                        <span class="widget_title">
                            <span>@lang('lang.Tags')</span>
                        </span>
                        <div class="tagcloud">
                            <a href="#">Camera & Video</a>
                            <a href="#">Electronic</a>
                            <a href="#">Headphone</a>
                            <a href="#">Laptop</a>
                            <a href="#">Mobile & Tablet</a>
                            <a href="#">Television</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="clear: both"></div>
@endsection

@section('footer')
    @include('frontend.layouts.footer')
@endsection

@section('js')
<script>
    $(document).ready(function () {
        formVote = function (vote_id,post_id) {
            var _token = $('meta[name="csrf-token"]').attr('content');
            var data = {
                vote_id: vote_id,
                post_id: post_id,
                _token: _token,
                type: 'reply'
            };
            $.ajax({
                url:"{{route('getFormVote')}}",
                type:"post",
                dataType:"json",
                data: data,
                success: function (data) {
                    // console.log(data);
                    $('#respond').remove();
                    $('#vote-'+vote_id).append(data);
                },
            })
        }
        closeReply = function (vote_id,post_id) {
            var _token = $('meta[name="csrf-token"]').attr('content');
            var data = {
                vote_id: vote_id,
                post_id: post_id,
                _token: _token,
            };
            $.ajax({
                url:"{{route('getFormVote')}}",
                type:"post",
                dataType:"json",
                data: data,
                success: function (data) {
                    // console.log(data);
                    $('#respond').remove();
                    $('#comments').append(data);
                },
            })
        }
    })
</script>
@endsection

