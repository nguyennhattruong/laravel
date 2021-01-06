<div class="fix_right d-none d-md-block">
    <div class="dangkynhantin" data-toggle="modal" data-target="#myModal">
        <img src="{{ asset('public/images/nhantin.png')}}" alt="Nhận tin">
    </div>
    <div class="hotline_fix">
        <a href="tel:0938187496"><span>Hotline: 0938187496</span></a>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Đăng ký nhận tin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('ContactSend') }}" class="form_register_mail">
                    <div class="form-group">
                        <input class="form-control" name="fullname" type="text" id="ten_dknhantin" placeholder="Họ và Tên . ">
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="email" type="text" id="email_dknhantin" placeholder="Email . ">
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="phone" type="text" id="dienthoai_dknhantin" placeholder="Số điện thoại . ">
                    </div>
                    <button type="submit" id="button_dknhantin" class="btn btn-primary">Đăng ký</button>
                </form>
            </div> </div>

    </div>
</div>
<div class="fixed-bottom">
    <div class="d-block d-md-none p-0">
        <div class="row">
            <div class="col p-0">
                <a href="#" class="btn btn-danger text-uppercase rounded-0 w-100 border-right btn-lg"
                   data-toggle="modal"
                   data-target="#myModal">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    <small>Đăng ký nhận tin</small>
                </a>
            </div>
            <div class="col p-0">
                <a id="contact-phone" href="tel:0938187496"
                   class="btn btn-danger text-uppercase rounded-0 w-100 btn-lg">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <small>Click gọi ngay</small>
                </a>
            </div>
        </div>
    </div>
</div>
{{--<div class="fixed-bottom">--}}
    {{--<div class="d-block d-md-none p-0">--}}
        {{--<div class="row">--}}
            {{--<div class="col p-0">--}}
                {{--<a href="#" class="btn btn-danger text-uppercase rounded-0 w-100 border-right btn-lg"--}}
                   {{--data-toggle="modal"--}}
                   {{--data-target="#exampleModal">--}}
                    {{--<i class="fa fa-pencil-square-o" aria-hidden="true"></i>--}}
                    {{--<small>Đăng ký nhận tư vấn</small>--}}
                {{--</a>--}}
            {{--</div>--}}
            {{--<div class="col p-0">--}}
                {{--<a id="contact-phone" href="tel:{{ $data['phone'] }}"--}}
                   {{--class="btn btn-danger text-uppercase rounded-0 w-100 btn-lg">--}}
                    {{--<i class="fa fa-phone" aria-hidden="true"></i>--}}
                    {{--<small>Click gọi ngay</small>--}}
                {{--</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

<script type="text/javascript">
    $(document).ready(function (e) {
        $('.register_mail_header').click(function (e) {
            $('.register_mail_body').slideToggle();
        });

        $('.form_register_mail').submit(function (e) {
            $('.modal').modal('hide');
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: {
                    fullname: $(this).find('input[name=fullname]').val(),
                    phone: $(this).find('input[name=phone]').val(),
                    email: $(this).find('input[name=email]').val(),
                    // content: $(this).find('textarea[name=content]').val(),
                },
                success: function (result) {
                    if (result.result === 1) {
                        swal({
                            title: "Đăng ký thành công",
                            icon: "success",
                            timer: 1000
                        });
                    }
                }
            });
        });
    });
</script>
