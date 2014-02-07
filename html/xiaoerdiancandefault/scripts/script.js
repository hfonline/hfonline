// 首页选择餐品按钮
(function ($) {
  $(function() {
    $('.index-list-order-button').click(function () {
      if (!$(this).hasClass("toggle")) {
        var buydetail = $("#detail-buy-container");
        buydetail.parent().css("position", "relative");
        buydetail.css({
            display: "block",
        });
        $(this).addClass("toggle");
      }
      else {
        $(this).removeClass("toggle");
      }
    });
    
    $("#detail-buy-container input[name='buy-detail-ok-btn']").click(function () {
        $("#detail-buy-container").hide();
    });
  });
})(jQuery);

// record the scroll size
(function ($) {
    $(function () {
        $(window).scroll(function () {
            // buy detail 
            var buydetail = $("#detail-buy-container");
            buydetail.css({
                top: parseInt($(window).scrollTop()) + 30 + "px"
            });
        });
        $("#content .content").scroll(function () {
            console.log("HELLO");
        });
    })

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