<?php

/* /var/www/html/themes/feflip/partials/explain/ajax.htm */
class __TwigTemplate_9cd96dab600cdc9ab776ba749c11cc1e5d365200b8614083b4220b75513290ac extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            '__internal_341b8104bab8427c3426f9c5c38e4f0c7245977526d0e87add3225c0d05aaa02' => array($this, 'block___internal_341b8104bab8427c3426f9c5c38e4f0c7245977526d0e87add3225c0d05aaa02'),
            '__internal_67e9ee2491cb8c5f374be6802aacd02d13a980f6cfdd2f429bf0eca94cdda77c' => array($this, 'block___internal_67e9ee2491cb8c5f374be6802aacd02d13a980f6cfdd2f429bf0eca94cdda77c'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<hr />

<!-- This file is an explanation of the AJAX page -->

<p class=\"lead\">
    <i class=\"icon-copy\"></i>
        The HTML markup for this example:
    </p>
    <pre>";
        // line 9
        echo twig_escape_filter($this->env, (string) $this->renderBlock("__internal_341b8104bab8427c3426f9c5c38e4f0c7245977526d0e87add3225c0d05aaa02", $context, $blocks));
        // line 24
        echo "</pre>

<hr />

<p class=\"lead\">
    <i class=\"icon-tags\"></i>
    The <code>calcresult</code> partial:
</p>

<pre>";
        // line 33
        echo twig_escape_filter($this->env, (string) $this->renderBlock("__internal_67e9ee2491cb8c5f374be6802aacd02d13a980f6cfdd2f429bf0eca94cdda77c", $context, $blocks));
        // line 38
        echo "</pre>

<hr />

<p class=\"lead\">
    <i class=\"icon-code\"></i>
    The <code>onTest</code> PHP code:
</p>

<pre>function onTest()
{
    \$value1 = post('value1');
    \$value2 = post('value2');
    \$operation = post('operation');

    switch (\$operation) {
        case '+' : 
            \$this['result'] = \$value1 + \$value2;
            break;
        case '-' : 
            \$this['result'] = \$value1 - \$value2;
            break;
        case '*' : 
            \$this['result'] = \$value1 * \$value2;
            break;
        default : 
            \$this['result'] = \$value1 / \$value2;
            break;
    }
}</pre>


<hr />

<div class=\"text-center\">
    <p><a href=\"";
        // line 73
        echo $this->env->getExtension('CMS')->pageFilter("plugins");
        echo "\" class=\"btn btn-lg btn-default\">Continue to Plugin components</a></p>
</div>";
    }

    // line 9
    public function block___internal_341b8104bab8427c3426f9c5c38e4f0c7245977526d0e87add3225c0d05aaa02($context, array $blocks = array())
    {
        echo "<!-- The form -->
<form data-request=\"onTest\" data-request-update=\"calcresult: '#result'\">
    <input type=\"text\" value=\"15\" name=\"value1\">
    <select name=\"operation\">
        <option>+</option>
        <option>-</option>
        <option>*</option>
        <option>/</option>
    </select>
    <input type=\"text\" value=\"5\" name=\"value2\">
    <button type=\"submit\">Calculate</button>
</form>

<!-- The result -->
<div id=\"result\">";
        // line 23
        echo "{% partial \"calcresult\" %}";
        echo "</div>
";
    }

    // line 33
    public function block___internal_67e9ee2491cb8c5f374be6802aacd02d13a980f6cfdd2f429bf0eca94cdda77c($context, array $blocks = array())
    {
        // line 34
        echo "{% if result != null %}";
        echo "
    The result is ";
        // line 35
        echo "{{ result }}";
        echo ".
";
        // line 36
        echo "{% else %}";
        echo "
    Click the <em>Calculate</em> button to find the answer.
";
        // line 38
        echo "{% endif %}";
    }

    public function getTemplateName()
    {
        return "/var/www/html/themes/feflip/partials/explain/ajax.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  129 => 38,  124 => 36,  120 => 35,  116 => 34,  113 => 33,  107 => 23,  89 => 9,  83 => 73,  46 => 38,  44 => 33,  33 => 24,  31 => 9,  30 => 6,  24 => 3,  21 => 1,  64 => 39,  56 => 33,  52 => 32,  19 => 1,);
    }
}
