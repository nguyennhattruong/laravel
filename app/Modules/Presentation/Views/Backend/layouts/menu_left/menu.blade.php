<div class="card">
    <div class="card-header" role="tab" id="headingMenu">
        <h5 class="mb-0">
            <a class="collapsed" data-toggle="collapse" href="#collapseMenu" aria-expanded="false"
               aria-controls="collapseMenu">
                <i class="fa fa-bars"></i>{{ trans('Backend::common.menu') }}
            </a>
        </h5>
    </div>
    <div id="collapseMenu" class="collapse" role="tabpanel" aria-labelledby="headingMenu"
         data-parent="#accordion">
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="{{ route('MenuIndex') }}">
                        <i class="fa fa-list-ul"></i>{{ trans('Backend::common.menu') }}
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('MenuTypesIndex') }}">
                        <i class="fa fa-cube"></i>{{ trans('Backend::common.menu_group') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>