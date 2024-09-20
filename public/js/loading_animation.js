function StartLoading(id){
    if($(id).hasClass("unloading")){
        $(id).toggleClass("unloading");
    }
    $(id).toggleClass("loading");

}
function StopLoading(id){
    $(id).toggleClass("unloading");
    setTimeout(function(){ $(id).toggleClass("loading"); $(id).toggleClass("unloading");},300)
}
