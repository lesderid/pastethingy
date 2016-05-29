<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use Storage;

class Paste extends Model
{
	public $incrementing = false;
	public $timestamps = false;

	public static function create_id()
	{
		//TODO: Check if id is unique

		$characters = 'abcdefghijklmnopqrstuvwxyz';

		$id = '';
		for($i = 0; $i < 6; $i++) //TODO: Make id length configurable (?)
		{
			$id .= $characters[rand(0, strlen($characters) -1)];
		}

		return $id;
	}

	public function deletion()
	{
		return $this->hasOne(Deletion::class);
	}

	public function soft_delete($reason, $deleted_by)
	{
		if($this->deleted)
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

	public function try_hard_delete()
	{
		if(Storage::disk('ephemeral')->exists($this->id) && $this->has_expired)
		{
			Storage::disk('ephemeral')->delete($this->id);
		}
	}

	public function getDeletedAttribute()
	{
		return $this->deletion !== null;
	}

	public function getExpiresAttribute()
	{
		return $this->expires_at !== null;
	}

	public function getHasExpiredAttribute()
	{
		return $this->expires && $this->expires_at < Carbon::now();
	}

	public function getIsFuturePasteAttribute()
	{
		return $this->created_at > Carbon::now();
	}

	public function getContentAttribute()
	{
		if($this->deleted)
		{
			return null;
		}

		if($this->expires)
		{
			if($this->has_expired)
			{
				$this->try_hard_delete();

				return null;
			}
			else
			{
				return Storage::disk('ephemeral')->get($this->id);
			}
		}
		else
		{
			return Storage::disk('persistent')->get($this->id);
		}
	}

	public function setContentAttribute($content)
	{
		if($this->deleted || $this->has_expired)
		{
			//TODO: Throw an exception

			return;
		}

		if($this->expires)
		{
			Storage::disk('ephemeral')->put($this->id, $content);
		}
		else
		{
			Storage::disk('persistent')->put($this->id, $content);
		}
	}
}
