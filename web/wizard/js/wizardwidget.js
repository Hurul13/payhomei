$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();

    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        var $target = $(e.target);
        var $tab_active = $('.wizard .nav-tabs li.active');

        if ($target.parent().hasClass('disabled')) {
            return false;
        }

        $tab_active.removeClass('active');
        $target.parent().addClass('active');
    });

    // Manage next step button click
    $(document).on("click", ".next-step", function (e) {
        var $tab_active = $('.wizard .nav-tabs li.active');
        var $next_tab = $tab_active.next();
        var $function = jQuery(this).data('function') || false;
        if ($function) {
            var callback = function () {
                $next_tab.removeClass('disabled');
                nextTab($tab_active);
            };

            // Execute data item 'function' on click
            eval($function);
        } else {
            $next_tab.removeClass('disabled');
            nextTab($tab_active);
        }
    });

    // Manage previous step button click
    $(document).on("click", ".prev-step", function (e) {
        var $tab_active = $('.wizard .nav-tabs li.active');
        var $function = jQuery(this).data('function') || false;

        if ($function) {
            var callback = function () {
                prevTab($tab_active);
            };

            // Execute data item 'function' on click
            eval($function);
        } else {
            prevTab($tab_active);
        }
    });

    // Manage save step button click
    $(document).on("click", ".save-step", function (e) {
        var $function = jQuery(this).data('function') || false;
        // Execute data item 'function' on click
        if ($function) {
            eval($function);
        }
    });
});

// 'click' on next tab
function nextTab(elem) {
    if (elem.next().hasClass('disabled')) {
        elem.next().removeClass('disabled');
    }

    elem.removeClass('active');
    elem.next().addClass('active');
    $(elem).next().find('a[data-toggle="tab"]').click();
}

// 'click' on prev tab
function prevTab(elem) {
    elem.removeClass('active');
    elem.prev().addClass('active');
    $(elem).prev().find('a[data-toggle="tab"]').click();
}

