<?php

/*
 * This file is part of the GenemuFormBundle package.
 *
 * (c) Olivier Chauvel <olivier@generation-multiple.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SC\DatetimepickerBundle\Twig\Extension;

use Symfony\Component\Form\FormRendererInterface;
use Symfony\Component\Form\FormView;
use Symfony\Bridge\Twig\Form\TwigRendererInterface;

/**
 * FormExtension extends Twig with form capabilities.
 *
 * @author Olivier Chauvel <olivier@generation-multiple.com>
 */
class FormExtension extends \Twig_Extension
{
    /**
     * This property is public so that it can be accessed directly from compiled
     * templates without having to call a getter, which slightly decreases performance.
     *
     * @var \Symfony\Component\Form\FormRendererInterface
     */
    public $renderer;

    public function __construct(FormRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('form_javascript', array($this, 'renderJavascript'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('form_stylesheet', null, array('node_class' => 'Symfony\Bridge\Twig\Node\SearchAndRenderBlockNode', 'is_safe' => array('html'))),
        );
    }

    /**
     * Render Function Form Javascript
     *
     * @param FormView $view
     * @param bool $prototype
     *
     * @return string
     */
    public function renderJavascript(FormView $view, $prototype = false)
    {
        $block = $prototype ? 'javascript_prototype' : 'javascript';

        return $this->renderer->searchAndRenderBlock($view, $block);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'collot.twig.extension.form';
    }
}
