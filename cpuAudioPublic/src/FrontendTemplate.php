<?php

namespace Dotclear\Plugin\cpuAudioPublic;

use ArrayObject;
use Dotclear\App;

class FrontendTemplate
{

	public static function publicHeadContent() {
		// return dcCore::app()->util->jsLoad($core->getPF('js/cpu-audio.js'));
		// should also consider via preferences to choose lib compiled version : simple bouton or download
	}

	public static function addMP3template() {
		//App::frontend()->template()->setPath($tpl->getPath(), My::path().'/default-templates');
		App::frontend()->template()->setPath(
			App::frontend()->template()->getPath(),
			My::path().'/default-templates'
		);

	}

	public static function checkFile(string $path, string $ext, string $content): string {
		return
			'<?php
				$_checkFile_filename = App::frontend()->context()->file;
				if (!is_null($_checkFile_filename)) {

					if (file_exists( preg_replace(
						["/\/podcast\//", "/\.mp3/"],
						["'.$path.'", "'.$ext.'"],
						$_checkFile_filename ) )) {
					?>'.$content.'<?php
					}
				}
				unset($_checkFile_filename);
			?>';
	}

	public static function fileSize(string $attr, string $ext): string {
		return
			'<?php
				$_checkFile_filename = App::frontend()->context()->file;
				if (is_null($_checkFile_filename)) {
					// It s a magic value (bad idea) meaning the original file doesn t seem being available
					echo -1;
				} else {
					$check_for_file = preg_replace(
						["/\/podcast\//", "/\.mp3/"],
						["'.$path.'", "'.$ext.'"],
						App::frontend()->context()->file);
					echo filesize($check_for_file);
				}
				unset($_checkFile_filename);
			?>';
	}

	public static function returnUrl(string $path, string  $ext): string  {
		return 
			'<?php
				$_checkFile_url = App::frontend()->context()->file;
				if (!is_null($_checkFile_url)) {
				echo preg_replace(
					["/\/podcast\//", "/\.mp3/"],
					["'.$path.'", "'.$ext.'"],
					$_checkFile_url);
				}
				unset($_checkFile_url);
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