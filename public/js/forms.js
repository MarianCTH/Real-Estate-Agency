(function ($) {

    "use strict";

    var $document = $(document),
        $window = $(window),
        forms = {
            contactForm: $('#contactform'),
            appointmentForm: $('#appointment-form')
        };

    $document.ready(function () {

        // appointment form
        if (forms.appointmentForm.length) {
            var $appointmentForm = forms.appointmentForm;
            $appointmentForm.validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2
                    },
                    message: {
                        required: true,
                        minlength: 20
                    },
                    email: {
                        required: true,
                        email: true
                    }

                },
                messages: {
                    name: {
                        required: "Vă rugăm introduceți numele",
                        minlength: "Your name must consist of at least 2 characters"
                    },
                    message: {
                        required: "Introduceți un mesaj",
                        minlength: "Your message must consist of at least 20 characters"
                    },
                    email: {
                        required: "Please enter your email"
                    }
                },
                submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        type: "POST",
                        data: $(form).serialize(),
                        url: "form/process-appointment.php",
                        success: function () {
                            $('#successAppointment').fadeIn();
                            $('#appointment-form').each(function () {
                                this.reset();
                            });
                        },
                        error: function () {
                            $('#appointment-form').fadeTo("slow", 0, function () {
                                $('#errorAppointment').fadeIn();
                            });
                        }
                    });
                }
            });
        }

        // contact page form
        if (forms.contactForm.length) {
            var $contactform = forms.contactForm;
            $contactform.validate({
                rules: {
                    firstname: {
                        required: true,
                        minlength: 2
                    },
                    lastname: {
                        required: true,
                        minlength: 2
                    },
                    message: {
                        required: true,
                        minlength: 20
                    },
                    email: {
                        required: true,
                        email: true
                    }

                },
                messages: {
                    firstname: {
                        required: "Vă rugăm să introduceți prenumele",
                        minlength: "Prenumele trebuie să conțină cel puțin 2 caractere"
                    },
                    lastname: {
                        required: "Vă rugăm să introduceți numele de familie",
                        minlength: "Numele de familie trebuie să conțină cel puțin 2 caractere"
                    },
                    message: {
                        required: "Vă rugăm să introduceți mesajul",
                        minlength: "Mesajul trebuie să conțină cel puțin 20 de caractere"
                    },
                    email: {
                        required: "Vă rugăm să introduceți adresa de email"
                    }
                },
                submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        type: "POST",
                        data: $(form).serialize(),
                        url: "form/process-contact.php",
                        success: function () {
                            $('#success').fadeIn();
                            $('#contactform').each(function () {
                                this.reset();
                            });
                        },
                        error: function () {
                            $('#contactform').fadeTo("slow", 0, function () {
                                $('#error').fadeIn();
                            });
                        }
                    });
                }
            });
        }

    });

})(jQuery);
