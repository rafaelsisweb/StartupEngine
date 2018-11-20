<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use NexusPoint\Versioned\Versioned;

class PostType extends Model implements AuditableContract
{
    use SoftDeletes;

    use Auditable;

    use Versioned;

    /**
     * Field from the model to use as the versions name
     * @var string
     */
    protected $versionNameColumn = 'title';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    protected $dates = ['deleted_at', 'published_at'];

    public function json() {
        return json_decode($this->json);
    }

}