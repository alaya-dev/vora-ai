<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('email_reset.subject') }}</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f8fafc;
            color: #334155;
            margin: 0;
            padding: 0;
            width: 100% !important;
            -webkit-text-size-adjust: none;
            -ms-text-size-adjust: none;
        }
        .wrapper {
            background-color: #f8fafc;
            padding: 40px 20px;
        }
        .container {
            max-width: 570px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            border: 1px border #e2e8f0;
        }
        .header {
            background-color: #0b122c;
            padding: 24px 32px;
            text-align: center;
        }
        .logo-text {
            color: #ffffff;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 0.5px;
            text-decoration: none;
        }
        .logo-highlight {
            color: #10b981;
        }
        .content {
            padding: 40px 32px;
            direction: {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }};
            text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};
        }
        h1 {
            font-size: 18px;
            font-weight: 700;
            color: #0b122c;
            margin-top: 0;
            margin-bottom: 24px;
        }
        p {
            font-size: 15px;
            line-height: 1.6;
            color: #475569;
            margin-top: 0;
            margin-bottom: 24px;
        }
        .button-container {
            margin: 32px 0;
            text-align: center;
        }
        .button {
            display: inline-block;
            background-color: #10b981;
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 30px;
            font-size: 15px;
            font-weight: 700;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.15);
            text-align: center;
        }
        .button:hover {
            background-color: #0d9488;
        }
        .footer {
            background-color: #f1f5f9;
            padding: 24px 32px;
            border-top: 1px solid #e2e8f0;
            font-size: 12px;
            color: #64748b;
            direction: {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }};
            text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};
        }
        .trouble-link {
            word-break: break-all;
            color: #10b981;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            background-color: #f8fafc;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            display: block;
            margin-top: 10px;
        }
        .copyright {
            margin-top: 24px;
            text-align: center;
            font-size: 11px;
            color: #94a3b8;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <!-- Header/Branding -->
            <div class="header">
                <a href="{{ url('/') }}" class="logo-text">
                    VORA <span class="logo-highlight">AI</span>
                </a>
            </div>

            <!-- Content -->
            <div class="content">
                <h1>{{ __('email_reset.greeting') }}</h1>
                
                <p>{{ __('email_reset.intro') }}</p>

                <div class="button-container">
                    <a href="{{ $url }}" class="button" target="_blank" rel="noopener">
                        {{ __('email_reset.action') }}
                    </a>
                </div>

                <p>{{ __('email_reset.expiry', ['count' => $count]) }}</p>
                <p>{{ __('email_reset.outro') }}</p>

                <p style="margin-bottom: 0;">
                    {{ __('email_reset.regards') }}<br>
                    <strong>Vora AI Team</strong>
                </p>
            </div>

            <!-- Troubleshooting & Footer -->
            <div class="footer">
                <p style="margin-bottom: 0; font-size: 12px;">
                    {{ __('email_reset.trouble', ['action' => __('email_reset.action')]) }}
                    <span class="trouble-link">{{ $url }}</span>
                </p>
                
                <div class="copyright">
                    &copy; {{ date('Y') }} Vora AI. {{ __('landing.footer_desc') }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>
