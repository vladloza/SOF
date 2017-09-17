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
                $("#content").append(data);       
            });
        }
    });
}); 