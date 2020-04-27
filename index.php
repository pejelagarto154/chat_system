<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script
        src="https://code.jquery.com/jquery-3.5.0.js"
        integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc="
        crossorigin="anonymous"></script>
</head>
<body>

    <div id="wrapper">
    <h1>Welcome to my Chat</h1>
        <div class="chat_wrapper">
            <div id="abc"></div>
            <div id="chat"></div>
            <form method="post" id="messageFrm">
                <textarea name="message" id="message" cols="30" rows="7" class="textarea" placeholder="Please Type a message to send"></textarea>
            </form>
            
        </div>

    </div>

    <script>
        LoadChat();

        setInterval(function()  {
            LoadChat();
        }, 1000);
        function LoadChat(){
            $.post('handlers/message.php?action=getMessage',function(response){
                var scrollpos=$('#chat').scrollTop();
                var scrollpos=parseInt(scrollpos)+520;
                var scrollHeight=$('#chat').prop('scrollHeight');

                 $('#chat').html(response);
                if(scrollpos<scrollHeight){

                }else{
                    $('#chat').scrollTop($('#chat').prop('scrollHeight'));
                }

            });
        }

        $('.textarea').keyup(function(e){
            if(e.which==13){
                $('form').submit();
            }
        });

        $('form').submit(function(){
            var message=$('.textarea').val();
            $.post('handlers/message.php?action=sendMessage&message='+message,function(response){
                if(response==1){
                    LoadChat();
                    document.getElementById('messageFrm').reset();
                }
            });
            return false;
        });
    </script>
</body>
</html>