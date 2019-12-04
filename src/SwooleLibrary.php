<?php declare(strict_types=1);

namespace IDEHelper;

use RuntimeException;
use ZipArchive;
use function curl_close;
use function curl_error;
use function curl_exec;
use function curl_getinfo;
use function curl_init;
use function curl_setopt;
use function fclose;
use function file_put_contents;
use function fopen;
use function mkdir;
use function preg_match_all;
use function round;
use function rtrim;
use function stream_copy_to_stream;
use function strlen;
use function strrpos;
use function sys_get_temp_dir;
use function tempnam;
use function unlink;

/**
 * Class SwooleLibrary
 */
class SwooleLibrary
{
    public const EXTRA_FILES = [
        'example',
        'ext',
        '.gitignore',
        'LICENSE',
        'README.md',
        'config.inc',
    ];

    private function formatByte(int $byte, int $dec = 2)
    {
        static $unit = ['B', 'KB', 'MB'];
        $pos  = 0;
        while ($byte >= 1024) {
            $byte /= 1024;
            $pos++;
        }
        return round($byte, $dec) . ' ' . $unit[$pos];
    }

    public function extract(string $output)
    {
        $output = rtrim($output, '/\\');
        $output .= '/';
        mkdir($output, 0755, true);

        $zipName = tempnam(sys_get_temp_dir(), '') . '.swoole.zip';
        $this->download($zipName, SWOOLE_VERSION);

        echo '     save to: ' . $zipName . PHP_EOL;

        $zip = new ZipArchive();
        if (true !== $errcode = $zip->open($zipName, ZipArchive::CHECKCONS)) {
            throw new RuntimeException("extract swoole library fail: zip ({$errcode})");
        }
        $filecount = 0;
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $filename = $zip->getNameIndex($i);
            if (preg_match_all('/^swoole-swoole-src-\w+\/library\/(.+)/', $filename, $matches)) {
                $filename = $matches[1][0];
                foreach (self::EXTRA_FILES as $extra) {
                    if (0 === strpos($filename, $extra)) {
                        continue 2;
                    }
                }
                if (strlen($filename) - 1 === strrpos($filename, '/')) {
                    mkdir($output . $filename);
                } else {
                    $filecount++;
                    file_put_contents($output . $filename, $zip->getFromIndex($i));
                }
            }
        }

        echo '     extract count: ' . $filecount . PHP_EOL;
        unlink($zipName);
    }

    protected function download($zipName, $version)
    {
        $url = 'https://api.github.com/repos/swoole/swoole-src/zipball/v' . $version;

        $progress = function ($ch, $download_size, $downloaded, $upload_size, $uploaded) use ($url) {
            if($download_size > 0 || $downloaded > 0) {
                $downloaded = $this->formatByte($downloaded);
                echo("\r     down: {$url} $downloaded        ");
            }
        };

        $fiveMBs = 16 * 1024 * 1024;
        $fp = fopen("php://temp/maxmemory:{$fiveMBs}", 'r+');
        $ch = curl_init();
        try {
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLINFO_HEADER_OUT, true);
            // progress
            curl_setopt($ch, CURLOPT_NOPROGRESS, false); // needed to make progress function work
            curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, $progress);
            // write curl response to file
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            // user agent
            curl_setopt($ch, CURLOPT_USERAGENT, 'swoole ide helper generate');
            // header
            curl_setopt($ch, CURLOPT_HTTPHEADER, []);
            $result = curl_exec($ch);
            $error = curl_error($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $httpResponseHeaderSzie = curl_getinfo($ch, CURLINFO_HEADER_SIZE);


            if (false === $result) {
                throw new RuntimeException("extract swoole library fail: curl ({$error})");
            }
            if (200 !== $httpCode) {
                throw new RuntimeException("extract swoole library fail: http ({$httpCode})");
            }

            //$httpResponseHeader = stream_get_contents($fp, $httpResponseHeaderSzie, 0);
            //$headers = array_filter(explode("\r\n\r\n", $httpResponseHeader));
            //$header = array_pop($headers);
            //var_dump($httpResponseHeader);

            $zipfp = fopen($zipName, 'w+');
            stream_copy_to_stream($fp, $zipfp, -1, $httpResponseHeaderSzie);

            echo PHP_EOL;
        } finally {
            curl_close($ch);
            isset($zipfp) && fclose($zipfp);
            fclose($fp);
        }
    }
}
