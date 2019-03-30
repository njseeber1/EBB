var getUrlParams = function(sParam) {
  var sPageURL = window.location.search.substring(1);
  var sURLVariables = sPageURL.split("&");
  for (var i = 0; i < sURLVariables.length; i++) {
    var sParameterName = sURLVariables[i].split("=");
    if (sParameterName[0] == sParam) {
      return sParameterName[1];
    }
  }
  return null;
};

var valid_types = [
  "1",
  "2",
  "3",
  "other",
  "liquor",
  "store",
  "church",
  "land",
  ""
];

var app = angular.module("App", ["ngSanitize"]);

app.filter("unsafe", function($sce) {
  return $sce.trustAsHtml;
});

app.directive("map", function() {
  var google =
    "https://www.google.com/maps/embed/v1/place?key=AIzaSyDFBXnIUgR7B2jtMTTRYGhQbtjYZgdaB9U&zoom=12&q=";
  return function(scope, el, attrs) {
    el.bind("click touch", function() {
      var image = $(el)
        .parent()
        .parent()
        .parent()
        .prev()
        .prev();
      var frameContainer = $(el)
        .parent()
        .parent()
        .parent()
        .prev();
      if ($(el).hasClass("map")) {
        $(el).removeClass("map");
        $(el).text("View Location");
        image.removeClass("hide");
        frameContainer.addClass("hide");
      } else {
        $(el).text("Hide Map");
        $(el).addClass("map");
        frameContainer.empty();
        frameContainer.append(
          '<iframe src="' +
            google +
            attrs.loc +
            "+" +
            attrs.city +
            '"></iframe>'
        );
        image.addClass("hide");
        frameContainer.removeClass("hide");
      }
    });
  };
});

app.directive("inc", function($http) {
  return {
    scope: {
      listing: "="
    },
    link: function(scope, el, attrs) {
      el.on("click touch", function() {
        scope.listing.count++;
        var req = {
          method: "POST",
          url: "ajax/increment.php",
          headers: {
            "Content-Type": "application/json"
          },
          data: { id: attrs.inc }
        };
        $http(req).success(function(resp) {
          //console.log(resp);
        });
      });
    }
  };
});

app.factory("listings", function($http) {
  var list = {};

  list.get = function(status) {
    return $http.get("ajax/get-listings.php?status=" + status);
  };

  return list;
});

app.controller("ListingsCtrl", function(listings) {
  var list = this;
  list.Title = "EagleBusiness Brokers!!!!";
  console.log(list.Title);
  list.filter = {};
  list.criteria = [];
  list.status = "";
  list.google =
    "https://www.google.com/maps/embed/v1/place?key=AIzaSyDFBXnIUgR7B2jtMTTRYGhQbtjYZgdaB9U&zoom=12&q=";

  list.init = function(status) {
    list.status = status;
    list.loading = true;
    var crit;
    var type = getUrlParams("type");
    if (type) {
      var types = type.split(",");
      for (var i = 0; i < types.length; i++) {
        crit = types[i];
        list.pushCriteria(types[i]);
        $("#" + types[i]).prop("checked", true);
      }
    }
    list.getAll(status);
  };

  list.helloWorld = function() {
    console.log(list.Title);
  };
  list.helloWorld();
  list.getAll = function(status) {
    list.loading = true;
    listings.get(status).success(function(resp) {
      if (list.criteria.length == 0) {
        list.all = resp;
        list.show = resp.slice(0, 20);
      } else {
        list.show = list.all = resp;
      }
      list.loading = false;
      if (list.criteria.length == 0) list.empty = false;
      else if ($(".bodylistings").children().length == 2) list.empty = true;
      else list.empty = false;
    });
  };
  list.pushCriteria = function(c) {
    list.filter.classification = $("#offer-types > option:selected").attr("id");
    list.filter.price = $("#amount")
      .val()
      .split("-");
    list.filter.priceRange = [];
    for (var price in list.filter.price) {
      list.filter.priceRange.push(
        list.filter.price[price].replace("$", "").trim()
      );
    }
    if (c === undefined) {
      c = $("#offer-types > option:selected").attr("id");
    }

    var index = list.criteria.indexOf(c.toString());
    if (index > -1) {
      list.criteria.splice(index, 1);
      list.none = null;
    } else {
      list.criteria.push(c.toString());
      list.checkExists(c);
    }
    list.getAll(list.status);
  };
  list.meetsCriteria = function(l) {
    if (list.criteria.length == 0) return true;
    else {
      for (var i = 0; i < list.criteria.length; i++) {
        if (
          l.classification == list.criteria[i] ||
          (l.type == list.criteria[i] &&
            l.listPrice > list.filter.priceRange[0] &&
            l.listPrice < list.filter.priceRange[1])
        )
          return true;
      }
      return false;
    }
  };
  list.checkExists = function(c) {
    var count = 0;
    var text = $("#" + c)
      .parent()
      .text();
    if (list.all) {
      list.none = null;
      for (var i = 0; i < list.all.length; i++) {
        if (
          list.all[i].classification == c ||
          (list.all[i].type == c &&
            list.all[i].listPrice > list.filter.priceRange[0] &&
            list.all[i].listPrice < list.filter.priceRange[1])
        )
          count++;
      }
      if (count == 0) {
        list.none =
          "Sorry, we do not have any " + text + " for sale right now.";
      }
      console.log(list.show);
    }
  };
  list.setCurrent = function(l) {
    list.current_listing = l;
    $(".overlay, .sub-overlay").removeClass("hide");
  };
});
