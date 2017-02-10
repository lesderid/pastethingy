<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Paste;

use Pygmentize\Pygmentize;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class PasteController extends Controller
{
	public function create(Request $request)
	{
		//TODO: Input validation

		$paste = new Paste;
		$paste->id = Paste::create_id();
		$paste->created_at = $request->input('available_at', Carbon::now());
		$paste->expires_at = $this->calculate_expiry($request->input('expire_after', null), $paste->created_at);
		$paste->language = $request->input('language', 'text');
		$paste->save();
		$paste->content = $request->input('content');

		if($request->input('redirect',false))
		{
			return redirect(url("/paste/$paste->id"));
		}
		else
		{
			return response(url("/paste/$paste->id"))->header('Content-Type', 'text/plain');
		}
	}

	private static function calculate_expiry($expire_after, $available_at)
	{
		if($expire_after === null || $expire_after === "never")
		{
			return null;
		}
		else
		{
			return Carbon::parse($available_at)->copy()->addSeconds((int)$expire_after);
		}
	}

	public function view(Request $request, Paste $paste)
	{
		//TODO: Use HTTP content negotiation for the default format
		$userAgent = $request->header('User-Agent');
		if(substr($userAgent, 0, 4) == 'curl')
		{
			$format = $request->input('format', 'raw'); //default to raw format for curl
		}
		else
		{
			$format = $request->input('format', 'html'); //default to html format for other user agents
		}

		switch($format)
		{
			case 'html':
				return $this->view_html($paste);
			case 'raw':
				return $this->view_raw($paste);
			case 'json':
				return $this->view_json($paste);
			case 'latex':
				return $this->view_latex($paste);
			case 'png':
				return $this->view_png($paste);
			case 'terminal':
				return $this->view_terminal($paste);
			case 'irc':
				return $this->view_irc($paste);
			case 'terminal256':
				return $this->view_terminal256($paste);
			default:
				break; //TODO: Throw an exception
		}
	}

	private function view_html(Paste $paste)
	{
		if($paste->deleted)
		{
			return view('paste.deleted', [
				'id' => $paste->id,
				'deletion_reason' => $paste->deletion->reason,
				'deleted_by' => $paste->deletion->deleted_by,
				'deleted_at' => $paste->deletion->deleted_at
			]);
		}
		else if($paste->is_future_paste)
		{
			return view('paste.future_paste', [
				'id' => $paste->id,
				'available_at' => $paste->created_at
			]);
		}
		else if($paste->has_expired)
		{
			return view('paste.expired', [
				'id' => $paste->id
			]);
		}
		else
		{
			$content = Pygmentize::highlight($paste->content, $paste->language, "utf-8", "html");

			return view('paste.available', [
				'id' => $paste->id,
				'language' => $paste->language,
				'created_at' => $paste->created_at,
				'expires_at' => $paste->expires_at,
				'content' => $content	
			]);
		}
	}

	private function view_raw(Paste $paste)
	{
		//TODO: More informative messages
		if($paste->deleted)
		{
			response('This paste was deleted.')->header('Content-Type', 'text/plain');	
		}
		else if($paste->is_future_paste)
		{
			response('This paste is not available yet.')->header('Content-Type', 'text/plain');	
		}
		else if($paste->has_expired)
		{
			response('This paste has expired.')->header('Content-Type', 'text/plain');	
		}
		else
		{
			return response($paste->content)->header('Content-Type', 'text/plain');
		}
	}
	
	private function view_terminal(Paste $paste)
	{
		//TODO: More informative messages
		if($paste->deleted)
		{
			response('This paste was deleted.')->header('Content-Type', 'text/plain');	
		}
		else if($paste->is_future_paste)
		{
			response('This paste is not available yet.')->header('Content-Type', 'text/plain');	
		}
		else if($paste->has_expired)
		{
			response('This paste has expired.')->header('Content-Type', 'text/plain');	
		}
		else
		{
			$content = Pygmentize::highlight($paste->content, $paste->language, "utf-8", "terminal");

			return response($content)->header('Content-Type', 'text/plain');
		}
	}

	private function view_terminal256(Paste $paste)
	{
		//TODO: More informative messages
		if($paste->deleted)
		{
			response('This paste was deleted.')->header('Content-Type', 'text/plain');	
		}
		else if($paste->is_future_paste)
		{
			response('This paste is not available yet.')->header('Content-Type', 'text/plain');	
		}
		else if($paste->has_expired)
		{
			response('This paste has expired.')->header('Content-Type', 'text/plain');	
		}
		else
		{
			$content = Pygmentize::highlight($paste->content, $paste->language, "utf-8", "terminal256");

			return response($content)->header('Content-Type', 'text/plain');
		}
	}

	private function view_irc(Paste $paste)
	{
		//TODO: More informative messages
		if($paste->deleted)
		{
			response('This paste was deleted.')->header('Content-Type', 'text/plain');	
		}
		else if($paste->is_future_paste)
		{
			response('This paste is not available yet.')->header('Content-Type', 'text/plain');	
		}
		else if($paste->has_expired)
		{
			response('This paste has expired.')->header('Content-Type', 'text/plain');	
		}
		else
		{
			$content = Pygmentize::highlight($paste->content, $paste->language, "utf-8", "irc");

			return response($content)->header('Content-Type', 'text/plain');
		}
	}

	private function view_json(Paste $paste)
	{
		if($paste->deleted)
		{
			return response()->json([
				'id' => $paste->id,
				'deleted' => true,
				'deletion_reason' => $paste->deletion->reason,
				'deleted_by' => $paste->deletion->deleted_by,
				'deleted_at' => $paste->deletion->deleted_at
			]);
		}
		else if($paste->is_future_paste)
		{
			return response()->json([
				'id' => $paste->id,
				'deleted' => false,
				'future_paste' => true,
				'available_at' => $paste->created_at
			]);
		}
		else if($paste->has_expired)
		{
			return response()->json([
				'id' => $paste->id,
				'deleted' => false,
				'future_paste' => false,
				'expired' => true
			]);
		}
		else
		{
			return response()->json([
				'id' => $paste->id,
				'deleted' => false,
				'future_paste' => false,
				'expired' => false,
				'language' => $paste->language,
				'created_at' => $paste->created_at,
				'expires_at' => $paste->expires_at,
				'content' => $paste->content	
			]);
		}
	}	

	private function view_latex(Paste $paste)
	{
		//TODO: More informative messages (PNG?)
		if($paste->deleted)
		{
			response('\begin{Verbatim}
This paste was deleted.
\end{Verbatim}
')
					->header('Content-Type', 'text/plain');	
		}
		else if($paste->is_future_paste)
		{
			response('\begin{Verbatim}
This paste is not available yet.
\end{Verbatim}
')
					->header('Content-Type', 'text/plain');	
		}
		else if($paste->has_expired)
		{
			response('\begin{Verbatim}
This paste has expired.
\end{Verbatim}
')
					->header('Content-Type', 'text/plain');	
		}
		else
		{
			$content = Pygmentize::highlight($paste->content, $paste->language, "utf-8", "latex");

			return response($content)->header('Content-Type', 'text/plain');
		}
	}
	private function view_png(Paste $paste)
	{
		//TODO: More informative messages (PNG?)
		if($paste->deleted)
		{
			response('This paste was deleted.')->header('Content-Type', 'text/plain');	
		}
		else if($paste->is_future_paste)
		{
			response('This paste is not available yet.')->header('Content-Type', 'text/plain');	
		}
		else if($paste->has_expired)
		{
			response('This paste has expired.')->header('Content-Type', 'text/plain');	
		}
		else
		{
			$content = Pygmentize::highlight($paste->content, $paste->language, "utf-8", "png");

			return response($content)->header('Content-Type', 'image/png');
		}
	}
}
