jQuery(function (r) {
  var n = {
    ajax: function (a) {
      return jQuery.post(wpas_ajax_object.ajax_url, a);
    },
    preLoader: function () {
      return (
        '<div class="wpas-ajax-pre-loader-container" ><img  class="wpas-ajax-pre-loader" src="' +
        wpas_ajax_object.image_path +
        'pre-loader.gif" alt="Loadding..." /></div>'
      );
    },
    loadMorePreLoader: function () {
      return (
        '<img  class="wpas-ajax-loadmore-pre-loader" src="' +
        wpas_ajax_object.image_path +
        'load-more.gif" alt="Loadding..." />'
      );
    },
    primeDom: function (a) {
      return '<div class="amazon-product-thumb">';
    },
    action: function (a) {
      var t = a.DetailPageURL;
      return (
        "on" == wpas_ajax_object.is_cart &&
          (t = wpas_ajax_object.cart_prefix + "ASIN.1=" + a.ASIN),
        t
      );
    },
    rating: function (a) {
      if ("" == a.TotalReviews) return "";
      if ("" == a.Rating) return "";
      console.log("Rating : ", a.Rating);
      var t = "";
      return (
        (t =
          -1 != a.Rating.indexOf(".0")
            ? a.Rating.replace(".0", "")
            : a.Rating.replace(".", "-")),
        '<div class="amazon-product-rating" data-product-asin="' +
          a.ASIN +
          '">\n            <i class="a-icon a-icon-star a-star-' +
          t +
          '"><span class="a-icon-alt">' +
          a.Rating +
          ' out of 5 stars</span></i>\n            <p>( <a href="' + n.action(t) +'" target="_blank">' +
          a.TotalReviews +
          "</a>)</p>\n        </div>\n"
      );
    },
    products: function (a) {
      var o = "";
	  var enoferta = ['<span class="aawp-product__ribbon aawp-product__ribbon--sale">¡En Oferta!</span>', ''];
	  var enofertaR = '';
      return (
        0 < a.length
          ? r.each(a, function (a, t) {
			  enofertaR = enoferta[Math.round(Math.random())];
              o +=
                '<div class="aawp-grid__item"> <div class="aawp-product aawp-product--vertical aawp-product--ribbon aawp-product--sale" data-aawp-product-title="'+t.Title.replace("\\", "")+'">'+enofertaR+'<a class="aawp-product__image--link aawp-product__image" href="' + n.action(t) +'" title="'+t.Title.replace("\\", "")+'" rel="nofollow noopener" target="_blank" style="background-image: url(\'' +t.ImageUrl +'\');"> <img class="aawp-product__image-spacer" src="https://viajaencoche.com/wp-content/plugins/wp-amazon-shop/assets/images/thumb-spacer.png" alt="'+t.Title.replace("\\", "")+'"> </a> <div class="aawp-product__content"> <a class="aawp-product__title" href="' + n.action(t) +'" title="'+t.Title.replace("\\", "")+'" rel="nofollow noopener" target="_blank">'+t.Title.replace("\\", "")+'</a> <div class="aawp-product__meta"> <a class="aawp-check-prime" href="' + n.action(t) +'" title="Amazon Prime" rel="nofollow noopener" target="_blank"></a> </div> </div> <div class="aawp-product__footer"> <div class="aawp-product__pricing"> <span class="aawp-product__price aawp-product__price--current">'+t.Price.substring(4,t.Price.length) +'€</span> </div> <a class="aawp-button aawp-button--buy aawp-button aawp-button--amazon rounded shadow aawp-button--icon aawp-button--icon-amazon-black" href="' + n.action(t) +'" title="Ver en Amazon" target="_blank" rel="nofollow noopener">Ver en Amazon</a> </div> </div> </div>';
            })
          : (o += "<p>No se han encontrado productos</p>"),
        o
      );
    },
    comparision: function (a) {
      var o = "";
      return (
        0 < a.length
          ? ((o +=
              '<div class="wpas-comparison-shortcode-inner">\n                <div class="wpas-comparison-item wpas-comparison-unite">\n                    <div class="wpas-comparison-item-inner">\n                        <div class="wpas-comparison-base">\n                            <p>Product Image</p>\n                        </div>\n                        <div class="wpas-comparison-base"><h4>Product Name</h4></div>\n                        <div class="wpas-comparison-base"><p>Unit Price</p></div>\n                        <div class="wpas-comparison-base"><p>Availability</p></div>\n                        <div class="wpas-comparison-base wpas-comparison-product-action">\n                            <p>Buy Now</p></div>\n                    </div>\n                    \x3c!--wpas-comparison-item-inner--\x3e\n                </div>\n'),
            r.each(a, function (a, t) {
              o +=
                '<div class="wpas-comparison-item">\n                        <div class="wpas-comparison-item-inner">\n                            <div class="wpas-comparison-base"><img src="' +
                t.ImageUrl +
                '" alt="' +
                t.Title.replace("\\", "") +
                '" >\n                            </div>\n                            <div class="wpas-comparison-base"><h4 title="' +
                t.Title.replace("\\", "") +
                '"><a href="' +
                n.action(t) +
                '" target="_blank">' +
                t.Title.replace("\\", "") +
                '</a></h4>\n                            </div>\n                            <div class="wpas-comparison-base">\n                                <p>' +
                t.Price +
                '</p>\n                            </div>\n                            <div class="wpas-comparison-base"><p>In Stock</p></div>\n                            <div class="wpas-comparison-base wpas-comparison-product-action">\n                                <a href="' +
                n.action(t) +
                '" class="aawp-button aawp-button--buy aawp-button aawp-button--amazon rounded shadow aawp-button--icon aawp-button--icon-amazon-black" target="_blank"> ' +
                wpas_ajax_object.action_label +
                "  </a>\n                            </div>\n                        </div>\n                        \x3c!--wpas-comparison-item-inner--\x3e\n                    </div>\n";
            }),
            (o += "</div>"))
          : (o += "<p>No Products Found</p>"),
        o
      );
    },
  };
  r(document).ready(function (a) {
    if (
      0 < r("form[role='search']").length &&
      "on" == wpas_ajax_object.enable_global_search &&
      0 == r(".wp-amazon-shop-shortcode-wrapper").length &&
      0 == r(".wp-amazon-shop-auto-link-shortcode-wrapper").length
    ) {
      r(".content-area")
        .first()
        .prepend(
          "<div class='container'><div class='row wpas-products-wrapper'></div>" +
            '<div class="wpas-load-more-wrapper" style="display: none"><button id="wpas-load-more-btn" class="wpas-load-more-btn" data-keyword="" data-page-num="">Load More</button></div></div>'
        ),
        r("input[type='search']").on("keypress", function (a) {
          (13 != a.which && 13 != a.keyCode) ||
            (a.preventDefault(), o(r(this).val()));
        }),
        r("input[type='submit'],button[type='submit']").on(
          "click",
          function (a) {
            a.preventDefault(),
              0 < r(this).parents("form").length && o(r(this).val());
          }
        );
    }
    function o(o) {
      r(".wpas-products-wrapper").html(n.preLoader());
      var a =
        wpas_ajax_object.store_country +
        "&Keywords=" +
        o +
        "&SearchIndex=All&multipageStart=" +
        wpas_ajax_object.page_number +
        "&multipageCount=" +
        wpas_ajax_object.prouct_per_page;
      r.ajax({
        url: a,
        dataType: "jsonp",
        jsonpCallback: "search_callback",
        success: function (a) {
          console.log(a);
          var t = parseInt(a.InstanceId + 1);
          r(".wpas-products-wrapper").html(n.products(a.results)),
            a.results.length >= wpas_ajax_object.prouct_per_page
              ? (r(".wpas-load-more-wrapper").show(),
                r("#wpas-load-more-btn").attr("data-keyword", o),
                r("#wpas-load-more-btn").attr("data-page-num", t))
              : r(".wpas-load-more-wrapper").hide();
        },
        error: function (a, t, o) {
          console.log(a, t, o);
        },
      });
    }
    0 < r(".wp-amazon-shop-products").length &&
      r(".wp-amazon-shop-products").each(function (a) {
        var t;
        (t = this),
          setTimeout(function () {
            "asin" == r(t).attr("shortcode-type")
              ? (function (a, o) {
                  r(".wp-amazon-shop-products").html(n.preLoader());
                  var t = { action: "wpas_shortcode_by_asin", asin: a };
                  n.ajax(t).done(function (a) {
                    var t = JSON.parse(a);
                    0 < t.length && r(o).parent().html(n.products(t));
                  });
                })(r(t).attr("asin-keys").trim(), t)
              : "keyword" == r(t).attr("shortcode-type")
              ? (function (o, e) {
                  r(".wp-amazon-shop-products").html(n.preLoader());
                  var a =
                    wpas_ajax_object.store_country +
                    "&Keywords=" +
                    o +
                    "&SearchIndex=All&multipageStart=" +
                    wpas_ajax_object.page_number +
                    "&multipageCount=" +
                    wpas_ajax_object.prouct_per_page;
                  r.ajax({
                    url: encodeURI(a),
                    dataType: "jsonp",
                    jsonpCallback: "search_callback",
                    success: function (a) {
                      var t = {
                        action: "wpas_search_by_keyword",
                        keyword: o,
                        data: a.results,
                      };
                      n.ajax(t).done(function (a) {
                        var t = r(e)
                          .parent()
                          .parent()
                          .find(".wpas-load-more-wrapper");
                        r(e).parent().html(a.html),
                          a.product_num >= wpas_ajax_object.prouct_per_page
                            ? (t.show(),
                              r("#wpas-load-more-btn").attr(
                                "data-keyword",
                                a.keyword
                              ),
                              r("#wpas-load-more-btn").attr(
                                "data-page-num",
                                a.page_num
                              ))
                            : r(".wpas-load-more-wrapper").hide();
                      });
                    },
                    error: function (a, t, o) {
                      console.log(a, t, o);
                    },
                  });
                })(r(t).attr("asin-keys").trim(), t)
              : "comparision" == r(t).attr("shortcode-type") &&
                (function (a, o) {
                  r(".wp-amazon-shop-products").html(n.preLoader());
                  var t = { action: "wpas_comparision_by_asin", asin: a };
                  n.ajax(t).done(function (a) {
                    var t = JSON.parse(a);
                    0 < t.length && r(o).parent().html(n.comparision(t));
                  });
                })(r(t).attr("asin-keys").trim(), t);
          }, 1e3 * a);
      }),
      r("#wpas-search-input").on("keypress", function (a) {
        if (13 == a.which || 13 == a.keyCode) {
          a.preventDefault();
          var t = r(this).val().trim();
          "" != t && o(t);
        }
      }),
      r("#wpas-search-btn").on("click", function (a) {
        a.preventDefault();
        var t = r("#wpas-search-input").val().trim();
        "" != t && o(t);
      }),
      r(document).on("click", "#wpas-load-more-btn", function () {
        var o = r(this).attr("data-keyword"),
          a = r(this).attr("data-page-num");
        if (1 == a) var t = 20;
        else if (2 == a) t = 20;
        r(".wpas-products-wrapper").last().append(n.preLoader());
        var e =
          wpas_ajax_object.store_country +
          "&Keywords=" +
          o +
          "&SearchIndex=All&multipageStart=" +
          a +
          "&multipageCount=" +
          t;
        r.ajax({
          url: e,
          dataType: "jsonp",
          jsonpCallback: "search_callback",
          success: function (a) {
            r(".wpas-ajax-pre-loader-container").remove();
            var t = parseInt(t + 1);
            r(".wpas-products-wrapper").html(n.products(a.results)),
              a.results.length < 20
                ? (r(".wpas-load-more-wrapper").show(),
                  r("#wpas-load-more-btn").attr("data-keyword", o),
                  r("#wpas-load-more-btn").attr("data-page-num", t))
                : r(".wpas-load-more-wrapper").hide();
          },
          error: function (a, t, o) {
            console.log(a, t, o);
          },
        });
      });
  });
});
