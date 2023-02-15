<script src="{{ asset('js/jquery.datetimepicker.full.min.js') }}"></script>

<script>
    let ajaxGoing = false;

    function show_image_preview() {
        var target = $( $(this).attr("data-target") );

        if( target.length ) {
            
            if( this.files.length ) {
                var file = this.files[0];
                target.prop('src', URL.createObjectURL(file));
                target.show();
            } else {
                target.hide();
            }
        }
    }

    function _map_errors(errors) {
        if( errors.errors ) {
            errors = errors.errors;
        }

        var error_box = $(".error_box");

        $.each(errors, function(key, val) {
            const input = $("input[name='" + key + "']");

            if (input.length) {
                const v = val[0] === 'validation.mime_types' ? val[1] : val[0];

                const invalid_feedback = input.next();

                if (invalid_feedback && invalid_feedback.hasClass('invalid-feedback')) {
                    invalid_feedback.text(v);
                } else {
                    input.after(
                        "<div class='invalid-feedback'>" + v + "</div>"
                    );
                }

                input.addClass('is-invalid');

                if( error_box.length ) {
                    error_box.append('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+v+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                }
            }
        });
    }

    function _process(form, process = true) {
        ajaxGoing = process;

        form = $(form);

        if (process) {
            form.css({
                "pointer-events": "none",
                "opacity": 0.7
            });

            form.find("input[type='submit'],button[type='submit']")
                .val("Submitting...")
                .addClass("disabled");

            form.find(".invalid-feedback").remove();
        } else {
            form.css({
                "pointer-events": "auto",
                "opacity": 1
            });

            form.find("input[type='submit'],button[type='submit']")
                .val("Submit")
                .removeClass("disabled");
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        var $ = $ || jQuery;

        $(".show_image_preview").change(show_image_preview);

        $.datetimepicker.setLocale('en');

        $('.datetimepicker').datetimepicker({
            dateFormat: "yy-mm-dd HH:ii:ss"
        });
        $('.onlydatepicker').datetimepicker({
            timepicker: false,
            format: "Y/m/d"
        });

        const errors = @json($errors->getMessages());
        _map_errors(errors);

        function _form_required_check(form) {
            var form_error = false;

            // one of them is required
            var required_fields = $(form).attr("data-required_fields");

            if( required_fields ) {
                required_fields = JSON.parse(required_fields);

                $.each(required_fields, function(key, value) {
                    var inputs = $(".input-"+value);

                    if( inputs && inputs.length ) {
                        var all_good = false;

                        $.each(inputs, function() {
                            if( $(this).val() !== '' ) {
                                all_good = true;
                            }
                        });

                        if( !all_good ) {
                            inputs.addClass("is-invalid");
                            form_error = true;
                            alert((value ? value.toUpperCase() : '') + ' required for field of at least one language');
                        }
                    }
                });
            }

            return form_error;
        }

        $("form.submit-via-ajax")
            .submit(function(e) {
                e.preventDefault();

                if( _form_required_check(this) ) {
                    return;
                }
                
                if (ajaxGoing) return;

                const form = this;

                form.classList.add('was-validated');

                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();

                    form.reportValidity();

                    return;
                }

                const self = $(form);

                const formData = new FormData(form);

                $.ajax({
                    url: self.attr('action'),
                    type: 'POST',
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        _process(form);
                    },
                    success: function(data) {
                        if (data) {
                            if( data.error ) {
                                alert(data.error);
                                return;
                            } else if( data.redirect ) {
                                window.location = data.redirect;
                                return;
                            }
                        }

                        alert('Something is not right. Please refresh your page. Sorry for the inconvenience.');
                    },
                    error: function(data) {
                        const responseJSON = data.responseJSON;

                        alert("Error(s) occurred while submitting. Please check for errors on inputs or at the bottom and try again.");

                        _map_errors(responseJSON);
                    },
                    complete: function() {
                        _process(form, false);
                    }
                });
            });

        $(".btn-cancel").click(function(e) {
            if( ! confirm('Are you sure you want to cancel? Any changes made will not be saved.') ) {
                e.preventDefault();
                return false;
            }
        });

        $(".has-toggle-switch").on("change", ".toggle-switch-button", function() {
            $(this).parents("form").first().submit();
        });

        $(".has-toggle-switch").on("submit", ".toggle-switch-form", function(e) {
            const self = $(this);
            const method = self.attr("method");
            const url = self.attr("action");
            if( method && url ) {
                e.preventDefault();
                $.ajax({
                    url: url,
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    type: method,
                    success: function(data){
                        if( self.hasClass("reload") ) {
                            window.location.reload();
                        } else {
                            Swal.fire({icon:"success",title:"{{__('Status Updated')}}",toast:!0,position:"top",showConfirmButton:!1,timer:5e3,timerProgressBar:!0});
                        }

                    }
                });
            }
        });


        // file validation for size and resolution
        $(".file-check-size-res")
            .change(function() {
                // console.log('shivmaa')
                var _URL = window.URL || window.webkitURL;

                var self = $(this);
                console.log(self)

                var max_size = 500000;

                var min_width = parseInt(self.attr("data-min_width"));
                var min_height = parseInt(self.attr("data-min_height"));
                var target_cls = $(self.attr("data-wrap_target"));

                if (this.files && this.files.length) {
                    var file = this.files[0];
                    // alert(file.size)
                    if( file.size > max_size ) {
                        alert("File size too large. Provided: "+(parseInt(file.size/1024))+"kb. Required: 500kb maxmimum. Please try with a smaller file size.");
                        self.val("");
                        $('#preview-image').hide();
                        return;
                    }

                    var img = new Image();

                    $(img).on("load", function() {
                        // alert(this.width);
                        if (this.width < min_width) {
                            alert("Invalid image width! Minimum Required: " + min_width +
                                "px. Provided: " + this.width + "px");
                            self.val("");
                            $('#preview-image').hide();
                        } else if (this.height < min_height) {
                            alert("Invalid image height! Minimum Required: " + min_height +
                                "px. Provided: " + this.height + "px");
                            self.val("");
                            $('#preview-image').hide();
                        }
                        // place the thumbnail image
                        else if (target_cls && target_cls.length) {
                            target_cls.css({
                                "background-image": "url(" + objectUrl + ")"
                            });
                        }
                    });

                    img.src = _URL.createObjectURL(file);
                }
            });

        $(".drce-998iup98777").on("contextmenu", function() { return false; });
    });
</script>
