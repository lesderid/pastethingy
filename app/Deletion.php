<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deletion extends Model
{
	public $timestamps = false;

	public function paste()
	{
		return $this->belongsTo(Paste::class);
	}
}
