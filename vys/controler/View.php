<?php

class View {

    function render($file, $variables = array()) {
        extract($variables);

        ob_start();
        include '../templates/'.$file;
        $renderedView = ob_get_clean();

        return $renderedView;
    }

}


?>
