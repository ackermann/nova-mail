<?php

namespace KirschbaumDevelopment\NovaMail\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use KirschbaumDevelopment\NovaMail\Events;
use KirschbaumDevelopment\NovaMail\Models\NovaMailTemplate as NovaMailTemplateModel;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Resource;

class NovaMailTemplate extends Resource {
	/**
	 * The model the resource corresponds to.
	 *
	 * @var string
	 */
	public static $model = NovaMailTemplateModel::class;

	/**
	 * The single value that should be used to represent the resource when being displayed.
	 *
	 * @var string
	 */
	public static $title = 'name';

	/**
	 * Get the displayable label of the resource.
	 *
	 * @return string
	 */
	public static function label() {
		return __('Mail Templates');
	}

	/**
	 * Get the displayable singular label of the resource.
	 *
	 * @return string
	 */
	public static function singularLabel() {
		return __('Mail Template');
	}

	/**
	 * The columns that should be searched.
	 *
	 * @var array
	 */
	public static $search = [
		'name',
	];

	/**
	 * Get the fields displayed by the resource.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 *
	 * @return array
	 */
	public function fields(Request $request) {
		return [

			Text::make(__('Name'), 'name'),

			Text::make(__('Subject'), 'subject'),

			Code::make(__('Content'), 'content')
				->language('markdown')
				->hideFromIndex(),

			Number::make(__('Send delay (minutes)'), 'send_delay_in_minutes'),

			Events::make(__('Events'), 'events')
				->hideWhenCreating()
				->help('Targeting a specific column is only available on the "Updated" event.'),
		];
	}

	/**
	 * Get the cards available for the request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 *
	 * @return array
	 */
	public function cards(Request $request) {
		return [];
	}

	/**
	 * Get the filters available for the resource.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 *
	 * @return array
	 */
	public function filters(Request $request) {
		return [];
	}

	/**
	 * Get the lenses available for the resource.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 *
	 * @return array
	 */
	public function lenses(Request $request) {
		return [];
	}

	/**
	 * Get the actions available for the resource.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 *
	 * @return array
	 */
	public function actions(Request $request) {
		return [];
	}

	/**
	 * Determine if this resource is available for navigation.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 *
	 * @return bool
	 */
	public static function availableForNavigation(Request $request) {
		return config('nova_mail.show_resources.nova_mail_template');
	}
}
