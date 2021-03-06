<?php
# -- BEGIN LICENSE BLOCK ---------------------------------------
#
# This file is part of Dotclear 2.
#
# Copyright (c) 2003-2013 Olivier Meunier & Association Dotclear
# Licensed under the GPL version 2.0 license.
# See LICENSE file or
# http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
#
# -- END LICENSE BLOCK -----------------------------------------
if (!defined('DC_RC_PATH')) { return; }

$this->registerModule(
        /* Name */                      "CPU Audio",
        /* Description*/                "CPU Audio for Dotclear",
        /* Author */                    "Da Scritch",
        /* Version */                   '2.0',
        [
            'permissions' 	=>			'admin',
            'type'  		=>			'plugin'
        ]
);