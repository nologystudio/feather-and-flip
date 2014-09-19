<?php 
class Cms53f63c2e4850e_404445345Class extends \Cms\Classes\PageCode
{
public function onTest()
{
    $value1 = post('value1');
    $value2 = post('value2');
    $operation = post('operation');

    switch ($operation) {
        case '+' :
            $this['result'] = $value1 + $value2;
            break;
        case '-' :
            $this['result'] = $value1 - $value2;
            break;
        case '*' :
            $this['result'] = $value1 * $value2;
            break;
        default :
            $this['result'] = $value1 / $value2;
            break;
    }
}

}
