"use strict";

// Class definition
var KTAppInvoicesCreate = function () {
    var form;


    var initForm = function (element) {
        // Due date. For more info, please visit the official plugin site: https://flatpickr.js.org/
        var invoiceDate = $(form.querySelector('[name="invoice_date"]'));
        invoiceDate.flatpickr({
            enableTime: false,
            dateFormat: "d, M Y",
        });

        // Due date. For more info, please visit the official plugin site: https://flatpickr.js.org/
        var dueDate = $(form.querySelector('[name="invoice_due_date"]'));
        dueDate.flatpickr({
            enableTime: false,
            dateFormat: "d, M Y",
        });
    };

    // Public methods
    return {
        init: function (element) {
            initForm();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTAppInvoicesCreate.init();
});
