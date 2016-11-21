var FormWizard = function () {

	"use strict";

    var wizardContent = $('#wizard');

    var wizardForm = $('#form');

    var numberOfSteps = $('.swMain > ul > li').length;

    var initWizard = function () {

        // function to initiate Wizard Form

        wizardContent.smartWizard({

            selected: 0,

            keyNavigation: false,

            onLeaveStep: leaveAStepCallback,

            onShowStep: onShowStep,

        });

        var numberOfSteps = 0;

        

    };



    var validateCheckRadio = function (val) {

        $("input[type='radio'], input[type='checkbox']").on('ifChecked', function(event) {

            $(this).parent().closest(".has-error").removeClass("has-error").addClass("has-success").find(".help-block").hide().end().find('.symbol').addClass('ok');

        });

    }; 

    

     var runValidator1 = function () {

        var form1 = $('#form');

        var errorHandler1 = $('.errorHandler', form1);

        var successHandler1 = $('.successHandler', form1);

        $.validator.addMethod("FullDate", function () {

            //if all values are selected

            if ($("#dd").val() != "" && $("#mm").val() != "" && $("#yyyy").val() != "") {

                return true;

            } else {

                return false;

            }

        }, 'Please select a day, month, and year');

        $('#form').validate({

            errorElement: "span", // contain the error msg in a span tag

            errorClass: 'help-block',

            errorPlacement: function (error, element) { // render error placement for each input type

                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container

                    error.insertAfter($(element).closest('.form-group').children('div').children().last());

                } else if (element.attr("name") == "dd" || element.attr("name") == "mm" || element.attr("name") == "yyyy") {

                    error.insertAfter($(element).closest('.form-group').children('div'));

                } else {

                    error.insertAfter(element);

                    // for other inputs, just perform default behavior

                }

            },

            ignore: "",

            rules: {

                firstname: {

                    minlength: 2,

                    required: true

                },

                lastname: {

                    minlength: 2,

                    required: true

                },

                email: {

                    required: true,

                    email: true

                },

                password: {

                    minlength: 6,

                    required: true

                },

                password_again: {

                    required: true,

                    minlength: 5,

                    equalTo: "#password"

                },

                yyyy: "FullDate",

                gender: {

                    required: true

                },

                zipcode: {

                    required: true,

                    number: true,

                    minlength: 5

                },

                city: {

                    required: true

                },

                 nomeApelido: {

                    minlength: 2,

                    required: true

                },

                escolaridade: {

                    required: true                    

                },

                dataNascimento: {

                    minlength: 2,

                    required: true

                },

                generoSexual: {

                    required: true

                }



            },

            messages: {

               email: "Digite seu email corretamente.",
			   
			   nomeApelido: "Digite o seu nome ou o seu apelido.",

               dataNascimento: "Digite a data do seu nascimento (12/08/1991).",

               escolaridade: "Selecione seu grau de escolaridade.",

               generoSexual: "Selecione uma das opções acima."
				
				

            },

            groups: {

                dataNascimento: "dd mm yyyy",

            },

            invalidHandler: function (event, validator) { //display error alert on form submit

                successHandler1.hide();

                errorHandler1.show();

            },

            highlight: function (element) {

                $(element).closest('.help-block').removeClass('valid');

                // display OK icon

                $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');

                // add the Bootstrap error class to the control group

            },

            unhighlight: function (element) { // revert the change done by hightlight

                $(element).closest('.form-group').removeClass('has-error');

                // set error class to the control group

            },

            success: function (label, element) {

                label.addClass('help-block valid');

                // mark the current input as valid and display OK icon

                $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');

            },

            submitHandler: function (form) {

                successHandler1.show();

                errorHandler1.hide();

                // submit form

                //$('#form').submit();

            }

        });

    };







    

    var displayConfirm = function () {

        $('.display-value', form).each(function () {

            var input = $('[name="' + $(this).attr("data-display") + '"]', form);

            if (input.attr("type") == "text" || input.attr("type") == "email" || input.is("textarea")) {

                $(this).html(input.val());

            } else if (input.is("select")) {

                $(this).html(input.find('option:selected').text());

            } else if (input.is(":radio") || input.is(":checkbox")) {



                $(this).html(input.filter(":checked").closest('label').text());

            } else if ($(this).attr("data-display") == 'card_expiry') {

                $(this).html($('[name="card_expiry_mm"]', form).val() + '/' + $('[name="card_expiry_yyyy"]', form).val());

            }

        });

    };

    var onShowStep = function (obj, context) {

    	if(context.toStep == numberOfSteps){

    		$('.anchor').children("li:nth-child(" + context.toStep + ")").children("a").removeClass('wait');

            displayConfirm();

    	}

        $(".next-step").unbind("click").click(function (e) {

            e.preventDefault();

            wizardContent.smartWizard("goForward");

            $('body,html').animate({scrollTop:0},100);



        });

        $(".back-step").unbind("click").click(function (e) {

            e.preventDefault();

            wizardContent.smartWizard("goBackward");

        });

        $(".go-first").unbind("click").click(function (e) {

            e.preventDefault();

            wizardContent.smartWizard("goToStep", 1);

        });

        $(".finish-step").unbind("click").click(function (e) {

            e.preventDefault();

            alert('teste');

            wizardForm.submit();

        });



};



    var leaveAStepCallback = function (obj, context) {

        return validateSteps(context.fromStep, context.toStep);

        // return false to stay on step and true to continue navigation

    };

    var onFinish = function (obj, context) {

        if (validateAllSteps()) {

            alert('form submit function');

            $('.anchor').children("li").last().children("a").removeClass('wait').removeClass('selected').addClass('done').children('.stepNumber').addClass('animated tada');

            //wizardForm.submit();

        }

    };

    var validateSteps = function (stepnumber, nextstep) {

        var isStepValid = false;

        

        

        if (numberOfSteps >= nextstep && nextstep > stepnumber) {

        	

            // cache the form element selector

            if (wizardForm.valid()) { // validate the form

                wizardForm.validate().focusInvalid();

                for (var i=stepnumber; i<=nextstep; i++){

        		$('.anchor').children("li:nth-child(" + i + ")").not("li:nth-child(" + nextstep + ")").children("a").removeClass('wait').addClass('done').children('.stepNumber').addClass('animated tada');

        		}

                //focus the invalid fields

                isStepValid = true;

                return true;

            };

        } else if (nextstep < stepnumber) {

        	for (i=nextstep; i<=stepnumber; i++){

        		$('.anchor').children("li:nth-child(" + i + ")").children("a").addClass('wait').children('.stepNumber').removeClass('animated tada');

        	}

            

            return true;

        } 

    };

    var validateAllSteps = function () {

        var isStepValid = true;

        // all step validation logic

        return isStepValid;

    };

    return {

        init: function () {

            validateCheckRadio();

            initWizard();

            runValidator1();

           

            

        }

    };

}();