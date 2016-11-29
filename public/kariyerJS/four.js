
$(document).ready(function () { 
    window.fbAsyncInit = function () {
    FB.init({        
        appId:$('#hdnFacebookAppId').val(), // App ID
        channelUrl: '//localhost/kariyerim/channel.html', // Channel File
        status: true, // check login status
        cookie: true, // enable cookies to allow the server to access the session
        xfbml: true,  // parse XFBML
        perms: 'birthday'
    });


    // Additional init code here

};

// Load the SDK Asynchronously
(function (d) {
    var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    if (d.getElementById(id)) { return; }
    js = d.createElement('script'); js.id = id; js.async = true;
    js.src = "//connect.facebook.net/en_US/all.js";
    ref.parentNode.insertBefore(js, ref);
}(document));

});
function facebooklogin(yon) {
    var backtopage = 0; 
    var kepValue = 0;
    var site = 0;
    if (yon == 1)
    {
        if (window.location != null && window.location.pathname != null && window.location.pathname != '') {
            var ilanmi = window.location.pathname.match('^(.+)/(.+)-is-ilani-i([0-9]+)/?(.+)');
            if ((ilanmi != null && ilanmi != '' && ilanmi.length > 0) || window.location.pathname.toLowerCase().indexOf('')) {
                site = 1;
                if (yon == 1)
                    backtopage = 2;
                else
                    backtopage = 1;
            } else {
                site = 2;
                ilanmi = window.location.pathname.match('is-ilani/(.+)-([0-9]+)/?(.+)');
                var ilanmi1 = window.location.pathname.match('is-ilani/(.+)-([0-9]+)');
                if ((ilanmi != null && ilanmi != '' && ilanmi.length > 0) || (ilanmi1 != null && ilanmi1 != '' && ilanmi1.length > 0) || window.location.pathname.toLowerCase().indexOf('')) {
                    if (yon == 1)
                        backtopage = 2;
                    else
                        backtopage = 1;
                }
            }
        }
    }
    else if (yon == 2)
        backtopage = 1;
    else if(yon == 3)//kep facebook login
    {
        backtopage = 3;
        kepValue=1;
    }
    else
        backtopage = 0;

    var cb = function (response) {
        
        $.ajax({
            type: 'POST',
            url: '/website/kariyerim/fblogin.aspx/Login',
            data: "{ 'uid': '" + response.authResponse.userID + "', 'token': '" + response.authResponse.accessToken + "','kepVal':'"+kepValue+"'}",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (result) {
                if (response.status === 'connected') {
                    if (result.d == '0') { document.location.href = '/index.aspx?err=fblogin'; }
                    else if (result.d == '1') {
                        if (backtopage == 1)
                            window.location.reload();
                        else if (backtopage == 2) {
                            if (site == 1)
                                ilanaBasvur();
                            else if (site == 2)
                                jobApply($('#hdnJobId').val(), $('#hdnActivation').val() == "true", $('#hdnAreaText').val());
                        }
                        else if (backtopage == 3)
                            window.location.reload();
                        else
                            document.location.href = '/website/kariyerim/index.aspx'; 

                    }
                    else if (result.d == '4') { document.location.href = '/website/kariyerim/index.aspx?Come=fb';} 
                    else if (result.d == '2') {
                        if (backtopage == 3)
                        {
                            document.location.href = '/website/kariyerim/fbLogin.aspx?Act=fbkep&Id=' + response.authResponse.userID + '&token=' + response.authResponse.accessToken;
                            dataLayer.push({ 'pageView': '/vp/yeni_uyelik_KEPfacebook', 'event': 'virtualPageView' });
                        }
                        else {
                        document.location.href = '/website/kariyerim/fbLogin.aspx?Act=fb&Id=' + response.authResponse.userID + '&token=' + response.authResponse.accessToken;
                        dataLayer.push({ 'pageView': '/vp/yeni_uyelik_ozgecmis_facebook', 'event': 'virtualPageView' });
                         }
                    }
                    else if (result.d == '5') { alert("Sistem bir sorun ile karşılaştı.Lütfen daha sonra tekrar deneyiniz."); }
                    else { document.location.href = '/?err=fblogin'; alert("Sistem bir sorun ile karşılaştı.Lütfen daha sonra tekrar deneyiniz."); } //CAB:Anasayfa için yönlendirme değiştiriliyor. document.location.href = 'index.aspx/?err=fblogin';
                    
                } else {
                    alert("User is logged out");
                    // Log.info('User is logged out');
                }
            }
        })
    }
    FB.login(cb, { scope: 'user_birthday,email,user_education_history,user_hometown,user_location,user_photos,user_website,user_work_history' });
}
