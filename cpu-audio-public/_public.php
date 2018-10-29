<?php

if (!defined('DC_RC_PATH')) { return; }

$core->addBehavior('publicHeadContent', ['CPU_Audio_behaviors', 'publicHeadContent']);
$core->addBehavior('publicBeforeDocument', ['CPU_Audio_behaviors', 'addMP3template']);

$core->tpl->addValue('OggFile',                     ['CPU_Audio_tpl','OggFile']);
$core->tpl->addValue('ChapterFile',                 ['CPU_Audio_tpl','ChapterFile']);
$core->tpl->addBlock('HasChapterFile',				['CPU_Audio_tpl','HasChapterFile']);

/**
$this->tpl_path  [] = $core->getPF('default-templates')
**/


class CPU_Audio_behaviors
{
    public static function publicHeadContent($core) {
        return $core->util->jsLoad($core->getPF('js/cpu-audio.js'));
    }

    public static function addMP3template($core) {
        $core->tpl->setPath(
            dirname(__FILE__) . '/default-templates',
            $core->tpl->getPath());


    }
}


class CPU_Audio_tpl
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