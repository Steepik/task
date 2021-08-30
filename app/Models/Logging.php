<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Logging
 * @package App\Models
 *
 * @property $date
 * @property $request_method
 * @property $request_url
 * @property $response_http_code
 * @property $response_body
 */
class Logging extends Model
{
    use HasFactory;

    protected $guarded = ['*'];

    public $timestamps = false;
}
