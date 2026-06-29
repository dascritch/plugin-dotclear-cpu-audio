<?php
# Adapted from https://dotclear.watch/Billet/Fichier-Frontend-d-un-module
# TEMPORAIRE cf https://forum.dotclear.org/viewtopic.php?pid=350354

namespace Dotclear\Plugin\cpuAudioPublic;

use Dotclear\App;
use Dotclear\Core\Process;

class Frontend extends Process
{
	public static function init(): bool
	{
		return self::status(My::checkContext(My::FRONTEND));
	}

	public static function process(): bool
	{
		if (!self::status()) {
			return false;
		}

		// Only for test
		foreach ([
			'MP3File', 'MP3FileSize', # just a test
			'OggFile', 'OggFileSize',
			'HlsFile', 'ChapterFile', 'WaveformFile',
		] as $template) {
			App::frontend()->template()->addValue($template,	[FrontendTemplate::class,$template]);
		}

		foreach ([
			'HasOggFile', 'HasHlsFile', 'HasChapterFile', 'HasWaveformFile'
		] as $template) {
			App::frontend()->template()->addBlock($template,	[FrontendTemplate::class,$template]);
		}

		App::behavior()->addBehaviors([
			'publicHeadContentV2'		=> [FrontendTemplate::class, 'publicHeadContent'],
			'publicBeforeDocumentV2'	=> [FrontendTemplate::class, 'addMP3template'],
		]);

		return true;
	}
}

?>