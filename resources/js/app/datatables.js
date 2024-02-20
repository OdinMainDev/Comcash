import axios from 'axios';
import flatpickr from "flatpickr";
import { Russian } from "flatpickr/dist/l10n/ru.js";
import { English } from "flatpickr/dist/l10n/default.js";
import 'flatpickr/dist/flatpickr.min.css'


(() => {
    function debounce(callback, ms) {
        let timer = 0;
        return function() {
            const context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(() => callback.apply(context, args), ms || 0);
        };
    }
    function convertToFilterObject(dataObject) {
        const filterObject = {};
    
        dataObject.columns.forEach(column => {
            const key = `filter_${column.name}`;
            filterObject[key] = column.search.value;
        });
        return filterObject;
    }

    function cleanDataFilter(dataObject) {   
        const columns = dataObject.columns
        const mappedColums = columns.map(item => {
            return {
                ...item,
                search: {
                    ...item.search,
                    value: ''
                }
            }
        })
        return {...dataObject, columns: mappedColums}
    }

    
    $(".eaDatatable").each(function() {
        var parent = $(this).parent();
        var pathname = window.location.pathname + '/data';
        if($(this).data("model")){
            pathname = $(this).data("model");
        }
        var orderType = 'desc';
        if(window.location.pathname.includes("verification/list"))
            orderType = 'asc';
        var dtCont = $(this).DataTable({
            pageLength: 25,
            processing: true,
            serverSide: true,
            pagingType: 'numbers',
            ajax: {
                url: pathname,
                type: "GET",
                data: function(data) {
                    if(data.columns) {
                        $.extend(data, convertToFilterObject(data), cleanDataFilter(data));
                    }
                }
            },
            buttons: [
                {
                    extend: 'excel',
                },
                {
                    extend: 'pdf',
                },
            ],
            dom: "<'table-responsive'tr><'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6 dataTables_pager'p>>",
            columns: $(this).data("columns"),
            orderCellsTop: true,
            order: [ [0, orderType] ],
            language: {
                "info":           "_START_ - _END_ (_TOTAL_)",
                "infoEmpty":      "0 - 0",
            },
            columnDefs: [
                { className: "align-middle white-space-nowrap fw-semi-bold text-1000 ps-4 border-start", targets: 0, "width": "10%" },
                { className: "align-middle white-space-nowrap fw-semi-bold text-1000 ps-4 border-end", targets: -1, "width": "5%" },
                { className: "align-middle white-space-nowrap ps-4 border-end", targets: "_all" },
                { targets: "column-exch-status", "width": "10%" },
                { targets: "column-exch-currency", "width": "8%" },
                { targets: "column-exch-data", className:"align-middle white-space-nowrap fw-semi-bold text-1000 ps-3", "width": "25%" },
                { targets: "column-exch-hash", "width": "15%" },
            ],
            // autoWidth: true,
            exportOptions: {
                modifer: {
                  page: 'all',
                  search: 'none'    
                }
            },
            "language": {
                search: ""
            }
        });

        $(this).find("thead tr:eq(1) th").each(function (a) {
            if(!$(this).data("search")){
                $(this).html(" ");
                return;
            }
            

            if($(this).data('select-type')) {
                $(this)
                .html('<select class="form-select" id="enabled" name="enabled"></select>')
                .find('select')
                .on('change', debounce(function(e) {
                  const text = $.fn.dataTable.util.escapeRegex(this.value);
                  dtCont.column(a).search(text ? text : '', true, false).draw();

                }, 1000));

            } else if($(this).data('datepicker')) {
                var t = $(this).text();
                $(this).html('<input type="text" class="form-control datepicker" placeholder="🔍 ' + t + '" />');
                const url = window.location.href;
                const languagePattern = /\/(en|ru)\//;
              
                const match = url.match(languagePattern);
                const datepicker = $(this).find('input.datepicker');
    
                flatpickr(datepicker, {
                    enableTime: true,
                    dateFormat: "d.m.Y H:i",
                    locale: match[1] === 'ru' ? Russian : English,
                    onChange: (selectedDates, dateStr, instance) => {
                        const inputDate = dateStr;
    
                        let parts = inputDate.split(' ');
                        
                        let dateParts = parts[0].split('.');
                        let year = dateParts[2];
                        let month = dateParts[1];
                        let day = dateParts[0];
                        let time = parts[1];
                        let formattedDate = year + '-' + month + '-' + day + 'T' + time;
                        dtCont.column(a).search(formattedDate, true, false).draw();
                    }
                });
                datepicker.on('lc')
            } else if($(this).data('search-type')) {
                var t = $(this).text();
                $(this).html('<input type="text" class="form-control search" placeholder="🔍 ' + t + '" />');
                let timer = null;
                const search = $(this).find('input.search');
                const ul = $('<ul class="admin-exchange-table__search-list"></ul>');
                $(search).after(ul)
        
                search.on('input', (e) => {
                    clearTimeout(timer);
                    timer = setTimeout(() => {
                        if (e.target.value.trim().length !== 0) {
                            axios.get('/ru/panel/api/get/users/', {
                                params: {
                                    search: e.target.value
                                }
                            })
                            .then(res => {
                                ul.empty()
                                res.data.forEach(item => {
                                    ul.append(`<li data-value="${item.id}">${item.text}</li>`).on('mousedown', () => {
                                        search.val(item.text);
                                        dtCont.column(a).search(item.id, true, false).draw();
                                    });
                                })
                            })
                        } else {
                            dtCont.column(a).search('', true, false).draw();
                        }
  
                    }, 500);
                })
        
                search.on('blur', (e) => {
                    ul.empty();
                })
            } else {
                var t = $(this).text();
                $(this).html('<input type="text" class="form-control" placeholder="🔍 ' + t + '" />');
                $("input", this).keyup(debounce(function(e){
                    var val = $.fn.dataTable.util.escapeRegex(this.value);
                    dtCont.column(a).search(val ? val : '', true, false).draw();
                }, 1000));
            }            
        });

        dtCont.on( 'draw', function () {
            feather.replace();
        });

        parent.find(".eaDTSearchInput").each(function (a) {
            console.log($(this));
            $(this).on("change input keyup", debounce(function(e){
                console.log("changed");
                dtCont.draw();
                // dtCont.columns.adjust().draw();
            }, 1000))
        });

        parent.find(".eaDTExportExcel").on("click", function() {
            dtCont.buttons('.buttons-excel' ).trigger();
        });

        parent.find(".eaDTExportPdf").on("click", function() {
            dtCont.buttons('.buttons-pdf' ).trigger();
        });
        
    });

    // $('.eaDatatable').each(function() {
    //     var datatable = $(this);
    //     // SEARCH - Add the placeholder for Search and Turn this into in-line form control
    //     var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
    //     search_input.attr('placeholder', '🔎.....');
    //     search_input.removeClass('form-control-sm');
    //     search_input.addClass('form-control')
    //     // LENGTH - Inline-Form control
    //     var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
    //     length_sel.removeClass('form-control-sm');
    //     length_sel.addClass('form-control')
    // });
})()