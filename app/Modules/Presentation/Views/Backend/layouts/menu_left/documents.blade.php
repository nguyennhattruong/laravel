<div class="card-header" role="tab">
    <h5 class="mb-0">
        <a href="{{ route('DocumentsIndex') }}">
            <i class="fa fa-files-o"></i> Văn bản
        </a>
    </h5>
</div>
@can('show_menu_doc_type')
    <div class="card-header" role="tab">
        <h5 class="mb-0">
            <a href="{{ route('DocumentsTypesIndex') }}">
                <i class="fa fa-folder-open-o"></i> Loại Văn bản
            </a>
        </h5>
    </div>
@endcan
@can('show_menu_doc_departments')
    <div class="card-header" role="tab">
        <h5 class="mb-0">
            <a href="{{ route('DocumentsDepartmentsIndex') }}">
                <i class="fa fa-users"></i> Phòng ban
            </a>
        </h5>
    </div>
@endcan