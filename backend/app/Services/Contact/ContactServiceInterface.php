<?php

namespace App\Services\Contact;

use App\Models\Contact;
use Illuminate\Support\Collection;

interface ContactServiceInterface
{
    public function send(Contact $contact, array $contactRecord);
}
