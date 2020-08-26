<?php

namespace Larapress\Notifications\Services\Notifications;

use Illuminate\Support\Facades\Auth;

class NotificationService implements INotificationService {
    /**
     * Undocumented function
     *
     * @param BatchSendNotificationRequest $request
     * @return Notification[]
     */
    public function queueBatchNotifications(BatchSendNotificationRequest $request) {
        $ids = $request->getIds();
        $author = Auth::user();

        $data = [
            'author_id' => $author->id,
            'title' => $request->getTitle(),
            'message' => $request->getMessage(),
            'data' => $request->getData(),
        ];

        switch ($request->getType()) {
            case 'in_ids':
            break;
            case 'all_except_ids':
            break;
            case 'in_purchased_ids':
            break;
            case 'not_in_purchased_ids':
            break;
            case 'in_form_entries':
            break;
            case 'not_in_form_entries':
            break;
            case 'in_form_entry_tags':
            break;
            case 'not_in_form_enty_tags':
            break;
        }
    }
}
