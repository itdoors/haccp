var HaccpMap = (function() {

    var _plan,
        _contours,
        _map,
        _clusters,
        _scale;

    function HaccpMap(){
        this.setAttributes = function(options){
            _plan = options.plan;
            _contours = options.contours;
            _map = {};
            _clusters = [];
            // For Image Map plan type
            _scale = 1;
        }
    }

    /**
     * Init map, clusters, set handlers for map
     */
    HaccpMap.prototype.init = function(options){

        this.setAttributes(options);

        this.initMap();

        this.initPlanChildren();

        this.initMapActions();

        this.initClusters();

        this.clusterShowAll();
    };

    /**
     * Fabric for map init. Depends on _plan.type
     */
    HaccpMap.prototype.initMap = function() {
        var self = this;

        var fabricName = 'initMapBy' + this.capitalise(_plan.type);

        if (typeof window['HaccpMap'][fabricName] === 'function') {
            formok = window['HaccpMap'][fabricName]();
        }
    };

    /**
     * Init PlanChildren
     */
    HaccpMap.prototype.initPlanChildren = function() {
        var self = this;

        for (key in _plan.children) {
            if (!_plan.children.hasOwnProperty(key)) {
                continue;
            }

            var plan = _plan.children[key];

            var bounds = [
                new L.LatLng(plan.parentLatitudeTopLeft / _scale, plan.parentLongitudeTopLeft / _scale),
                new L.LatLng(plan.parentLatitudeBottomRight / _scale ,plan.parentLongitudeBottomRight / _scale)
            ];

            // create an orange rectangle
            var rectangle = L.rectangle(bounds, {color: "#ff0000", weight: 10});

            rectangle.addTo(_map);
            rectangle.plan = plan;

            rectangle.on('click', function(e){
                L.popup()
                    .setLatLng(e.latlng)
                    .setContent(self.getPopupHtml({
                        name: this.plan.name,
                        url: this.plan.url
                    }))
                    .openOn(_map);
            });
            console.log(_plan.children[key]);
        }
    };

    /**
     * Set map Handles
     */
    HaccpMap.prototype.initMapActions = function() {
        var self = this;

        _map.on('zoomend', function() {
            self.onViewChanged();
         });

        _map.on('moveend', function() {
            self.onViewChanged();
        });

        _map.on('click', function(e) {
            self.onMapClick(e);
        });
    };

    /**
     * Map init when _plan.type = image
     */
    HaccpMap.prototype.initMapByImage = function(){
        var windowWidth = $('#map').width();

        var srcWidth = _plan.imageWidth;
        var srcHeight = _plan.imageHeight;

        _scale = Math.ceil(srcWidth / windowWidth);

        _map = L.map('map', {
            crs: L.CRS.Simple,
            attributionControl: false
        });

        var imageUrl = _plan.imageFullPath;
        var imageBounds = new L.LatLngBounds([0, 0], [srcHeight/_scale , srcWidth/_scale]);
        var options =  { noWrap: true, maxZoom: 3, minZoom: 0};

        L.imageOverlay(imageUrl, imageBounds, options).addTo(_map);

        // Current zoom from State
        var currentZoom = HaccpState.getMapZoom(0);

        var center = HaccpState.getMapCenter(new L.LatLng(srcHeight/_scale/2, srcWidth/_scale/2));

        _map.setView(center, currentZoom);
    };

    /**
     * Map init when _plan.type = map
     * Default zoom = 17
     */
    HaccpMap.prototype.initMapByMap = function() {
        _map = L.map('map');

        // add an OpenStreetMap tile layer
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: ''
        }).addTo(_map);

        // Current zoom from State
        var currentZoom = HaccpState.getMapZoom(17);

        var center = HaccpState.getMapCenter(new L.LatLng(_plan.latitude, _plan.longitude));

        _map.setView(center, currentZoom);
    };

    /**
     * Map init when _plan.type = tails
     * Default zoom = 1
     */
    HaccpMap.prototype.initMapByTails = function(){
        // Current zoom from State
        var currentZoom = HaccpState.getMapZoom(1);

        var center = HaccpState.getMapCenter([0, 0]);

        _map = L.map('map', {
            maxZoom: _plan.maxZoom,
            minZoom: 1
        }).setView(center, currentZoom);

        var options = {
            attribution: '',
            tms: true,
            noWrap: true,
            continuousWorld: true
        };

        var Layer = L.tileLayer(_plan.imageFullPath + _plan.id + '/tails/{z}/{x}/{y}.png', options);

        Layer.addTo(_map);
    };

    /**
     * Creates and binds MarkerClusterGroup(s)
     * Represented as associative (array) _clusters[contourSlug] = (MarkerClusterGroup) cluster
     *
     */
    HaccpMap.prototype.initClusters = function() {
        var self = this;

        // Loop by contours and create clusters
        for (contourSlug in _contours)
        {
            if (!_contours.hasOwnProperty(contourSlug)) {
                continue;
            }

            // If cluster is not defined
            if (!_clusters[contourSlug]) {
                _clusters[contourSlug] = new L.MarkerClusterGroup({
                    disableClusteringAtZoom: _plan.maxZoom,
                    spiderfyOnMaxZoom : false,
                    showCoverageOnHover: false,
                    contourSlug: contourSlug,
                    iconCreateFunction: function (cluster) {
                        var childCount = cluster.getChildCount();
                        // Cluster class depends on contour
                        var c = ' marker-cluster-' + cluster._group.options.contourSlug;

                        return new L.DivIcon({ html: '<div><span>' + childCount + '</span></div>', className: 'marker-cluster' + c, iconSize: new L.Point(40, 40) });
                    }
                });
            }

            // _contours[contourSlug] = Points in this contour

            // Loop by points array and add to cluster
            for (key in _contours[contourSlug]) {
                if (!_contours[contourSlug].hasOwnProperty(key)){
                    continue;
                }

                var point = _contours[contourSlug][key];

                var myIcon = L.divIcon({
                    className: 'icon-bait-station',
                    html: self.getPointHtml({
                        classNameStatistics: point.classNameStatistics,
                        value: point.pointAVG,
                        name: point.name,
                        contourSlug: contourSlug
                    })
                });

                var pointLat = point.lat ? point.lat / _scale : 0;
                var pointLng = point.lng ? point.lng / _scale : 0;

                var pointMarker = L.marker(new L.LatLng(pointLat , pointLng), {
                    icon: myIcon
                });

                pointMarker.pointUrl = point.url;
                pointMarker.pointName = point.name;

                pointMarker.on('click', function(e){
                    Haccp.ajaxModal('Контрольная точка ' + this.pointName, '#ajax-modal', this.pointUrl);
                });

                _clusters[contourSlug].addLayer(pointMarker);
            }
        }
    };

    /**
     * Fires when contour filter submitted
     */
    HaccpMap.prototype.onContourRefresh = function(targetId) {
        var target = $('#' + targetId);

        var value = target.val();

        if (value) {
            this.clusterShowOne(value);
        }
        else {
            this.clusterShowAll();
        }
    };

    /**
     * Shows only one cluster on map depending on clusterSlug
     */
    HaccpMap.prototype.clusterShowOne = function(clusterSlug){
        // Loop through clusters and add to map
        for (key in _clusters) {
            if (!_clusters.hasOwnProperty(key)) {
                continue;
            }

            if (key != clusterSlug) {
                _map.removeLayer(_clusters[key]);
            }
            else {
                if (!_map.hasLayer(_clusters[key])) {
                    _map.addLayer(_clusters[key]);
                }
            }
        }
    };

    /**
     * Shows all cluster on map
     */
    HaccpMap.prototype.clusterShowAll = function() {
        // Loop through clusters and add to map
        for (key in _clusters) {
            if (_clusters.hasOwnProperty(key)) {
                if (!_map.hasLayer(_clusters[key])) {
                    _map.addLayer(_clusters[key]);
                }
            }
        }
    };

    /**
     * Generate html for point Icon
     *
     * @param {Object} options
     *
     * @return {String}
     */
    HaccpMap.prototype.getPointHtml = function(options) {
        var point =
            '<a class="label ' + options.classNameStatistics + '-' + options.contourSlug + ' ' +
                ' " href="#">' +
                '<i class="fa fa-inbox"></i>' +
                '' + options.name  + '' +
                '</a>';

        return point;
    };

    /**
     * Generate html for subPlan OnClick
     *
     * @param {Object} options
     *
     * @return {String}
     */
    HaccpMap.prototype.getPopupHtml = function(options) {
        var content =
            '<div class="btn-group">' +
                '<button data-toggle="dropdown" type="button" class="btn default btn-sm dropdown-toggle">' +
                '<i class="fa fa-building-o"></i> ' + options.name + ' <i class="fa fa-angle-down"></i>' +
                '<br>' +
                //'<span class="badge badge-success"> 2 </span>' +
                //'<span class="badge badge-warning"> 7 </span>' +
                //'<span class="badge badge-important"> 2 </span>' +
                '</button>' +
                '<ul role="menu" class="dropdown-menu">';

        content +=
            '<li>' +
                '<a href="' + options.url + '">' +
                    'View' +
                '</a>' +
            '</li>';

        content +=
                '</ul>' +
            '</div>';

        return content;
    };

    /**
     * Capitalize first latter
     *
     * @param {String} string
     *
     * @return {String}
     */
    HaccpMap.prototype.capitalise = function (string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    };

    /**
     * Handle map OnZoom action
     */
    HaccpMap.prototype.onViewChanged = function() {
        HaccpState.setMapZoom(_map.getZoom());
        HaccpState.setMapCenter(_map.getCenter());
    };

    /**
     * Handle map OnClick action
     */
    HaccpMap.prototype.onMapClick = function(e) {
        L.popup()
            .setLatLng(e.latlng)
            .setContent("Координаты точки " + e.latlng.lat * _scale + ' ' + e.latlng.lng * _scale)
            .openOn(_map);
    };

    return new HaccpMap();
})();