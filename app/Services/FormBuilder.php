<?php

namespace App\Services;


class FormBuilder
{
    /**
     * html_forms
     * 
     * Html output 
     * @var string
     */
    public $html_forms = "";
    /**
     * forms_get_vals
     * id of elements to get values
     * @var mixed
     */
    public $forms_get_vals;
    /**
     * script_se
     * Start /end for script
     * @var array
     */
    private $script_se = ["<script>", "</script>"];
    /**
     * scripts_tag
     * Scripts for forms 
     * @var string
     */
    public $scripts_tag = "";

        
    /**
     * editors
     *
     * @var array
     */
    public $editors =[];
    
    /**
     * _path to edit item
     *
     * @var string
     */
    public $update_path= "";

    public $delete_path= "";

    public $back_path= "";
    
    /**
     * editros
     * Editors data
     * @var array
     */
    public $editros = [];

    
    /**
     * item
     * maain array with info
     * @var array
     */
    public $item = [];
    
    /**
     * name
     * name of item
     * @var string
     */
    public $name ="";
    
    /**
     * __construct
     *
     * @param  mixed $item
     * @param  mixed $id of element 
     * @return void
     */
    public function __construct(array $item,$item_id,$name)
    {
        $this->name = $name;
        $this->forms_get_vals["item_id"] =  $item_id;
        $this->item = $item;
        $this->scripts_tag .= $this->script_se[0];
    }

    
   
    /**
     * addZeroCheckbox
     *
     * @param  mixed $name key of elemnt in item array
     * @param  mixed $title
     * @param  mixed $input_title
     * @param  mixed $limit
     * @return bool
     */
    public function addZeroCheckbox(string $name, string $title, string $input_title, array $limit = ["min","max"] ): bool
    {
        $limitStr = "";
        if ($limit[1] != "max" && $limit[0] != "min") {
            $limitStr = " max='" .$limit[1] . "'" . " min='" .$limit[0] . "'" ;
            $this->scripts_tag .= $this->set_number_limit("ID" . $name ,$limit[0],$limit[1] );
        }


        $this->html_forms .= (
            "<div class=\"product_option\" x-data=\"{ 
                    CHC$name: " . ($this->item["product_price_discount"] == 0 ? "false" : "true") . ", 
                    discountPrice: " .  $this->item["product_price_discount"] . ",
                    originalPrice: " .  $this->item["product_price_discount"] . "
                }\">
                    <label>$title
                        <input  x-model=\"CHC$name\" type=\"checkbox\" name=\"discount_avalible\"  $limitStr id=\"CHC$name\"
                            @change=\"if (!CHC$name) { discountPrice = 0 } else { discountPrice = originalPrice }\">
                    </label>
                    <label>$input_title
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
        $this->forms_get_vals["$name"] =  "$(\"#ID$name\").val();";

        return 0;
    }
    
    /**
     * addCheckbox
     *
     * @param  mixed $name
     * @param  mixed $title
     * @return bool
     */
    public function addCheckbox(string $name, string $title): bool
    {
            $this->html_forms .= ("<div class='product_option'>");

            $this->html_forms .=
                " <label for='form_" .

                $name .
                "'>" .
                $title .
                "</label>";

            $this->html_forms .=  "<input class='input_change' type='checkbox' id='ID$name'";
            if ($this->item[$name] == 1) {
                $this->html_forms .=  " checked ";
            }

            $this->html_forms .=
                " name='form_" . $name . "'"
                . "> </input>";


            $this->html_forms .=  '</div>';

            $this->forms_get_vals["$name"] =  "$(\"#ID$name\").is(':checked') ? 1 : 0;";
        
        return 0;
    }
        
