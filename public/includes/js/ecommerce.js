var cookieNameOutletId = 'vervata_cart_outletID';
var productList = "FSX_S9,FSNLGIP,FSLGIP4,FSP_S9,FRECPC,FSL_S9,FSHS9,FSXGIP,FSBGIP6M,FSBGIP3M,FSB,FSBGIP";

UTIL = (
       function () {
         var ajax = function (url, onSuccess, async, testData, onFail) {
           var xhr;

           if (!window.ActiveXObject) {
             xhr = new XMLHttpRequest()
           }
           else {
             try {
               xhr = new ActiveXObject("Msxml2.XMLHTTP.6.0")
             }
             catch (x) {
               try {
                 xhr = new ActiveXObject("Msxml2.XMLHTTP")
               }
               catch (x) {
                 xhr = new ActiveXObject("Microsoft.XMLHTTP")
               }
             }
           }

           var handler = function () {
             if (xhr.status == 200) {
               var data = eval('(' + xhr.responseText + ')');

               if (data._error) {
                 onFail(data)
               }
               else {
                 onSuccess(data)
               }
             }
             else {
               alert('ERROR: ' + xhr.status + ' - ' + xhr.statusText)
             }
           };

           var setHandler = window.ActiveXObject || async;
           if (setHandler) {
             xhr.onreadystatechange = function () {
               if (xhr.readyState == 4) {
                 handler(xhr)
               }
             }
           }

           xhr.open('GET', url + (url.indexOf('?') >= 0 ? '&' : '?') + (new Date().getTime()), async);
           xhr.send(null);

           if (!setHandler) {
             handler()
           }
         };

         var testPrices = {FSX_S9:251, FSP_S9:151, FSHS9:101, FRECPC:102};
         var currencies = {1:{id:1, code:'EUR', symbol:'&euro;'}, 2:{id:2, code:'USD', symbol:'$'}};

         var _ = {
           addToCart: function (prodId, prodName, outletId) {
             var outletIDExpire = getCookie("vervata_cart_outletID_Expire");
             var referrer = getCookie("vervata_cart_referrer");
             if (!referrer) {
               referrer = document.location;
             }

             window.location.href = 'https://ecommerce.flexispy.com/secure/cart' +
                 '?prodID=' + encodeURIComponent(prodId) + '&prodName=' + encodeURIComponent(prodName) +
                 '&currency=' + _.getCurrency() + '&outletID=' + outletId + '&outletIDExpire=' + outletIDExpire + '&referrer=' + escape(referrer) +
                 '&' + new Date().getTime(); // prevent caching
           },

           getCountry: function () {
             return geoip_country_code()
           },

           getCurrency: function () {
             var c = _.getCountry();
//				return c == "US" ? 2 : 1
             return 2;
           },

           getOutlet: function () {
             var outlet = getCookie(cookieNameOutletId);
             if (!outlet) {
               readRef();
               outlet = refNo
             }
             if (!outlet || outlet == "null" || outlet == "0") {
               outlet = verv_refNo
             }
             return outlet
           },
           getPriceList: function (product) {
             var c = _.getCurrency();
             var r = {currency:currencies[c]};
             var onSuccess = function(data) {
               var keysArr = product.split(',');
               var valuesArr = data.price.split(',');
               for (j = 0; j < keysArr.length; j++) {
                 var priceValue = valuesArr[j];
                 var formattedPrice = priceValue;
                 if (formattedPrice.match(/\d+.0$/)) {
                   formattedPrice = formattedPrice.substr(0, formattedPrice.indexOf('.'));
                 }
                 r[keysArr[j]] = formattedPrice;
               }
             };
             var onUnrecoverableFail = function(data) {
               setCookie("vervata_cart_outletID", verv_refNo, null);
               alert("ERROR: " + data._error);
             };
             var onFail = function(data) {
               setCookie("vervata_cart_outletID", verv_refNo, null);
               ajax('myproxy.php?_url=' + encodeURIComponent('https://ecommerce.flexispy.com/util.jsp?op=getPriceList&product=' + product + '&outlet=' + verv_refNo + '&currency=' + c),
                   onSuccess,
                   false,
               {price:testPrices[product]},
                   onUnrecoverableFail
                   );
             };
             ajax('myproxy.php?_url=' + encodeURIComponent('https://ecommerce.flexispy.com/util.jsp?op=getPriceList&product=' + product + '&outlet=' + _.getOutlet() + '&currency=' + c),
                 onSuccess,
                 false,
             {price:testPrices[product]},
                 onFail
                 );

             return r
           },

           getPrice: function (product) {
             var c = _.getCurrency();
             var r = {currency:currencies[c]};
             var onSuccess = function(data) {
               r.amount = data.price.toString();
             };
             var onUnrecoverableFail = function(data) {
               setCookie("vervata_cart_outletID", verv_refNo, null);
               alert('ERROR: ' + data._error);
             };
             var onFail = function(data) {
               setCookie("vervata_cart_outletID", verv_refNo, null);
               ajax('myproxy.php?_url=' + encodeURIComponent('https://ecommerce.flexispy.com/util.jsp?op=getPrice&product=' + product + '&outlet=' + verv_refNo + '&currency=' + c),
                   onSuccess, false, {price:testPrices[product]}, onUnrecoverableFail
                   );
             };
             ajax('myproxy.php?_url=' + encodeURIComponent('https://ecommerce.flexispy.com/util.jsp?op=getPrice&product=' + product + '&outlet=' + _.getOutlet() + '&currency=' + c),
                 onSuccess, false, {price:testPrices[product]}, onFail
                 );

             return r
           },
           renderPrice: function (product) {
             var price = _.getPrice(product);
             var formattedPrice = price.amount;
             if (formattedPrice.match(/\d+.0$/)) {
               formattedPrice = formattedPrice.substr(0, formattedPrice.indexOf('.'));
             }
             document.write(price.currency.symbol + formattedPrice);
           }
         };

         return _
       }
    )();

    var productPriceMap;
    function setPrice() {
            productPriceMap = UTIL.getPriceList(productList);
    }
    function renderPrice(product, period) {
            if( productPriceMap == null){
              setPrice()
            }
            var amount = productPriceMap[product]
            var currency = productPriceMap.currency
            var convertCurrency = currency.id == 2 ? 'EUR' : 'USD'
            document.write('<span class="price">'+currency.symbol+amount+'</span>'+
                ' ('+(period || 'per year')+')')
    }

function geoip_country_code() { return 'TH'; }
function geoip_country_name() { return 'Thailand'; }
//document.write('<script src="http://j.maxmind.com/app/country.js"></script>');   // use GeoIP to detect user's country