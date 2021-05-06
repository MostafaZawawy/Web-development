<!DOCTYPE html>
<html>
<head>
    <title> Lab4 by zazy</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
    <link href="main.css" rel="stylesheet" />

    </head>
<body>
<div class="s010 ">
    <form>
        <div class="inner-form">
            <div class="basic-search">
                <div class="input-field">
                    <input type="text" name="search_text" id="search_text" placeholder="Search" class="form-control "/>
            </div>
        </div>
    </form>
    <br /><br />
    <div class="styled-table table-responsive" id="pagination_data">
    </div>
</div>
</body>
</html>
<script>
    $(document).ready(function(){
        load_data(1);
        function load_data(page, query='')
        {
            $.ajax({
                url:"pagination.php",
                method:"POST",
                data:{page:page,query:query},
                success:function(data){
                    $('#pagination_data').html(data);
                }
            });
        }

        $(document).on('click', '.pagination_link', function(){
            var page = $(this).data('page_number');
            var query = $('#search_text').val();


            load_data(page, query);
        });
        $('#search_text').keyup(function(){
            var query = $('#search_text').val();
            if(query.length>=3)
            load_data(1, query);
             else{
                load_data(1);
             }
        });
    });
</script>