    /**
     * AddInputText
     *
     * @param  mixed $name
     * @param  mixed $title
     * @param  mixed $lang
     * @param  mixed $number_limit  [$min,$max]
     * @return bool
     */
    public function AddInputText(string $name, string $title, bool $lang =false, int $lenght_limit =-1, string $copy_trans = "", string $copy = "",$novoid = true): bool
    {    
            if ($lang == 0) {
                $this->html_forms .= ("<div class='product_option'>");
                $this->html_forms .=
                    " <label for='form_" . $name ."'>$title</label>";
                $this->html_forms .=   "<input   class='input_change' type='input' id='ID$name'";

                if ($lenght_limit != -1) {
                    if($lenght_limit < 0) die("lenght limit value error");
                    $this->html_forms .=
                        " maxlength='" . $lenght_limit . "'";
                    $this->scripts_tag .= $this->set_lenght_limit("ID" . $name , $lenght_limit);
                }

                $this->html_forms .= " value='" . $this->item[$name] . "'"
                    . " name='form_" . $name . "'"
                    . " </input>";
                
                    if($novoid)        $this->scripts_tag .= $this->set_input_novoid("ID" . $name , $lenght_limit);
                $this->html_forms .=  '</div>';
                $this->forms_get_vals["$name"] =  "$(\"#ID$name\").val();";
            } 
            elseif ($lang == 1) {
                if ($copy != "") {
                    $this->html_forms .= "<button id ='ID$name" . "_bc" . "' class='auto_gen'>Авто-заповнення на основі назви продукту</button>";
                    $this->scripts_tag .= $this->set_copy_text_ru_ua("ID" . $name, "ID" . $copy , "ID$name" . "_bc");
                }
                if ($copy_trans !="") {
                    $this->html_forms .= "<button id ='ID$name" . "_bc" . "' class='auto_gen'>Авто-заповнення на основі назви продукту</button>";

                    $this->scripts_tag .= $this->set_copy_text_trans_ru_ua("ID$name", "ID" . $copy_trans , "ID$name" . "_bc");

                }
                $this->html_forms .= ("<div class='product_option'>");
                ///ru
                $this->html_forms .=
                    " <label for='form_" .
                    $name .
                    " ru'>" .
                    $title .
                    ' ru <img src="\img\icon\ru.svg" alt="ru" sizes="21 14"> '

              .
                    "</label>";

                $this->html_forms .= "<input  class='input_change' type='input' id='ID$name" . "_ru'";

                if ($lenght_limit != -1) {
                    if($lenght_limit < 0) die("lenght limit value error");
                    $this->html_forms .=
                        " maxlength='" . $lenght_limit . "'";
                    $this->scripts_tag .= $this->set_lenght_limit("ID" . $name . "_ru", $lenght_limit);
                }
                $this->html_forms .= " value='" . $this->item[$name. "_ru"] . "'"
                    . " name='form_" . $name . "_ru'>"
                    . " </input>";

                ///ua 
                $this->html_forms .=  '</div>';
                $this->html_forms .= ("<div class='product_option'>");
                $this->html_forms .=
                    " <label for='form_" .
                    $name .
                    ' ua'.
                    "'>" .
                    $title .
                    ' ua <img src="\img\icon\ua.svg" alt="ru" sizes="21 14"> ' .
                    "</label>";

                $this->html_forms .="<input class='input_change' type='input' id='ID$name" . "_ua'";

                if ($lenght_limit != -1) {
                    if($lenght_limit < 0 || !is_integer($lenght_limit ) ) die("lenght limit value error");
                    $this->html_forms .=
                        " maxlength='" . $lenght_limit . "'";
                    $this->scripts_tag .= $this->set_lenght_limit("ID" . $name . "_ua", $lenght_limit);
                }

                if($novoid)
                {
                    $this->scripts_tag .= $this->set_input_novoid("ID" . $name . "_ru");
                    $this->scripts_tag .= $this->set_input_novoid("ID" . $name . "_ua");
                }
       

                $this->html_forms .= " value='" . $this->item[$name. "_ua"] . "'"
                    . " name='form_" . $name . "_ua'>"
                    . " </input>";

                $this->html_forms .=  '</div>';

                $this->forms_get_vals["$name" . "_ua"] =  "$(\"#ID$name" . "_ua" . "\").val();";
                $this->forms_get_vals["$name" . "_ru"] =  "$(\"#ID$name" . "_ru" . "\").val();";
            }
        
        return 0;
    }    
    /**
     * AddInputNumber
     *
     * @param  mixed $name arr key name 
     * @param  mixed $title 
     * @param  mixed $lang lang if 1
     * @param  mixed $limit [min,max]
     * @return bool
     */
    public function AddInputNumber(string $name, string $title, bool $lang =false, array $limit = ["min","max"] ): bool{  
            ///dodelay
            if ($lang == 0) {
                $this->html_forms .= ("<div class='product_option'>");
                $this->html_forms .=
                    " <label for='form_" . $name ."'>$title</label>";
                $this->html_forms .=   "<input class='input_change' type='number' id='ID$name'";

                if ($limit[1] != "max" && $limit[0] != "min") {
                    $this->html_forms .= " max='" .$limit[1] . "'" . " min='" .$limit[0] . "'" ;
                    $this->scripts_tag .= $this->set_number_limit("ID" . $name ,$limit[0],$limit[1] );
                }

                $this->html_forms .= " value='" . $this->item[$name] . "'"
                    . " name='form_" . $name . "'"
                    . " </input>";
                
                
                $this->html_forms .=  '</div>';
                $this->forms_get_vals["$name"] =  "$(\"#ID$name\").val();";
            } 
            elseif ($lang == 1) {

                $this->html_forms .= ("<div class='product_option'>");
                ///ru
                $this->html_forms .=
                    " <label for='form_" .
                    $name .
                    " ru'>" .
                    $title .
                    ' ru <img src="\img\icon\ru.svg" alt="ru" sizes="21 14"> '

              .
                    "</label>";

                $this->html_forms .= "<input class='input_change' type='number' id='ID$name" . "_ru'";


                if ($limit[1] != "max" && $limit[0] != "min") {
                    $this->html_forms .= " max='" .$limit[1] . "'" . " min='" .$limit[0] . "'" ;
                    $this->scripts_tag .= $this->set_number_limit("ID" . $name . "_ru",$limit[0],$limit[1] );
                }

                $this->html_forms .= " value='" . $this->item[$name. "_ru"] . "'"
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
                    $title .
                    ' ua <img src="\img\icon\ua.svg" alt="ru" sizes="21 14"> ' .
                    "</label>";

                $this->html_forms .="<input  class='input_change' type='number' id='ID$name" . "_ua'";


                if ($limit[1] != "max" && $limit[0] != "min") {
                    $this->html_forms .= " max='" .$limit[1] . "'" . " min='" .$limit[0] . "'" ;
                    $this->scripts_tag .= $this->set_number_limit("ID" . $name . "_ua",$limit[0],$limit[1] );
                }

                $this->html_forms .= " value='" . $this->item[$name. "_ua"] . "'"
                    . " name='form_" . $name . "_ua'>"
                    . " </input>";

                $this->html_forms .=  '</div>';

                $this->forms_get_vals["$name" . "_ua"] =  "$(\"#ID$name" . "_ua" . "\").val();";
                $this->forms_get_vals["$name" . "_ru"] =  "$(\"#ID$name" . "_ru" . "\").val();";
            }
        
        return 0;
    }
    
       
    /**
     * AddSelect
     *
     * @param  mixed $name
     * @param  mixed $title
     * @param  mixed $options arr [value => name]
     * @return bool
     */
    public function AddSelect(string $name, string $title, array  $options = ["value"=>"text"] ): bool{
        
            $this->html_forms .= ("<div class='product_option'>");

            $this->html_forms .= " <label for='form_" . $name . "'>" . $title ."</label>";

            $this->html_forms .=   "<select id='ID$name' name='form_" . $name . "'>";

            $this->html_forms .= "<option value='" .$this->item[$name]. "'>" . $options[$this->item[$name]] . '</option>';

            unset( $options[$this->item[$name]]);

            foreach ($options as $key => $value) {
                $this->html_forms .= "<option value='$key'>$value</option>";
            }

            $this->html_forms .=  "</select>";

            $this->html_forms .=  '</div>';

            $this->forms_get_vals["$name"] =  "$(\"#ID$name\").val();";
        
            return 0;
    }

