<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Record
 * @package App\Models
 *
 * @property string $title
 * @property string $url
 * @property string $short_description
 * @property string $author
 * @property string $image
 */
class Record extends Model
{
    use HasFactory;

    /**
     * @var array
     */

    protected $guarded = ['*'];
}
