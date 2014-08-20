<?php

/* /var/www/html/themes/demo/partials/explain/ajax.htm */
class __TwigTemplate_7869f308459ec2b6a77d8876accfedf290888ea8dc18599d6ac36f97dad7eef2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            '__internal_10808fa0902b725e47c219042bf5fc0a2b02d2b813d11f3805e5a00931a832d1' => array($this, 'block___internal_10808fa0902b725e47c219042bf5fc0a2b02d2b813d11f3805e5a00931a832d1'),
            '__internal_80b949e96689486b8ea70cb2ddf94cd86610f7d8d66c5d5f35c50c0e32b14bdf' => array($this, 'block___internal_80b949e96689486b8ea70cb2ddf94cd86610f7d8d66c5d5f35c50c0e32b14bdf'),
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
        echo twig_escape_filter($this->env, (string) $this->renderBlock("__internal_10808fa0902b725e47c219042bf5fc0a2b02d2b813d11f3805e5a00931a832d1", $context, $blocks));
        // line 24
        echo "</pre>

<hr />

<p class=\"lead\">
    <i class=\"icon-tags\"></i>
    The <code>calcresult</code> partial:
</p>

<pre>";
        // line 33
        echo twig_escape_filter($this->env, (string) $this->renderBlock("__internal_80b949e96689486b8ea70cb2ddf94cd86610f7d8d66c5d5f35c50c0e32b14bdf", $context, $blocks));
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
    public function block___internal_10808fa0902b725e47c219042bf5fc0a2b02d2b813d11f3805e5a00931a832d1($context, array $blocks = array())
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
    public function block___internal_80b949e96689486b8ea70cb2ddf94cd86610f7d8d66c5d5f35c50c0e32b14bdf($context, array $blocks = array())
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
        return "/var/www/html/themes/demo/partials/explain/ajax.htm";
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
