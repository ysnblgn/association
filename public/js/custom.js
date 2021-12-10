$(document).ready(function () {
    if ($('h1:first').text() != '') {
        document.title = $('h1:first').text();
    } else if ($('h2:first').text() != '') {
        document.title = $('h2:first').text();
    }
});
$(document).ready(function () {
    (function initializeFilters() {
        $(".date-filter").on("click", "ul li a", function (e) {
            e.preventDefault();

            if (!$(this).hasClass("show-custom-range")) {
                $(this).parents("ul").children().last().hide();
            } else {
                $(this).parent().next().show();
            }

            var thisValue;
            thisValue = $(this).html();
            $(this).parents("ul").find("a").removeClass("a-disabled");
            $(this).addClass("a-disabled");
            $(".breadcrumb li span").html(thisValue);
        });

        $('.date-filter').on("click", "ul li *", function (e) {
            e.stopPropagation();
        });

        $(".datepicker").datepicker({
            format: "mm-yyyy",
            viewMode: "months",
            minViewMode: "months",
            autoclose: true
        });

        $(document).on('click', 'span.month, th.next, th.prev, th.switch, span.year', function (e) {
            e.stopPropagation();
        });

    })();
});
