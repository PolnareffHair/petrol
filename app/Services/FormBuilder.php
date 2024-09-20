<?php

namespace App\Services;

use FG\X509\PublicKey;

class FormBuilder
{

    public $html_forms = "";
    public $forms_get_vals;
    public $scripts_tag = "";



    
    private $script_se = ["<script>", "</script>"];

    public function create( array $product,array $form_object)
    {
        $this->scripts_tag .=$this->script_se[0];

        foreach ($form_object as $name => $params) {
                if (!isset($params)) break;
                if ($params["type"] == "zero_checkbox") {
                    $this->html_forms .= (
                        "<div class=\"product_option\" x-data=\"{ 
                            CHC$name: " . ($product["product_price_discount"] == 0 ? "false" : "true") . ", 
                            discountPrice: " . $product["product_price_discount"] . ",
                            originalPrice: " . $product["product_price_discount"] . "
                        }\">
                            <label>Знижка
                                <input x-model=\"CHC$name\" type=\"checkbox\" name=\"discount_avalible\" id=\"CHC$name\"
                                    @change=\"if (!CHC$name) { discountPrice = 0 } else { discountPrice = originalPrice }\">
                            </label>
                            <label>Ціна зі знижкою
                                <input 
                                        type=\"number\" 
                                       :disabled=\"!CHC$name\"
                                       name=\"discount_price\"
                                       id=\"ID$name\"
                                       x-model.number=\"discountPrice\"
                                       @input=\"if (!CHC$name) { discountPrice = 0 }\">
                            </label>
                        </div>"
                    );

                   $this->forms_get_vals ["$name"] =  "$(\"#ID$name\").is(':checked') ? 1 : 0;";

                }
                if ($params["type"] == "checkbox") {

                    $this->html_forms .= ("<div class='product_option'>");

                    $this->html_forms .=
                        " <label for='form_" .

                        $name .
                        "'>" .
                        $params["title"] .
                        "</label>";

                    $this->html_forms .=
                        "<input" .

                        " type='" . $params["val_type"] .
                        "' id='ID$name'";

                    if ($product[$name] == 1) {
                        $this->html_forms .=  " checked ";
                    }

                    $this->html_forms .=
                        " name='form_" . $name . "'"
                        . "> </input>";

                    $forms_ids[] = $name;

                    $this->html_forms .=  '</div>';

                    $this->forms_get_vals ["$name"] =  "$(\"#ID$name\").is(':checked') ? 1 : 0;";
                }
                if($params["type"] == "options") {
                    $this->html_forms .= ("<div class='product_option'>");

                    $this->html_forms .=
                        " <label for='form_" .
                        $name .
                        "'>" .
                        $params["title"] .
                        "</label>";


                    $this->html_forms .=
                        "<select id='ID$name'
                         name='form_" . $name . "'>";

                    $this->html_forms .= "<option value='" . $product[$name] . "'>" . $params["options"][$product[$name]] . '</option>';

                    unset($params["options"][$product["product_avalible_state"]]);

                    foreach ($params["options"] as $key => $value) {
                        $this->html_forms .= "<option value='$key'>$value</option>";
                    }

                    $this->html_forms .=
                        "</select>";

                    $forms_ids[] = $name;

                    $this->html_forms .=  '</div>';

                    $this->forms_get_vals ["$name"] =  "$(\"#ID$name\").val();";
                } 
        
                if ($params["type"] == "input_") {
                    if ($params["lang"] == 0) {
                            $this->html_forms .= ("<div class='product_option'>");
                            $this->html_forms .=
                                " <label for='form_" .
                                $name .
                                "'>" .
                                $params["title"] .
                                "</label>";

                            $this->html_forms .=
                                "<input" .
                                " type='" . $params["val_type"] .
                                "'" .
                                " id='ID$name'";

                            if (isset($params["number_limit"][0])) {
                                $this->html_forms .=
                                    " max='" . $params["number_limit"][0] . "'" .
                                    " min='" . $params["number_limit"][1] . "'";
                                $this->scripts_tag .= $this->set_number_limit("ID" . $name, $params["number_limit"][0], $params["number_limit"][1]);
                            }
                            $this->html_forms .= " value='" . $product[$name] . "'"
                                . " name='form_" . $name . "'"
                                . " </input>";
                            $forms_ids[] = $name;


                            $this->html_forms .=  '</div>';
                            $this->forms_get_vals ["$name"] =  "$(\"#ID$name\").val();";
                    }
                    elseif ($params["lang"] == 1) {
                            if (isset($params["copy_name"])) {
                                $this->html_forms .= "<button id ='ID$name" . "_bc" . "' class='auto_gen'>Авто-заповнення на основі назви продукту</button>";

                                $this->scripts_tag .= $this->set_copy_text_ru_ua("ID" . $name, "ID$name" . "_bc");
                            }
                            if (isset($params["copy_name_trans"])) {
                                $this->html_forms .= "<button id ='ID$name" . "_bc" . "' class='auto_gen'>Авто-заповнення на основі назви продукту</button>";

                                $this->scripts_tag .= $this->set_copy_text_trans_ru_ua("ID" . $name, "ID$name" . "_bc");
                            }
                            $this->html_forms .= ("<div class='product_option'>");
                            ///ru
                            $this->html_forms .=
                                " <label for='form_" .
                                $name .
                                " ru" .
                                "'>" .
                                $params["title"] .
                                " ru" .
                                "</label>";

                            $this->html_forms .=
                                "<input" .
                                " type='" . $params["val_type"] .
                                "'" .
                                " id='ID$name" . "_ru'";

                            if (isset($params["lenght_limit"])) {
                                $this->html_forms .=
                                    " maxlength='" . $params["lenght_limit"] . "'";
                                $this->scripts_tag .= $this->set_lenght_limit("ID" . $name . "_ru", $params["lenght_limit"]);
                            }
                            $this->html_forms .= " value='" . $product[$name . "_ru"] . "'"
                                . " name='form_" . $name . "_ru'>"
                                . " </input>";

                            ///ua 
                            $this->html_forms .=  '</div>';
                            $this->html_forms .= ("<div class='product_option'>");
                            $this->html_forms .=
                                " <label for='form_" .
                                $name .
                                " ua" .
                                "'>" .
                                $params["title"] .
                                " ua" .
                                "</label>";

                            $this->html_forms .=
                                "<input" .
                                " type='" . $params["val_type"] .
                                "'" .
                                " id='ID$name" . "_ua'";

                            if (isset($params["lenght_limit"])) {
                                $this->html_forms .=
                                    " maxlength='" . $params["lenght_limit"] . "'";
                                $this->scripts_tag .= $this->set_lenght_limit("ID" . $name . "_ua", $params["lenght_limit"]);
                            }
                            $this->html_forms .= " value='" . $product[$name . "_ua"] . "'"
                                . " name='form_" . $name . "_ua'>"
                                . " </input>";

                            $this->html_forms .=  '</div>';


                            $this->forms_get_vals ["$name"."_ua"] =  "$(\"#ID$name"."_ua"."\").val();";
                            $this->forms_get_vals ["$name"."_ru"] =  "$(\"#ID$name"."_ru"."\").val();";
                    }
                } 
        
                if ($params["type"] == "html_editor") {

                            $this->html_forms .= ("<div class='product_option'>");
                            $this->html_forms .=
                                " <label for='form_" .
                                $name .
                                " ru" .
                                "'>" .
                                $params["title"] .
                                " ru" .
                                "</label>";
                            $this->html_forms .= '<div style="display:none;" id="DATA' . $name . '_ru" data-text="' . json_decode($product["product_description_ru"]) . '"></div>';
                            $this->html_forms .= '<textarea class="product_editor_html" id="ID' . $name . '_ru" ></textarea>';

                            $this->scripts_tag .=   $this->set_html_field($name);

                            ///ua 
                            $this->html_forms .=  '</div>';
                            $this->html_forms .= ("<div class='product_option'>");
                            $this->html_forms .=
                                " <label for='form_" .
                                $name .
                                " ua'>" .
                                $params["title"] .
                                " ua" .
                                "</label>";
                            $this->html_forms .= '<div style="display:none;" id="DATA' . $name . '_ua" data-text="' . json_decode($product["product_description_ua"]) . '"></div>';
                            $this->html_forms .= '<textarea class="product_editor_html" id="ID' . $name . '_ua" ></textarea>';


                            $this->html_forms .=  '</div>';

                            $this->forms_get_vals ["$name"."_ua"] =  "$(\"#ID".$name."_ua\").summernote('code');";
                            $this->forms_get_vals ["$name"."_ru"] =  "$(\"#ID".$name."_ru\").summernote('code');";
                 
                }
            }
            
        $this->forms_get_vals ["product_id"] =  $product["product_id"];

        $this->scripts_tag .=  "let form_options =". json_encode($this->forms_get_vals).";";

        $this->scripts_tag .= $this->script_se[1];



    }


    public function get_html(){
        return $this->html_forms;
    }
    public function get_scrits(){
        return $this->scripts_tag;
    }
 



    private function set_number_limit($id, $min, $max)
    {
        return "set_number_limit('$id',$min,$max);";
    }
    private function set_lenght_limit($id, $max)
    {
        return "set_lenght_limit('$id',$max);";
    }
    private function set_copy_text_ru_ua($id, $name)
    {
        return "set_copy_text_ru_ua('$id', '$name');";
    }
    private function set_copy_text_trans_ru_ua($id,$name)
    {
        return 
            "set_copy_text_trans_ru_ua('$id','$name');"
        ;
    }
    private function set_html_field($id)
    {
        return "set_html_field('$id');";
    }
}
