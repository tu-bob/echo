<?php


namespace Modules\Media\Http\Controllers\Video;


use Modules\Media\Http\Filters\Media\VideoFilter;
use Modules\Media\Models\Video\Video;
use Modules\Shared\Http\Controllers\BaseController;

class VideoController extends BaseController
{
    public function getVideos()
    {
        $query = Video::withoutTrashed();
        $filter = new VideoFilter(request()->all(), $query);
        return $this->callGetOrPaginate($filter->filter());
    }

    public function incrementViewCount(Video $video){
        $video->view_count += 1;
        $video->save();
        return;
    }

    public function incrementPlayCount(Video $video){
        $video->play_count += 1;
        $video->save();
        return;
    }
}
