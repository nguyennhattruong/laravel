(function ($) {
    $.fn.UploadImage = function (settings) {
        // Default global variables
        var defaults = {
            id: '#' + $(this).attr('id'),
            input_name: 'image',
            url_upload: '',
            url_delete: '',
            folder_tmp: '',
            folder_upload: '',
            folder_upload_thumb: '',
            image: '',
            is_multiple: false
        };

        // Merge default global variables with custom variables
        var options = $.extend(defaults, settings);

        // Create for each element
        this.each(function (i) {
            var arrImg = [];
            var opt = options;
            var text_multiple = '';
            if (opt.is_multiple) {
                text_multiple = 'multiple';
            }

            var input_choose = opt.input_name + '_input';
            var input_hidden = '<input type="hidden" name="' + opt.input_name + '" ' +
                'id="' + opt.input_name + '" ' +
                'value="' + options.image + '">';

            var hid = '';
            if (options.image !== '') {
                if (!options.is_multiple) {
                    hid = 'display:none';
                }
            }

            var input = '<div id="upload-image" class="upload-image mb-3" style="' + hid + '">' +
                '<input name="' + input_choose + '" ' +
                'id="' + input_choose + '" ' +
                'type="file"' + text_multiple + '>' +
                '</div>';

            var btn_remove = '<span style="position:absolute; bottom:5px; right:20px" class="btn btn-danger btn-sm mt-2">' +
                '<i class="fa fa-trash-o" aria-hidden="true"></i> Xóa' +
                '</span>';

            // Add image input
            $(this).append(input_hidden);
            $(this).append(input);
            $(this).append('<div id="row-sortable" class="row"></div>');

            if (opt.is_multiple) {
                $('#row-sortable').sortable({
                    stop: function (event, ui) {
                        reloadValue($(this));
                    }
                });
                $('#row-sortable').disableSelection();
            }

            // Add button remove
            if (options.image !== '') {
                if (options.is_multiple) {
                    var imgs = options.image.split(',');
                    $.each(imgs, function (index, value) {
                        var img = '<img width="100%" ' +
                            ' src="' + site_path + '/' + options.folder_upload_thumb + '/' + value + '"' +
                            ' data-src="' + value + '"' +
                            ' data-edit="true">';
                        $(options.id + ' .row').append('<div class="col-md-4 mb-2 ui-state-default">' + img + btn_remove + '</div>');
                    });
                } else {
                    var img = '<img width="100%" ' +
                        ' src="' + site_path + '/' + options.folder_upload_thumb + '/' + options.image + '"' +
                        ' data-src="' + options.image + '">';
                    $(options.id + ' .row').append('<div class="col-12">' + img + btn_remove + '</div>');
                }
            }

            // Event choose image
            $(this).on('change', '#' + input_choose, function (e) {
                if ($(this).val() !== '') {
                    loadFile();
                }
            });

            // Event remove image
            $(this).on('click', 'span', function () {
                swal({
                    text: "Are you sure you want to do this?",
                    icon: "error",
                    buttons: {
                        cancel: true,
                        confirm: true,
                    },
                }).then((value) => {
                    if (!value) {
                        return;
                    }

                    var element = $(this).parent().find('img').data('src');
                    var is_edit = $(this).parent().find('img').data('edit');
                    var i = arrImg.indexOf(element);

                    if (is_edit === true) {
                        // Delete Image
                        $.ajax({
                            type: "DELETE",
                            url: options.url_delete + '/' + element,
                            success: function (result) {
                                if (result === 1) {
                                    swal({
                                        title: "Successfully",
                                        icon: "success",
                                        timer: 1000
                                    });
                                }
                            }
                        });
                    }

                    if (i !== -1) {
                        arrImg.splice(i, 1);
                    }

                    // Remove
                    $(this).parent().remove();

                    $('#upload-image').show();

                    reloadValue();
                });
            });

            function loadFile() {
                // Retrieve the FileList object from the referenced element ID
                var myFileList = document.getElementById(input_choose).files;

                var count = myFileList.length;
                for (i = 0; i < count; i++) {
                    // Let's upload the complete file object
                    uploadFile(myFileList[i]);
                }
            }

            function uploadFile(file) {
                var formData = new FormData();

                // Append file to the formData
                // Notice the first argument "file" and keep it in mind
                formData.append("file", file);

                // Create XMLHttpRequest Object
                var xhr = new XMLHttpRequest();

                xhr.upload.addEventListener("progress", uploadProgress, false);
                xhr.addEventListener("load", uploadComplete, false);
                xhr.addEventListener("error", uploadFailed, false);
                xhr.addEventListener("abort", uploadCanceled, false);

                // Open connection using the POST method
                xhr.open("POST", opt.url_upload);

                // Send the file
                xhr.send(formData);
            }

            function uploadProgress(evt) {
                if (evt.lengthComputable) {
                    // var percentComplete = Math.round(evt.loaded * 100 / evt.total);
                    //$(config.id + ' #' + config.alias + '-progress' + iImageTemp).css('width', percentComplete + '%');
                }
                //else
                //document.getElementById('progressNumber').innerHTML = 'unable to compute';
            }

            function uploadComplete(evt) {
                var result = $.parseJSON(evt.target.responseText);

                if (result.result === 0) {
                    alert('Đã có lỗi xảy ra với hình ảnh của bạn.');
                } else {
                    addImage(result.image);
                    arrImg.push(result.image);
                }

                if (!options.is_multiple) {
                    $('#upload-image').hide();
                }

                reloadValue();
            }

            function uploadFailed(evt) {
                alert("Có lỗi attempt trong quá trình upload file.");
            }

            function uploadCanceled(evt) {
                alert("Quá trình upload sẽ bị gián đoạn.");
            }

            function addImage(image) {
                $('#' + options.input_name).val(image);
                var img = '<img width="100%" ' +
                    ' class="display-none" ' +
                    ' src="' + site_path + '/' + options.folder_tmp + '/' + image + '"' +
                    ' data-src="' + image + '">';
                if (options.is_multiple) {
                    $(options.id + ' .row').append('<div class="col-md-4 mb-2 ui-state-default">' + img + btn_remove + '</div>');
                    $(options.id + ' img').fadeIn('normal');
                } else {
                    $(options.id + ' .row').append('<div class="col-12">' + img + btn_remove + '</div>');
                    $(options.id + ' img').fadeIn('normal');
                }
            }

            function reloadValue() {
                arrImg = [];
                $('#row-sortable').find('img').each(function (index) {
                    arrImg.push($(this).data('src'));
                });

                $('#' + options.input_name).val(arrImg);
                if (!options.is_multiple) {
                    $('#' + input_choose).val('');
                }
            }
        });
    };
})(jQuery);
