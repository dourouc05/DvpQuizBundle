<?php

/* Sf2genConsoleBundle:Console:toolbar.html.twig */
class __TwigTemplate_204fd7bc422ae4386933af336cf97b62 extends Twig_Template
{
    protected function doDisplay(array $context, array $blocks = array())
    {
        $context = array_merge($this->env->getGlobals(), $context);

        // line 1
        echo "<!-- START of Symfony2 Web Debug Toolbar -->
";
        // line 2
        if (("normal" != $this->getContext($context, 'position'))) {
            // line 3
            echo "    <div style=\"clear: both; height: 40px;\"></div>
";
        }
        // line 5
        echo "
<div
    style=\"position: ";
        // line 7
        echo twig_escape_filter($this->env, $this->getContext($context, 'position'), "html");
        echo ";
        background-color: #f7f7f7;
            top: 0;
            right:0;
            margin:0;
            padding: 0;
            z-index: 6000000;
            width: 16px;
            height: 16px;
            text-align: left;\"
>
    <span style=\"display:block; position:absolute; text-align:right; top:2px; right:2px; width:auto; height:20px;\">
        <img 
            alt=\"Show console\" 
            style=\"cursor: pointer;\"
            src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAAlFJREFUeJylk7FrFFEQxn/z3tu9Z3bvchBIQBEsrCSEdEKMhWWE2EUrq5AyBP8IJUUCIvgX2NkIqWw02AkWkaRILV5ySXMJCefe7tv3noXcYkhh4cDHwMwwMx/zDfynycLCwpPt7e0309PTXe99k4gxAtBut6/EYoxorTk8PDxfXV19rjc3N98tLS3dGw6HNs9zm2WZnZiYaKCUslrrBiJiRcTOzs52T05OctPtdpN+v8/LV6+Yn5/nbDCg1WqhlLq+rghFUXB6esrW1hbWWmtijEGA2bk5Hj56xPe9Pfb39vg1HF5rEmMkhMDU1BTOOeq6DkYpRZqm7H76xM3bt3n29Cm9Xo+D/X2stde28N4jIlxeXuK9x2itKYqCW3fuEGNkfX2db1+/MhwOUSLYGzdQShFjbCiUZYn3Hq01RilFu9Phw/v3vH39Gpum3H/wgMfLy1Qh8PnjR456PQDqumYwGJBlWUPJACilcFUFMZKkKUc/f/Jld5cInJ2dEULAOUdRFDjnEBHqukZE/lAQEfI8xzlHp9MhhsBJv48SIU0SJicnKcsSYwxVVaG1ZqwZIyKICFmW4Zyj3W5jrSVJEkSEGCPOOUajEcYYRqMRrVbraoMQAnVdE0JAKYUxhiRJrkxyzgEQQmjqAYzW2qRpytraGlVVNdPH1EIIVFVFWZaUZcnFxQUzMzPjc2pzcHDwY3FxcW5jY+OKYOq6buC9b7z3nqqqcM5xfHw8kE6nc3dlZeVFnudd730cq+1v5Y0faxwXETk/P7/Y2dl5849n/bf9Bv1DPYZYR4JBAAAAAElFTkSuQmCC\" 
            onclick=\"el=document.getElementById('sf2gencdt-console');if(el.style.display == 'none'){el.style.display = 'block';document.getElementById('sf2gencdt-console-input').focus();}else{el.style.display = 'none';}\" 
        />
        <div
            id=\"sf2gencdt-console\"
            style=\"display:none;
            position:relative;width:100%;\"
        >
            <div 
            id=\"sf2gencdt-console-output\"
            style=\"position:relative;
                   background-color:#000;
                   color:#fff;
                   width:600px;
                   height:300px;
                   padding:5px;
                   text-align:left;
                   overflow:auto;
                   font:13px arial,sans-serif;
                   \"
            >
                Sf2gen\\ConsoleBundle [Version 1.0 alpha2]<br/>
                <hr/>
            </div>
            <div>
";
        // line 47
        if ((twig_length_filter($this->env, $this->getContext($context, 'apps')) > 1)) {
            // line 48
            echo "            <select
                id=\"sf2gencdt-console-app\" 
                type=\"text\" 
                style=\"float:left;width:19%;background-color:#000;color:#fff;padding:2px;\"
                onkeyup=\"return sf2gen.console(event);\"
            />
";
            // line 54
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getContext($context, 'apps'));
            foreach ($context['_seq'] as $context['_key'] => $context['item']) {
                // line 55
                echo "            <option value=\"";
                echo twig_escape_filter($this->env, $this->getContext($context, 'item'), "html");
                echo "\">";
                echo twig_escape_filter($this->env, $this->getContext($context, 'item'), "html");
                echo "</option>
";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 56
            echo "            
            </select>
            <input
                id=\"sf2gencdt-console-input\" 
                type=\"text\" 
                style=\"float:left;width:79%;background-color:#000;color:#fff;padding:2px;\"
                onkeyup=\"return sf2gen.console(event);\"
            />            
";
        } else {
            // line 65
            echo "            <input
                id=\"sf2gencdt-console-input\" 
                type=\"text\" 
                style=\"width:98%;background-color:#000;color:#fff;padding:2px;\"
                onkeyup=\"return sf2gen.console(event);\"
            />
";
        }
        // line 72
        echo "            <div id=\"sf2gencdt-console-ac\" style=\"position:absolute;text-align:left;bottom:20px;left:0;display:none;\"></div>
            </div>
        </div>
    </span>
</div>
<!-- END of Symfony2 Web Debug Toolbar -->
";
    }

    public function getTemplateName()
    {
        return "Sf2genConsoleBundle:Console:toolbar.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
