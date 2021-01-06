<!-- BEGIN: Social Network -->
<div class="mt-4">
    <div class="pull-left">
        <div id="fb-root"></div>
        <script>(function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.6";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
        <div class="fb-like"
             data-href="{{ 'http://' . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"] }}"
             data-layout="button" data-action="like" data-show-faces="true"
             data-share="true"></div>
    </div>
    <div class="pull-left" style="margin:3px">
        <script src="https://apis.google.com/js/platform.js" async defer>
            {
                lang: 'vi'
            }
        </script>
        <div class="g-plusone" data-size="medium" data-annotation="none"></div>
    </div>
</div>
<!-- END: Social Network -->
<div class="clearfix"></div>
<!-- Comment -->
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.6";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-comments"
     data-href="{{ 'http://' . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"] }}"
     data-width="100%"
     data-numposts="5"></div>
<!-- END: Comment-->