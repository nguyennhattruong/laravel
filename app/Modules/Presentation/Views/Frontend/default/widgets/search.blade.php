@extends(getView('layouts.' . $wid_content['layout']), ['layout' => ['wid' => $wid_content, 'link' => $wid_content['link']]])
@section('wid_content')
    @if($data)
        <input type="text" class="form-control border-light-gray rounded-pill" title=""
               placeholder="Tìm sản phẩm...">
        <div class="input-group-append">
            <button class="btn border-left" type="button" style="margin-left: -40px">
                <i class="fas fa-search"></i>
            </button>
        </div>
    @endif
@overwrite
