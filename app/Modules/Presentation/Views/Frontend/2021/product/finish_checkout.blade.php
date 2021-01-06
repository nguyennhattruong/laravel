@extends(getView('master.master'))
@section('content')
    <div class="col-md-12 col-lg-9 mb-5">
        <h2 class="title_main">
            Thanh toán
        </h2>
        <div class="bg-white rounded p-4">
            <table style="width:100%;color:#333;border:1px solid #e9e9e9;">
                <thead>
                <tr style="background-color: #fff;">
                    <th style="text-align:center;padding:5px;white-space:nowrap;font-size: 13px;border:1px solid #e9e9e9;">Hình ảnh</th>
                    <th style="text-align:center;padding:5px;white-space:nowrap;font-size: 13px;border:1px solid #e9e9e9;">Tên</th>
                    <th style="text-align:center;padding:5px;white-space:nowrap;font-size: 13px;border:1px solid #e9e9e9;">Số lượng</th>
                    <th style="text-align:center;padding:5px;white-space:nowrap;font-size: 13px;border:1px solid #e9e9e9;">Tổng</th>
                </tr>
                </thead><!--head-->
                <tfoot>
                <tr style="border:1px solid #e9e9e9;">
                    <td colspan="5" style="text-align:right;padding:10px 5px;font-weight: bold;color:#E53C2F;font-size: 17px;"><b>Tổng giá : <span class="price_all_cart">{{number_format($priceTotal)}} đ</span></b></td>
                </tr>
                </tfoot><!--footer-->
                <tbody>
                @foreach($data as $item)
                <tr style="border-bottom:1px solid #ecedef;">
                    <td style="text-align:center;padding:5px 5px;border:1px solid #e9e9e9;">
                        <img src="{{ getThumbImage($item['images'][0], 'define.folder.products_thumb') }}" width="60" alt=" SHOP THUỐC SINH LÝ PT ">
                    </td>
                    <td style="text-align:left;padding:5px 5px;border:1px solid #e9e9e9;">
                        <h3 class="name_p_cart" style="font-size:14px;font-weight:bold;">{{ $item->title }}</h3>
                        <div class="price_p_cart_name" style="font-size:15px;color:#f00;">{{ number_format($item->price) }} đ</div>
                    </td>
                    <td style="text-align:center;padding:5px 5px;border:1px solid #e9e9e9;">
                        <div class="box_number_cart">
                           {{ $item->quantity_cart}}
                        </div><!--box number cart-->
                    </td>
                    <td style="text-align:center;padding:5px 5px;border:1px solid #e9e9e9;"><div class="price_p_cart" style="text-align: center; font-size: 16px; color: #43484D;">{{ number_format($item->price * $item->quantity_cart)}} đ</div></td>
                </tr>
                @endforeach
                </tbody><!--body-->
            </table>
        </div>

        <div class="bg-white rounded p-4">
            <form method="post" name="frm_order" action="{{route('ContactSend')}}" enctype="multipart/form-data" id="frm_order">
                <div class=" tablelienhe" style="width:100%">
                    <div class="l50">
                        <div class="box_input_contact has_notify">
                            <i class="fa fa-user fa-contact"></i>
                            <input name="fullname" type="text" class="input input_check_validate" id="ten_thanhtoan" size="50" required="" placeholder="Họ và tên">
                        </div><!--box input contact-->

                        <div class="box_input_contact has_notify">
                            <i class="fa fa-map-marker fa-contact"></i>
                            <input name="address" type="text" class="input input_check_validate" size="50" id="diachi_thanhtoan" required="" placeholder="Địa chỉ">
                        </div><!--box input contact-->
                    </div><!--end l50-->
                    <div class="r50">
                        <div class="box_input_contact has_notify">
                            <i class="fa fa-phone fa-contact"></i>
                            <input name="phone" type="text" class="input input_check_validate" id="dienthoai_thanhtoan" required="" size="50" placeholder="Điện thoại">
                        </div><!--box input contact-->

                        <div class="box_input_contact has_notify">
                            <i class="fa fa-envelope-o fa-contact"></i>
                            <input name="email" type="email" class="input input_check_validate" id="email_thanhtoan" required="" size="50" placeholder="_email">
                        </div><!--box input contact-->
                    </div><!--r50-->
                    <div class="clear"></div>
                    <div class="box_input_contact">
                        <textarea name="content" cols="50" rows="7" class="input" style="height:150px;" placeholder="Nội dung"></textarea>
                    </div><!--box input contact-->
                    <div class="box_input_contact">
                        <button type="submit" class="btn btn-danger btn-lg">Thanh Toán</button>
                    </div><!--box input contact-->
                </div><!--end table lien he-->
                <input type="hidden" name="is_checkout" value="1">
            </form>

        </div>

    </div>

    <script type="text/javascript">
        $(document).ready(function (e) {
            $('#frm_order').submit(function (e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: $(this).attr('action'),
                    data: {
                        fullname: $(this).find('input[name=fullname]').val(),
                        phone: $(this).find('input[name=phone]').val(),
                        email: $(this).find('input[name=email]').val(),
                        title: 'Đơn hàng mới',
                        address: $(this).find('input[name=address]').val(),
                        is_checkout: $(this).find('input[name=is_checkout]').val(),
                        content: $(this).find('textarea[name=content]').val(),

                        // content: $(this).find('textarea[name=content]').val(),
                    },
                    beforeSend: function(){
                        $("#loading").show();
                    },
                    complete: function(){
                        $("#loading").hide();
                    },
                    success: function (result) {
                        if (result.result === 1) {
                            swal({
                                title: "Thành công!",
                                text: "Bạn đã mua thành công chúng tôi sẽ liên hệ sớm với bạn!",
                                icon: "success",
                                button: 'OK'
                            }).then(() => {
                                location.href = APP_URL;
                            });
                        }
                    }
                });
            });
        });
    </script>

@endsection

