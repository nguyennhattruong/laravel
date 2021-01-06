@extends(getView('master.master'))
@section('content')

{{--            <div class="col-12">--}}
{{--                <h2 class="font-size-1d3"><span class="text-uppercase">Giỏ hàng</span>--}}
{{--                    <small>({{ count(session('cart')) }} sản phẩm)</small>--}}
{{--                </h2>--}}
{{--            </div>--}}

            <div class="col-md-12 col-lg-9 mb-5">
                <h2 class="title_main">
                    Giỏ hàng
                </h2>
                <div class="bg-white rounded p-4">
                    <form method="post">
                        @foreach($data as $item)
                            <div class="clearfix mt-3 pb-3 border-bottom">
                                <a href="{{ route('FrontendProduct', $item->alias) }}">
                                    <img class="float-left img-fluid img-thumbnail rounded" width="120" height="80"
                                         src="{{ getThumbImage($item['images'][0], 'define.folder.products_thumb') }}">
                                </a>
                                <div style="margin-left: 150px">
                                    <a href="{{ route('FrontendProduct', $item->alias) }}"
                                       class="color-black">{{ $item->title }}</a>
                                    <div class="font-size-1d2 mt-2">
                                        <span class="float-right">
                                            @if($item->price_contact)
                                                {{ "Liên hệ" }}
                                            @else
                                                {{ number_format($item->price * $item->quantity_cart) }} đ
                                            @endif
                                        </span>
                                        <div class="float-left form-inline">
                                            <input name="product_id[{{ $item->id }}]" style="width: 80px"
                                                   class="form-control form-control-sm"
                                                   max="100"
                                                   min="1"
                                                   type="number" value="{{ $item->quantity_cart }}"
                                                   title="">
                                            <a href="#"
                                               class="btn btn-danger btn-sm float-right ml-2"
                                               data-coco="ajax"
                                               data-url="{{ route('ApiProductDeleteCartById', $item->id) }}"> <i
                                                        class="far fa-trash-alt"></i>
                                                Xóa</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if($data)
                            <div class="text-right mt-4">
                                <button class="btn btn-success text-uppercase"><i class="fas fa-sync-alt"></i> Cập nhật
                                    mới
                                </button>
                            </div>
                        @endif
                    </form>
                </div>
            <div class="bg-white rounded p-4 mb-2">
                <span>Thành tiền:</span> <span class="font-size-1d3 color-red float-right">{{ number_format($priceTotal) }}
                đ</span>
            </div>
                <div class="text-right mt-4">
                    <a href="{{url('thanh-toan')}}" class="btn btn-danger btn-lg" >Tiến hành đặt hàng</a>
                </div>
            </div>
@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            $("[data-coco=ajax]").click(function (e) {
                var url = $(this).data('url');
                swal({
                    text: "Bạn thực sự muốn thực hiện chức năng này?",
                    icon: "warning",
                    buttons: {
                        cancel: true,
                        confirm: true,
                    },
                }).then((value) => {
                    if (value) {
                        $.ajax({
                            type: "DELETE",
                            url: url,
                            success: function (data) {
                                if (data === '1') {
                                    location.reload();
                                } else {
                                }
                            },
                            error: function (data) {
                                console.log('Error:', data);
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
