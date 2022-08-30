@extends('frontend.layouts.base')

@section('title')
    <title>@lang('lang.It24hcontact')</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('asset/css/contact.css')}}">
@endsection

@section('header-home')
    @include('frontend.layouts.header-page', [$Sidebars, $Menus])
@endsection

@section('header-mobile')
    @include('frontend.layouts.menu-mobile', [$Sidebars, $Menus])
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
                                        <div class="editor-text">Velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accu santium olorem que laud antium id est laborum.</div>
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
                                    <form class="contact_form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <span class="form-control-wrap">
                                                    <input type="text" placeholder="@lang('lang.Name') *">
                                                </span>
                                            </div>
                                            <div class="col-md-6">
                                                <span class="form-control-wrap">
                                                    <input type="email" placeholder="@lang('lang.Email') *">
                                                </span>
                                            </div>
                                            <div class="col-md-12">
                                                <span class="form-control-wrap">
                                                    <textarea cols="40" rows="3" placeholder="@lang('lang.Message')"></textarea>
                                                </span>
                                            </div>
                                        </div>
                                        <p>
                                            <span class="form-control-wrap">
                                                <span class="form-checkbox">
                                                    <span class="form-list-item">
                                                        <label>
                                                            <input type="checkbox" value="yes">
                                                            <span>@lang('lang.SavemynameemailandwebsiteinthisbrowserforthenexttimeIcomment').</span>
                                                        </label>
                                                    </span>
                                                </span>
                                            </span>
                                        </p>
                                        <div>
                                            <input type="submit" value="@lang('lang.SendYourMessage')">
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
    @include('frontend.layouts.footer')
@endsection
