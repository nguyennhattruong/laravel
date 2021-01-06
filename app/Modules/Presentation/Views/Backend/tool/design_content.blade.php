@extends('Backend::layouts.master')
@section('content')
    <style type="text/css">
        .design-view {
            height: 200px;
            overflow: auto;
        }

        .design-view div[class*="col"] {
            border: 1px dashed #ddd
        }

        #display {
            margin: 0 15px;
        }
    </style>
    <div class="header sticky-top">
        <h4><i class="fa fa-trash-o"></i> Design Content</h4>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="mb-2">
                <a class="btn btn-primary mb-2" data-toggle="collapse" href="#collapseExample" role="button"
                   aria-expanded="true" aria-controls="collapseExample">
                    <i class="fa fa-eye" aria-hidden="true"></i> View
                </a>
                <div class="collapse show border p-2" id="collapseExample">
                    <div class="design-view">
                        <div id="display"></div>
                    </div>
                </div>
            </div>
            <textarea name="content"></textarea>
            <script type="text/javascript">
                $(document).ready(function () {
                    var editor = CKEDITOR.replace('content');
                    editor.height = 400;

                    editor.on('change', function () {
                        $('#display').html(CKEDITOR.instances['content'].getData());
                    });
                });
            </script>
        </div>
    </div>
@endsection
