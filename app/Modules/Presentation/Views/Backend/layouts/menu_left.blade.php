<script type="text/javascript" src="{{ asset('public/js/admin/layouts/menu_left.js') }}"></script>
<div id="accordion" role="tablist" class="menu-left">
    @include('Backend::layouts.menu_left.system')
    @include('Backend::layouts.menu_left.media')
    @include('Backend::layouts.menu_left.seo_tools')
    @include('Backend::layouts.menu_left.content')
    @include('Backend::layouts.menu_left.products')
    @include('Backend::layouts.menu_left.bill_manage')
    @include('Backend::layouts.menu_left.page')
    {{--@include('Backend::layouts.menu_left.template')--}}
    @include('Backend::layouts.menu_left.contact')
    @include('Backend::layouts.menu_left.menu')
    @include('Backend::layouts.menu_left.users')
    <div class="card-header" role="tab" id="headingUsers">
        <h5 class="mb-0">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out"></i>LOGOUT
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                  style="display: none;">
                {{ csrf_field() }}
            </form>
        </h5>
    </div>
</div>