    public function AddHtmlEdit(string $name, string $title): bool{


            $this->html_forms .= ("<div class='product_option'>");
            $this->html_forms .=
                " <label for='form_" .
                $name .
                " ru" .
                "'>" .
                $title .
                ' ru <img src="\img\icon\ru.svg" alt="ru" sizes="21 14"> '

              .
                "</label>";
            $this->html_forms .= '<div style="display:none;" id="DATA' . $name . '_ru" data-text="' . json_decode($this->item["product_description_ru"]) . '"></div>';
            $this->html_forms .= '<textarea class="product_editor_html" id="ID' . $name . '_ru" ></textarea>';

            $this->scripts_tag .=   $this->set_html_field($name);

            ///ua 
            $this->html_forms .=  '</div>';
            $this->html_forms .= ("<div class='product_option'>");
            $this->html_forms .=
                " <label for='form_" .
                $name .
                " ua'>" .
                $title .
                ' ua <img src="\img\icon\ua.svg" alt="ru" sizes="21 14"> ' .
                "</label>";
            $this->html_forms .= '<div style="display:none;" id="DATA' . $name . '_ua" data-text="' . json_decode($this->item["product_description_ua"]) . '"></div>';
            $this->html_forms .= '<textarea class="product_editor_html" id="ID' . $name . '_ua" ></textarea>';
            $this->html_forms .=  '</div>';
            $this->forms_get_vals["$name" . "_ua"] =  "$(\"#ID" . $name . "_ua\").summernote('code');";
            $this->forms_get_vals["$name" . "_ru"] =  "$(\"#ID" . $name . "_ru\").summernote('code');";
        

        return 0;

    }
    public function AddEditor( array $path_name):void{
        $this->editors [] = $path_name;
    }


