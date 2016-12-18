<!DOCTYPE html>
<html>
    <head>
        <title>{{ $id }} &middot; {{ config('app.name') }}</title>

		<link href='https://fonts.googleapis.com/css?family=Roboto+Mono:100,300' rel='stylesheet' type='text/css'>

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
			
			.deletion-reason {
				text-align: left;
                font-size: 24px;
                font-weight: 100;
				border: #ccc 1px solid;
				margin: 10px 20%;
				padding: 5px 5px;
            }

			.deleted-by, .deleted-at {
				font-weight: 300;
			}
        </style>
    </head>
    <body>
        <section>
            <div class="title">{{ $id }} was deleted on <span class="deleted-at">{{ $deleted_at }}</span> by <span class="deleted-by">{{ $deleted_by }}</span> with the following reason: </div>
			<br>
            <div class="deletion-reason">{!! nl2br(e($deletion_reason)) !!}</div>
        </section>
    </body>
</html>
