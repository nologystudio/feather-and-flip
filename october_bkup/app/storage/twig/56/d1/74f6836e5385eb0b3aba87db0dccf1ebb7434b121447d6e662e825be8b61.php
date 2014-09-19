<?php

/* /var/www/html/themes/feflip/partials/main-nav.htm */
class __TwigTemplate_56d174f6836e5385eb0b3aba87db0dccf1ebb7434b121447d6e662e825be8b61 extends Twig_Template
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
        echo "<div id=\"main-nav\">
    <div class=\"container\">
        <div id=\"search-form\"></div>
        <div id=\"nav-items\">
        \t<ul class=\"nav\">
        \t\t<li>HOTEL REVIEWS</li>
        \t\t<li>ITINERARIES</li>
        \t\t<li>HOTEL REVIEWS</li>
        \t\t<li>TRAVEL JOURNAL</li>
\t\t\t\t";
        // line 10
        if ((isset($context["user"]) ? $context["user"] : null)) {
            // line 11
            echo "\t\t\t\t    <li>Hi ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "name"), "html", null, true);
            echo "</li>
\t\t\t\t";
        } else {
            // line 13
            echo "\t\t\t\t    <li>JOIN NOW / SIGN IN</li>
\t\t\t\t";
        }
        // line 15
        echo "        \t</ul>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "/var/www/html/themes/feflip/partials/main-nav.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  32 => 11,  153 => 66,  149 => 65,  145 => 64,  142 => 63,  140 => 60,  135 => 57,  131 => 56,  126 => 53,  122 => 52,  117 => 49,  115 => 48,  98 => 38,  90 => 37,  82 => 36,  75 => 32,  56 => 15,  53 => 13,  50 => 12,  46 => 11,  42 => 15,  38 => 13,  34 => 8,  30 => 10,  24 => 4,  19 => 1,);
    }
}
