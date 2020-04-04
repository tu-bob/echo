<?php


namespace Modules\Shared\Http\Responses;


use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class FileResponse
{

    private string $path;
    private string $mimeType;
//    private string $filename;

    private array $headers = [
//        'Content-Type' => 'audio/mpeg',
        'Cache-Control' => "public, must-revalidate, max-age=1000000",
//        'Pragma' => 'no-cache',
        'Accept-Ranges' => 'bytes',
        'Expires' => '0'
    ];

    public function __construct($path, $mimeType)
    {
        $this->path = $path;
        $this->mimeType = $mimeType;
    }

    public function generateResponse()
    {
        if (!Storage::exists($this->path))
            return response()->json(['message'  => 'Указанный файл не найден' ], 404);

        $headers = array_merge($this->headers, [
            'Content-Length' => Storage::size($this->path),
            'Content-Type' => $this->mimeType,
        ]);

        return (new Response(Storage::get($this->path), 200, $headers));
    }
}
