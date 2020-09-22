<?php

if (!defined('DC_RC_PATH')) { return; }

$core->addBehavior('publicHeadContent', ['CPU_Audio_behaviors', 'publicHeadContent']);
$core->addBehavior('publicBeforeDocument', ['CPU_Audio_behaviors', 'addMP3template']);

$core->tpl->addValue('OggFile',                     ['CPU_Audio_tpl','OggFile']);
$core->tpl->addBlock('HasHlsFile',                  ['CPU_Audio_tpl','HasHlsFile']);
$core->tpl->addValue('HlsFile',                     ['CPU_Audio_tpl','HlsFile']);
$core->tpl->addValue('ChapterFile',                 ['CPU_Audio_tpl','ChapterFile']);
$core->tpl->addBlock('HasChapterFile',				['CPU_Audio_tpl','HasChapterFile']);
$core->tpl->addValue('WaveformFile',                ['CPU_Audio_tpl','WaveformFile']);
$core->tpl->addBlock('HasWaveformFile',             ['CPU_Audio_tpl','HasWaveformFile']);

/**
$this->tpl_path  [] = $core->getPF('default-templates')
**/


class CPU_Audio_behaviors
{
//    public static function publicHeadContent($core) {
//        return $core->util->jsLoad($core->getPF('js/cpu-audio.js'));
//    }

    public static function addMP3template($core) {
        $core->tpl->setPath(
            dirname(__FILE__) . '/default-templates',
            $core->tpl->getPath());


    }
}


class CPU_Audio_tpl
{
    public static function checkFile($path, $ext, $content) {
        return '<?php if (file_exists( preg_replace(
                        ["/\/podcast\//", "/\.mp3/"],
                        ["'.$path.'", "'.$ext.'"],
                        $attach_f->file) )) { 
                ?>'.$content."<?php } ?>\n";
    }

    public static function returnUrl($path, $ext) {
        return '<?php echo preg_replace(
                        ["/\/podcast\//", "/\.mp3/"],
                        ["'.$path.'", "'.$ext.'"],
                        $attach_f->file_url); ?>'."\n";
    }


	public static function OggFile($attr) {
		return CPU_Audio_tpl::returnUrl('/', '.ogg');
	}

    public static function HasHlsFile($attr, $content) {
        return CPU_Audio_tpl::checkFile('/hls/', '/index.m3u8', $content);
    }

    public static function HlsFile($attr) {
        return CPU_Audio_tpl::returnUrl('/hls/', '/index.m3u8');
    }

    public static function HasChapterFile($attr, $content) {
        return CPU_Audio_tpl::checkFile('/tracks/', '.vtt', $content);
    }

    public static function ChapterFile($attr) {
        return CPU_Audio_tpl::returnUrl('/tracks/', '.vtt');
    }

    public static function HasWaveformFile($attr, $content) {
        return CPU_Audio_tpl::checkFile('/waveforms/', '.png', $content);
    }

    public static function WaveformFile($attr) {
        return CPU_Audio_tpl::returnUrl('/waveforms/', '.png');
    }
}

?>