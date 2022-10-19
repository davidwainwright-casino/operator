<?php
namespace Wainwright\CasinoDogOperatorApi\Controllers\Playground;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class iFrameManager
{

    public function load(Request $request)
    {
        if (filter_var($request->url, FILTER_VALIDATE_URL)) {
            $iframejs = file_get_contents(__DIR__.'/AssetStorage/iframe_manager.js.stub');
            $iframe = str_replace('[URL]', $request->url, $iframejs);
            header("Content-Type: application/javascript; charset=utf-8");
            echo $iframe;
        } else {
            return '';
        }

    }

    public function pretendResponseIsFile(string $path, string $contentType)
    {
        abort_unless(
            file_exists($path) || file_exists($path = base_path($path)),
            404,
        );

        $cacheControl = 'public, max-age=31536000';
        $expires = strtotime('+1 year');

        $lastModified = filemtime($path);

        if (@strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE'] ?? '') === $lastModified) {
            return response()->noContent(304, [
                'Expires' => $this->getHttpDate($expires),
                'Cache-Control' => $cacheControl,
            ]);
        }

        return response()->file($path, [
            'Content-Type' => $contentType,
            'Expires' => $this->getHttpDate($expires),
            'Cache-Control' => $cacheControl,
            'Last-Modified' => $this->getHttpDate($lastModified),
        ]);
    }

    public function getHttpDate(int $timestamp)
    {
        return sprintf('%s GMT', gmdate('D, d M Y H:i:s', $timestamp));
    }
}