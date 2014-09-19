<?php

/* /var/www/html/themes/feflip/partials/explain/plugins.htm */
class __TwigTemplate_5e3c3eef9d2d6e9473d850c300e57a4ccc211a0f08e19ca42de88f64b1f308ed extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            '__internal_7d52d4c826819fb66edf99e576c3aef0d63817ec408785416bda28c8a4653578' => array($this, 'block___internal_7d52d4c826819fb66edf99e576c3aef0d63817ec408785416bda28c8a4653578'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<hr />

<p class=\"lead\">
    <i class=\"icon-copy\"></i>
    The HTML markup for this example:
</p>
<pre>
";
        // line 8
        echo twig_escape_filter($this->env, (string) $this->renderBlock("__internal_7d52d4c826819fb66edf99e576c3aef0d63817ec408785416bda28c8a4653578", $context, $blocks));
        // line 10
        echo "</pre>

<hr />

<p class=\"lead\">
    <i class=\"icon-question\"></i> 
    Wait, only one line is needed?
</p>
<p><em>Yes!</em> unlike the <a href=\"";
        // line 18
        echo $this->env->getExtension('CMS')->pageFilter("ajax");
        echo "\">AJAX example</a>, components are simple building blocks that can be used with a small amount of code.</p>
<p>The <code>demoTodo</code> component used here is provided by the plugin called <strong>October\\Demo</strong>, you can find it in the <code>plugins/october/demo</code> folder.</p>

<hr />

<div class=\"text-center\">
    <p><a target=\"_blank\" href=\"http://octobercms.com/docs\" class=\"btn btn-lg btn-default\">Learn more at October's Documentation</a></p>
</div>";
    }

    // line 8
    public function block___internal_7d52d4c826819fb66edf99e576c3aef0d63817ec408785416bda28c8a4653578($context, array $blocks = array())
    {
        // line 9
        echo "{% component 'demoTodo' %}";
        echo "
";
    }

    public function getTemplateName()
    {
        return "/var/www/html/themes/feflip/partials/explain/plugins.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 9,  53 => 8,  41 => 18,  31 => 10,  29 => 8,  20 => 1,  26 => 3,  22 => 2,  42 => 17,  37 => 14,  33 => 13,  19 => 1,);
    }
}
