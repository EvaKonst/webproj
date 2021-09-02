<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class UserData extends Model
{
    protected $table = 'entry';
    protected $fillable = [
            'wait','request_method' ,
            'url',
            'response_status',
            'response_status_Text' ,
            'response_age',
            'res_serverLocation',
            'request_age',
            'response_age' ,
            'Request_content_type ',
            'Request_cache_control',
            'Request_pragma',
            'Request_expires',
            'Request_last_modified' ,
            'Request_host',
            'startedDateTime',
            'Response_content_type ',
            'Response_cache_control',
            'Response_pragma',
            'Response_expires',
            'Response_last_modified' ,
            'Response_host',
    ];
}
 