@extends('frontend.layouts.base')

@section('title')
    <title>@lang('lang.IT24Haccount')</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('asset/css/user/myaccount.css')}}">
@endsection

@section('header-home')
    @include('frontend.layouts.header-page', [$Sidebars, $Menus])
@endsection

@section('header-mobile')
    @include('frontend.layouts.menu-mobile', [$Sidebars, $Menus])
@endsection

@section('content')
    <div class="wp-breadcrumb-page">
        <div class="container-page">
            <div class="breadcrumb-page">
                <a href="{{route('user')}}">@lang('lang.Home') <i class="fas fa-angle-right mx-1"></i></a>
                <a>@lang('lang.Myaccount')</a>
            </div>
        </div>
    </div>
    <div class="container-page" style="color: #222">
            <div class="row">
                <div class="col-12 col-md-3">
                    <ul class="menu-account nav nav-tabs" id="myTab" role="tablist">
                        <li><a href="javascript:;" class="nav-link" id="account-detail-tab" data-bs-toggle="tab" data-bs-target="#account-detail-tab-pane" role="tab" aria-controls="account-detail-tab-pane" aria-selected="true">@lang('lang.AccountDetail') <span><i class="fas fa-user"></i></span></a></li>
                        <li><a href="javascript:;" class="nav-link" id="change-password-tab" data-bs-toggle="tab" data-bs-target="#change-password-tab-pane" role="tab" aria-controls="change-password-tab-pane" aria-selected="false">@lang('lang.ChangePassword') <span><i class="fas fa-lock"></i></span></a></li>
                        <li><a href="javascript:;" class="nav-link" id="order-tab" data-bs-toggle="tab" data-bs-target="#order-tab-pane" role="tab" aria-controls="order-tab-pane" aria-selected="false">@lang('lang.Orders')<span><i class="fas fa-shopping-bag"></i></span></a></li>
                        <li><a href="{{route('user_logout')}}">@lang('lang.Logout') <span><i class="fas fa-sign-out"></i></span></a></li>
                    </ul>
                </div>
                <div class="col-12 col-md-9">
                    <div class="tab-content" id="myTabContent">
                        <!-- ======= ACCOUNT DETAIL ===== -->
                        <div class="tab-pane fade {{ $errors->has('password') || $errors->has('password_confirmation') || session('passSuccess') ? '' : 'show active' }}"
                             id="account-detail-tab-pane" role="tabpanel" aria-labelledby="account-detail-tab" tabindex="0">
                            <form action="{{route('user_update', $user->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    @if ($message = Session::get('success'))
                                    <div class="alert alert-success align-items-center" role="alert">
                                        <div><i class="fal fa-bell me-1"></i> {{ $message }}</div>
                                    </div>
                                    @endif
                                    <div class="col-12 mb-3">
                                        <h4>@lang('lang.AccountDetail')</h4>
                                    </div>

                                    <div class="col-12 col-md-8 content-info">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group mb-3">
                                                    <label for="">@lang('lang.Fullname')</label>
                                                    <input type="text" name="name" value="{{(old('name')) ? old('name') : $user->name}}" class="form-control @error('name') is-invalid @enderror">
                                                    @error('name')
                                                    <span role="alert">
                                                        <p class="text-danger fst-italic mt-2" style="font-size: 14px;">{{ $message }}</p>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="">@lang('lang.Email')</label>
                                                    <input type="email" name="email" value="{{$user->email}}" class="form-control" disabled>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for=""> @lang('lang.Address')</label>
                                                    <input type="text" name="address" value="{{(old('address')) ? old('address') : $user->address}}" placeholder="@lang('lang.Enteryouraddress')"
                                                    class="form-control @error('address') is-invalid @enderror">
                                                    @error('address')
                                                    <span role="alert">
                                                        <p class="text-danger fst-italic mt-2" style="font-size: 14px;">{{ $message }}</p>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="">@lang('lang.Phone')</label>
                                                    <input type="text" name="phone_number" value="{{(old('phone_number')) ? old('phone_number') : $user->phone_number}}" placeholder="@lang('lang.Enteryourphone')"
                                                    class="form-control @error('phone_number') is-invalid @enderror">
                                                    @error('phone_number')
                                                    <span role="alert">
                                                        <p class="text-danger fst-italic mt-2" style="font-size: 14px;">{{ $message }}</p>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="">@lang('lang.Birthday')</label>
                                                    <input type="date" name="birthday" value="{{(old('birthday')) ? old('birthday') : $user->birthday}}"
                                                    class="form-control @error('birthday') is-invalid @enderror">
                                                    @error('birthday')
                                                    <span role="alert">
                                                        <p class="text-danger fst-italic mt-2" style="font-size: 14px;">{{ $message }}</p>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="">@lang('lang.gender')</label>
                                                    <select class="form-select" name="gender">
                                                        <option selected value="">@lang('lang.Chooseyourgender')</option>
                                                        <option value="Nam" @if ($user->gender == 'Nam') selected @endif>@lang('lang.male')</option>
                                                        <option value="Nữ" @if ($user->gender == 'Nữ') selected @endif>@lang('lang.female')</option>
                                                        <option value="Gới tính khác" @if ($user->gender == 'Gới tính khác') selected @endif>@lang('lang.Othergenders')</option>
                                                    </select>
                                                    @error('gender')
                                                    <span role="alert">
                                                        <p class="text-danger fst-italic mt-2" style="font-size: 14px;">{{ $message }}</p>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn btn-primary px-5">@lang('lang.Update')</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 content-avt">
                                        <div class="wp-avatar">
                                            <div class="show-avatar mb-3">
                                                <img id="upload-image" src="@php
                                                if (isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])) {
                                                    echo '/upload/user/' . $_FILES['avatar']['name'];
                                                } else {
                                                    if (!empty($user->avatar)) {
                                                        echo '/upload/images/user/' . $user->avatar;
                                                    } else {
                                                        echo '/upload/images/common_img/avt-user.png';
                                                    }
                                                }
                                            @endphp" alt="">
                                            </div>
                                            <input name="avatar" id="avatar" type="file" onchange="show_upload_image()" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- ======= CHANGE PASSWORD ===== -->
                        <div class="tab-pane fade {{ $errors->has('password') || $errors->has('password_confirmation') || session('passSuccess') ? 'show active' : '' }}"
                        id="change-password-tab-pane" role="tabpanel" aria-labelledby="change-password-tab" tabindex="0">
                            <form action="{{route('change_password', $user->id)}}" method="POST">
                                @csrf
                                <div class="row">
                                    @if ($message = Session::get('passSuccess'))
                                    <div class="alert alert-success align-items-center" role="alert">
                                        <div><i class="fal fa-bell me-1"></i> {{ $message }}</div>
                                    </div>
                                    @endif
                                    <div class="col-12 mb-3">
                                        <h4>@lang('lang.ChangePassword')</h4>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <div class="form-group mb-3">
                                            <label for="">@lang('lang.OldPassword')</label>
                                            <input type="password" name="pw_old" value="{{ old('pw_old') }}" placeholder="@lang('lang.Enteroldpassword')" class="form-control" required>
                                            @error('pw_old')
                                            <span role="alert">
                                                <p class="text-danger fst-italic mt-2" style="font-size: 14px;">{{ $message }}</p>
                                            </span>
                                            @enderror
                                            @error(session('error'))
                                            <span role="alert">
                                                <p class="text-danger fst-italic mt-2" style="font-size: 14px;">{{ session('error') }}</p>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">@lang('lang.NewPassword')</label>
                                            <input type="password" name="password" value="{{ old('password') }}" placeholder="@lang('lang.Enternewpassword')"
                                            class="form-control" required>
                                            @error('password')
                                            <span role="alert">
                                                <p class="text-danger fst-italic mt-2" style="font-size: 14px;">{{ $message }}</p>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">@lang('lang.PasswordConfirm')</label>
                                            <input type="password" name="password_confirmation" placeholder="@lang('lang.Enterconfirmpassword')" value="{{ old('password_confirmation') }}"
                                            class="form-control" required>
                                            @error('password_confirmation')
                                            <span role="alert">
                                                <p class="text-danger fst-italic mt-2" style="font-size: 14px;">{{ $message }}</p>
                                            </span>
                                            @enderror
                                        </div>
                                        <div>
                                          <button type="submit" class="btn btn-primary px-5">@lang('lang.Update')</button>
                                          <a href="{{route('forgot_password')}}" class="lost-pass d-block float-end">@lang('lang.Lostyourpassword')</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- ======= ORDER ===== -->
                        <div class="tab-pane fade" id="order-tab-pane" role="tabpanel" aria-labelledby="order-tab" tabindex="0">
                          <table class="table table-striped table-hover">
                            <thead>
                              <tr>
                                <th scope="col">@lang('lang.CodeOrder')</th>
                                <th scope="col">@lang('lang.Date')</th>
                                <th scope="col">@lang('lang.Status')</th>
                                <th scope="col">@lang('lang.Total')</th>
                                <th scope="col">@lang('lang.Action')</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td scope="row">#IT24H{{$order->id}}</td>
                                    <td>{{ \App\Helpers\CommonHelper::convertDateToDMY($order->created_at) }}</td>
                                    <td>@if ($order->status == 1)
                                        @lang('lang.waitprocessing')
                                    @elseif($order->status == 2)
                                        @lang('lang.Packed')
                                    @elseif($order->status == 3)
                                        @lang('lang.shipping')
                                    @elseif($order->status == 4)
                                       @lang('lang.Complete')
                                    @elseif($order->status == 5)
                                        @lang('lang.Cancel')
                                    @endif</td>
                                    <td>{{ number_format($order->total, 0, '', '.') }} @lang('lang.Currencyunit')</td>
                                    <td>
                                      <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$order->id}}">@lang('lang.View') <i class="far fa-eye"></i></button>
                                      <div class="modal fade" id="exampleModal-{{$order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel-{{$order->id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel-{{$order->id}}">
                                                @lang('lang.OrderDetail'): #IT24H{{$order->id}}</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body overflow-auto">
                                                <table class="table table-striped table-hover mb-4">
                                                  <thead>
                                                    <tr>
                                                      <th scope="col">#</th>
                                                      <th scope="col">@lang('lang.Thumb')</th>
                                                      <th scope="col">@lang('lang.Productname')</th>
                                                      <th scope="col">@lang('lang.Price')</th>
                                                      <th scope="col">@lang('lang.Quantity')</th>
                                                      <th scope="col">@lang('lang.Total')</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    @php
                                                        $t=0;
                                                    @endphp
                                                    @foreach ($order->order_item as $product)
                                                    @php
                                                        $t++;
                                                    @endphp
                                                    <tr>
                                                        <td scope="row">{{$t}}</td>
                                                        <td>
                                                            @if (!empty($product->product_id) && !empty($product->product->thumb))
                                                            <img width="120px" height="auto" src="upload/images/products/medium/{{$product->product->thumb}}" alt="">
                                                            @else
                                                            <img width="120px" height="auto" src="upload/images/common_img/no-image-product.jpg" alt="">
                                                            @endif
                                                        </td>
                                                        <td><a href="{{route('detailproduct', $product->product->slug)}}">{{$product->product_name}}</a></td>
                                                        <td>{{ number_format($product->price, 0, '', '.') }} @lang('lang.Currencyunit')</td>
                                                        <td>{{$product->quantity}}</td>
                                                        <td>{{ number_format((($product->price)*($product->quantity)), 0, '', '.') }} @lang('lang.Currencyunit')</td>
                                                    </tr>
                                                    @endforeach
                                                  </tbody>
                                                  <tfoot>
                                                    <th colspan="5">@lang('lang.Total')</th>
                                                    <td colspan="1">{{ number_format($order->total, 0, '', '.') }} @lang('lang.Currencyunit')</td>
                                                  </tfoot>
                                                </table>
                                                <h5>@lang('lang.Customerinformation')</h5>
                                                <table class="table table-striped mb-4">
                                                  <thead>
                                                    <th scope="col">@lang('lang.CustomerName')</th>
                                                    <th scope="col">@lang('lang.Address')</th>
                                                    <th scope="col">@lang('lang.Phone')</th>
                                                    <th scope="col">@lang('lang.Email')</th>
                                                    <th scope="col">@lang('lang.Notes')</th>
                                                    <th scope="col">@lang('lang.Paymentmethod')</th>
                                                  </thead>
                                                  <tbody>
                                                    <tr>
                                                      <td>{{$order->customer_name}}</td>
                                                      <td>{{$order->address}}</td>
                                                      <td>{{$order->phone_number}}</td>
                                                      <td>{{$order->email}}</td>
                                                      <td>{{$order->note}}</td>
                                                      <td>{{$order->payment_method}}</td>
                                                    </tr>
                                                  </tbody>
                                                </table>

                                          </div>
                                          </div>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                @endforeach

                            </tbody>
                          </table>
                        </div>

                      </div>
                </div>
            </div>
    </div>
@endsection

@section('footer')
    @include('frontend.layouts.footer')
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            show_upload_image = function() {
            var upload_image = document.getElementById("avatar")
            if (upload_image.files && upload_image.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#upload-image').attr('src', e.target.result)
                };
                reader.readAsDataURL(upload_image.files[0]);
            }
        }
        });

    </script>
@endsection




