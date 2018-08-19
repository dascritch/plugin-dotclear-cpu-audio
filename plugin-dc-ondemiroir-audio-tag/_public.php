<?php

if (!defined('DC_RC_PATH')) { return; }

$core->tpl->addValue('OggFile',                     ['DSN_audio_tpl','OggFile']);
$core->tpl->addValue('ChapterFile',                 ['DSN_audio_tpl','ChapterFile']);
$core->tpl->addBlock('HasChapterFile',				['DSN_audio_tpl','HasChapterFile']);

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
                    $chapterpossiblefile = preg_replace(
                        ["/\.mp3/", "/\/podcast\//"],
                        [".vtt", "/tracks/"],
                        $attach_f->file);
                    if (file_exists( $chapterpossiblefile)) { 
                ?>'.$content."<?php } ?>\n";
    }

}

?>