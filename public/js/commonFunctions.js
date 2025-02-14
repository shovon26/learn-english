$(document).on('keypress', '.numberKeyOnly', function(evt) {
    let charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    } else {
        return true;
    }
});

$(document).on('keypress', '.notAllowKey', function(evt) {
    let charCode = (evt.which) ? evt.which : evt.keyCode;
    //alert(charCode);
    //if (charCode === 69 || charCode === 101 || charCode === 43 || charCode === 47)
    if (charCode === 46) {
        return true;
    } else if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    } else {
        return true;
    }
});

$(function () {
    $('.select2').select2({
        theme: 'bootstrap-5',
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
        allowClear: true,
        // minimumInputLength: 2,
        ajax: {
            url: function (e) {
              return $(this).data("url");
            },
            data: function (params) {
                var element = $(this);

                let postData = element.data("post");
                let dynamicData = {};
                if (postData) {
                    postData.split(',').forEach(function(item) {
                        let elementVal = $('#' + item).val();
                        dynamicData[item] = elementVal;
                    });
                }
                var query = {
                    q: params.term,
                    page: params.page || 1,
                    per_page: 10,
                    ...dynamicData
                };
                return query;
            },
            dataType: "json",
            delay: 350,
            cache: true
        },
    });
    $('.select22').select2({
        theme: 'bootstrap-5',
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
        allowClear: true
    });
    $(function() {
        let start = '';
        let end = '';
    
        if (!start) {
            start = moment();
        }
        if (!end) {
            end = moment();
        }
    
        $('.dateRangePicker').daterangepicker({
            opens: 'left',
            locale: {
                cancelLabel: 'Clear',
                format: 'DD/MM/YYYY'
            },
            autoApply: true,
            alwaysShowCalendars: true,
            autoUpdateInput: false,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }).on('show.daterangepicker', function(ev, picker) {
            if ($(window).width() < 768) {
                picker.opens = 'center';
            } else {
                picker.opens = 'left';
            }
        }).on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY')).trigger('change');
        }).on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

        $('.dateMonthPicker').datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'MM yy',
            maxDate: 1,
            minDate: new Date(2020, 10, - 1, 25),
            onClose: function(dateText, inst) {
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1)).trigger('change');
            }
        });



    });
    $(".modal").each(function(l) {
        $(this).on("shown.bs.modal", function(l) {
            const inputForm = $('.modal-dialog').find('input.focus');
            if (inputForm.length > 0) {
                inputForm[0].focus();
                inputForm[0].select();
            }
            const eIn = $(this).data("easein");
            try {
                if(eIn) {
                    $(".modal-dialog").velocity("callout." + eIn);
                }
            } catch (err) {}
        });
        $(this).on("hide.bs.modal", function(l) {
            const eOut = $(this).data("easeout");
            try {
                if(eOut) {
                    $(".modal-dialog").velocity("callout." + eOut);
                }
            } catch (err) {}
        });
    });
});

function savingAction(actionField, massage) {
    $(actionField).attr("disabled", true);
    $(actionField).text(massage);
}

function removeAction(actionField, massage) {
    $(actionField).attr("disabled", false);
    $(actionField).text(massage);
}

function showSuccessMassage(massage) {
    toastr.success(massage);
}

function successAction(actionField, btnMassage, massage) {
    $(actionField).attr("disabled", false);
    $(actionField).text(btnMassage);
    toastr.success(massage);
}

function errorAction(actionField, btnMassage, massage) {
    $(actionField).attr("disabled", false);
    $(actionField).text(btnMassage);
    toastr.error(massage);
}

function showErrorMassage(massage) {
    toastr.error(massage);
}

function dirtyForm(actionField) {
    $(actionField).dirrty();
}

function cleanForm(actionField) {
    $(actionField).dirrty("setAsClean");
}

function redirectToLogin() {
    window.location = "/account/login";
}

function globalErrorAction(errorStatus, message = null) {
    if (errorStatus === 401) {
        showErrorMassage(message);
    } else if (errorStatus === 403) {
        showErrorMassage(message);
        window.location = "/account/login";
    } else if (errorStatus === 404) {
        showErrorMassage(message);
    } else if (errorStatus === 412) {
        window.location = "/account/verify-account";
    } else if (errorStatus === 500) {
        showErrorMassage(message);
        reloadFunction();
    } else {
        showErrorMassage(message);
        reloadFunction();
    }
}

function reloadFunction() {
    window.setTimeout(function() {
        window.location.reload();
    }, 500);
}

function focusToInvalidField() {
    $('html, body').animate($(".invalid")[0].focus());
}

