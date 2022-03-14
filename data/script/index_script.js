window.onload = callback;

function callback(){
    var categories =  document.getElementsByClassName("category");
    for(element of categories){
        element.onmouseover = function(id){return function(){hoverIn(id)}}(element.id);
        element.onmouseout = function(id){return function(){hoverOut(id)}}(element.id);
    };
}

async function hoverIn(id){
    var element = document.getElementById(id);
    element.getElementsByClassName("ligne")[0].setAttribute("class","ligne");
    element.getElementsByTagName("img")[0].setAttribute("class","category_img_button");
}

async function hoverOut(id){
    var element = document.getElementById(id);
    element.getElementsByClassName("ligne")[0].setAttribute("class","ligne invisible");
    element.getElementsByTagName("img")[0].setAttribute("class","category_img_button invisible");
}