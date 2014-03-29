var Haccp = (function() {

    var defaults = {
        assetsDir: '',
        loadingImgPath: ''
    };

    function Haccp(){
        this.params = {};
    }

    /**
     * Init
     *
     * @param {Object} options
     */
    Haccp.prototype.init = function(options) {
        this.params = $.extend(defaults, options);

        this.params.loadingImgPath = this.params.assetsDir + 'templates/metronic/img/ajax-loading.gif';
    };

    /**
     * Load Modal window
     *
     * @param {String} title
     * @param {String} targetId
     * @param {String} url
     */
    Haccp.prototype.ajaxModal = function(title, targetId, url) {
        var selfHaccp = this;

        var target = $(targetId);

        if (!target.length || !url) {
            return;
        }

        target.html(selfHaccp.getModalHeader(title));

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

    /**
     * Generates Header for Modal window
     *
     * @param {String} title
     *
     * @return {String}
     */
    Haccp.prototype.getModalHeader = function(title) {
        var header =
        '<div class="modal-header">' +
            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>' +
            '<h4 class="modal-title">' + title + '</h4>' +
        '</div>' +
        '<div class="modal-body" style="height: 500px;">LOADING...</div>';

        return header;
    };

    return new Haccp();
})();