<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=noto-sans-thai:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles

        <style>
            footer,header {
                font-size: 9px;
                color: #232323;
                text-align: center;
                width: 100%;
            }
            main{
                margin: 10px;
            }
            footer {
                position: fixed;
                bottom: 0;
            }
            header {
                position: fixed;
                top: 0;
            }

            @page {
                size: A4;
                margin: 10mm 10mm 10mm 10mm;
            }

            @media print {
                footer {
                    position: fixed;
                    bottom: 0;
                }
                header {
                    position: fixed;
                    top: 0;
                }

                .content-block, p {
                    page-break-inside: avoid;
                }

                html, body {
                    width: 210mm;
                    height: 297mm;
                }
            }

        </style>
    </head>
    <body class="font-sans antialiased">

        <div class="w-full text-right p-4 print:hidden">
            <x-button icon="printer" onclick="window.print();" class="py-1">print</x-button>

        </div>
        <div id="htmlPDF">


        <header class="hidden print:block">
            <span class="float-left flex w-32">
                <img src="{{asset('img/logo.png')}}" alt="">
            </span>

            <span class="float-right text-right">
                Printed by {{Auth::user()->name}} ( {{Auth::user()->staff_id}} )<br> Date : {{Carbon\Carbon::now()->toDateString()}}
            </span>
        </header>
        <main class="content-block">
            {{ $slot }}
        </main>
        <footer class="hidden print:block">
            <span class="float-left">
                @if (isset($name))
                    {{ $name }}
                @endif
            </span>

            <span class="float-right ">
                @if (isset($rev))
                    {{ $rev }}
                @endif
            </span>
        </footer>
        </div>
        @livewireScripts
    </body>
</html>