document.addEventListener('invalid', function(e) {
    $(e.target).addClass("invalid");
    // $('html, body').animate({scrollTop: $($(".invalid")[0]).offset().top - 150 }, 0);
    focusToInvalidField();
}, true);
document.addEventListener('change', function(e) {
    $(e.target).removeClass("invalid")
}, true);

$(function() {
    $(':input[type=number]').on('mousewheel', function(e) { $(this).blur(); });
});

function showLoader() {
    $('body').append('<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>');
}

function removeLoader() {
    $("#loadingDiv").remove(); //makes page more lightweight
}

function confirmFormResubmission() {
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
}

function changePushStateUrl(data, title) {
    window.history.pushState(data, "", title);
}
/**
 * Converts number into currency format
 * @param {number} number   Number that should be converted.
 * @param {string} [decimalSeparator]    Decimal separator, defaults to '.'.
 * @param {string} [thousandsSeparator]    Thousands separator, defaults to ','.
 * @param {int} [nDecimalDigits]    Number of decimal digits, defaults to `2`.
 * @return {string} Formatted string (e.g. numberToCurrency(12345.67) returns '12,345.67')
 */
function numberToCurrency(number, decimalSeparator, thousandsSeparator, nDecimalDigits) {
    //default values
    decimalSeparator = decimalSeparator || '.';
    thousandsSeparator = thousandsSeparator || ',';
    nDecimalDigits = nDecimalDigits == null ? 2 : nDecimalDigits;

    let fixed = number.toFixed(nDecimalDigits), //limit/add decimal digits
        parts = new RegExp('^(-?\\d{1,3})((?:\\d{3})+)(\\.(\\d{' + nDecimalDigits + '}))?$').exec(fixed); //separate begin [$1], middle [$2] and decimal digits [$4]

    if (parts) { //number >= 1000 || number <= -1000
        return parts[1] + parts[2].replace(/\d{3}/g, thousandsSeparator + '$&') + (parts[4] ? decimalSeparator + parts[4] : '');
    } else {
        return fixed.replace('.', decimalSeparator);
    }
}

function debounce(callback, delay) {
    let timeout;
    return function() {
        clearTimeout(timeout);
        timeout = setTimeout(callback, delay);
    }
}

function footerCalculationDatatable(api, currencyHtmlCode, column) {
    let formattingType = 0;
    if (currencyHtmlCode === '€' || currencyHtmlCode === '₫' || currencyHtmlCode === 'Rp') {
        formattingType = 1;
    }
    // Remove the formatting to get integer data for summation
    let intVal = function(i) {
        return typeof i === 'string' ?
            i * 1 :
            typeof i === 'number' ?
                i : 0;
    };

    // Total over this page
    let pageTotal = api
        .column(column, { page: 'current' })
        .data()
        .reduce(function(a, b) {
            if (formattingType === 1) {
                b = b.replace(/[\.]/g, "");
                b = b.replace(/[\,]/g, ".");
                b = b.replace(/[^\d\.]+/g, '');
            } else {
                b = b.replace(/[\,]/g, "");
                b = b.replace(/[^\d\.]+/g, '');
            }
            return intVal(a) + intVal(b);
        }, 0);

    // Update footer
    if (pageTotal > 0) {
        $(api.column(column).footer()).html(
            currencyHtmlCode + (formattingType === 1 ? numberToCurrency(pageTotal, ',', '.', 2) : numberToCurrency(pageTotal, '.', ',', 2))
        );
    }
}

function proxyChain(chainId) {
    let form = document.createElement("form");
    form.setAttribute('method', "post");
    form.setAttribute('action', "/account/proxy-chain-action");

    let chainIdInput = document.createElement("input");
    chainIdInput.setAttribute('type', "hidden");
    chainIdInput.setAttribute('name', "selectedChainId");
    chainIdInput.setAttribute('value', chainId);

    let csrfTokenInput = document.createElement("input");
    csrfTokenInput.setAttribute('type', "hidden");
    csrfTokenInput.setAttribute('name', "_token");
    csrfTokenInput.setAttribute('value', $('meta[name="csrf-token"]').attr('content'));

    let submit = document.createElement("input");
    submit.setAttribute('type', "hidden");
    submit.setAttribute('value', "Submit");
    form.appendChild(chainIdInput);
    form.appendChild(csrfTokenInput);
    form.appendChild(submit);

    document.body.appendChild(form);
    form.submit();
}

