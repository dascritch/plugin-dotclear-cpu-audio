<?php

if (!defined('DC_RC_PATH')) { return; }

$core->addBehavior('publicHeadContent', ['CPU_Audio_behaviors', 'publicHeadContent']);
$core->addBehavior('publicBeforeDocument', ['CPU_Audio_behaviors', 'addMP3template']);

$core->tpl->addValue('OggFile',                     ['CPU_Audio_tpl','OggFile']);
$core->tpl->addValue('ChapterFile',                 ['CPU_Audio_tpl','ChapterFile']);
$core->tpl->addBlock('HasChapterFile',				['CPU_Audio_tpl','HasChapterFile']);
$core->tpl->addValue('WaveformFile',                ['CPU_Audio_tpl','WaveformFile']);
$core->tpl->addBlock('HasWaveformFile',             ['CPU_Audio_tpl','HasWaveformFile']);

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