<?php

if (!defined('DC_RC_PATH')) { return; }

$core->tpl->addValue('OggFile',                     ['DSN_audio_tpl','OggFile']);
$core->tpl->addValue('ChapterFile',                 ['DSN_audio_tpl','ChapterFile']);
$core->tpl->addBlock('HasChapterFile',				['DSN_audio_tpl','HasChapterFile']);
$core->tpl->addValue('WaveformFile',                ['CPU_Audio_tpl','WaveformFile']);
$core->tpl->addBlock('HasWaveformFile',             ['CPU_Audio_tpl','HasWaveformFile']);

class DSN_audio_tpl
{
    public static function OggFile($attr) {
        return '<?php
                    $oggpossible = preg_replace(
                        ["/\.mp3/", "/\/podcast\//"],
                        [".ogg", "/"],
                        $attach_f->file_url);
                    echo $oggpossible;
                ?>';
    }

    public static function ChapterFile($attr) {
        return '<?php
                    $chapterpossible = preg_replace(
                        ["/\.mp3/", "/\/podcast\//"],
                        [".vtt", "/tracks/"],
                        $attach_f->file_url);
                    echo $chapterpossible;
                ?>';
    }

    public static function HasChapterFile($attr, $content) {
        return '<?php
                    $chapterpossible = preg_replace(
                        ["/\.mp3/", "/\/podcast\//"],
                        [".vtt", "/tracks/"],
                        $attach_f->file_url);
                    if (file_exists($chapterpossible)) { 
                ?>'.$content."<?php } ?>\n";
    }

    public static function WaveformFile($attr) {
        return '<?php
                    $waveformpossible = preg_replace(
                        ["/\.mp3/", "/\/podcast\//"],
                        [".png", "/waveform/"],
                        $attach_f->file_url);
                    echo $waveformpossible;
                ?>';
    }

    public static function HasWaveformFile($attr, $content) {
        return '<?php
                    $waveformpossible = preg_replace(
                        ["/\.mp3/", "/\/podcast\//"],
                        [".png", "/waveform/"],
                        $attach_f->file);
                    if (file_exists($waveformpossible)) { 
                ?>'.$content."<?php } ?>\n";
    }

}

?>