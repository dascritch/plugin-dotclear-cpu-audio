<?php

if (!defined('DC_RC_PATH')) { return; }

$core->tpl->addValue('OggFile',					['DSN_audio_tpl','OggFile']);

class DSN_audio_tpl
{
	public static function OggFile($attr) {
		return '<?php
					$oggfile=$attach_f->file_url;
					$oggpossible=preg_replace(array("/\.mp3/","/\/podcast\//"),array(".ogg","/"),$attach_f->file_url);
					echo $oggpossible;
				?>';
	}
}

?>