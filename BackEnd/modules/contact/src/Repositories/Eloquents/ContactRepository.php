<?php

namespace Modules\Contact\Repositories\Eloquents;

use Core\Supports\Repositories\Eloquents\BaseRepository;
use Modules\Contact\Models\Contact;
use Modules\Contact\Repositories\Interfaces\ContactInterface;

class ContactRepository extends BaseRepository implements ContactInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return Contact::class;
    }

    function delAllContact()
    {
        return Contact::query()->delete();
    }
}
