<?php

namespace Dotclear\Plugin\cpuAudioPublic;

use ArrayObject;
use dcCore;

class FrontendTemplate
{

	public static function publicHeadContent() {
		// return dcCore::app()->util->jsLoad($core->getPF('js/cpu-audio.js'));
		// should also consider via preferences to choose lib compiled version : simple bouton or download
	}

	public static function addMP3template() {
		$tpl = dcCore::app()->tpl;
		$tpl->setPath($tpl->getPath(), My::path().'/default-templates');
	}

	public static function checkFile(string $path, string $ext, string $content): string {
		return '<?php
					if (file_exists( preg_replace(
						["/\/podcast\//", "/\.mp3/"],
						["'.$path.'", "'.$ext.'"],
						dcCore::app()->ctx->file ) )) {
				?>'.$content."<?php } ?>";
	}

	public static function fileSize(string $attr, string $ext): string {
		return '<?php
					$check_for_file = preg_replace(
						["/\/podcast\//", "/\.mp3/"],
						["'.$path.'", "'.$ext.'"],
						$thisfile);
					echo filesize($check_for_file);
				?>';
	}

	public static function returnUrl(string $path, string  $ext): string  {
		return '<?php
					echo preg_replace(
						["/\/podcast\//", "/\.mp3/"],
						["'.$path.'", "'.$ext.'"],
						dcCore::app()->ctx->file_url);
				?>';
	}

	public static function MP3File(ArrayObject $attr): string {
		return FrontendTemplate::returnUrl('/podcast/', '.mp3');
	}

	public static function MP3FileSize(ArrayObject $attr): string {
		return FrontendTemplate::fileSize('/podcast/', '.mp3');
	}

	public static function HasOggFile(ArrayObject $attr, string $content): string {
		return FrontendTemplate::checkFile('/', '/.ogg', $content);
	}

	public static function OggFile(ArrayObject $attr): string {
		return FrontendTemplate::returnUrl('/', '.ogg');
	}

	public static function OggFileSize(ArrayObject $attr): string {
		return FrontendTemplate::fileSize('/', '.ogg');
	}

	public static function HasHlsFile(ArrayObject $attr, string $content): string {
		return FrontendTemplate::checkFile('/hls/', '/index.m3u8', $content);
	}

	public static function HlsFile(ArrayObject $attr): string {
		return FrontendTemplate::returnUrl('/hls/', '/index.m3u8');
	}

	public static function HasChapterFile(ArrayObject $attr, string $content): string {
		return FrontendTemplate::checkFile('/tracks/', '.vtt', $content);
	}

	public static function ChapterFile(ArrayObject $attr): string {
		return FrontendTemplate::returnUrl('/tracks/', '.vtt');
	}

	public static function HasWaveformFile(ArrayObject $attr, string $content): string {
		return FrontendTemplate::checkFile('/waveforms/', '.png', $content);
	}

	public static function WaveformFile(ArrayObject $attr): string {
		return FrontendTemplate::returnUrl('/waveforms/', '.png');
	}


}