<?php


namespace Modules\Shared\Http\Responses;


use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class FileResponse
{

    private string $path;
    private string $mimeType;
    private ?array $byteRange;
    private int $fileSize;
//    private string $filename;

    private array $headers = [
//        'Content-Type' => 'audio/mpeg',
        'Cache-Control' => "public, must-revalidate, max-age=1000000",
//        'Pragma' => 'no-cache',
        'Accept-Ranges' => 'bytes',
        'Expires' => '0'
    ];

    /**
     * FileResponse constructor.
     * @param string $path to the file
     * @param string $mimeType of the file
     * @param array|null $byteRange
     */
    public function __construct(string $path, string $mimeType, ?array $byteRange = null)
    {
        $this->path = $path;
        $this->mimeType = $mimeType;
        $this->byteRange = $byteRange;
    }

    public function generateResponse()
    {
        if (!Storage::exists($this->path))
            return response()->json(['message' => 'Указанный файл не найден'], 404);

        $this->fileSize = Storage::size($this->path);

        $headers = array_merge($this->headers, [
            'Content-Length' => $this->fileSize,
            'Content-Type' => $this->mimeType,
        ]);

        if ($this->byteRange)
            return $this->generateStreamResponse($headers);
        else
            return (new Response(Storage::get($this->path), 200, $headers));
    }

    private function generateStreamResponse($headers)
    {
        $from = $this->byteRange[0];
        $to = $this->byteRange[1] ?? $this->fileSize - 1;
        $length = $to - $from + 1;

        $stream = fopen('../storage/app/' . $this->path, "r");
        $headers['Content-Range'] = sprintf('bytes %d-%d/%d', $from, $to, $this->fileSize);

        return response()->stream(function () use ($stream, $from, $length) {
            fseek($stream, $from, SEEK_SET);
            echo fread($stream, $length);
            fclose($stream);
        }, 206, $headers);
    }
}
