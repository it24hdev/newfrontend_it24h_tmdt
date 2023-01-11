@extends('frontend.layouts.base')

@section('title')
    <title>@lang('lang.It24hblog')</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('asset/css/category-blog.css')}}">
@endsection

@section('header-home')
    @include('frontend.layouts.header-page', [$Sidebars, $active_menu])
@endsection

@section('content')
<div class="wp-breadcrumb-page">
    <div class="container-page">
        <div class="breadcrumb-page">
            <a href="{{route('user')}}">@lang('lang.Home') <i class="fas fa-angle-right mx-1"></i></a>
            <a>@lang('lang.Blog')</a>
        </div>
    </div>
</div>
<div id="content" class="container-page">
    <div class="site-content">
        <div class="content_default">
            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <div class="blog-style-grid">
                        @foreach($blogs as $item)
                            <div class="post-style-1">
                                <div class="post-inner">
                                    <div class="post-thumbnail">
                                        <div class="categories-link-box">
                                            @foreach($item->getCategoryRela as $category_rela)
                                                <a href="{{route('categoryBlog',['slug'=>$category_rela->getCategory->slug])}}">{{$category_rela->getCategory->name}}</a>
                                            @endforeach
                                        </div>
                                        <a href="{{route('singlePost',['slug'=>$item->slug])}}" style="display: block;"><img src="{{asset('upload/images/post/medium').'/'.$item->thumb}}"></a>
                                    </div>
                                    <div class="entry-content">
                                        <div class="entry-meta">
                                            <div class="post-author">
                                                <i class="far fa-user"></i>
                                                <span>@lang('lang.By') </span>
                                                <a href="#">{{$item->getUser->name}}</a>
                                            </div>
                                            <div class="posted-on">
                                                <i class="far fa-calendar"></i>
                                                <span>{{\App\Helpers\CommonHelper::convertDateToDMY($item->created_at)}}</span>
                                            </div>
                                        </div>
                                        <h3 class="entry-title">
                                            <a href="{{route('singlePost',['slug'=>$item->slug])}}">{{$item->title}}</a>
                                        </h3>
                                        <p>{{$item->excerpt}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {!! $blogs->links('frontend.pagination') !!}
                </main>
            </div>
            <div id="secondary" class="widget-area">
                <div class="widget_search">
                    <span class="widget_title">
                        <span>@lang('lang.Search')</span>
                    </span>
                    <form>
                        <i class="fal fa-search"></i>
                        <label class="w-100">
                            <span class="screen-reader-text">@lang('lang.Searchfor'):</span>
                            <input type="search" name="tim-kiem" value="{{(request()->input('tim-kiem')) ? request()->input('tim-kiem') : ''}}" class="search-field" placeholder="@lang('lang.Search')">
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
                                    @endif</a>
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

