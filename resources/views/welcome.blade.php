<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>
    <center>
        <div id="message"></div>
        <form id="addpost" action="{{route('ajaxupload')}}" method="post">
            @csrf
            <div><br><br>
                <label for="">Title</label>
                <input type="text" name="title">
            </div><br><br>
            <div>
                <label for="">Description</label>
                <input type="text" name="description">
            </div><br><br>
            <div>
                <input type="submit" value="Add">
            </div>
        </form>

    </center>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#addpost').on('submit', function(event) {
                event.preventDefault();
                
                jQuery.ajax({
                    url: "{{route('ajaxupload')}}",
                    data: jQuery('#addpost').serialize(),
                    type: "post",

                    success: function(result){
                        $('#message').css('display','block');
                        jQuery('#message').html(result.message);
                        jQuery('#addpost')[0].reset();
                    }

                });
            });
        });
    </script>
</body>
</html>