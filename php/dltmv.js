
            $(function(){
                $(document).on('click', '.link', function(e){
                    var elem = $(this);
        

                    var ajaxReq= $.ajax({
                                    type: "GET",
                                    url: "deletefrommov.php",
                                    data: "id="+elem.attr('movid')
                                }).fail(function(){
                                    elem.remove();
                                    
                                }).done(function(data){
                                 

                                   elem.closest("tr").remove();
                                });

                    return false;
                });
            });
      