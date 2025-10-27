"use strict";

// Class definition
var program_tags_keywords = function () {

    // Private functions
    // Init tagify
    const initTagify = () => {
        // Define all elements for tagify
        const elements = [
            '#program_tags_meta_keywords'
        ];

        // Loop all elements
        elements.forEach(element => {
            // Get tagify element
            const tagify = document.querySelector(element);

            // Break if element not found
            if (!tagify) {
                return;
            }

            // Init tagify --- more info: https://yaireo.github.io/tagify/
            new Tagify(tagify);
        });
    };

    // Public methods
    return {
        init: function () {
            // Init forms
            initTagify();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    program_tags_keywords.init();
});
