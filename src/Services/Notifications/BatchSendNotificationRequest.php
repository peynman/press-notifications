<?php

namespace Larapress\Notifications\Services\Notifications;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class BatchSendNotificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|in:' . implode(',', [
                'not_in_form_enty_tags',
                'in_form_entry_tags',
                'not_in_form_entries',
                'in_form_entries',
                'not_in_purchased_ids',
                'in_purchased_ids',
                'all_except_ids',
                'in_ids'
            ]),
            'title' => 'required|string',
            'message' => 'required|string',
            'data.type' => 'required|string',
            'data.link' => 'required|string',
            'data.dismissable' => 'nullable',
            'data.color' => 'nullable|string',
            'ids' => 'required_unless:type,all_except_ids',
            'roles.*.id' => 'nullable|exists:roles,id',
            'domains.*.id' => 'nullable|exists:domains,id',
            'registration_after' => 'nullable|datetime_zoned',
            'registration_before' => 'nullable|datetime_zoned',
        ];
    }

    public function getIds()
    {
        $ids = $this->request->get('ids', []);
        if (is_string($ids)) {
            return explode(",", $ids);
        } else {
            if (!is_array($ids)) {
                return [$ids];
            }
        }

        return $ids;
    }

    public function getMessage()
    {
        return $this->request->get('message');
    }

    public function getTitle()
    {
        return $this->request->get('title');
    }

    public function getType()
    {
        return $this->request->get('type');
    }

    public function getLink()
    {
        $data = $this->get('data', []);
        return isset($data['link']) ? $data['link']: null;
    }

    public function getColor()
    {
        $data = $this->get('data', []);
        return isset($data['color']) ? $data['color']: null;
    }

    public function isDismissable()
    {
        $data = $this->get('data', []);
        return isset($data['dismissable']) ? $data['dismissable']: null;
    }

    public function getIcon()
    {
        $data = $this->get('data', []);
        return isset($data['icon']) ? $data['icon']: null;
    }

    public function getRoleIds()
    {
        return array_values(array_keys($this->request->get('roles', [])));
    }

    public function getNotificationType()
    {
        $data = $this->get('data', []);
        return isset($data['type']) ? $data['type']: null;
    }

    public function getDomainIds()
    {
        return array_keys($this->request->get('domains', []));
    }

    public function shouldFilterRoles()
    {
        return count($this->getRoleIds()) > 0;
    }

    public function shouldFilterDomains()
    {
        return count($this->getDomainIds()) > 0;
    }

    public function getRegisteredFrom()
    {
        $time = $this->request->get('from', null);
        if (!is_null($time)) {
            $time = Carbon::createFromFormat(config('larapress.crud.datetime-format'), $time);
        }
        return $time;
    }

    public function getRegisteredTo()
    {
        $time = $this->request->get('to', null);
        if (!is_null($time)) {
            $time = Carbon::createFromFormat(config('larapress.crud.datetime-format'), $time);
        }
        return $time;
    }
}
