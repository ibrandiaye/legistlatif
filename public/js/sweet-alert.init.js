/*
 Template Name: Zoter - Bootstrap 4 Admin Dashboard
 Author: Mannatthemes
 Website: www.mannatthemes.com
 File: Sweet Alert init js
 */

!function ($) {
    "use strict";

    var SweetAlert = function () {
    };

    //examples
    SweetAlert.prototype.init = function () {



        //Parameter
        $('#sa-params').click(function () {
            swal({
                title: 'Voulez-vous faire une approvisionnement?',
               // text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Approvisionner materiel lourds',
                cancelButtonText: 'Approvisionner materiel legers',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger m-l-10',
                buttonsStyling: false
            }).then(function () {
                /* swal(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                ) */
                $("#alourd").click();
            }, function (dismiss) {
                // dismiss can be 'cancel', 'overlay',
                // 'close', and 'timer'
                if (dismiss === 'cancel') {
                  /*   swal(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    ) */
                    $("#aleger").click();

                }
            })
        });

        //Custom Image


    },
        //init
        $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
}(window.jQuery),

//initializing
    function ($) {
        "use strict";
        $.SweetAlert.init()
    }(window.jQuery);
