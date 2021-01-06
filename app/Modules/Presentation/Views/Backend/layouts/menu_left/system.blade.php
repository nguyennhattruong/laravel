<div class="card">
    <div class="card-header" role="tab" id="headingSystem">
        <h5 class="mb-0">
            <a data-toggle="collapse" href="#collapseSystem" aria-controls="collapseSystem">
                <i class="fa fa-cogs"></i>{{ trans('Backend::common.system') }}
            </a>
        </h5>
    </div>
    <div id="collapseSystem" class="collapse" role="tabpanel" aria-labelledby="headingSystem"
         data-parent="#accordion">
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="{{ url('admin/config/general') }}"><i
                            class="fa fa-globe"></i>{{ trans('Backend::common.site_settings') }}</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ url('admin/config/mail') }}"><i
                            class="fa fa-envelope-o"></i>{{ trans('Backend::common.mail_settings') }}</a>
                </li>
                <li class="list-group-item"><a href="{{ url('admin/tool/clean_system') }}"><i
                            class="fa fa-trash-o"></i>{{ trans('Backend::common.clean_system') }}</a></li>
            </ul>
        </div>
    </div>
</div>