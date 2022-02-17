<?php

namespace App\Repositories\Contact;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ContactRepository implements ContactRepositoryInterface
{
    private Contact $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
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
        $contact->fill($contactRecord)->save();
    }
}
