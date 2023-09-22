<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Translation App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,700;1,6..12,500&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: 'Nunito Sans', sans-serif;
            font-family: 'Open Sans', sans-serif;
        }
        .container{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 82vh;
            width: 100%;
        }
        form{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .left{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-right: 10px;
        }
        .right{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-right: 10px;
        }
        textarea{
            width: 100%;
            margin-top: 10px;
            padding: 17px;
            border-radius: 50px;
            border: 1px solid greenyellow;
            outline: none;
        }
        .formfirstcontainer{
            display: flex;
        }
        .formsecondcontainer{
            margin-top: 10px;
        }
        .formsecondcontainer button{
            padding: 10px 15px;
            border-radius: 50px;
            background-color: greenyellow;
            border: 1px solid greenyellow;
            transition: all 0.3s;
        }
        .formsecondcontainer button:hover{
            background-color: transparent;
        }
        #to, #from{
            padding: 10px;
            border-radius: 50px;
            border: 1px solid greenyellow;
            outline: none;
        }
        label{
            font-size: 30px;
            margin-bottom: 7px;
        }
        footer div{
            text-align: center;
            padding: 15px;
            background-color: rgb(224, 255, 176);
        }
        nav{
            padding: 15px;
            background-color: greenyellow;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            display: flex;
        }
        nav div{
            font-size: 20px;
        }
        .fa-solid{
            font-size: 30px;
            margin-right: 7px;
        }
        .about{
            font-size: 15px;
            margin-top: 5px;
            margin-left: 10px;
        }
        a{
            text-decoration: none;
            color: black;
        }
    </style>
  </head>
  <body>
    <nav>
        <i class="fa-solid fa-book"></i>
        <div>Translation App</div>
        <div class="about"><a href="/about">About This App</a></div>
    </nav>
    <div class="container">
        <form method="post">
            @csrf
            <div class="formfirstcontainer">
                <div class="left">
                    <label for="from"> From </label>
                    <select name="from" id="from">
                        @foreach($languages as $language)
                        <option value="{{$language->ShortCode}}" @if($language->ShortCode == 'en') selected @endif>{{$language->LanguageName}}</option>
                        @endforeach
                    </select>
                    <textarea name="translationtext" id="translationtext" rows="3" placeholder="Enter Text To Translate"></textarea>
                </div>
                <div class="right">
                    <label for="to"> To </label>
                    <select name="to" id="to">
                        @foreach($languages as $language)
                        <option value="{{$language->ShortCode}}" @if($language->ShortCode == 'hi') selected @endif>{{$language->LanguageName}}</option>
                        @endforeach
                    </select>
                    <textarea name="translatedtext" id="translatedtext" rows="3" placeholder="Translated Text"></textarea>
                </div>
            </div>
            <div class="formsecondcontainer">
                <button>Translate</button>
            </div>
        </form>        
    </div>
    <footer>
        <div>
            Copyright &copy; {{ date("Y") }} | Created By Rajan
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('form').on('submit', function(e) {
                // var from = $('#from').val();
                // var to = $('#to').val();
                // var translationtext = $('#translationtext').val();
                e.preventDefault();
                var formData = $('form').serialize(); 

                
                $.ajax({
                    method: 'POST',
                    url: '{{ route('translation') }}',
                    data: formData,

                    success: function(response) {
                        // Handle the response (e.g., update the result container)
                        $('#translatedtext').val(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle errors if necessary
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
  </body>
</html>