"use strict";document.addEventListener("DOMContentLoaded",function(){var e=document.querySelector(".menuicon");e.addEventListener("click",function(){e.classList.toggle("active"),document.querySelector(".header__menu").classList.toggle("active")});var t=document.querySelector("header"),o=window.pageYOffset||document.documentElement.scrollTop;o>0&&t.classList.add("scroll"),document.addEventListener("scroll",function(){var e=window.pageYOffset||document.documentElement.scrollTop;e>o&&t.classList.add("scroll"),e<10&&t.classList.remove("scroll"),o=e<=0?0:e},!1);!function(){if(null===localStorage.getItem("vostcookiept")){var e=document.getElementById("cookie");e.addEventListener("click",function(){this.classList.add("hide"),localStorage.setItem("vostcookiept","read and agreed")}),e.classList.remove("hide")}}()});