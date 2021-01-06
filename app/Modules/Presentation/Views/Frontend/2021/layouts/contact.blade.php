@extends(getView('master.master'))
@section('content')
    <div class="col-md-9">
        <section class="rounded mb-4 container">

        <header>
            <h2 class="title_main">
                LIÊN HỆ
            </h2>
        </header>
        <div class="row">
            <div class="col-md-6 col-lg-6 col-xs-12">
                <div class="text"><h3 style="margin: 0px; padding: 0px; box-sizing: border-box; color: rgb(0, 0, 0); font-family: Arial; font-size: 14px; line-height: 21px; text-align: justify;"><span style="font-size:24px;"><span style="color:#FF0000;"><strong>Shop PT</strong></span></span></h3>

                    <p style="margin: 0px; padding: 0px; box-sizing: border-box; color: rgb(0, 0, 0); font-family: Arial; font-size: 14px; line-height: 21px; text-align: justify;"><span style="font-size:14px;">Địa chỉ: 91/1 Nguyễn Ảnh Thủ, Xã Ba Điểm, Huyện Hóc Môn, TpHcm<br>
                    Điện thoại: &nbsp;093 8187496<br>
                    Email: nguyenthaoly0202@gmail.com<br>
                    Website:&nbsp;</span>shoppt.com</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xs-12">
                <div class="right_lienhe">
                    <form method="post" name="frm" id="frm" action="{{ route('ContactSend') }}" enctype="multipart/form-data" class="form_register_mail">
                        <div class=" tablelienhe" style="width:100%">
                            <div class="box_input_contact has_notify box_not_valid">
                                <i class="fa fa-user fa-contact"></i>
                                <input name="fullname" type="text" class="input input_check_validate" id="ten" size="50" required="" placeholder="Họ và tên">
                            </div><!--box input contact-->

                            <div class="box_input_contact has_notify">
                                <i class="fa fa-map-marker fa-contact"></i>
                                <input name="address" type="text" class="input input_check_validate" size="50" id="diachi" placeholder="Địa chỉ">
                            </div><!--box input contact-->

                            <div class="box_input_contact has_notify">
                                <i class="fa fa-phone fa-contact"></i>
                                <input name="phone" type="text" class="input input_check_validate" id="dienthoai" size="50" placeholder="Điện thoại">
                            </div><!--box input contact-->

                            <div class="box_input_contact has_notify">
                                <i class="fa fa-address-book fa-contact"></i>
                                <input name="email" type="text" class="input input_check_validate" size="50" id="email" placeholder="Email">
                            </div><!--box input contact-->

                            <div class="box_input_contact has_notify">
                                <i class="fa fa-share-alt fa-contact"></i>
                                <input name="title" type="text" class="input input_check_validate" id="tieude" size="50" placeholder="Tiêu đề">
                            </div><!--box input contact-->

                            <div class="box_input_contact">
                                <textarea name="content" cols="50" rows="7" class="input" style="height:150px;" placeholder="Nội dung"></textarea>
                            </div><!--box input contact-->
                            {{--<div class="box_input_contact has_notify">--}}
                                {{--<div class="captcha_box">--}}
                                    {{--<div class="g-recaptcha" data-sitekey="6LdDm3YUAAAAAKjfUmsNIlfG5in1Ec9yMLnjyj44"><div><iframe src="https://www.google.com/recaptcha/api/fallback?k=6LdDm3YUAAAAAKjfUmsNIlfG5in1Ec9yMLnjyj44&amp;hl=vi&amp;v=EQY1At-f1G9OIivZUYX73fK0&amp;t=93724" frameborder="0" scrolling="no" style="width: 302px; height: 422px;"></iframe><div style="margin: -4px 0px 0px; padding: 0px; background: rgb(249, 249, 249); border: 1px solid rgb(193, 193, 193); border-radius: 3px; height: 60px; width: 300px;"><textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: block;"></textarea></div></div></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="box_input_contact">
                                <button type="submit"  class="btn  btn-success ">Gửi </button>
                                <a class="btn  btn-success">Làm lại</a>
                            </div><!--box input contact-->
                        </div><!--end table lien he-->
                    </form>
                </div>
            </div>
        </div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.273746617968!2d106.61295351526063!3d10.866771560489894!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752a10f007d31d%3A0xa6959021d9ab8f9!2zOTEsIDEgTmd1eeG7hW4g4bqibmggVGjhu6csIFRydW5nIE3hu7kgVMOieSwgUXXhuq1uIDEyLCBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1571573173695!5m2!1svi!2s" width="100%" height="350" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </section>
    </div>
        <script type="text/javascript">
        $(document).ready(function (e) {
            $('.form_register_mail').submit(function (e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: $(this).attr('action'),
                    data: {
                        fullname: $(this).find('input[name=fullname]').val(),
                        phone: $(this).find('input[name=phone]').val(),
                        email: $(this).find('input[name=email]').val(),
                        title: $(this).find('input[name=title]').val(),
                        address: $(this).find('input[name=address]').val(),
                        content: $(this).find('textarea[name=content]').val(),
                        // content: $(this).find('textarea[name=content]').val(),
                    },
                    success: function (result) {
                        if (result.result === 1) {
                            swal({
                                title: "Gửi thành công",
                                icon: "success",
                                timer: 1000
                            });
                        }
                    }
                });
            });
        });
        </script>
@endsection
