$(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
        var nextPage = parseInt($('#pageno').val())+1;
        $.ajax({
            type: 'POST',
            url: '/more-news',
            data: {
                pageno: nextPage
            },
            success: function(data){
                if(data != ''){                          
                    $('#post-data').append(data)
                    $('#pageno').val(nextPage)
                } else {                                 
                   $("#newsLoader").hide()
                }
            }
        })
    }
});
