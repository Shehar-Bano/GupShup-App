@vite('resources/js/app.js')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Interface</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Styles omitted for brevity */
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        Chat - Welcome, <span id="username">{{$username}}</span>!
                    </div>
                    <div class="card-body">
                        <div class="chat-box" id="messages">
                            <!-- Chat messages omitted for brevity -->
                        </div>
                        <div class="message-input d-flex">
                            <input type="text" class="form-control me-2" id="messageInput" placeholder="Type your message here...">
                            <button class="btn btn-primary" type="button" onclick="SendMsg()">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"
    integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

    <!-- Ensure SendMsg is defined globally -->
    <script>
        function SendMsg() {
            let sender = "{{ $username }}"
            let csrfToken = "{{ csrf_token() }}"
            let message = messageInput.value
            $.ajax({
                url: "{{ route('sent.message') }}",
                type: "POST",
                data: {
                    sender: sender,
                    message: message,
                    _token: csrfToken
                },
                success: function(response) {
                    $("#messages").append(`
                       <div>
                           <strong>You:</strong> ${response.message}
                       </div>
                    `)
                    messageInput.value=''
                },

                error: function(response) {
                    // console.error('Error sending message')
                }
            })
        }

        window.onload=()=> {
    window.Echo.channel('user-message').listen('MessageSent', function(data) {
        console.log(data);  // Fix typo here

        if(data.sender !== "{{ $username }}") {
            $("#messages").append(`
            <div>
                <strong>${data.sender}</strong> ${data.message}
            `)
        }
    })
}
    </script>
</body>
</html>
