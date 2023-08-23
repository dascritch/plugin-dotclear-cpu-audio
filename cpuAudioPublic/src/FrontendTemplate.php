<?php

namespace Dotclear\Plugin\cpuAudioPublic;

use dcCore;

class FrontendTemplate
{

	public static function publicHeadContent() {
		error_log('FrontEndTemplate:publicHeadContent');
		// return dcCore::app()->util->jsLoad($core->getPF('js/cpu-audio.js'));
		// should also consider via preferences to choose lib compiled version : simple bouton or download
	}

	public static function addMP3template() {
		error_log('FrontEndTemplate:addMP3template');
		$tpl = dcCore::app()->tpl;
		$tpl->setPath(My::path().'/default-templates', $tpl->getPath());
	}

	public static function checkFile($path, $ext, $content) {
		return '<?php
					$thisfile = dcCore::app()->ctx->dir . dcCore::app()->ctx->basename;
					error_log("thisfile = ". $thisfile ."*" );
					error_log("attach_f = ". $attach_f);
					if (file_exists( preg_replace(
						["/\/podcast\//", "/\.mp3/"],
						["'.$path.'", "'.$ext.'"],
						$thisfile) )) {
				?>'.$content."<?php } ?>";
	}

	public static function fileSize($attr, $ext, $content) {
		return '<?php
					$thisfile = dcCore::app()->ctx->dir . dcCore::app()->ctx->basename;
					$check_for_file =  preg_replace(
						["/\/podcast\//", "/\.mp3/"],
						["'.$path.'", "'.$ext.'"],
						$thisfile);
					echo filesize($check_for_file);
				?>';
	}

	public static function returnUrl($path, $ext) {
		return '<?php
					echo preg_replace(
						["/\/podcast\//", "/\.mp3/"],
						["'.$path.'", "'.$ext.'"],
						dcCore::app()->ctx->file_url);
				?>';
	}

	public static function MP3File($attr) {
		return FrontendTemplate::returnUrl('/podcast/', '.mp3');
	}

	public static function MP3FileSize($attr) {
		return FrontendTemplate::fileSize('/podcast/', '.mp3');
	}

	public static function HasOggFile($attr, $content) {
		return FrontendTemplate::checkFile('/', '/.ogg', $content);
	}

	public static function OggFile($attr) {
		return FrontendTemplate::returnUrl('/', '.ogg');
	}

	public static function OggFileSize($attr) {
		return FrontendTemplate::fileSize('/', '.ogg');
	}

	public static function HasHlsFile($attr, $content) {
		return FrontendTemplate::checkFile('/hls/', '/index.m3u8', $content);
	}

	public static function HlsFile($attr) {
		return FrontendTemplate::returnUrl('/hls/', '/index.m3u8');
	}

	public static function HasChapterFile($attr, $content) {
		return FrontendTemplate::checkFile('/tracks/', '.vtt', $content);
	}

	public static function ChapterFile($attr) {
		return FrontendTemplate::returnUrl('/tracks/', '.vtt');
	}

	public static function HasWaveformFile($attr, $content) {
		return FrontendTemplate::checkFile('/waveforms/', '.png', $content);
	}

	public static function WaveformFile($attr) {
		return FrontendTemplate::returnUrl('/waveforms/', '.png');
	}


}