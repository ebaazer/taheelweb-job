"use strict";

var KTUsersList = function () {
    // Define shared variables
    var table = document.getElementById('kt_table_job_title');
    var datatable;
    var toolbarBase;
    var toolbarSelected;
    var selectedCount;

    // Define template element variables
    var uploadTemplate;
    var renameTemplate;
    var actionTemplate;
    var checkboxTemplate;


    // Private functions
    const initTemplates = () => {
        uploadTemplate = document.querySelector('[data-kt-filemanager-template="upload"]');
        renameTemplate = document.querySelector('[data-kt-filemanager-template="rename"]');
        actionTemplate = document.querySelector('[data-kt-filemanager-template="action"]');
        checkboxTemplate = document.querySelector('[data-kt-filemanager-template="checkbox"]');
    }









    // Private functions
    var initUserTable = function () {

        // Init datatable --- more info on datatables: https://datatables.net/manual/
        datatable = $(table).DataTable({
            "info": false,
            'order': [],
            "pageLength": 5,
            "lengthChange": false,
            'columnDefs': [
                {orderable: false, targets: 0}, // Disable ordering on column 0 (checkbox)
                        //{ orderable: false, targets: 5 }, // Disable ordering on column 6 (actions)                
            ]
        });

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        datatable.on('draw', function () {
            initToggleToolbar();
            handleDeleteRows();
            toggleToolbars();
            //KTMenu.createInstances();
            handleRename();
            resetNewFolder();
        });
    };

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-user-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    };

    // Filter Datatable
    var handleFilterDatatable = () => {
        // Select filter options
        const filterForm = document.querySelector('[data-kt-user-table-filter="form"]');
        const filterButton = filterForm.querySelector('[data-kt-user-table-filter="filter"]');
        const selectOptions = filterForm.querySelectorAll('select');

        // Filter datatable on submit
        filterButton.addEventListener('click', function () {
            var filterString = '';

            // Get filter values
            selectOptions.forEach((item, index) => {
                if (item.value && item.value !== '') {
                    if (index !== 0) {
                        filterString += ' ';
                    }

                    // Build filter value options
                    filterString += item.value;
                }
            });

            // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
            datatable.search(filterString).draw();
        });
    };

    // Reset Filter
    var handleResetForm = () => {
        // Select reset button
        const resetButton = document.querySelector('[data-kt-user-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Select filter options
            const filterForm = document.querySelector('[data-kt-user-table-filter="form"]');
            const selectOptions = filterForm.querySelectorAll('select');

            // Reset select2 values -- more info: https://select2.org/programmatic-control/add-select-clear-items
            selectOptions.forEach(select => {
                $(select).val('').trigger('change');
            });

            // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
            datatable.search('').draw();
        });
    };

    // Delete subscirption
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = table.querySelectorAll('[data-kt-users-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get user name
                const userName = parent.querySelectorAll('td')[1].querySelectorAll('a')[1].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + userName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        Swal.fire({
                            text: "You have deleted " + userName + "!.",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        }).then(function () {
                            // Remove current row
                            datatable.row($(parent)).remove().draw();
                        }).then(function () {
                            // Detect checked checkboxes
                            toggleToolbars();
                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: customerName + " was not deleted.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
            });
        });
    };

    // Init toggle toolbar
    var initToggleToolbar = () => {
        // Toggle selected action toolbar
        // Select all checkboxes
        const checkboxes = table.querySelectorAll('[type="checkbox"]');

        // Select elements
        toolbarBase = document.querySelector('[data-kt-user-table-toolbar="base"]');
        toolbarSelected = document.querySelector('[data-kt-user-table-toolbar="selected"]');
        selectedCount = document.querySelector('[data-kt-user-table-select="selected_count"]');
        const deleteSelected = document.querySelector('[data-kt-user-table-select="delete_selected"]');

        // Toggle delete selected toolbar
        checkboxes.forEach(c => {
            // Checkbox on click event
            c.addEventListener('click', function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
        deleteSelected.addEventListener('click', function () {
            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            Swal.fire({
                text: "Are you sure you want to delete selected?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(function (result) {
                if (result.value) {
                    Swal.fire({
                        text: "You have deleted all selected!.",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    }).then(function () {
                        // Remove all selected customers
                        checkboxes.forEach(c => {
                            if (c.checked) {
                                datatable.row($(c.closest('tbody tr'))).remove().draw();
                            }
                        });

                        // Remove header checked box
                        const headerCheckbox = table.querySelectorAll('[type="checkbox"]')[0];
                        headerCheckbox.checked = false;
                    }).then(function () {
                        toggleToolbars(); // Detect checked checkboxes
                        initToggleToolbar(); // Re-init toolbar to recalculate checkboxes
                    });
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Selected was not deleted.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    });
                }
            });
        });
    };

    // Toggle toolbars
    const toggleToolbars = () => {
        // Select refreshed checkbox DOM elements 
        const allCheckboxes = table.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    };

    // Handle rename file or folder
    const handleRename = () => {
        const renameButton = table.querySelectorAll('[data-kt-filemanager-table="rename"]');

        renameButton.forEach(button => {
            button.addEventListener('click', renameCallback);
        });
    }

    // Rename callback
    const renameCallback = (e) => {
        e.preventDefault();

        // Define shared value
        let nameValue;

        // Stop renaming if there's an input existing
        if (table.querySelectorAll('#kt_file_manager_rename_input').length > 0) {
            Swal.fire({
                text: "Unsaved input detected. Please save or cancel the current item",
                icon: "warning",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger"
                }
            });

            return;
        }

        // Select parent row
        const parent = e.target.closest('tr');

        // Get name column
        const nameCol = parent.querySelectorAll('td')[0];
        const colIcon = nameCol.querySelector('.icon-wrapper');
        nameValue = nameCol.innerText;
        console.log(parent);
        const old_name = nameValue;

        // Set rename input template
        const renameInput = renameTemplate.cloneNode(true);
        //renameInput.querySelector('#kt_file_manager_rename_folder_icon').innerHTML = colIcon.outerHTML;

        // Swap current column content with input template
        nameCol.innerHTML = renameInput.innerHTML;

        // Set input value with current file/folder name
        parent.querySelector('#kt_file_manager_rename_input').value = nameValue;

        // Rename file / folder validator
        var renameValidator = FormValidation.formValidation(
                nameCol,
                {
                    fields: {
                        'rename_folder_name': {
                            validators: {
                                notEmpty: {
                                    message: 'Name is required'
                                }
                            }
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: '.fv-row',
                            eleInvalidClass: '',
                            eleValidClass: ''
                        })
                    }
                }
        );

        // Rename input button action
        const renameInputButton = document.querySelector('#kt_file_manager_rename_folder');
        renameInputButton.addEventListener('click', e => {
            e.preventDefault();

            // Detect if valid
            if (renameValidator) {
                renameValidator.validate().then(function (status) {
                    console.log('validated!');

                    if (status == 'Valid') {
                        // Pop up confirmation
                        Swal.fire({
                            text: "Are you sure you want to rename " + nameValue + "?",
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonText: "Yes, rename it!",
                            cancelButtonText: "No, cancel",
                            customClass: {
                                confirmButton: "btn fw-bold btn-danger",
                                cancelButton: "btn fw-bold btn-active-light-primary"
                            }
                        }).then(function (result) {
                            if (result.value) {
                                Swal.fire({
                                    text: "You have renamed " + nameValue + "!.",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                }).then(function () {
                                    // Get new file / folder name value
                                    const newValue = document.querySelector('#kt_file_manager_rename_input').value;

                                    $.ajax({
                                        type: 'post',
                                        url: baseurl + 'employee/rename_job_title/',
                                        data: {
                                            newValue: newValue,
                                            old_name: old_name
                                        },
                                        success: function (response) {
                                            response = response.trim();
                                            if (response == 'false') {

                                            } else if (response == 'true') {


                                            }
                                        }
                                    });

                                    //New column data template
                                    const newData = `<div class="d-flex align-items-center"><a href="javascript:;" class="text-gray-800 text-hover-primary">${newValue}</a></div>`;

                                    // Draw datatable with new content -- Add more events here for any server-side events
                                    datatable.cell($(nameCol)).data(newData).draw();
                                });
                            } else if (result.dismiss === 'cancel') {
                                Swal.fire({
                                    text: nameValue + " was not renamed.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                });
                            }
                        });
                    }
                });
            }
        });

        // Cancel rename input
        const cancelInputButton = document.querySelector('#kt_file_manager_rename_folder_cancel');
        cancelInputButton.addEventListener('click', e => {
            e.preventDefault();

            // Simulate process for demo only
            cancelInputButton.setAttribute("data-kt-indicator", "on");

            setTimeout(function () {
                const revertTemplate = `<div class="d-flex align-items-center"><a href="?page=apps/file-manager/files/" class="text-gray-800 text-hover-primary">${nameValue}</a></div>`;

                // Remove spinner
                cancelInputButton.removeAttribute("data-kt-indicator");

                // Draw datatable with new content -- Add more events here for any server-side events
                datatable.cell($(nameCol)).data(revertTemplate).draw();

                // Toggle toastr
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toastr-top-right",
                    "preventDuplicates": false,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.error('Cancelled rename function');
            }, 1000);
        });
    }


    // Handle new folder
    const handleNewFolder = () => {
        // Select button
        const newFolder = document.getElementById('kt_file_manager_new_folder');

        // Handle click action
        newFolder.addEventListener('click', e => {
            e.preventDefault();

            // Ignore if input already exist
            if (table.querySelector('#kt_file_manager_new_folder_row')) {
                return;
            }

            // Add new blank row to datatable
            const tableBody = table.querySelector('tbody');
            const rowElement = uploadTemplate.cloneNode(true); // Clone template markup
            tableBody.prepend(rowElement);

            // Define template interactive elements
            const rowForm = rowElement.querySelector('#kt_file_manager_add_folder_form');
            const rowButton = rowElement.querySelector('#kt_file_manager_add_folder');
            const cancelButton = rowElement.querySelector('#kt_file_manager_cancel_folder');
            const folderIcon = rowElement.querySelector('#kt_file_manager_folder_icon');
            const rowInput = rowElement.querySelector('[name="new_folder_name"]');

            // Define validator
            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            var validator = FormValidation.formValidation(
                    rowForm,
                    {
                        fields: {
                            'new_folder_name': {
                                validators: {
                                    notEmpty: {
                                        message: is_required
                                    }
                                }
                            },
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: '.fv-row',
                                eleInvalidClass: '',
                                eleValidClass: ''
                            })
                        }
                    }
            );

            // Handle add new folder button
            rowButton.addEventListener('click', e => {
                e.preventDefault();

                // Activate indicator
                rowButton.setAttribute("data-kt-indicator", "on");

                // Validate form before submit
                if (validator) {
                    validator.validate().then(function (status) {
                        console.log('validated!');
                        console.log('1');
                        if (status == 'Valid') {
                            // Simulate process for demo only
                            setTimeout(function () {
                                // Create folder link
                                //const folderLink = document.createElement('a');
                                //const folderLinkClasses = ['text-gray-800', 'text-hover-primary'];
                                //folderLink.setAttribute('href', 'javascript:;');
                                //folderLink.classList.add(...folderLinkClasses);
                                //folderLink.innerText = rowInput.value;

                                const newRow = datatable.row.add({
                                    //'checkbox': checkboxTemplate.innerHTML,
                                    '0': rowInput.value,
                                    '1': '<div class="badge badge-light-success fw-bold">نشط</div>',
                                    '2': actionTemplate.innerHTML
                                }).node();
                                //$(newRow).find('td').eq(2).attr('data-kt-filemanager-table', 'action_dropdown');
                                //$(newRow).find('td').eq(2).addClass('text-end'); // Add custom class to last 'td' element --- more info: https://datatables.net/forums/discussion/22341/row-add-cell-class
                                console.log('2');

                                console.log(newRow);


                                $.ajax({
                                    type: 'post',
                                    url: baseurl + 'employee/add_job_title/',
                                    data: {
                                        newValue: rowInput.value
                                    },
                                    success: function (response) {
                                        console.log(response);


                                    }
                                });
                                console.log('3');

                                // Re-sort datatable to allow new folder added at the top
                                var index = datatable.row(0).index(),
                                        rowCount = datatable.data().length - 1,
                                        insertedRow = datatable.row(rowCount).data(),
                                        tempRow;

                                for (var i = rowCount; i > index; i--) {
                                    tempRow = datatable.row(i - 1).data();
                                    datatable.row(i).data(tempRow);
                                    datatable.row(i - 1).data(insertedRow);
                                }

                                toastr.options = {
                                    "closeButton": true,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": false,
                                    "positionClass": "toastr-top-right",
                                    "preventDuplicates": false,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                };

                                toastr.success(rowInput.value + ' was created!');

                                // Disable indicator
                                rowButton.removeAttribute("data-kt-indicator");

                                // Reset input
                                rowInput.value = '';

                                datatable.draw(false);

                            }, 2000);
                        } else {
                            // Disable indicator
                            rowButton.removeAttribute("data-kt-indicator");
                        }
                    });
                }
            });

            // Handle cancel new folder button
            cancelButton.addEventListener('click', e => {
                e.preventDefault();

                // Activate indicator
                cancelButton.setAttribute("data-kt-indicator", "on");

                setTimeout(function () {
                    // Disable indicator
                    cancelButton.removeAttribute("data-kt-indicator");

                    // Toggle toastr
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toastr-top-right",
                        "preventDuplicates": false,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };

                    toastr.error('Cancelled new creation');
                    resetNewFolder();
                }, 1000);
            });
        });
    }

    // Reset add new folder input
    const resetNewFolder = () => {
        const newFolderRow = table.querySelector('#kt_file_manager_new_folder_row');

        if (newFolderRow) {
            newFolderRow.parentNode.removeChild(newFolderRow);
        }
    }



    return {
        // Public functions  
        init: function () {
            if (!table) {
                return;
            }

            initUserTable();



            initToggleToolbar();
            handleSearchDatatable();
            //handleResetForm();
            handleDeleteRows();
            //handleFilterDatatable();
            initTemplates();
            handleRename();
            handleNewFolder();

        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTUsersList.init();
});