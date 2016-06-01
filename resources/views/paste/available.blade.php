<!DOCTYPE html>
<html>
    <head>
        <title>{{ $id }} &middot; pastethingy</title>

		<link href='https://fonts.googleapis.com/css?family=Roboto+Mono:400,300' rel='stylesheet' type='text/css'>

		<style>
			/* how do I CSS */		

			html, body {
				margin: 0 auto;
				font-family: 'Roboto Mono';
			}

			header {
				text-align: center;
				font-family: 'Roboto Mono';
				font-weight: 300;
				font-size: 12px;
				user-select: none;
				-webkit-user-select: none;
			}
			
			pre {
				margin: 0 0;
				white-space: pre-wrap;
				font-family: 'Roboto Mono';
				font-size: 10pt;
				font-weight: 400;
			}

			section {
				padding: 5px 5px;
				margin: 10px 10px;
				border: 1px solid #ccc;
				font-family: 'Roboto Mono';
				font-weight: 400;
			}

			footer {
				display: flex;
				justify-content: center;
				user-select: none;
				-webkit-user-select: none;
			}

			a {
				display: inline-block;
				align-self: flex-end;
				font-weight: 300;
				color: #555;
				margin-bottom: 0px;
			}

		</style>

		<link href="/pygments.css" rel="stylesheet">
    </head>
    <body>
		<header>
@if($expires_at !== null)
			{{ $id }} ({{ $language }}, expires at: {{ $expires_at }} UTC)
@else
			{{ $id }} ({{ $language }}, doesn't expire)
@endif
		</header>
		<section>
			{!! $content !!}
		</section>
		<footer>
			@foreach(array('raw', 'json', 'terminal', 'terminal256', 'png', 'latex', 'irc') as $format)
				<a href="?format={{$format}}">{{ $format }}</a>&nbsp;
			@endforeach
		</footer>
	</body>
</html>
