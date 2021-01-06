<div class="card">
    <div class="card-header" role="tab" id="headingThree">
        <h5 class="mb-0">
            <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false"
               aria-controls="collapseThree">
                <i class="fa fa-line-chart"></i>{{ trans('Backend::common.seo_tools') }}
            </a>
        </h5>
    </div>
    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree"
         data-parent="#accordion">
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="{{ url('admin/config/metadata') }}">
                        <i class="fa fa-header"></i>{{ trans('Backend::common.meta_data') }}
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="{{ url('admin/config/embed_script') }}">
                        <i class="fa fa-code" aria-hidden="true"></i>{{ trans('Backend::common.embed_script') }}
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="{{ url('admin/config/embed_css') }}">
                        <i class="fa fa-css3" aria-hidden="true"></i>{{ trans('Backend::common.embed_css') }}
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="{{ url('admin/config/embed_link') }}">
                        <i class="fa fa-link" aria-hidden="true"></i>{{ trans('Backend::common.embed_link') }}
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('DesignContent') }}">
                        <i class="fa fa-paint-brush"></i>{{ trans('Backend::common.design_content') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>