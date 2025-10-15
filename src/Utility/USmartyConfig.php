<?php

namespace Utility;

use Smarty\Smarty;

class USmartyConfig extends Smarty {
    public function __construct() {
        parent::__construct();
        $this->setTemplateDir(__DIR__ . '/../Smarty/tpl/');
        $this->setCompileDir(__DIR__ . '/../Smarty/templates_c/');
    }
}
