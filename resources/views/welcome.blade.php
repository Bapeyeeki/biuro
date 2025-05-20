<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Biuro - ArrisAgency</title>
    @vite('resources/js/app.js')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Nadpisanie stylów ikon */
        svg.h-3, svg.h-4, svg.h-5, svg.h-6, svg.h-8, svg.h-10 {
            width: 12px !important;
            height: 12px !important;
        }
        
        /* Naprawienie białych pasków na przyciskach i formularzach */
        input, button, select, textarea {
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            outline: none !important;
            box-shadow: none !important;
            border-radius: 0.375rem !important;
        }
        
        input[type="date"], input[type="text"], input[type="email"], input[type="tel"] {
            background-color: #1f2937 !important;
            color: white !important;
            border: 1px solid #374151 !important;
        }
        
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
        }
        
        /* Style dla przycisków */
        button {
            background-color: #1f2937 !important;
            border: 1px solid #374151 !important;
            color: white !important;
        }
    </style>
</head>
<body class="bg-black">
    <div id="app"></div>
</body>
</html>