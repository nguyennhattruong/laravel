<div class="card">
    <div class="card-header" role="tab" id="headingProducts">
        <h5 class="mb-0">
            <a class="collapsed" data-toggle="collapse" href="#collapseProducts" aria-expanded="false"
               aria-controls="collapseProducts">
                <i class="fa fa-cube" aria-hidden="true"></i>Bất động sản
            </a>
        </h5>
    </div>
    <div id="collapseProducts" class="collapse" role="tabpanel" aria-labelledby="headingProducts"
         data-parent="#accordion">
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="{{ route('ApartmentIndex') }}">
                        <i class="fa fa-cube" aria-hidden="true"></i>Căn hộ
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('ApartmentLocationsIndex') }}">
                        <i class="fa fa-folder-open-o"></i>Dự án
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>