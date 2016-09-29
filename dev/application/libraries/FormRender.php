<?php

    class FormRender {
        function __construct(argument) {

        }

        public function renderForm($action, $dataMatrix, $method='POST') {
            echo "<form class=\"\" action=\"$action\" method=\"$method\">";
            foreach ($dataMatrix as $key => $value) {
                echo "<div class=\"form-group\">";
                echo "<label for=\"user\">$key</label>";
                $value['class']='form-control';
                echo form_input($value);
                echo "</div>";
            }
            echo "<div class=\"container-fluid\"> <div class=\"row form-group\"> <button type=\"submit\" class=\"btn btn-default pull-right\">Sign in</button> </div> </div>";
            echo "</form>";
        }
    }
