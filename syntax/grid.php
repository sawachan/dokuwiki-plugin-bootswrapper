<?php
/**
 * Bootstrap Wrapper Plugin: Grid
 * 
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Giuseppe Di Terlizzi <giuseppe.diterlizzi>
 * @copyright  (C) 2015, Giuseppe Di Terlizzi
 */
 
// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

require_once(dirname(__FILE__).'/bootstrap.php');

class syntax_plugin_bootswrapper_grid extends syntax_plugin_bootswrapper_bootstrap {

    protected $pattern_start = '<(?:GRID|grid).*?>(?=.*?</(?:GRID|grid)>)';
    protected $pattern_end   = '</(?:GRID|grid)>';
    protected $tag           = 'GRID';

    function render($mode, Doku_Renderer $renderer, $data) {

        if (empty($data)) return false;

        if ($mode == 'xhtml') {

            /** @var Doku_Renderer_xhtml $renderer */
            list($state, $content, $classes, $attributes) = $data;
            $wrap = ($attributes['wrap']) ? $attributes['wrap'] : 'div';

            switch($state) {

                case DOKU_LEXER_ENTER:

                    $markup = sprintf('<%s class="row">', $wrap);

                    $renderer->doc .= $markup;
                    return true;

                case DOKU_LEXER_UNMATCHED:
                    $renderer->doc .= $content;
                    return true;

                case DOKU_LEXER_EXIT:
                    $renderer->doc .= "</$wrap>";
                    return true;

            }

            return true;

        }

        return false;

    }

}
