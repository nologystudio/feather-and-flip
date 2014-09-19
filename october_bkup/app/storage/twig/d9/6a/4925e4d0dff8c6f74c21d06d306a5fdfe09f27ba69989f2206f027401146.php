<?php

/* /var/www/html/plugins/rainlab/user/components/account/default.htm */
class __TwigTemplate_d96a4925e4d0dff8c6f74c21d06d306a5fdfe09f27ba69989f2206f027401146 extends Twig_Template
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
        if ((!(isset($context["user"]) ? $context["user"] : null))) {
            // line 2
            echo "
    <div class=\"row\">

        <div class=\"col-md-6\">
            <h3>Sign in</h3>
            ";
            // line 7
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('CMS')->partialFunction(((isset($context["__SELF__"]) ? $context["__SELF__"] : null) . "::signin")            , $context['__cms_partial_params']            );
            unset($context['__cms_partial_params']);
            // line 8
            echo "        </div>

        <div class=\"col-md-6\">
            <h3>Register</h3>
            ";
            // line 12
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('CMS')->partialFunction(((isset($context["__SELF__"]) ? $context["__SELF__"] : null) . "::register")            , $context['__cms_partial_params']            );
            unset($context['__cms_partial_params']);
            // line 13
            echo "        </div>

    </div>

";
        } else {
            // line 18
            echo "
    ";
            // line 19
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('CMS')->partialFunction(((isset($context["__SELF__"]) ? $context["__SELF__"] : null) . "::activation_check")            , $context['__cms_partial_params']            );
            unset($context['__cms_partial_params']);
            // line 20
            echo "
    ";
            // line 21
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('CMS')->partialFunction(((isset($context["__SELF__"]) ? $context["__SELF__"] : null) . "::update")            , $context['__cms_partial_params']            );
            unset($context['__cms_partial_params']);
            // line 22
            echo "
";
        }
    }

    public function getTemplateName()
    {
        return "/var/www/html/plugins/rainlab/user/components/account/default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  63 => 22,  59 => 21,  56 => 20,  52 => 19,  38 => 12,  32 => 8,  28 => 7,  19 => 1,  196 => 106,  190 => 102,  182 => 129,  156 => 106,  149 => 102,  127 => 83,  109 => 68,  90 => 52,  49 => 18,  47 => 12,  42 => 13,  37 => 8,  33 => 6,  26 => 3,  24 => 2,  21 => 2,);
    }
}
