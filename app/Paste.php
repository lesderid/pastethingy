<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paste extends Model
{
	public $incrementing = false;
	public $timestamps = false;

	public function deletion()
	{
		return $this->hasOne(Deletion::class);
	}

	public function isDeleted()
	{
		return $this->deletion !== null;
	}

	public function soft_delete($reason, $deleted_by)
	{
		if($this->isDeleted())
		{
			return false;
		}

		$deletion = new Deletion;
		$deletion->reason = $reason;
		$deletion->deleted_by = $deleted_by;
		$deletion->deleted_at = Carbon::now();

		$this->deletion()->save($deletion);

		return true;
	}
}
