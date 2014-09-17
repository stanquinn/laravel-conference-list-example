var qsParm = new Array();
var cookieNameOutletId='vervata_cart_outletID';
var verv_refNo="10001";
var refNo="0";
var cookieEnabled=(navigator.cookieEnabled)? true : false;

refNo=getCookie(cookieNameOutletId);
//alert("refNo=" + refNo);
var query = window.location.search.substring(1);
var parms = query.split('&');

if(parms.length==0){
refNo=verv_refNo;
}else{
    if(getCookie(cookieNameOutletId)==null || getCookie(cookieNameOutletId)=="null")
    {
    for (var i=0; i<parms.length; i++)
     {
            var pos = parms[i].indexOf('=');
                    if (pos > 0) {
                            var key = parms[i].substring(0,pos);
                            var val = parms[i].substring(pos+1);
                            qsParm[key] = val;
                                    if(key=="ref"){
                                    refNo=val;
                                    }
                    }
            }
    saveOutlet(refNo);
    }
}

function getCookie(NameOfCookie)
{if (document.cookie.length > 0)
{begin = document.cookie.indexOf(NameOfCookie+"=");
if (begin != -1)
{begin += NameOfCookie.length+1;
end = document.cookie.indexOf(";", begin);
if (end == -1) end = document.cookie.length;
return unescape(document.cookie.substring(begin, end));}
}
return null;
}

function setCookie(NameOfCookie, value, expiredays)
{var ExpireDate = new Date ();
ExpireDate.setTime(ExpireDate.getTime() + (expiredays * 24 * 3600 * 1000));
document.cookie = NameOfCookie + "=" + escape(value) +
((expiredays == null) ? "" : "; expires=" + ExpireDate.toGMTString());
}

function clearCookie(){
delCookie(cookieNameOutletId);
}

function delCookie (NameOfCookie)
{if (getCookie(NameOfCookie)) {
document.cookie = NameOfCookie + "=" +
"; expires=Thu, 01-Jan-70 00:00:01 GMT";
}

}

function saveOutlet(outletId){
    if(!cookieEnabled){
        alert("Please enable your cookies");
        return;
    }
    var oldId=getCookie(cookieNameOutletId);
    var expireDays = 30;
    setCookie(cookieNameOutletId,outletId,expireDays);
    var ExpireDate = new Date ();
    ExpireDate.setTime(ExpireDate.getTime() + (expireDays * 24 * 3600 * 1000));
    setCookie("vervata_cart_outletID_Expire", ExpireDate.getTime(), 90);
}
