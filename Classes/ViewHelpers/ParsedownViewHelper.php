<?php


namespace Buepro\Auxlibs\ViewHelpers;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithContentArgumentAndRenderStatic;

class ParsedownViewHelper extends AbstractViewHelper
{
    use CompileWithContentArgumentAndRenderStatic;

    protected $escapeOutput = false;

    public function initializeArguments()
    {
        $this->registerArgument('text', 'string', 'The text with markdown syntax to be parsed.', false);
        $this->registerArgument('nl2br', 'bool', 'If true converts line feeds to line breaks', false, false);
    }

    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $text = $arguments['text'] ?? $renderChildrenClosure();
        $parsedown = new \Parsedown;
        $parsedown->setBreaksEnabled($arguments['nl2br']);
        return $parsedown->text($text);
    }
}
