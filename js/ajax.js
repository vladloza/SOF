$(document).ready(function(){

var inProgress = false;
var startFrom = 5;
    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() >= $(document).height() - 200 && !inProgress) {
            $.ajax({
                url: 'refreshnews.php',
                method: 'POST',
                data: {"startFrom" : startFrom},
                beforeSend: function() {
                inProgress = true;}
                }).done(function(data){
                    data = jQuery.parseJSON(data);
                    if (data.length > 0) {
                        $.each(data, function(index, data){
                            var news = "<article class='clearfix'><div class='image-container'><img src='data:image;base64, "+data[5]+"'/></div><div class='body-container clearfix'><header class='entry-header'><div class='entry-admin'><a href='editnews.php?id="+data[0]+"'>Редагувати</a> | <a href='?des=del&id="+data[0]+"'>Видалити</a></div><h2 class='entry-title'><a href='item.php?id="+data[0]+"'>"+data[1]+"</a></h2></header><div class='entry-summary'><p>"+$('<p/>').html(data[2]).text()+"<span class='read-more'><a href='item.php?id="+data[0]+"'>Read more</a></span></p></div></div></article>";
                            $("#content").append(news);
                        });
                        var img = document.getElementsByTagName("img");
                        var i=0, l=img.length;
                        for(;i<l;i++){
                            var t = img[i];
                            if(t.naturalWidth === 0){
                                t.src = 'img/default.jpg';
                            }
                        }
                        inProgress = false;
                        startFrom += 5;
                    }
            });
        }
    });
});