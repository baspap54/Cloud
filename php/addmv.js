/*
        
        $(document).ready(function(){
                $(document).on('click', '#btnsubmit', function(e){
                //$('#btnsubmit').click(function(e){
                    e.preventDefault();
                    $.post("addMovie.php",
                        {
                            titleId: $('#titleId').val(),
                            categoryId: $('#categoryId').val(),
                            startId: $('#startId').val(),
                            endId: $('#endId').val()
                        },
                        function(data){
                            $('#moviestable').load('owner.php' + ' #moviestable');
                        }
                        );
                    });
                });
                
*/
    
            $(function(){
                $(document).on('click', '#btnsubmit', function(e){
           
                    e.preventDefault();
                    var elem = $(this);
              

                    var ajaxReq= $.ajax({
                                    cache: false,
                                    type: "post",
                                    url: "addMovie.php",
                                    data: {
                                            titleId: $('#titleId').val(),
                                            categoryId: $('#categoryId').val(),
                                            startId: $('#startId').val(),
                                            endId: $('#endId').val()
                                            },
                                }).fail(function(){
                                    elem.remove();
                                    alert("fail");
                                }).done(function(data){
                                    //alert("done");
                                    // $(this).closest('tr').remove();
                                    //ocation.reload ()
                                   
                                    $('#moviestable').load('owner.php' + ' #moviestable');
                                   
                                   
                                });

                    return false;
                });
            });
