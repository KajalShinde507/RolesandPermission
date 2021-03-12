<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>welcome</title>
</head>
<body>
    
@if (session('status'))
                          <div class="alert alert-success">
                                    {{ session('status') }}
                                       </div>
                                            @endif
                                     @if (session('warning'))
                              <div class="alert alert-warning">
                                 {{ session('warning') }}
                                          </div>
                                      @endif


<h1<b>Thank you for registration....!</b><h1>

        <b> Please check your email.To activate your account...</b>

</body>
</html>



