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
    }

    HACCP.prototype.init = function(options)
    {
        this.params = $.extend(defaults, options);

        this.params.loadingImgPath = this.params.assetsDir + 'templates/metronic/img/ajax-loading.gif';
    };

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
    };

    HACCP.prototype.getModalHeader = function(title)
    {
        var header =
        '<div class="modal-header">' +
            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>' +
            '<h4 class="modal-title">' + title + '</h4>' +
        '</div>' +
        '<div class="modal-body" style="height: 500px;">LOADING...</div>';

        return header;
    };

    return new HACCP();
})();