<section class="popup-ad">
    <aside id="popup-ad" class="gam-aulv aulv-popup-ad">
        <!-- /21666183985/aulv/float-ad -->
        <div id='div-gpt-ad-1575955616703-0'>
        <script>
            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1575955616703-0'); });
        </script>
        </div>
        <span onclick="document.getElementById('popup-ad').style.display='none'" 
                class="ad-close-button2">&times;</span>
    </aside>
</section>
<section class="bfa">
    <aside id="bfa" class="gam-aulv aulv-bfa">
        <!-- /21666183985/aulv/aulv-bottom-fixed -->
        <div id='div-gpt-ad-1562633073617-0'>
            <script>
                googletag.cmd.push(function() { googletag.display('div-gpt-ad-1562633073617-0'); });
            </script>
        </div>
        <span onclick="document.getElementById('bfa').style.display='none'" 
                class="ad-close-button">&times;</span>
    </aside>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
   $(document).ready(function(){
        setTimeout(function(){
            document.getElementById("bfa").style.display = "none";
            document.getElementById("popup-ad").style.display = "initial";
        }, 5000);
        setTimeout(function(){
            document.getElementById("popup-ad").style.display = "none";
        }, 20000);
        if($(window).width() > 992 && $(window).height() < 768){
            $h=$(window).height()-32+'px';
            $('.aulv-popup-ad').css({"top": "32px", "transform": "translate(-50%, 0)", "height": $h,"overflow-y":"scroll"});
        }
    });
</script>