<?php

namespace Larapress\Notifications\Services\Chat;

use Larapress\Notifications\Models\ChatMessage;
use Larapress\Notifications\Models\ChatRoom;
use Larapress\Profiles\IProfileUser;

interface IChatService {
    /**
     * Undocumented function
     *
     * @param IProfileUser $author
     * @param integer $flags
     * @param array $participants
     * @param array $data
     *
     * @return ChatRoom
     */
    public function createRoom(IProfileUser $author, int $flags, $data = [], $participants = []);

    /**
     * Undocumented function
     *
     * @param IProfileUser $author
     * @param ChatRoom $room
     *
     * @return ChatRoom
     */
    public function closeRoom(IProfileUser $author, ChatRoom $room);

    /**
     * Undocumented function
     *
     * @param IProfileUser $author
     * @param ChatRoom $room
     * @param int|IProfileUser $user
     * @param array $data
     * @param int   $flags
     *
     * @return ChatRoom
     */
    public function addParticipantToRoom(IProfileUser $author, ChatRoom $room, $user, $data, $flags);

    /**
     * Undocumented function
     *
     * @param IProfileUser $author
     * @param ChatRoom $room
     * @param int|IProfileUser $user
     *
     * @return ChatRoom
     */
    public function removeParticipantFromRoom(IProfileUser $author, ChatRoom $room, $user);

    /**
     * Undocumented function
     *
     * @param ChatRoom $room
     * @param int|IProfileUser $user
     * @param string $message
     * @param array $data
     * @param int $flags
     *
     * @return ChatMessage
     */
    public function postMessage(ChatRoom $room, $user, $message, $data, $flags);

    /**
     * Undocumented function
     *
     * @param ChatMessage $msg
     * @param int|IProfileUser $user
     * @param string $message
     * @param array $data
     * @param int $flags
     *
     * @return ChatMessage
     */
    public function updateMessage(ChatMessage $msg, $user, $message, $data, $flags);

    /**
     * Undocumented function
     *
     * @param int|ChatMessage $msg
     * @param int|IProfileUser $user
     *
     * @return boolean
     */
    public function removeMessage($msg, $user);
}
