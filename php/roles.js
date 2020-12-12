$(function(){
                $(document).on('click', '.role', function(e){
           
                    e.preventDefault();
                    var elem = $(this);
              

                    var ajaxReq= $.ajax({
                                    cache: false,
                                    type: "get",
                                    url: "changeRole.php",
                                    data: {
                                            usrid: usrid,
                                            bool: bool
                                            },
                                }).fail(function(){
                                    elem.remove();
                                    alert("fail");
                                }).done(function(data){
                                    
                                   
                                    $('#moviestable').load('owner.php' + ' #moviestable');
                                   
                                   
                                });

                    return false;
                });
            });