    public function finish()
    {
        $this->scripts_tag .=  "let form_options =" . json_encode($this->forms_get_vals) . ";";
        $this->scripts_tag .= $this->script_se[1];

        return view("admin.form_edit", 
        [
            "form" => $this,
            "item_name" => $this->name ,
            "item_id" =>$this->forms_get_vals["item_id"],
            "update_path" => $this->update_path,

            "delete_path" =>$this->delete_path,
        
            "back_path" =>$this->back_path,
            "editors" => $this->editors
        ]
        );

    }

    public   function get_html()
    {
        return $this->html_forms;
    }
    public function get_scrits()
    {
        return $this->scripts_tag;
    }
    /*
    *   Sets js code
    *
    */
    public function setLinks($update,$delete,$back){

        $this->update_path = $update;

        $this->delete_path = $delete;
    
        $this->back_path =   $back;
    
    }


    /**
     * set_number_limit
     *  sets max min number value limit
     * @param  mixed $id 
     * @param  mixed $min
     * @param  mixed $max
     * @return void
     */
    private function set_number_limit(string $id, int | float $min, int | float $max): string
    {
        return "set_number_limit('$id',$min,$max);";
    }
    /**
     * set_lenght_limit
     * Sets max lenght of string 
     * @param  mixed $id
     * @param  mixed $max
     * @return string
     */
    private function set_lenght_limit(string $id, int  $max): string
    {
        return "set_lenght_limit('$id',$max);";
    }

    /**
     * set_copy_text_ru_ua
     * Make button that copies  source ru/ua
     * @param  mixed $id
     * @param  mixed $name
     * @return string
     */
    private function set_copy_text_ru_ua(string $id,string $copy, string  $button): string
    {
        return "set_copy_text_ru_ua('$id','$copy','$button');";
    }
    /**
     * set_copy_text_trans_ru_ua
     * Make button that creates url basis on source
     * @param  mixed $id
     * @param  mixed $name
     * @return string
     */
    private function set_copy_text_trans_ru_ua(string $id,string $copy, string $button): string
    {
        return  "set_copy_text_trans_ru_ua('$id','$copy','$button');";
    }
    /**
     * set_html_field
     *
     * @param  mixed $id
     * @return string
     */
    private function set_html_field(string $id): string
    {
        return "set_html_field('$id');";
    }
    private function set_input_novoid($id){
        return "set_input_novoid('$id');";
    }
}
