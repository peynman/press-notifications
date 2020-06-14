<?php

namespace Larapress\Notifications\CRUD;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Larapress\CRUD\Base\BaseCRUDProvider;
use Larapress\CRUD\Base\ICRUDProvider;
use Larapress\CRUD\Base\IPermissionsMetadata;
use Larapress\Notifications\Models\SMSGatewayData;

class SMSGatewayDataCRUDProvider implements ICRUDProvider, IPermissionsMetadata
{
	use BaseCRUDProvider;

    public $name_in_config = 'larapress.notifications.routes.sms_gateways.name';
    public $verbs = [
        self::VIEW,
        self::CREATE,
        self::EDIT,
        self::DELETE
    ];
    public $model = SMSGatewayData::class;
	public $createValidations = [
        'name' => 'required|string|unique:sms_gateways,name',
        'flags' => 'nullable|numeric',
        'data.gateway' => 'required|string|',
	];
	public $updateValidations = [
        'name' => 'required|string|unique:sms_gateways,name',
        'flags' => 'nullable|numeric',
        'data.gateway' => 'required|string|',
	];
	public $validSortColumns = ['id', 'title', 'gateway_id', 'status', 'created_at'];
	public $validRelations = [];
	public $validFilters = [];
	public $defaultShowRelations = [];
	public $excludeFromUpdate = [];
	public $autoSyncRelations = [];
	public $searchColumns = [
		'equals:id',
		'equals:gateway_id',
		'title',
	];
	public $filterFields = [];
	public $filterDefaults = [];

    /**
     * Exclude current id in name unique request
     *
     * @param Request $request
     * @return void
     */
    public function getUpdateRules(Request $request) {
        $this->updateValidations['name'] .= ',' . $request->route('id');
        return $this->updateValidations;
    }

    /**
     * Undocumented function
     *
     * @param array $args
     * @return array
     */
	public function onBeforeCreate( $args )
	{
        $args['author_id'] = Auth::user()->id;

		return $args;
	}
}
