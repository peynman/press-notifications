<?php

namespace Larapress\Notifications\Services\Chat\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Larapress\Notifications\Models\ChatMessage;
use Larapress\Notifications\Models\ChatRoom;

/**
 */
class RoomMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // already handled in CRUD middleware
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
            'room_id' => 'required|exists:chat_rooms,id',
            'message_id' => 'required_without:room_id|exists:chat_messages,id',
            'data' => 'nullable|json_object',
            'flags' => 'nullable|numeric',
            'message' => 'nullable|string',
        ];
    }

    /**
     * Undocumented function
     *
     * @return ChatRoom
     */
    public function getRoom()
    {
        return ChatRoom::find($this->getRoomId());
    }

    /**
     * Undocumented function
     *
     * @return int
     */
    public function getRoomId()
    {
        return $this->get('room_id');
    }

    /**
     * Undocumented function
     *
     * @return int
     */
    public function getMessageId()
    {
        return $this->get('message_id');
    }

    /**
     * Undocumented function
     *
     * @return ChatMessage
     */
    public function getMessage()
    {
        return ChatMessage::find($this->getMessageId());
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function getData()
    {
        return $this->get('data', []);
    }

    /**
     * Undocumented function
     *
     * @return int
     */
    public function getFlags()
    {
        return $this->get('flags', 0);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getMessageString()
    {
        return $this->get('message');
    }
}
