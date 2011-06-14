<?php

/* SonataAdminBundle::standard_layout.html.twig */
class __TwigTemplate_f6edaa80d7eb0d3cee0c9af3db7500d9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'title' => array($this, 'block_title'),
            'user_panel' => array($this, 'block_user_panel'),
            'actions' => array($this, 'block_actions'),
            'breadcrumb' => array($this, 'block_breadcrumb'),
            'footer' => array($this, 'block_footer'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $context = array_merge($this->env->getGlobals(), $context);

        // line 11
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />

        ";
        // line 16
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 29
        echo "
        ";
        // line 30
        $this->displayBlock('javascripts', $context, $blocks);
        // line 38
        echo "
        <title>
            ";
        // line 40
        $this->displayBlock('title', $context, $blocks);
        // line 51
        echo "        </title>
    </head>
    <body>

        ";
        // line 56
        echo "        ";
        $context['preview'] = $this->renderBlock("preview", $context, $blocks);
        // line 57
        echo "        ";
        $context['form'] = $this->renderBlock("form", $context, $blocks);
        // line 58
        echo "        ";
        $context['list_table'] = $this->renderBlock("list_table", $context, $blocks);
        // line 59
        echo "        ";
        $context['list_filters'] = $this->renderBlock("list_filters", $context, $blocks);
        // line 60
        echo "        ";
        $context['side_menu'] = $this->renderBlock("side_menu", $context, $blocks);
        // line 61
        echo "        ";
        $context['content'] = $this->renderBlock("content", $context, $blocks);
        // line 62
        echo "

        <div class=\"container\">
            <div class=\"span-24 last header\">
                <div class=\"span-20\">
                    <a href=\"";
        // line 67
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_admin_dashboard"), "html");
        echo "\" class=\"home\">";
        echo $this->env->getExtension('translator')->getTranslator()->trans("Admin", array(), "SonataAdminBundle");
        echo "</a>
                </div>

                <div class=\"span-4 last\">
                    ";
        // line 71
        $this->displayBlock('user_panel', $context, $blocks);
        // line 72
        echo "                </div>
            </div>

            <div class=\"span-24 last content clear\">
                <div class=\"right\">
                    ";
        // line 77
        $this->displayBlock('actions', $context, $blocks);
        // line 78
        echo "                </div>

                <div class=\"sonata-ba-breadcrumbs\">
                    <h1>
                    ";
        // line 82
        $this->displayBlock('breadcrumb', $context, $blocks);
        // line 92
        echo "                    </h1>
                </div>
            </div>

            ";
        // line 96
        if ((!twig_test_empty($this->getContext($context, 'preview')))) {
            // line 97
            echo "                <div class=\"span-24 last content clear\">
                    <div class=\"sonata-ba-preview\">";
            // line 98
            echo $this->getContext($context, 'preview');
            echo "</div>
                </div>
            ";
        }
        // line 101
        echo "
            <div class=\"span-24 last content clear\">

                ";
        // line 104
        if ((!twig_test_empty($this->getContext($context, 'side_menu')))) {
            // line 105
            echo "                        <div class=\"span-4\">
                            <div class=\"sonata-ba-side-menu\">";
            // line 106
            echo $this->getContext($context, 'side_menu');
            echo "</div>
                        </div>
                        <div class=\"span-18 last content\">
                ";
        }
        // line 110
        echo "
                    ";
        // line 111
        if ((!twig_test_empty($this->getContext($context, 'content')))) {
            // line 112
            echo "                        <div class=\"sonata-ba-content\">";
            echo $this->getContext($context, 'content');
            echo "</div>
                    ";
        }
        // line 114
        echo "
                    ";
        // line 115
        if ((!twig_test_empty($this->getContext($context, 'form')))) {
            // line 116
            echo "                        <div class=\"sonata-ba-form\">";
            echo $this->getContext($context, 'form');
            echo "</div>
                    ";
        }
        // line 118
        echo "
                    ";
        // line 119
        if (((!twig_test_empty($this->getContext($context, 'list_table'))) || (!twig_test_empty($this->getContext($context, 'list_filters'))))) {
            // line 120
            echo "                        ";
            if ((!twig_test_empty($this->getContext($context, 'side_menu')))) {
                // line 121
                echo "                            <div class=\"sonata-ba-list\">
                                <div class=\"span-13\">
                                    ";
                // line 123
                echo $this->getContext($context, 'list_table');
                echo "
                                </div>
                                <div class=\"span-5 last\">
                                    ";
                // line 126
                echo $this->getContext($context, 'list_filters');
                echo "
                                </div>
                            </div>
                        ";
            } else {
                // line 130
                echo "                            <div class=\"sonata-ba-list\">
                                <div class=\"span-19\">
                                    ";
                // line 132
                echo $this->getContext($context, 'list_table');
                echo "
                                </div>
                                <div class=\"span-5 last\">
                                    ";
                // line 135
                echo $this->getContext($context, 'list_filters');
                echo "
                                </div>
                            </div>
                        ";
            }
            // line 139
            echo "                    ";
        }
        // line 140
        echo "
                ";
        // line 141
        if ((!twig_test_empty($this->getContext($context, 'side_menu')))) {
            // line 142
            echo "                    </div>
                ";
        }
        // line 144
        echo "
            </div>

            <!-- footer -->
            <div class=\"span-24 last\">
                ";
        // line 149
        $this->displayBlock('footer', $context, $blocks);
        // line 150
        echo "            </div>
        </div>
    </body>
</html>

";
    }

    // line 16
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 17
        echo "            <!-- jQuery code -->
            <link rel=\"stylesheet\" href=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatajquery/themes/flick/jquery-ui-1.8.6.custom.css"), "html");
        echo "\" type=\"text/css\" media=\"all\" />

            <!-- blueprint code -->
            <link rel=\"stylesheet\" href=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatablueprint/screen.css"), "html");
        echo "\" type=\"text/css\" media=\"screen, projection\">
            <link rel=\"stylesheet\" href=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatablueprint/print.css"), "html");
        echo "\" type=\"text/css\" media=\"print\">
            <!--[if lt IE 8]><link rel=\"stylesheet\" href=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatablueprint/ie.css"), "html");
        echo "\" type=\"text/css\" media=\"screen, projection\"><![endif]-->

            <!-- base application asset -->
            <link rel=\"stylesheet\" href=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonataadmin/css/layout.css"), "html");
        echo "\" type=\"text/css\" media=\"all\">
            <link rel=\"stylesheet\" href=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonataadmin/css/colors.css"), "html");
        echo "\" type=\"text/css\" media=\"all\">
        ";
    }

    // line 30
    public function block_javascripts($context, array $blocks = array())
    {
        // line 31
        echo "            <script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatajquery/jquery-1.4.4.js"), "html");
        echo "\" type=\"text/javascript\"></script>
            <script src=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatajquery/jquery-ui-1.8.6.custom.js"), "html");
        echo "\" type=\"text/javascript\"></script>
            <script src=\"";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatajquery/jquery-ui-i18n.js"), "html");
        echo "\" type=\"text/javascript\"></script>
            <script src=\"";
        // line 34
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonataadmin/qtip/jquery.qtip-1.0.0-rc3.min.js"), "html");
        echo "\" type=\"text/javascript\"></script>
            <script src=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonataadmin/jquery/jquery.form.js"), "html");
        echo "\" type=\"text/javascript\"></script>
            <script src=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonataadmin/base.js"), "html");
        echo "\" type=\"text/javascript\"></script>
        ";
    }

    // line 40
    public function block_title($context, array $blocks = array())
    {
        echo " ";
        echo $this->env->getExtension('translator')->getTranslator()->trans("Admin", array(), "SonataAdminBundle");
        // line 41
        echo "                ";
        if (twig_test_defined("action", $context)) {
            // line 42
            echo "                    -
                    ";
            // line 43
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, 'admin'), "breadcrumbs", array($this->getContext($context, 'action'), ), "method", false));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context['label'] => $context['uri']) {
                // line 44
                echo "                        ";
                if ((!$this->getAttribute($this->getContext($context, 'loop'), "first", array(), "any", false))) {
                    // line 45
                    echo "                            &gt;
                        ";
                }
                // line 47
                echo "                        ";
                echo twig_escape_filter($this->env, $this->getContext($context, 'label'), "html");
                echo "
                    ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['label'], $context['uri'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 49
            echo "                ";
        }
        // line 50
        echo "            ";
    }

    // line 71
    public function block_user_panel($context, array $blocks = array())
    {
        echo "Add here logout option / user options";
    }

    // line 77
    public function block_actions($context, array $blocks = array())
    {
    }

    // line 82
    public function block_breadcrumb($context, array $blocks = array())
    {
        // line 83
        echo "                        ";
        if (twig_test_defined("action", $context)) {
            // line 84
            echo "                            ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, 'admin'), "breadcrumbs", array($this->getContext($context, 'action'), ), "method", false));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context['label'] => $context['uri']) {
                // line 85
                echo "                                ";
                if ((!$this->getAttribute($this->getContext($context, 'loop'), "first", array(), "any", false))) {
                    // line 86
                    echo "                                    &gt;
                                ";
                }
                // line 88
                echo "                                <a href=\"";
                echo twig_escape_filter($this->env, $this->getContext($context, 'uri'), "html");
                echo "\">";
                echo twig_escape_filter($this->env, $this->getContext($context, 'label'), "html");
                echo "</a>
                            ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['label'], $context['uri'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 90
            echo "                        ";
        }
        // line 91
        echo "                    ";
    }

    // line 149
    public function block_footer($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle::standard_layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
