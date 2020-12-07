<?php

namespace KirschbaumDevelopment\NovaMail\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class NovaMailTemplate extends Model implements HasMedia {
	use HasMediaTrait;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'subject',
		'content',
		'user_id',
		'send_delay_in_minutes',
	];

	/**
	 * Get the mail template's mails.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function mails() {
		return $this->hasMany(NovaSentMail::class);
	}

	/**
	 * Get the mail template's events.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function events() {
		return $this->hasMany(NovaMailEvent::class, 'mail_template_id');
	}

	/**
	 * The "booting" method of the model.
	 *
	 * @return void
	 */
	protected static function boot() {
		parent::boot();

		static::creating(function ($template) {
			$template->user_id = auth()->id();
		});
	}

	public function registerMediaCollections() {
		$this->addMediaCollection('mail-templates')
			->useDisk('mailTemplatesDocuments');
	}
}
