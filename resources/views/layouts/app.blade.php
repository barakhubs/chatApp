
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>ChatApp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>

    @livewireStyles
</head>
<body>
<main class="content">
    @yield('content')
</main>

<style type="text/css">
body{
    margin-top:20px;
    margin-bottom: 20px;
}

.chat-online {
    color: #34ce57;
    font-size: 10px;
}

.chat-offline {
    color: #e4606d;
    font-size: 10px;
}

.chat-messages {
    display: flex;
    flex-direction: column;
    max-height: 450px;
    overflow-y: scroll
}

.chat-members{
    display: flex;
    flex-direction: column;
    max-height: 300px;
    overflow-y: scroll
}

.chat-members::-webkit-scrollbar
 {
     background-color: #e6e6e6;
     width: 2px;
 }

.chat-box {
    min-height: 300px;
}

.chat-messages::-webkit-scrollbar
 {
     background-color: #e6e6e6;
     width: 2px;
 }

.chat-message-left,
.chat-message-right {
    display: flex;
    max-width: 60%;
    min-width: 40%;
    font-size: 12px;
}

.chat-message-left {
    margin-right: auto
}

.chat-message-right {
    flex-direction: row-reverse;
    margin-left: auto
}
.py-3 {
    padding-top: 1rem!important;
    padding-bottom: 1rem!important;
}
.px-4 {
    padding-right: 1.5rem!important;
    padding-left: 1.5rem!important;
}
.flex-grow-0 {
    flex-grow: 0!important;
}
.border-top {
    border-top: 1px solid #dee2e6!important;
}

.icon {
    font-size: 11px;
}
</style>

<script>
        function myFunction() {
          $('#content_to_scroll').animate({scrollTop: $('#content_to_scroll').prop("scrollHeight")}, 500);
        }
</script>

@livewireScripts

@toastr_js
    @toastr_render
    <script>
        window.addEventListener('alert', event => {
                    toastr[event.detail.type](event.detail.message,
                    event.detail.title ?? ''), toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                    }
                });
    </script>
</body>
</html>
