
var current_category_sub;
var current_category;
element = [];
sub_element = [];
if (window.innerWidth >= 682) {
    is_mobile = false;
}
else {
    is_mobile = true;

}



for (let index = 1; index < 10; index++) {
    element[index] = document.getElementById("category_" + index);

    if (element[index] !== null) {

        sub_element[index] = document.getElementById("sub_category_" + index);


        function element_action() {
            if (current_category_sub !== undefined) {

                current_category_sub.style.display = 'none';
            }
            if (current_category !== undefined) {
                current_category.classList.remove("main_categories_item_hover");
            }

            element[index].classList.add("main_categories_item_hover");
            sub_element[index].style.display = 'block';

            current_category_sub = sub_element[index];
            current_category = element[index];

            if (is_mobile) {


                sub_element[index].style.width = '100vw';

                document.getElementById("catalog_window").style.transform = "translate(-100vw, 0)";

                document.getElementById("catalog_window").style.width = "100vw";

                document.getElementById("close_catalog_btton_subcategory").style.display = "block";
            }

        }

        if (index == 1 && !is_mobile) {


            element_action()
        }


        if (is_mobile) {





            // main_category_container = document.getElementById("main_categories_list");
            // main_category_container.style.width = "100%"

            // h4Elements = document.querySelectorAll('.main_categories_item h4');
            // h4Elements.forEach(h4 => {
            //     h4.style.opacity = '1';
            // });
            element[index].addEventListener("click", element_action);


        }
        else {
            element[index].addEventListener("mouseover", element_action);

        }





    }
    else {
        break;
    }
}


function sub_cat_close() {


    // main_category_container = document.getElementById("main_categories_list");
    // main_category_container.style.width = "280px"

    h4Elements = document.querySelectorAll('.main_categories_item h4');
    h4Elements.forEach(h4 => {

        h4.style.opacity = '1';
    });
    current_category.classList.remove("main_categories_item_hover");

    main_category_container = document.getElementById("catalog_window");
    main_category_container.style.transform = "translate(0,  0)";

    if (is_mobile) {

        document.getElementById("close_catalog_btton_subcategory").style.display = "none";

    }

}

element_back = document.getElementById("sub_category_back");

element_back.addEventListener("click", sub_cat_close);



