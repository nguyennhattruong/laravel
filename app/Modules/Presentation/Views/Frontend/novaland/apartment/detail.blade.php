@extends(getView('master.master'))
@section('content')
    <section class="bg-white">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb row mb-0 border-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('') }}">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item">
                        {{ $data->type->name }}
                    </li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="pb-4">
        <div id="images">
            @foreach($data->images as $image)
                <div>
                    <img width="100%" height="300" src="{{ getThumbImage($image, 'define.folder.apartment') }}">
                </div>
            @endforeach
        </div>
    </section>
    <section class="container py-2">
        <div class="row">
            @if(!empty($data))
                <div class="col-md-9 mb-4">
                    <div class="card border-0">
                        <div class="card-body mx-4">
                            <article class="article">
                                <header>
                                    <h1 class="font-play">{{ $data->name }}</h1>
                                    <div class="font-size-2 color-light-green font-weight-bold mb-4">
                                        {{ number_format($data->price, 0, '.', '.') }}<u>đ</u>
                                        @if($data->type_id == 2)
                                            / tháng
                                        @endif
                                    </div>
                                    <div class="mb-4">
                                        <span class="d-inline-block border border-dashed py-2 px-4 mr-2">{{ $data->bedroom }}
                                            Phòng ngủ</span>
                                        <span class="d-inline-block border border-dashed py-2 px-4">{{ $data->bathroom }}
                                            Phòng tắm</span>
                                    </div>
                                </header>
                                <div class="article-intro mb-4">
                                    <blockquote class="blockquote">
                                        <p class="mb-0">
                                            <i class="fa fa-quote-left"></i> {{ $data->description }}
                                            <i class="fa fa-quote-right"></i></p>
                                    </blockquote>
                                </div>
                                <div class="article-body mb-4">{!! $data->content !!}</div>
                                <footer>
                                    <fieldset>
                                        <legend class="color-blue font-weight-bold">Chi tiết căn hộ:</legend>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <table class="table table-striped table-bordered">
                                                    <tr>
                                                        <td>Mã căn hộ:</td>
                                                        <td>{{ $data->code }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Diện tích căn hộ:</td>
                                                        <td>{{ $data->land_size }} m2</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Phòng ngủ:</td>
                                                        <td>{{ $data->bedroom }} m2</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Phòng tắm:</td>
                                                        <td>{{ $data->bathroom }} m2</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table class="table table-striped table-bordered">
                                                    <tr>
                                                        <td>Loại căn hộ</td>
                                                        <td>{{ $data->type->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tình trạng</td>
                                                        <td>
                                                            @if(isset(\App\Modules\Domain\Models\Apartment::STATE[$data->state]))
                                                                {{ \App\Modules\Domain\Models\Apartment::STATE[$data->state] }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="mt-4">
                                        <legend class="color-blue font-weight-bold">Tiện ích:</legend>
                                        <ul class="list-inline row">
                                            @foreach($featuresAll as $item)
                                                <li class="mb-3 color-black list-inline-item col-md-3 col-5">
                                                    @if(in_array($item, $features))
                                                        <i class="fas fa-check-square color-indigo mr-2"></i>
                                                    @else
                                                        <i class="far fa-check-square color-gray mr-2"></i>
                                                    @endif
                                                    {{ $item }}</li>
                                            @endforeach
                                        </ul>
                                    </fieldset>
                                </footer>
                            </article>
                            @include(getView('layouts.social'))
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    @include(getView('master.widget_area'), ['position' => 'apartment_detail'])
                </div>
            @endif
        </div>
    </section>
@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#images').slick({
                dots: true,
                centerMode: true,
                centerPadding: '60px',
                slidesToShow: 3,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            centerPadding: '40px',
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            centerPadding: '40px',
                            slidesToShow: 1
                        }
                    }
                ]
            });
        });
    </script>
@endsection
