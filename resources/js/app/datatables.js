(() => {
    function debounce(callback, ms) {
        var timer = 0;
        return function() {
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
            callback.apply(context, args);
            }, ms || 0);
        };
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
                    parent.find(".eaDTSearchInput").each(function (a) {
                        data["filter_" + $(this).attr('name')] = this.value;
                    });
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
                { className: "align-middle white-space-nowrap fw-semi-bold text-1000 ps-4 border-end", targets: "_all" },
                { className: "align-middle white-space-nowrap fw-semi-bold text-1000 ps-4 border-end", targets: -1 },
            ],
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
            $(this).removeAttr(Object.values($(this).get(0).attributes).map(attr => attr.name).join(' '));
            $(this).removeClass("sorting");
            $(this).addClass("sorting_disabled");
            var t = $(this).text();
            $(this).html('<input type="text" class="form-control" placeholder="🔍 ' + t + '" />');
            $("input", this).keyup(debounce(function(e){
                var val = $.fn.dataTable.util.escapeRegex(this.value);
                dtCont.column(a).search(val ? val : '', true, false).draw();
            }, 1000));
        });

        dtCont.on( 'draw', function () {
            feather.replace();
        });

        parent.find(".eaDTSearchInput").each(function (a) {
            console.log($(this));
            $(this).on("change input keyup", debounce(function(e){
                console.log("changed");
                dtCont.draw();
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