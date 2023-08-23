<?php

if (!defined('DC_RC_PATH')) { return; }

$app = dcCore::app();
$app->addBehavior('publicHeadContentV2', ['CPU_Audio_behaviors', 'publicHeadContent']);
$app->addBehavior('publicBeforeDocumentV2', ['CPU_Audio_behaviors', 'addMP3template']);

$tpl = $app->tpl;
$tpl->addValue('OggFile',			['CPU_Audio_tpl','OggFile']);
$tpl->addValue('ChapterFile',		['CPU_Audio_tpl','ChapterFile']);
$tpl->addBlock('HasChapterFile',	['CPU_Audio_tpl','HasChapterFile']);


class CPU_Audio_behaviors
{
	public static function publicHeadContent() {
		// return dcCore::app()->util->jsLoad($core->getPF('js/cpu-audio.js'));
	}

	public static function addMP3template() {
		$tpl = dcCore::app()->tpl;
		$tpl->setPath(
			dirname(__FILE__) . '/default-templates',
			$tpl->getPath());
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