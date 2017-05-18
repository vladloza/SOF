$(document).ready(function(){
    var inProgress = false;
    var startFrom = 5;
    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() >= $(document).height() - 20 && !inProgress) {
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
                            var image = 'img/default.jpg';
                            if (data[5]) {image = 'data:image;base64, '+data[5];}
                            var text = data[2];
                            var news = "<article class='clearfix'><div class='image-container'><img src='"+image+"'/></div><div class='body-container clearfix'><header class='entry-header'>";
                            if (data[6]) {
                                news += "<div class='entry-admin'><a href='editnews.php?id="+data[0]+"'>Редагувати</a> | <a href='?des=del&id="+data[0]+"'>Видалити</a></div>";
                            }
                            news += "<h2 class='entry-title'><a href='item.php?id="+data[0]+"'>"+data[1]+"</a></h2></header><div class='entry-summary'><div class='entry-summary-body'>"+text+"...</div><span class='read-more'><a href='item.php?id="+data[0]+"'>Read more</a></span></div></div></article>";
                            $("#content").append(news);
                        });
                        inProgress = false;
                        startFrom += 5;
                    }
            });
        }
    });
}); 