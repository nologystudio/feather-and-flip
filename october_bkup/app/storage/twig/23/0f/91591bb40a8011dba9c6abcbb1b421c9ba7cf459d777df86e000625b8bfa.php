<?php

/* /var/www/html/plugins/october/demo/components/todo/list.htm */
class __TwigTemplate_230f91591bb40a8011dba9c6abcbb1b421c9ba7cf459d777df86e000625b8bfa extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["items"]) ? $context["items"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 2
            echo "    <li class=\"list-group-item\">
        <input type=\"hidden\" name=\"items[]\" value=\"";
            // line 3
            echo twig_escape_filter($this->env, (isset($context["item"]) ? $context["item"] : null), "html", null, true);
            echo "\" />
        
        ";
            // line 5
            echo twig_escape_filter($this->env, (isset($context["item"]) ? $context["item"] : null), "html", null, true);
            echo "

        <button type=\"button\" 
            class=\"close pull-right\" 
            aria-hidden=\"true\" 
            class=\"\" 
            onclick=\"\$(this).closest('li').remove()\">&times;</button>
    </li>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "/var/www/html/plugins/october/demo/components/todo/list.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 5,  26 => 3,  23 => 2,  19 => 1,);
    }
}
