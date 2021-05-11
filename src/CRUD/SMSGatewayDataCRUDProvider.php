<?php

namespace Larapress\Notifications\CRUD;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Larapress\CRUD\Services\CRUD\BaseCRUDProvider;
use Larapress\CRUD\Services\CRUD\ICRUDProvider;
use Larapress\CRUD\Services\RBAC\IPermissionsMetadata;

class SMSGatewayDataCRUDProvider implements ICRUDProvider, IPermissionsMetadata
{
    use BaseCRUDProvider;

    public $name_in_config = 'larapress.notifications.routes.sms_gateways.name';
    public $class_in_config = 'larapress.notifications.routes.sms_gateways.model';
    public $verbs = [
        self::VIEW,
        self::CREATE,
        self::EDIT,
        self::DELETE
    ];
    public $createValidations = [
        'name' => 'required|string|unique:sms_gateways,name',
        'flags' => 'nullable|numeric',
        'data.gateway' => 'required|string',
    ];
    public $updateValidations = [
        'name' => 'required|string|unique:sms_gateways,name',
        'flags' => 'nullable|numeric',
        'data.gateway' => 'required|string',
    ];
    public $validSortColumns = ['id', 'title', 'gateway_id', 'status', 'created_at'];
    public $searchColumns = [
        'equals:id',
        'equals:gateway_id',
        'title',
    ];

    /**
     * Exclude current id in name unique request
     *
     * @param Request $request
     * @return void
     */
    public function getUpdateRules(Request $request)
    {
        $this->updateValidations['name'] .= ',' . $request->route('id');
        return $this->updateValidations;
    }

    /**
     * Undocumented function
     *
     * @param array $args
     * @return array
     */
    public function onBeforeCreate($args)
    {
        $args['author_id'] = Auth::user()->id;

        return $args;
    }
}
