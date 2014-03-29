var HaccpState = (function() {

    var _map = {};

    function HaccpState(){}

    /**
     * Set current zoom
     *
     * @param {int} zoom
     */
    HaccpState.prototype.setMapZoom = function(zoom){
        _map.zoom = zoom;
    };

    /**
     * Set current bounds
     *
     * @param {Object} bounds
     */
    HaccpState.prototype.setMapBounds = function(bounds){
        _map.bounds = bounds;
    };

    /**
     * Set current center
     *
     * @param {Object} center
     */
    HaccpState.prototype.setMapCenter = function(center){
        _map.center = center;
    };

    /**
     * Return current map zoom value (default cz it's depends on plan type)
     *
     * @return {int}
     */
    HaccpState.prototype.getMapZoom = function(defaultZoom) {

        if (defaultZoom == null) {
            defaultZoom = 1;
        }

        return _map.zoom ? _map.zoom : defaultZoom;
    };

    /**
     * Return current map bounds
     *
     * @return {Object} | null
     */
    HaccpState.prototype.getMapBounds = function(){
        return _map.bounds ?_map.bounds : null;
    };

    /**
     * Return current map center
     *
     * @param {Object} defaultCenter (default cz it's depends on plan type)
     *
     * @return {Object} | null
     */
    HaccpState.prototype.getMapCenter = function(defaultCenter){
        return _map.center ?_map.center : defaultCenter;
    };

    return new HaccpState();
})();