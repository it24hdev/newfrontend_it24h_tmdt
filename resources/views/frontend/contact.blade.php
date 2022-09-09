@extends('frontend.layouts.base')

@section('title')
    <title>@lang('lang.It24hcontact')</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('asset/css/contact.css')}}">
@endsection

@section('header-home')
    @include('frontend.layouts.header-page', [$Sidebars, $active_menu])
@endsection

@section('header-mobile')
    @include('frontend.layouts.menu-mobile', [$Sidebars])
@endsection

@section('content')
    <div id="content">
        <div class="col-full">
            <section class="contact">
                <div class="contact_container-0 mw-1290">
                    <div class="contact_populated">
                        <section class="w-100">
                            <div class="contact_container-1">
                                <div class="contact_left">
                                    <div class="contact_left-default">
                                        <h3 class="heading-title">@lang('lang.Donthesitatetocontactusifyouneedhelp')</h3>
                                    </div>
                                </div>
                                <div class="contact_right">
                                    <div class="contact_right-default">
                                        <div class="editor-text">
                                            <p style="font-size: 16px; text-align:justify">Chúng tôi mong muốn mang lại những giá trị đích thực, những giải pháp và dịch vụ có chất lượng tốt nhất cho khách hàng.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="w-100 show-contact">
                            <div class="contact_container-2">
                                <div class="col-address">
                                    <div class="show-contact_populated">
                                        <div class="contact_icon">
                                            <i class="fal fa-map-marker-alt"></i>
                                            <span class="contact_text">@lang('lang.Address')</span>
                                        </div>
                                        <div class="contact_address">
                                            81c Phố Mê Linh<br>
                                            Lê Chân, Hải Phòng
                                        </div>
                                    </div>
                                </div>
                                <div class="col-call">
                                    <div class="show-contact_populated">
                                        <div class="contact_icon">
                                            <i class="fal fa-phone-alt"></i>
                                            <span class="contact_text">@lang('lang.CallUs')</span>
                                        </div>
                                        <div class="contact_address">
                                            088 677 6286<br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-openning">
                                    <div class="show-contact_populated">
                                        <div class="contact_icon">
                                            <i class="fal fa-clock"></i>
                                            <span class="contact_text">@lang('lang.Openning')</span>
                                        </div>
                                        <div class="contact_address">
                                            @lang('lang.Monday') – @lang('lang.Saturday'): 8am – 5.30pm<br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-contact">
                                    <div class="show-contact_populated">
                                        <div class="contact_icon">
                                            <i class="fal fa-envelope"></i>
                                            <span class="contact_text">@lang('lang.Contact')</span>
                                        </div>
                                        <div class="contact_address">
                                            contact@it24h.com
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="form-contact w-100">

                            <div class="form-contact_container">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success align-items-center" role="alert">
                                        <div><i class="fal fa-bell me-1"></i> {{ $message }}</div>
                                    </div>
                                @endif
                                <div class="form_heading">
                                    <div class="form_heading-container">
                                        <h4 class="heading-title">@lang('lang.GotAnyQuestions')</h4>
                                    </div>
                                </div>
                                <div class="text-editor_default w-100">
                                    <div class="text-editor_container">
                                        <div>@lang('lang.Usetheformbelowtogetintouchwiththesalesteam')</div>
                                    </div>
                                </div>
                                <div class="contactform w-100">
                                    <form class="contact_form" action="{{route('submit_contact')}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <span class="form-control-wrap">
                                                    <input type="text" name="name" placeholder="@lang('lang.Name') *" required>
                                                </span>
                                            </div>
                                            <div class="col-md-6">
                                                <span class="form-control-wrap">
                                                    <input type="email" name="email" placeholder="@lang('lang.Email') *" required>
                                                </span>
                                            </div>
                                            <div class="col-md-12">
                                                <span class="form-control-wrap">
                                                    <textarea name="content" cols="40" rows="3" placeholder="@lang('lang.Message')" required></textarea>
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <button type="submit" class="submit">@lang('lang.SendYourMessage')</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
            <section class="map w-100">
                <div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3728.476669677981!2d106.67813361440444!3d20.85282889913801!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314a7a8bc74987f3%3A0xe3eb8ce124a7f43b!2zODFjIFAuIE3DqiBMaW5oLCBBbiBCacOqbiwgTMOqIENow6JuLCBI4bqjaSBQaMOybmcgMTgwMDAwLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1656574821535!5m2!1svi!2s" width="100%" height="600" class="address_map" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </section>
        </div>
    </div>
    <div style="clear: both"></div>
@endsection

@section('footer')
    @include('frontend.layouts.footer', [$posts_footer])
@endsection

