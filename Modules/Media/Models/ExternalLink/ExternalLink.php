<?php


namespace Modules\Media\Models\ExternalLink;


use Modules\Shared\Models\BaseModel;

class ExternalLink extends BaseModel
{
    public $visible = ['id', 'resource', 'link', 'song_id'];
}
