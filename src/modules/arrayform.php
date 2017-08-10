<?php
namespace freest\blog\modules\arrays;

function array2form(Array $array): string
{
    $formclass = $array['form-class'];
    $formaction = $array['form-action'];
    $formtitle = $array['form-title'];
    $formtitleclass = $array['form-title-class'];
    
    $out = '
                <form ';
    if ($formclass != "") {  $out .= 'class="'.$formclass.'" ';   }
    if ($formaction != "") { $out .= 'action="'.$formaction.'" '; }
    $out .= 'method="POST">';
    if ($formtitle != "") {
        $out .= '
                    <h2';
        if ($formtitleclass != "") { $out .= ' class="'.$formtitleclass.'"'; }
        $out .= '>'.$formtitle.'</h2>';
    }
    
    $elements = $array['elements'];
    foreach ($elements as $el) {
        $type = $el['type'];
        if ($type == 'email' || $type == 'password' || $type == 'text') {
            $name = $el['name'];
            $id = $el['id'];
            $class = $el['class'];
            $labelclass = $el['label-class'];
            $setlabel = $el['setlabel'];
            $label = $el['label'];
            if ($setlabel == 1) {
                $out .= '
                    <label for="'.$id.'" class="'.$labelclass.'">'.$label.'</label>';
            }
            $out .= '
                    <input type="'.$type.'" id="'.$id.'" name="'.$name.'" class="'.$class.'" />';
        }
        elseif ($type == "hidden") {
            $name  = $el['name'];
            $value = $el['value'];
            $out .= '
                    <input type="hidden" name="'.$name.'" value="'.$value.'"/>';
        }
        elseif ($type == "submit") {
            $class = $el['class'];
            $value = $el['value'];
            $out .= '
                    <input type="submit" class="'.$class.'" value="'.$value.'"/>';
        }
    }
    $out .= '
                </form>';
    return $out;
}
