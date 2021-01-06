<div class="card">
    <div class="card-header" role="tab" id="headingUsers">
        <h5 class="mb-0">
            <a class="collapsed" data-toggle="collapse" href="#collapseUsers" aria-expanded="false"
               aria-controls="collapseUsers">
                <i class="fa fa-user-o"></i>{{ trans('Backend::common.account') }}
            </a>
        </h5>
    </div>
    <div id="collapseUsers" class="collapse" role="tabpanel" aria-labelledby="headingUsers"
         data-parent="#accordion">
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="{{ route('UsersIndex') }}">
                        <i class="fa fa-user-o"></i>Thành viên
                    </a>
                </li>
                {{--<li class="list-group-item">
                    <a href="{{ route('UsersGroupsIndex') }}">
                        <i class="fa fa-users"></i>Nhóm thành viên
                    </a>
                </li>--}}
            </ul>
        </div>
    </div>
</div>
