<!DOCTYPE html>
<html>
    <head>
        <title>{{ $id }} &middot; pastethingy</title>

		<link href="https://fonts.googleapis.com/css?family=Lato:300" rel="stylesheet" type="text/css">
		<link href='https://fonts.googleapis.com/css?family=Fira+Mono|Roboto+Mono:400,300' rel='stylesheet' type='text/css'>

		<style>
			/* how do I CSS */		

			html, body {
				height: 100%;
				margin: 0 auto;
				font-family: 'Roboto Mono';
			}

			body {
				width: 99%;
				display: flex;
				flex-flow: column;
			}

			header {
				text-align: center;
				font-family: 'Roboto Mono';
				font-weight: 300;
				font-size: 12px;
				margin-bottom: 5px;
			}
			
			pre {
				margin: 0 0;
				white-space: pre-wrap;
			}

			section {
				padding: 5px 5px;
				margin: 3px 3px;
				border: 1px solid #ccc;
			}
		</style>

		<link href="/pygments.css" rel="stylesheet">
    </head>
    <body>
		<header>
			{{ $id }} (language: {{ $language }}, expires at: {{ $expires_at }} UTC)
		</header>
		<section>
			{!! $content !!}
		</section>
	</body>
</html>
