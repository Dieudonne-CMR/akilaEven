<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>{{ $title ?? 'Notification' }}</title>
    <style>
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }
            .footer {
                width: 100% !important;
            }
        }
        
        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: none;
            width: 100% !important;
        }
        
        .wrapper {
            width: 100%;
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
        }
        
        .body {
            width: 100%;
            margin: 0;
            padding: 20px 0;
        }
        
        .inner-body {
            width: 570px;
            margin: 0 auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .content {
            margin-bottom: 30px;
        }
        
        .header {
            padding-bottom: 20px;
            border-bottom: 1px solid #e8eaed;
            margin-bottom: 20px;
        }
        
        .footer {
            width: 570px;
            margin: 0 auto;
            padding: 20px 0;
            text-align: center;
            color: #9ca3af;
            font-size: 12px;
        }
        
        h1 {
            color: #111827;
            font-size: 24px;
            font-weight: bold;
            margin-top: 0;
            margin-bottom: 15px;
        }
        
        p {
            margin-top: 0;
            color: #4b5563;
            line-height: 1.6;
            margin-bottom: 12px;
        }
        
        .button {
            display: inline-block;
            padding: 12px 24px;
            font-weight: 600;
            font-size: 14px;
            color: #ffffff;
            text-decoration: none;
            text-align: center;
            background-color: #4f46e5;
            border-radius: 4px;
            margin-right: 10px;
            margin-bottom: 10px;
        }
        
        .button-primary {
            background-color: #4f46e5;
        }
        
        .button-success {
            background-color: #10b981;
        }
        
        .button-danger {
            background-color: #ef4444;
        }
        
        .button-warning {
            background-color: #f59e0b;
        }
        
        .logo {
            max-height: 50px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="body">
            <div class="inner-body">
                <div class="header">
                    @if(isset($logo))
                        <img src="{{ $logo }}" alt="Logo" class="logo">
                    @else
                        <img src="{{ asset('images/logo.png') }}" alt="Akila Immo" class="logo">
                    @endif
                </div>
                
                <div class="content">
                    @yield('content')
                </div>
            </div>
            
            <div class="footer">
                <p>© {{ date('Y') }} Akila Immo. Tous droits réservés.</p>
                <p>Si vous n'êtes pas à l'origine de cette demande, veuillez ignorer cet email.</p>
            </div>
        </div>
    </div>
</body>
</html>
