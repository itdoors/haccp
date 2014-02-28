var HACCP = (function() {

    var defaults = {
/*        ajaxFormClass: 'ajax-form',
        ajaxDeleteClass: 'ajax-delete',
        ajaxFormEntityClass: 'ajax-form-entity',
        ajaxFormCancelBtnClass: 'sd-cancel-btn',
        ajaxMoreInfoClass: 'more-info',
        ajaxFormUrl: '',
        ajaxDeleteUrl: '',*/
        assetsDir: '',
        loadingImgPath: ''
    };

    function HACCP(){
        this.params = {};
    };

    HACCP.prototype.init = function(options)
    {
        this.params = $.extend(defaults, options);

        this.params.loadingImgPath = this.params.assetsDir + 'templates/metronic/img/ajax-loading.gif';
    }

    HACCP.prototype.ajaxModal = function(title, targetId, url)
    {
        var selfHACCP = this;

        var target = $(targetId);

        if (!target.length || !url)
        {
            return;
        }

        target.html(selfHACCP.getModalHeader(title));

        var modalBodyLoading = target.find('.modal-body');

        $.ajax({
            type: 'POST',
            url: url,
            beforeSend: function(){},
            success: function(response){
                modalBodyLoading.replaceWith(response);
            }
        });

        target.modal();
    }

    HACCP.prototype.getModalHeader = function(title)
    {
        var header =
        '<div class="modal-header">' +
            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>' +
            '<h4 class="modal-title">' + title + '</h4>' +
        '</div>' +
        '<div class="modal-body" style="height: 500px;">LOADING...</div>';

        return header;
    }

    HACCP.prototype.getPopupHtml = function(options)
    {
        var content =
            '<div class="btn-group">' +
                '<button data-toggle="dropdown" type="button" class="btn default btn-sm dropdown-toggle">' +
                '<i class="fa fa-building-o"></i> План 1 <i class="fa fa-angle-down"></i>' +
                '<br>' +
                    '<span class="badge badge-success"> 2 </span>' +
                    '<span class="badge badge-warning"> 7 </span>' +
                    '<span class="badge badge-important"> 2 </span>' +
                '</button>' +
                '<ul role="menu" class="dropdown-menu">';

        for (key in options.plans)
        {
            var plan = options.plans[key];

            content += '<li>' +
                    '<a href="' + plan.url + '">' +
                        plan.name +
                    '</a>' +
                '</li>';
        }
        content +=
                '</ul>' +
            '</div>';

        return content;
    }

    HACCP.prototype.getPointHtml = function(options)
    {
        var point =
            '<a class="' + options.classNameStatistics + '-' + options.contourId + ' ' +
                ' " href="#">' +
                '<div style="z-index: 901; position: relative;">' + options.name  + '</div>' +
                '<div class="contour-' + options.classNameStatistics + '-' + options.contourId +
                '"></div>' +
            '</a>';

        return point;
    }

    HACCP.prototype.getRealPontCoordinates

    return new HACCP();
})();