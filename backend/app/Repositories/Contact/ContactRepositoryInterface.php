<?php

namespace App\Repositories\Contact;

use App\Models\Contact;
use Illuminate\Support\Collection;

interface ContactRepositoryInterface
{
    public function send(Contact $contact, array $contactRecord);
}
