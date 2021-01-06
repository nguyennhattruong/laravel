<div class="register_mail fixed-bottom">
    <form method="POST" action="{{ route('ContactSend') }}" class="d-none d-md-block form_register_mail">
        <div class="container py-3">
            <div class="row">
                <div class="col-2">
                    <div class="register_mail_header font-size-1d1 mt-2 color-white">ĐĂNG KÝ TƯ VẤN</div>
                </div>
                <div class="col">
                    <input type="text" name="fullname" class="form-control border rounded-0 bg-transparent color-white"
                           placeholder="Họ tên" required>
                </div>
                <div class="col">
                    <input type="text" name="phone" class="form-control border rounded-0 bg-transparent color-white"
                           placeholder="Điện thoại" required>
                </div>
                <div class="col">
                    <input type="email" name="email" class="form-control border rounded-0 bg-transparent color-white"
                           placeholder="Email" required>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-success rounded text-uppercase">Gửi yêu cầu</button>
                </div>
            </div>
        </div>
    </form>
    <div class="d-block d-md-none p-0">
        <div class="row">
            <div class="col p-0">
                <a href="#" class="btn btn-danger text-uppercase rounded-0 w-100 border-right btn-lg"
                   data-toggle="modal"
                   data-target="#exampleModal">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    <small>Đăng ký nhận tư vấn</small>
                </a>
            </div>
            <div class="col p-0">
                <a id="contact-phone" href="tel:0937769696"
                   class="btn btn-danger text-uppercase rounded-0 w-100 btn-lg">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <small>Click gọi ngay</small>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('ContactSend') }}" class="form_register_mail">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Đăng ký nhận tư vấn</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input name="fullname" class="form-control form-control-lg" type="text" placeholder="Họ tên">
                    </div>
                    <div class="form-group">
                        <input name="phone" class="form-control form-control-lg" type="text" placeholder="Điện thoại">
                    </div>
                    <div class="form-group">
                        <input name="email" class="form-control form-control-lg" type="email" placeholder="Email">
                    </div>
                </div>
                <div class="pb-3 text-center">
                    <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-pencil-square-o"
                                                                            aria-hidden="true"></i> Đăng ký ngay
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function (e) {
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
                    content: $(this).find('input[name=content]').val(),
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
