<?php
namespace FluidTYPO3\Vhs\ViewHelpers\Count;

/*
 * This file is part of the FluidTYPO3/Vhs project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;

/**
 * Counts number of lines in a string.
 *
 * #### Usage examples
 *
 *     <v:count.substring string="{myString}">{haystack}</v:count.substring> (output for example `2`
 *
 *     {haystack -> v:count.substring(string: myString)} when used inline
 *
 *     <v:count.substring string="{myString}" haystack="{haystack}" />
 *
 *     {v:count.substring(string: myString, haystack: haystack)}
 */
class SubstringViewHelper extends AbstractViewHelper
{
    /**
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('haystack', 'string', 'String to count substring in, if not provided as tag content');
        $this->registerArgument('string', 'string', 'Substring to count occurrences of', true);
    }

    /**
     * @return integer
     */
    public function render()
    {
        return static::renderStatic(
            $this->arguments,
            $this->buildRenderChildrenClosure(),
            $this->renderingContext
        );
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return integer
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        return mb_substr_count(
            isset($arguments['haystack']) ? $arguments['haystack'] : $renderChildrenClosure(), $arguments['string']
        );
    }
}