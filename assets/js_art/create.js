"use strict";

// Class definition
var KTAppInvoicesCreate = function () {
    var form;

    // Private functions

    var handleEmptyState = function () {
        if (form.querySelectorAll('[data-kt-element="items"] [data-kt-element="item"]').length === 0) {
            var item = form.querySelector('[data-kt-element="empty-template"] tr').cloneNode(true);
            form.querySelector('[data-kt-element="items"] tbody').appendChild(item);
        } else {
            KTUtil.remove(form.querySelector('[data-kt-element="items"] [data-kt-element="empty"]'));
        }
    }

    var handeForm = function (element) {
        // Add item
        form.querySelector('[data-kt-element="items"] [data-kt-element="add-item"]').addEventListener('click', function (e) {
            e.preventDefault();

            var item = form.querySelector('[data-kt-element="item-template"] tr').cloneNode(true);

            form.querySelector('[data-kt-element="items"] tbody').appendChild(item);

            handleEmptyState();
            //updateTotal();
        });

        // Remove item
        KTUtil.on(form, '[data-kt-element="items"] [data-kt-element="remove-item"]', 'click', function (e) {
            e.preventDefault();

            KTUtil.remove(this.closest('[data-kt-element="item"]'));

            handleEmptyState();
            //updateTotal();
        });

        // Handle price and quantity changes
        KTUtil.on(form, '[data-kt-element="items"] [data-kt-element="quantity"], [data-kt-element="items"] [data-kt-element="price"]', 'change', function (e) {
            e.preventDefault();

            //updateTotal();
        });
    };

    // Public methods
    return {
        init: function (element) {
            form = document.querySelector('#kt_ecommerce_settings_general_form');

            handeForm();
            //initForm();
            //updateTotal();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTAppInvoicesCreate.init();
});
