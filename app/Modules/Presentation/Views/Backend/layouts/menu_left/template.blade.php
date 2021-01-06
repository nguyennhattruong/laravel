<div class="card">
    <div class="card-header" role="tab" id="headingFour">
        <h5 class="mb-0">
            <a class="collapsed" data-toggle="collapse" href="#collapseFour" aria-expanded="false"
               aria-controls="collapseFour">
                <i class="fa fa-newspaper-o"></i>{{ trans('Backend::common.template') }}
            </a>
        </h5>
    </div>
    <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordion">
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="{{ route('WidgetsIndex') }}">
                        <i class="fa fa-list-alt"></i>{{ trans('Backend::common.widget') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>