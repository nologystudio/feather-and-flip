<?php

/* /var/www/html/themes/feflip/layouts/default.htm */
class __TwigTemplate_cfb898f1c173db5822db8773e418e9959bc635ff625516253ef15b10cf675a14 extends Twig_Template
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
        echo "<!DOCTYPE html>
<html>
    <head>
        <title>Feather & Flip | ";
        // line 4
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["this"]) ? $context["this"] : null), "page"), "title"), "html", null, true);
        echo "</title>
        <meta name=\"author\" content=\"NOLOGY.\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
\t\t<meta name=\"description\" content=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["this"]) ? $context["this"] : null), "page"), "meta_description"), "html", null, true);
        echo "\">
\t\t<meta name=\"og:title\" content=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["this"]) ? $context["this"] : null), "page"), "meta_title"), "html", null, true);
        echo "\">
\t\t<meta name=\"og:description\" content=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["this"]) ? $context["this"] : null), "page"), "meta_description"), "html", null, true);
        echo "\">
\t\t<meta name=\"og:url\" content=\"http://54.164.51.183";
        // line 10
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["this"]) ? $context["this"] : null), "page"), "url"), "html", null, true);
        echo "\">
        <link rel=\"icon\" type=\"image/png\" href=\"";
        // line 11
        echo $this->env->getExtension('CMS')->themeFilter("assets/images/october.png");
        echo "\" />
        ";
        // line 12
        echo $this->env->getExtension('CMS')->assetsFunction('css');
        echo $this->env->getExtension('CMS')->displayBlock('styles');
        // line 13
        echo "        <link href=\"";
        echo $this->env->getExtension('CMS')->themeFilter(array(0 => "assets/css/theme.css"));
        // line 15
        echo "\" rel=\"stylesheet\">
    </head>
    <body>

        <!-- Header -->
        <header id=\"layout-header\">

            <!-- Nav -->
            <nav id=\"layout-nav\" class=\"navbar navbar-inverse navbar-fixed-top\" role=\"navigation\">
                <div class=\"container\">
                    <div class=\"navbar-header\">
                        <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-main-collapse\">
                            <span class=\"sr-only\">Toggle navigation</span>
                            <span class=\"icon-bar\"></span>
                            <span class=\"icon-bar\"></span>
                            <span class=\"icon-bar\"></span>
                        </button>
                        <a class=\"navbar-brand\" href=\"";
        // line 32
        echo $this->env->getExtension('CMS')->pageFilter("home");
        echo "\">October Demo</a>
                    </div>
                    <div class=\"collapse navbar-collapse navbar-main-collapse\">
                        <ul class=\"nav navbar-nav\">
                            <li class=\"";
        // line 36
        if (($this->getAttribute($this->getAttribute((isset($context["this"]) ? $context["this"] : null), "page"), "id") == "home")) {
            echo "active";
        }
        echo "\"><a href=\"";
        echo $this->env->getExtension('CMS')->pageFilter("home");
        echo "\">Basic concepts</a></li>
                            <li class=\"";
        // line 37
        if (($this->getAttribute($this->getAttribute((isset($context["this"]) ? $context["this"] : null), "page"), "id") == "ajax")) {
            echo "active";
        }
        echo "\"><a href=\"";
        echo $this->env->getExtension('CMS')->pageFilter("ajax");
        echo "\">AJAX framework</a></li>
                            <li class=\"";
        // line 38
        if (($this->getAttribute($this->getAttribute((isset($context["this"]) ? $context["this"] : null), "page"), "id") == "plugins")) {
            echo "active";
        }
        echo "\"><a href=\"";
        echo $this->env->getExtension('CMS')->pageFilter("plugins");
        echo "\">Plugin components</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

        </header>

        <!-- Content -->
        <section id=\"layout-content\">
            ";
        // line 48
        echo $this->env->getExtension('CMS')->pageFunction();
        // line 49
        echo "        </section>

        <!-- Main navigation -->
        ";
        // line 52
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('CMS')->partialFunction("main-nav"        , $context['__cms_partial_params']        );
        unset($context['__cms_partial_params']);
        // line 53
        echo "        
        <!-- Footer -->
        <footer id=\"layout-footer\">
            ";
        // line 56
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('CMS')->partialFunction("footer"        , $context['__cms_partial_params']        );
        unset($context['__cms_partial_params']);
        // line 57
        echo "        </footer>

        <!-- Scripts -->
        <script src=\"";
        // line 60
        echo $this->env->getExtension('CMS')->themeFilter(array(0 => "assets/javascript/jquery.js", 1 => "assets/javascript/app.js"));
        // line 63
        echo "\"></script>
        ";
        // line 64
        echo '<script src="'. Request::getBasePath() .'/modules/system/assets/js/framework.js"></script>'.PHP_EOL;
        echo '<script src="'. Request::getBasePath() .'/modules/system/assets/js/framework.extras.js"></script>'.PHP_EOL;
        echo '<link href="'. Request::getBasePath() .'/modules/system/assets/css/framework.extras.css" rel="stylesheet">'.PHP_EOL;
        // line 65
        echo "        ";
        echo $this->env->getExtension('CMS')->assetsFunction('js');
        echo $this->env->getExtension('CMS')->displayBlock('scripts');
        // line 66
        echo "
    </body>
</html>";
    }

    public function getTemplateName()
    {
        return "/var/www/html/themes/feflip/layouts/default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  153 => 66,  149 => 65,  145 => 64,  142 => 63,  140 => 60,  135 => 57,  131 => 56,  126 => 53,  122 => 52,  117 => 49,  115 => 48,  98 => 38,  90 => 37,  82 => 36,  75 => 32,  56 => 15,  53 => 13,  50 => 12,  46 => 11,  42 => 10,  38 => 9,  34 => 8,  30 => 7,  24 => 4,  19 => 1,);
    }
}
