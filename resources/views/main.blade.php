<!DOCTYPE html>
<html>
	<head>
		<title>{{ config('app.name') }}</title>

		<link href='https://fonts.googleapis.com/css?family=Roboto+Mono:400,300' rel='stylesheet' type='text/css'>

		<style>
			/* how do I CSS */

			html, body {
				height: 100%;
				margin: 0 auto;
				font-family: 'Roboto Mono';
			}

			body {
				width: 80%;
				display: flex;
				flex-flow: column;
			}

			header {
				text-align: center;
				font-family: 'Roboto Mono';
				font-weight: 300;
				font-size: 24px;
			}

			footer {
				min-height: 35px;
				display: flex;
				justify-content: center;
			}

			.footer, a, p {
				display: inline-block;
				align-self: flex-end;
				font-weight: 300;
				color: #555;
				margin-bottom: 0px;
			}

			section, form {
				height: 100%;
				display: flex;
				flex-direction: column;
			}

			input, select, textarea, div, label {
				margin: 5px 0px;
			}

			.input-box-container {
			    display: flex;
   				justify-content: space-between;
				flex-wrap: wrap;
				margin: 0 0;
			}

			label {
				font-size: 12px;
				font-weight: 400;
			}

			textarea {
				height: 100%;
				resize: none;
				border: #ccc 1px solid;
				outline: none;
				padding: 5px 5px;
				font-family: 'Roboto Mono';
				font-weight: 400;
			}
		</style>
		@if($js)
			<script>
				window.onload = function() {
					document.querySelector("textarea").addEventListener('keydown',function(e) {
						if(e.keyCode === 9) { //tab
							var start = this.selectionStart;
							var end = this.selectionEnd;

							var target = e.target;
							var value = target.value;

							target.value = value.substring(0, start)
								+ "\t"
								+ value.substring(end);

							this.selectionStart = this.selectionEnd = start + 1;

							e.preventDefault();
						}
					},false);
				};
			</script>
		@endif
	</head>
	<body>
			<header>{{ config('app.name') }}</header>

			<section>
				<form action="/paste" method="post">
					<div class="input-box-container">
						<div>
							<label for="language">Language:</label>
							<select id="language" name="language">
								<option value="text">Text</option>
								<option value="irc">IRC logs</option>
								<option value="shell-session">Shell session</option>
								<option value="apacheconf">ApacheConf (e.g apache2.conf, .htaccess)</option>
								<option value="bash">Bash</option>
								<option value="batch">Batchfile</option>
								<option value="bbcode">BBCode</option>
								<option value="brainfuck">Brainfuck</option>
								<option value="c">C</option>
								<option value="cpp">C++</option>
								<option value="csharp">C#</option>
								<option value="crystal">Crystal</option>
								<option value="css">CSS</option>
								<option value="d">D</option>
								<option value="diff">Diff/Patch</option>
								<option value="fish">Fish</option>
								<option value="go">Go</option>
								<option value="haskell">Haskell</option>
								<option value="hexdump">Hexdump</option>
								<option value="html">HTML</option>
								<option value="http">HTTP</option>
								<option value="ini">INI</option>
								<option value="java">Java</option>
								<option value="js">JavaScript</option>
								<option value="json">JSON</option>
								<option value="kotlin">Kotlin</option>
								<option value="llvm">LLVM</option>
								<option value="lua">Lua</option>
								<option value="makefile">Makefile</option>
								<option value="md">Markdown</option>
								<option value="nginx">Nginx configuration file</option>
								<option value="perl">Perl</option>
								<option value="perl6">Perl 6</option>
								<option value="php">PHP</option>
								<option value="powershell">PowerShell</option>
								<option value="prolog">Prolog</option>
								<option value="python">Python 2</option>
								<option value="python3">Python 3</option>
								<option value="sql">SQL</option>
								<option value="postgresql">SQL (PostgreSQL dialect)</option>
								<option value="mysql">SQL (MySQL dialect)</option>
								<option value="rust">Rust</option>
								<option value="swift">Swift</option>
								<option value="tex">TeX/LaTeX</option>
								<option value="vim">VimL</option>
								<option value="vbnet">Visual Basic .NET</option>
								<option value="xml">XML</option>
								<option value="yaml">YAML</option>
							</select>
						</div>
						<div>
							<label for="available_at">Available at:</label>
							<input id="available_at" name="available_at" value="{{ Carbon\Carbon::now()->format('Y-m-d H:i') }}" type="text">
						</div>
						<div>
							<label for="expire_after">Expire:</label>
							<select id="expire_after"  name="expire_after">
								<option value="never">Never</option>
								<option value="10">After 10 seconds</option>
								<option value="60">After 1 minute</option>
								<option value="180">After 3 minutes</option>
								<option value="300">After 5 minutes</option>
								<option value="600">After 10 minutes</option>
								<option value="1800">After 30 minutes</option>
								<option value="3600">After 1 hour</option>
								<option value="43200">After 12 hours</option>
								<option value="86400">After 1 day</option>
								<option value="604800">After 1 week</option>
								<option value="1209600">After 2 weeks</option>
								<option value="2635200">After 1 month</option>
								<option value="15811200">After 6 months</option>
								<option value="31557600">After 1 year</option>
							</select>
						</div>
					</div>
					<textarea name="content"></textarea>
					<input type="submit" value="Paste">
					<input type="hidden" name="redirect" value="1">
				</form>
			</section>
			<footer>
				<div class="footer"> {{-- TODO: Fix this hack --}}
					@if($js)
						<a href="/">No JS version</a>
					@else
						<a href="/?js=1">Tab key support (requires JS)</a>
					@endif
					<p>&middot; <a href="{{ config('app.repo') }}">Source code</a></p>
					<p>&middot; <a href="mailto:{{ config('app.abusecontact') }}">Report abuse</a></p>
					<p>&middot; <a href="{{ config('app.parenturl') }}">{{ config('app.parentname') }}</a></p>
					<p>&middot; Dates and times are UTC.</p>
				</div>
			</footer>
	</body>
</html>
