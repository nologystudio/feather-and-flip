<?php

/* /var/www/html/plugins/rainlab/user/components/account/register.htm */
class __TwigTemplate_dbe520d2560cf090790c0c45ddb83f4355d3edfd445f2aeeea6be441f349d222 extends Twig_Template
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
        echo "<form
    data-request=\"onRegister\">
    <div class=\"form-group\">
        <label for=\"registerName\">Full Name</label>
        <input name=\"name\" type=\"text\" class=\"form-control\" id=\"registerEmail\" placeholder=\"Enter your full name\">
    </div>

    <div class=\"form-group\">
        <label for=\"registerEmail\">Email</label>
        <input name=\"email\" type=\"email\" class=\"form-control\" id=\"registerEmail\" placeholder=\"Enter your email\">
    </div>

    <div class=\"form-group\">
        <label for=\"registerPassword\">Password</label>
        <input name=\"password\" type=\"password\" class=\"form-control\" id=\"registerPassword\" placeholder=\"Choose a password\">
    </div>

    <button type=\"submit\" class=\"btn btn-default\">Register</button>
</form>";
    }

    public function getTemplateName()
    {
        return "/var/www/html/plugins/rainlab/user/components/account/register.htm";
    }

    public function getDebugInfo()
    {
        return array (  63 => 22,  59 => 21,  56 => 20,  52 => 19,  38 => 12,  32 => 8,  28 => 7,  19 => 1,  196 => 106,  190 => 102,  182 => 129,  156 => 106,  149 => 102,  127 => 83,  109 => 68,  90 => 52,  49 => 18,  47 => 12,  42 => 13,  37 => 8,  33 => 6,  26 => 3,  24 => 2,  21 => 2,);
    }
}
