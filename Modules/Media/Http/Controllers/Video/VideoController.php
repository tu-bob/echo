<?php


namespace Modules\Media\Http\Controllers\Video;


use Modules\Media\Http\Filters\Media\VideoFilter;
use Modules\Media\Http\Filters\VideoQuery;
use Modules\Media\Models\Video\Video;
use Modules\Shared\Http\Controllers\BaseController;

class VideoController extends BaseController
{
    /**
     * @deprecated
     * TODO remove
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getVideos()
    {
        $query = Video::withoutTrashed();
        return $this->callGetOrPaginate($query);
    }
    public function index(){
        $query = Video::latest();
        $filter = new VideoQuery($query);
        return $this->callGetOrPaginate($filter);
    }

    public function show(Video $video){
        return $video;
    }

    public function store(){
        return Video::create($this->getValidatedData());
    }

    public function update(Video $video){
        return $video->update($this->getValidatedData());
    }

    private function getValidatedData(){
        return request()->validate([
            'title' => 'required | string',
            'src' => 'required | string',
            'type' => 'required | string',
        ]);
    }

    public function destroy(Video $video){
        $video->delete();
        return;
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
