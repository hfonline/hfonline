// 首页选择餐品按钮
(function ($) {
  $(function() {
    $('.index-list-order-button').click(function () {
      if (!$(this).hasClass("toggle")) {
        $(".detail-order-select", $(this).parent(".item").parent(".food-items")).hide("fast");
        var detailBox = $(this).siblings(".detail-order-select");
        var w = $(this).parent(".item").width();
        var h = $(this).parent(".item").height();
        detailBox.css({
          left: "10px",
          top: "0px"
        }).show("fast");
        $(this).addClass("toggle");
      }
      else {
        $(this).removeClass("toggle");
        $(this).siblings(".detail-order-select").hide("fast");
      }
    });
  });
})(jQuery);


// Filter show/hide
(function ($) {
  $(function () {
    $("#toglle_filter").click(function () {
      if (!$(this).hasClass("toggle")) {
        $(this).siblings("form").show("fast");
        $(this).addClass("toggle");
      }
      else {
        $(this).removeClass("toggle");
        $(this).siblings("form").hide("fast");
      }
    });
  });
})(jQuery);

// 高徳地图
(function ($) {
  window.mapObj = null;
  $(function () {
    if (!window.mapObj && $("#address_map").size()) {
       var mapObj = window.mapObj = new AMap.Map("address_map", {
         center: new AMap.LngLat(121.501236,31.22161),
         level: 10
       });
       
      AMap.event.addListener(window.mapObj, 'click', function (e) {
        $.cleanMapMarker();
        $.addMapMarker("/xiaoerdiancandefault/images/picon.png", e.lnglat);
      });
    }
  });
  
  var markers = [];

  $.addMapMarker = function (icon, position) {
    var marker = new AMap.Marker({
      size: new AMap.Size(28,37),
      image: icon,
      imageOffset: new AMap.Pixel(0,0),
      position: position
    });
    
    if (window.mapObj) {
      marker.setMap(window.mapObj);
    }
    
    markers.push(marker);
    return marker;
  }
  
  $.cleanMapMarker = function (marker) {
    if (typeof marker == 'undefined') {
      for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
      }
    }
    else {
      marker.setMap(null);
    }
  }
  
})(jQuery);

// 付款
(function ($) {
  $(function () {
    $('.order-button input').click(function () {
      window.location.href="/index.php?r=site/address";
    });
  });
})(jQuery);