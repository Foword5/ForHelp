window.onload = callback;

function callback(){
    var categories =  document.getElementsByClassName("followed_category");
    for(element of categories){
        element.onmouseover = function(id){return function(){hoverIn(id)}}(element.id);
        element.onmouseout = function(id){return function(){hoverOut(id)}}(element.id);
        element.getElementsByTagName("span")[0].onclick = function(id){return function(){clicked(id)}}(element.id);
    };
}

async function hoverIn(id){
    var element = document.getElementById(id);
    list = element.getElementsByTagName("span")[0].className.split(" ");
    element.getElementsByClassName("ligne")[0].setAttribute("class","ligne");
    element.getElementsByTagName("span")[0].setAttribute("class",list[0]);
}

async function hoverOut(id){
    var element = document.getElementById(id);
    list = element.getElementsByTagName("span")[0].className.split(" ");
    element.getElementsByClassName("ligne")[0].setAttribute("class","ligne invisible");
    element.getElementsByTagName("span")[0].setAttribute("class",list[0]+" invisible");
}

async function clicked(id){
    var element = document.getElementById(id).getElementsByTagName("span")[0];
    list = element.className.split(" ");
    if(list[0] =="unfollow"){
        request = new XMLHttpRequest();
        request.open("GET","actions/follow.php?follow=false&url=&id="+id);
        request.send();

        element.innerHTML = "Annuler";
        document.getElementById(id).getElementsByTagName("a")[0].setAttribute("class","greytext");
        document.getElementById(id).getElementsByClassName("ligne")[0].setAttribute("style","background-color:grey");
        element.setAttribute("class","greylink follow");
    }else{
        request = new XMLHttpRequest();
        request.open("GET","actions/follow.php?follow=true&url=&id="+id);
        request.send();

        element.innerHTML = "Ne plus suivre";
        document.getElementById(id).getElementsByTagName("a")[0].setAttribute("class","");
        document.getElementById(id).getElementsByClassName("ligne")[0].setAttribute("style","");
        element.setAttribute("class","unfollow");
    }
}