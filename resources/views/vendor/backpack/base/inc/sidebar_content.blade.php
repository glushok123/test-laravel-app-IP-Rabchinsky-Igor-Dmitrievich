{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<!--li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></!--li-->

<!--li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user-tie"></i> Пользователи</a></!--li-->
@if(backpack_auth()->user()->type == 1)
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('product') }}"><i class="nav-icon la la-product-hunt"></i> Товары</a></li>
@endif

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('history-user-request') }}"><i class="nav-icon la la-history"></i> История запросов</a></li>