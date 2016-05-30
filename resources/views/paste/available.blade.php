<!DOCTYPE html>
<html>
    <head>
        <title>{{ $id }} &middot; pastethingy</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                display: table-cell;
            }

            .content {
                display: inline-block;
            }

            .title {
                text-align: center;
                font-size: 96px;
            }
		</style>

		<link href="/pygments.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="content">
				<div class="title">pastethingy</div>
				<div class="paste">
				{!! $content !!}
				</div>
            </div>
        </div>
    </body>
</html>
