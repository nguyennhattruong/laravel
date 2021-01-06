<div class="card">
    <div class="card-header" role="tab" id="headingProducts">
        <h5 class="mb-0">
            <a class="collapsed" data-toggle="collapse" href="#collapseProducts" aria-expanded="false"
               aria-controls="collapseProducts">
                <i class="fa fa-cube" aria-hidden="true"></i>{{ trans('Backend::common.product') }}
            </a>
        </h5>
    </div>
    <div id="collapseProducts" class="collapse" role="tabpanel" aria-labelledby="headingProducts"
         data-parent="#accordion">
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="{{ route('ProductsIndex') }}">
                        <i class="fa fa-cube" aria-hidden="true"></i>{{ trans('Backend::common.product') }}
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('ProductsCategoriesIndex') }}">
                        <i class="fa fa-folder-open-o"></i>{{ trans('Backend::common.product_categories') }}
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('ProductsIndex') }}">
                        <i class="fa fa-folder-open-o"></i>{{ trans('Backend::common.product_group') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>