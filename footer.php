<?php
 
$output = '<footer class="center-text">
        <p>© Факультет інформаційних технологій КНУ імені Тараса Шевченка, 2017</p>
      </footer>
<div class="clear"> 
</div>
<script>

fixBrokenImages = function( url ){
    var img = document.getElementsByTagName("img");
    var i=0, l=img.length;
    for(;i<l;i++){
        var t = img[i];
        if(t.naturalWidth === 0){
            //this image is broken
            t.src = url;
        }
    }
}
 window.onload = function() {
    fixBrokenImages("img/default.jpg");
 };
</script>
</body>
</html>';

echo $output;

?>