function proxyShop(shopId) {
    let form = document.createElement("form");
    form.setAttribute('method', "post");
    form.setAttribute('action', '/account/proxy-action');

    let shopIdInput = document.createElement("input");
    shopIdInput.setAttribute('type', "hidden");
    shopIdInput.setAttribute('name', "selectedShopId");
    shopIdInput.setAttribute('value', shopId);

    let csrfTokenInput = document.createElement("input");
    csrfTokenInput.setAttribute('type', "hidden");
    csrfTokenInput.setAttribute('name', "_token");
    csrfTokenInput.setAttribute('value', $('meta[name="csrf-token"]').attr('content'));

    let submit = document.createElement("input");
    submit.setAttribute('type', "submit");
    submit.setAttribute('value', "Submit");
    form.appendChild(shopIdInput);
    form.appendChild(csrfTokenInput);
    form.appendChild(submit);

    document.body.appendChild(form);
    form.submit();
}


function form_submit(t, callbackAfter = null, callbackBefore = null) {
    let that = $(t);
    let form = that.closest("form");
    let action = form.attr("action");
    let method = form.attr("method");
    
    $.validator.setDefaults({
        errorPlacement: function (error, element) {
            if (element.parent(".input-group").length) {
                error.insertAfter(element.parent());
            } else if (
                element.prop("type") === "radio" &&
                element.parent(".radio-inline").length
            ) {
                error.insertAfter(element.parent().parent());
            } else if (
                element.prop("type") === "checkbox" ||
                element.prop("type") === "radio"
            ) {
                error.appendTo(element.parent().parent());
            } else {
                error.insertAfter(element);
            }
        },
        debug: true,
        success: "valid",
    });

    let ladda = null;
    if ($(t).hasClass('ladda-button')) {
        ladda = Ladda.create(t);
        ladda.setProgress(0);
    }
    
    $(form).validate();
    var valid = form.valid();
    
    if (valid) {
        $(form).one("submit", function (e) {
            e.preventDefault();
            
            var form_data = new FormData(this);
            $.ajax({
                url: action,
                type: method,
                data: form_data,
                processData: false,
                contentType: false,
                mimeType: "multipart/form-data",
                dataType: "json",
                beforeSend: function () {
                    if(ladda) {
                        ladda.setProgress(0.1);
                        ladda.start();
                    }
                    if (callbackBefore != null) callbackBefore();
                },
                complete: function (data) {
                    if(ladda) {
                        ladda.setProgress(1);
                        setTimeout(() => {
                            ladda.stop();
                        }, 500)
                    }
                },
                success: function (response) {
                    if(response?.message) {
                        showSuccessMassage(response?.message)
                    }
                    if(response?.redirect) {
                        const redirect_to = response?.redirect_to;
                        console.log('redirect_to', redirect_to)
                        setTimeout(() => window.location.replace(redirect_to), 1000)
                    }
                },
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    if (xhr.upload) {
                        xhr.upload.addEventListener("progress", function (event) {
                            let percent = 0;
                            let position = event.loaded || event.position;
                            let total = event.total;

                            if (event.lengthComputable) {
                                percent = Math.ceil((position / total) * 100);
                            }

                            if (ladda) {
                                ladda.setProgress(percent / 100);
                            }
                        }, true);
                    }
                    return xhr;
                },
            }).done(function (response) {
                
            }).fail(function (response) {
                showErrorMassage(response.responseJSON?.message ?? response.status + ' ' + response.statusText);
            }).always(function (response, xhr) {
                if (callbackAfter != null) callbackAfter(response);
            });
        });
    }
}

function ajax_submit(action, data, method = 'POST', callbackAfter = null, callbackBefore = null) {
    $.ajax({
        url: action,
        type: method,
        data: data,
        dataType: "json",
        beforeSend: function () {
            if (callbackBefore != null) callbackBefore();
        },
        complete: function (data) {
            
        },
        success: function (response) {
            response?.message ? showSuccessMassage(response?.message) : ''
            if(response?.redirect) {
                const redirect_to = response?.redirect_to;
                setTimeout(() => window.location.replace(redirect_to), 1000)
            }
        },
        xhr: function () {
            var xhr = new window.XMLHttpRequest();
            if (xhr.upload) {
                xhr.upload.addEventListener("progress", function (event) {
                    // let percent = 0;
                    // let position = event.loaded || event.position;
                    // let total = event.total;

                    // if (event.lengthComputable) {
                    //     percent = Math.ceil((position / total) * 100);
                    // }

                    // if (ladda) {
                    //     ladda.setProgress(percent / 100);
                    // }
                }, true);
            }
            return xhr;
        },
    }).done(function (response) {
        
    }).fail(function (response) {
        showErrorMassage(response.responseJSON?.message ?? response.status + ' ' + response.statusText);
    }).always(function (response, xhr) {
        if (callbackAfter != null) callbackAfter(response);
    });
}

