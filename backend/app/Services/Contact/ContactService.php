<?php

namespace App\Services\Contact;

use App\Models\Contact;
use App\Repositories\Contact\ContactRepositoryInterface;
use Illuminate\Support\Collection;

class ContactService implements ContactServiceInterface
{
    private ContactRepositoryInterface $contactRepository;

    public function __construct(
        ContactRepositoryInterface $contactRepository
    ) {
        $this->contactRepository = $contactRepository;
    }

    /**
     * お問い合わせ内容を送信
     * 入力内容の修正時は値を保持したまま戻る(name="contact"のvalue値は必要ないのでexceptで除外する)
     *
     * @param  \App\Models\Contact  $contact
     * @param array $contactRecord
     */
    public function send(Contact $contact, array $contactRecord)
    {
        $this->contactRepository->send($contact, $contactRecord);
    }
}
