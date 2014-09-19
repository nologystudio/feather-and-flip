<?php

/* /var/www/html/themes/feflip/pages/home.htm */
class __TwigTemplate_e13625738ccad781a59b9854d5d899b4a5b135d569c4f2dba66ac6b450a0f6c2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            '__internal_490d897a2cf0dbb0f7f396371eb4d538d1f10eac8541b1a4406da2cd470addfd' => array($this, 'block___internal_490d897a2cf0dbb0f7f396371eb4d538d1f10eac8541b1a4406da2cd470addfd'),
            '__internal_7b67222737c039541b0d10bd988a34327b0ca31de186ccc95b287880be6e6f34' => array($this, 'block___internal_7b67222737c039541b0d10bd988a34327b0ca31de186ccc95b287880be6e6f34'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"jumbotron\">
\t";
        // line 2
        if ((isset($context["user"]) ? $context["user"] : null)) {
            // line 3
            echo "\t    <p>Hello ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "name"), "html", null, true);
            echo "</p>
\t    <a data-request=\"onLogout\" data-request-data=\"redirect: '/'\">Sign out</a>
\t";
        } else {
            // line 6
            echo "\t    <p>Nobody is logged in</p>
\t";
        }
        // line 8
        echo "\t";
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('CMS')->componentFunction("account"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 9
        echo "</div>
<div class=\"jumbotron\">
    <div class=\"container\">
        ";
        // line 12
        echo $this->env->getExtension('CMS')->contentFunction("welcome.htm"        );
        // line 13
        echo "    </div>
</div>

<div class=\"container\">

    <div class=\"page-header\">
        <h2>Overview <small>Basic concepts</small></h2>
    </div>
    <p>
        This page demonstrates the basic CMS features.
        Usually each page built with October is a combination of a layout, page, partials and content blocks,
        although in simple cases you can just use a page without anything else.
    </p>

    <!-- Layouts -->
    <h3>Layouts</h3>
    <p class=\"lead\">
        <i class=\"icon-th-large\"></i>
        Layouts define the page scaffold.
    </p>
    <p>
        The layout file <code>layouts/default.htm</code> defines the page scaffold —
        everything that repeats on each page, such as the HTML, HEAD and BODY tags, StyleSheet and JavaScript references.
    </p>
    <p>
        The page menu and footer in the Demo theme are defined in the layout as well.
    </p>

    <hr />

    <!-- Pages -->
    <h3>Pages</h3>
    <p class=\"lead\">
        <i class=\"icon-copy\"></i>
        Pages hold the content for each URL.
    </p>
    <p>
        The page file <code>pages/home.htm</code> defines the page URL (<code>/</code> for this page) and the page content.
        Pages are rendered inside layouts with this function that should be called in the layout code:
        <pre>";
        // line 52
        echo "{% page %}";
        echo "</pre>
        Using a layout for pages is optional — you can define everything right in the page file.
    </p>

    <hr />

    <!-- Partials -->
    <h3>Partials</h3>
    <p class=\"lead\">
        <i class=\"icon-tags\"></i>
        Partials contain reusable chunks of HTML markup.
    </p>
    <p>
        Partials are chunks of HTML defined in separate files which can be included anywhere.
        In this example we placed the footer content to the <code>partials/footer.htm</code> partial.
        Partials are rendered with:
        <pre>";
        // line 68
        echo "{% partial \"partial-name\" %}";
        echo "</pre> 
        It can be used inside pages, templates or other partials.
    </p>

    <hr />

    <!-- Content blocks -->
    <h3>Content blocks</h3>
    <p class=\"lead\">
        <i class=\"icon-font\"></i>
        Content blocks are text or HTML blocks that can be edited separately from the page or layout.
    </p>
    <p>
        The introductory text used on this page is defined in the <code>content/welcome.htm</code> file.
        Content blocks are defined and rendered with: 
        <pre>";
        // line 83
        echo "{% content \"content-name.htm\" %}";
        echo "</pre>
    </p>

    <hr />

    <!-- Placeholders -->
    <h3>Placeholders</h3>
    <p class=\"lead\">
        <i class=\"icon-bookmark\"></i>
        Placeholders allow pages to inject content to a layout.
    </p>
    <p>
        The common use is injecting page-specific links to StyleSheet or JavaScript files to the HEAD tag defined in the layout.
        Placeholders are defined in the layout file and they have names so that they can be referred in the page.
        Example:
    </p>
    <div class=\"row\">
        <div class=\"col-md-6\">
            Layout file:
            <pre>";
        // line 102
        echo twig_escape_filter($this->env, (string) $this->renderBlock("__internal_490d897a2cf0dbb0f7f396371eb4d538d1f10eac8541b1a4406da2cd470addfd", $context, $blocks));
        echo "</pre>
        </div>
        <div class=\"col-md-6\">
            Page file:
            <pre>";
        // line 106
        echo twig_escape_filter($this->env, (string) $this->renderBlock("__internal_7b67222737c039541b0d10bd988a34327b0ca31de186ccc95b287880be6e6f34", $context, $blocks));
        echo "</pre>
        </div>
    </div>

    <hr />

    <!-- Assets -->
    <h3>Assets</h3>
    <p class=\"lead\">
        <i class=\"icon-picture\"></i>
        Assets are resource files like images and stylesheets.
    </p>
    <p>This theme stores its asset files (JavaScript, StyleSheet, images, fonts, etc) in the <code>themes/feflip/assets</code> directory. This theme is also packaged with these useful 3rd party tools:</p>
    <ul class=\"list-inline\">
        <li><a target=\"_blank\" href=\"http://getbootstrap.com/\">Twitter Bootstrap</a></li>
        <li><a target=\"_blank\" href=\"http://fontawesome.io/3.2.1/\">Font Awesome</a></li>
        <li><a target=\"_blank\" href=\"http://www.google.com/fonts/specimen/Lato\">Lato webfont</a></li>
    </ul>
    <p>You might prefer to remove them for your website implementation.</p>

    <hr />

    <div class=\"text-center\">
        <p><a href=\"";
        // line 129
        echo $this->env->getExtension('CMS')->pageFilter("ajax");
        echo "\" class=\"btn btn-lg btn-default\">Continue to AJAX framework</a></p>
    </div>

</div>";
    }

    // line 102
    public function block___internal_490d897a2cf0dbb0f7f396371eb4d538d1f10eac8541b1a4406da2cd470addfd($context, array $blocks = array())
    {
        echo $this->env->getExtension('CMS')->contentFunction("placeholder/layout.txt"        );
    }

    // line 106
    public function block___internal_7b67222737c039541b0d10bd988a34327b0ca31de186ccc95b287880be6e6f34($context, array $blocks = array())
    {
        echo $this->env->getExtension('CMS')->contentFunction("placeholder/page.txt"        );
    }

    public function getTemplateName()
    {
        return "/var/www/html/themes/feflip/pages/home.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  196 => 106,  190 => 102,  182 => 129,  156 => 106,  149 => 102,  127 => 83,  109 => 68,  90 => 52,  49 => 13,  47 => 12,  42 => 9,  37 => 8,  33 => 6,  26 => 3,  24 => 2,  21 => 1,);
    }
}
