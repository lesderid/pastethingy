<!DOCTYPE html>
<html>
    <head>
        <title>{{ $id }} &middot; {{ config('app.name') }}</title>

		<link href='https://fonts.googleapis.com/css?family=Roboto+Mono:100' rel='stylesheet' type='text/css'>

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-family: 'Roboto Mono';
            }

            section {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .title {
                font-size: 48px;
                font-weight: 100;
            }
        </style>
    </head>
    <body>
        <section>
            <div class="title">{{ $id }} is not available yet.</div>
        </section>
    </body>
</html>
