<div class="card">
    <div class="card-header" role="tab" id="headingFive">
        <h5 class="mb-0">
            <a class="collapsed" data-toggle="collapse" href="#collapseFive" aria-expanded="false"
               aria-controls="collapseFive">
                <i class="fa fa-file-text-o"></i>{{ trans('Backend::common.content') }}
            </a>
        </h5>
    </div>
    <div id="collapseFive" class="collapse" role="tabpanel" aria-labelledby="headingFive" data-parent="#accordion">
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item"><a href="{{ route('ContentIndex') }}"><i
                                class="fa fa-file-text-o"></i>{{ trans('Backend::common.article') }}</a>
                </li>
                <li class="list-group-item"><a href="{{ route('CategoriesIndex') }}"><i
                                class="fa fa-folder-open-o"></i>{{ trans('Backend::common.categories') }}</a>
                </li>
            </ul>
        </div>
    </div>
</div>