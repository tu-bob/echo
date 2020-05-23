<?php


namespace Modules\Media\Models\Music;


use Modules\Shared\Models\FileModel;

class AudioFile extends FileModel
{
    public $tags = [];

    public function song()
    {
        return $this->hasOne(Song::class);
    }

    /**
     * Analyze the file to read the tags and store them
     *
     * @return void
     * @throws \getid3_exception
     */
    public function fetchTags()
    {
        $getID3 = new \getID3;
        $fileInfo = $getID3->analyze($this->path, null, 'random.mp3');

        // Get all the common tags
        if (isset($fileInfo['tags_html'])) {
            if (isset($fileInfo['tags_html']['id3v2']))
                $this->tags = $fileInfo['tags_html']['id3v2'];
            elseif (isset($fileInfo['tags_html']['id3v1']))
                $this->tags = $fileInfo['tags_html']['id3v1'];
        }
        // Adding the cover art if it is available
        if (isset($fileInfo['comments']['picture'])) {
            $this->tags['image'] = $fileInfo['comments']['picture'][0];
        }
    }

    /**
     * Write the given tags in the file
     *
     * @param array $tags
     * @return array
     * @throws \getid3_exception
     */
    public function writeTags(array $tags)
    {
        $textEncoding = 'UTF-8';
        $getID3 = new \getID3;
        $getID3->setOption(array('encoding' => $textEncoding));

        $tagwriter = new  \getid3_writetags;
        $tagwriter->filename = $this->path;
        $tagwriter->tagformats = array('id3v2.3');

        // set various options (optional)
        $tagwriter->overwrite_tags = true;
        $tagwriter->tag_encoding = $textEncoding;
        $tagwriter->remove_other_tags = true;

//        $fileInfo = $getID3->analyze($this->path);

        //XXX This will remove all tags
        // \getid3_lib::CopyTagsToComments($fileInfo);
        // foreach ($fileInfo['tags']['id3v2'] as $key => $value) {
        //     $tagData[$key] = $value;
        // }

        // populate data array
        $tagData['comment'] = array();
        foreach ($tags as $tag => $value) {
            $tagData[$tag] = array($value);
        }

        if (isset($tags['picture_path'])) {
            $tagData['attached_picture'][] = array(
                'picturetypeid' => 2, // Cover. More: module.tag.id3v2.php -> function APICPictureTypeLookup
                'description' => 'Cover', // text field
                'mime' => 'image/jpeg', // Mime type image
                'data' => file_get_contents($tags['picture_path'])  // Image data
            );
            unset($tagData['picture_path']);
        }

        $tagwriter->tag_data = $tagData;

        // write tags
        $tagwriter->WriteTags();

        return array(
            'warnings' => $tagwriter->warnings,
            'errors' => $tagwriter->errors
        );
    }
}


//$tags = array(
//    'artist'       => $request->artist[$key],
//    'title'        => $request->title[$key],
//    'album'        => $request->album[$key],
//    'band'         => $request->band[$key],
//    'publisher'    => $request->publisher[$key],
//    'genre'        => $request->genre[$key],
//    'year'         => $request->year[$key],
//    'track_number' => $request->track_number[$key],
//    'bpm'          => $request->bpm[$key],
//    'initial_key'  => $request->initial_key[$key],
//);
