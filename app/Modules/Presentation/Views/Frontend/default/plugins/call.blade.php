<style type="text/css">
    .animated {
        -webkit-animation-duration: 1s;
        -moz-animation-duration: 1s;
        -o-animation-duration: 1s;
        animation-duration: 1s;
        -webkit-animation-fill-mode: both;
        -moz-animation-fill-mode: both;
        -o-animation-fill-mode: both;
        animation-fill-mode: both;
    }

    .alo-circle {
        animation-iteration-count: infinite;
        animation-duration: 1s;
        animation-fill-mode: both;
        animation-name: zoomIn;
        width: 50px;
        height: 50px;
        top: 10px;
        right: -5px;
        position: absolute;
        background-color: transparent;
        -webkit-border-radius: 100%;
        -moz-border-radius: 100%;
        border-radius: 100%;
        border: 2px solid rgba(30, 30, 30, 0.4);
        opacity: .1;
        border-color: #3aac0b;
        opacity: .5;
    }

    .alo-circle-fill {
        animation-iteration-count: infinite;
        animation-duration: 1s;
        animation-fill-mode: both;
        animation-name: pulse;
        width: 60px;
        height: 60px;
        top: 5px;
        right: -10px;
        position: absolute;
        -webkit-transition: all 0.2s ease-in-out;
        -moz-transition: all 0.2s ease-in-out;
        -ms-transition: all 0.2s ease-in-out;
        -o-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
        -webkit-border-radius: 100%;
        -moz-border-radius: 100%;
        border-radius: 100%;
        border: 2px solid transparent;
        background-color: rgb(48, 168, 12);
        opacity: .75;
    }
</style>
<div style="position:fixed; right:20px; bottom:25%; z-index:1000">
    <a class="mb-1 pl-4 py-2 color-white font-size-1d3 rounded-right text-center" href="tel:0905123456"
       style="position:relative">
        <span class="font-size-2" style="position:relative;z-index:1;left:-4px;top:20px"><i class="fas fa-phone-alt"></i></span>
        <span class="animated alo-circle">&nbsp;</span> <span class="animated alo-circle-fill"></span>
    </a>
</div>
