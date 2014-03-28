var HACCPMAP = (function() {

    var _plan, _contours, _map, _clusters, _scale;

    function HACCPMAP(){
        this.setAttributes = function(options){
            _plan = options.plan;
            _contours = options.contours;
            _map = {};
            _clusters = [];
            // For Image Map plan type
            _scale = 1;
        }
    }

    HACCPMAP.prototype.init = function(options){

        console.log('init with ', options);

        this.setAttributes(options);

        this.initMap();

        this.initClusters();

        this.clusterShowAll();
    };

    HACCPMAP.prototype.initMap = function(){

        var self = this;

        var fabricName = 'initMapBy' + this.capitalise(_plan.type);

        if (typeof window['HACCPMAP'][fabricName] === 'function'){
            formok = window['HACCPMAP'][fabricName]();
        }

        /*_map.on('zoomend', function() {
            self.onZoomEnd();
        });*/
    };

    HACCPMAP.prototype.initMapByImage = function(){
        console.log('initMapByImage');

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

        _map.setView(new L.LatLng(srcHeight/_scale/2, srcWidth/_scale/2), 0);
    };

    HACCPMAP.prototype.initMapByMap = function(){
        console.log('initMapByMap');

        _map = L.map('map').setView(new L.LatLng(_plan.latitude, _plan.longitude), 17);

        // add an OpenStreetMap tile layer
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: ''
        }).addTo(_map);
    };

    HACCPMAP.prototype.initMapByTails = function(){
        console.log('initMapByTails');

        _map = L.map('map', {
            maxZoom: _plan.maxZoom,
            minZoom: 1
        }).setView([0, 0], 1);

        L.tileLayer(_plan.imageFullPath + _plan.id + '/tails/{z}/{x}/{y}.png', {
            attribution: '',
            tms: true,
            noWrap: true,
            continuousWorld: true
        }).addTo(_map);
    };

    HACCPMAP.prototype.initClusters = function(){
        console.log('initClusters with');

        var self = this;

        // Loop by contours and create clusters
        for (contourSlug in _contours)
        {
            if (!_contours.hasOwnProperty(contourSlug)){
                continue;
            }

            // If cluster is not defined
            if (!_clusters[contourSlug])
            {
                console.log('create cluster');
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
            for (key in _contours[contourSlug])
            {
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
                    HACCP.ajaxModal('Контрольная точка ' + this.pointName, '#ajax-modal', this.pointUrl);
                });

                _clusters[contourSlug].addLayer(pointMarker);
            }
        }
    };

    HACCPMAP.prototype.onContourRefresh = function(targetId){
        console.log('onContourRefresh ');

        var target = $('#' + targetId);

        var value = target.val();

        console.log('value ', value);

        if (value)
        {
            this.clusterShowOne(value);
        }
        else
        {
            this.clusterShowAll();
        }
    };

    HACCPMAP.prototype.clusterShowOne = function(clusterSlug){
        console.log('contourRefresh');

        // Loop through clusters and add to map
        for (key in _clusters)
        {
            if (!_clusters.hasOwnProperty(key)) {
                continue;
            }

            if (key != clusterSlug){
                _map.removeLayer(_clusters[key]);
            }
            else
            {
                if (!_map.hasLayer(_clusters[key]))
                {
                    _map.addLayer(_clusters[key]);
                }
            }


        }
    };

    HACCPMAP.prototype.clusterShowAll = function(){
        console.log('contourShowAll');

        // Loop through clusters and add to map
        for (key in _clusters)
        {
            if (_clusters.hasOwnProperty(key))
            {
                if (!_map.hasLayer(_clusters[key]))
                {
                    _map.addLayer(_clusters[key]);
                }

            }
        }
    };

    HACCPMAP.prototype.clusterOn = function(){
        console.log('clusterOn');
    };

    HACCPMAP.prototype.clusterOff = function(){
        console.log('clusterOff');
    };

    HACCPMAP.prototype.getPointHtml = function(options)
    {
        var point =
            '<a class="label ' + options.classNameStatistics + '-' + options.contourSlug + ' ' +
                ' " href="#">' +
                '<i class="fa fa-inbox"></i>' +
                '' + options.name  + '' +
                '</a>';

        return point;
    };

    HACCPMAP.prototype.getPopupHtml = function(options)
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

            content +=
                '<li>' +
                    '<a href="' + plan.url + '">' +
                        plan.name +
                    '</a>' +
                '</li>';
        }
        content +=
                '</ul>' +
            '</div>';

        return content;
    };

    HACCPMAP.prototype.capitalise = function (string)
    {
        return string.charAt(0).toUpperCase() + string.slice(1);
    };

    HACCPMAP.prototype.onZoomEnd = function(){
        console.log('onZoomEnd');
        //console.log(_map.getView());
    };

    return new HACCPMAP();
})();