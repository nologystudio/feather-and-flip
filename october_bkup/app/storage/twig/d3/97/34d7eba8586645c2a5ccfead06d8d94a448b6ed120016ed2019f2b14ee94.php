<?php

/* /var/www/html/plugins/rainlab/user/components/account/signin.htm */
class __TwigTemplate_d39734d7eba8586645c2a5ccfead06d8d94a448b6ed120016ed2019f2b14ee94 extends Twig_Template
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
    data-request=\"onSignin\">
    <div class=\"form-group\">
        <label for=\"userSigninEmail\">Email</label>
        <input name=\"email\" type=\"email\" class=\"form-control\" id=\"userSigninEmail\" placeholder=\"Enter your email\">
    </div>

    <div class=\"form-group\">
        <label for=\"userSigninPassword\">Password</label>
        <input name=\"password\" type=\"password\" class=\"form-control\" id=\"userSigninPassword\" placeholder=\"Enter your password\">
    </div>

    <button type=\"submit\" class=\"btn btn-default\">Sign in</button>
</form>";
    }

    public function getTemplateName()
    {
        return "/var/www/html/plugins/rainlab/user/components/account/signin.htm";
    }

    public function getDebugInfo()
    {
        return array (  63 => 22,  59 => 21,  56 => 20,  52 => 19,  38 => 12,  32 => 8,  28 => 7,  19 => 1,  196 => 106,  190 => 102,  182 => 129,  156 => 106,  149 => 102,  127 => 83,  109 => 68,  90 => 52,  49 => 18,  47 => 12,  42 => 13,  37 => 8,  33 => 6,  26 => 3,  24 => 2,  21 => 2,);
    }
}
