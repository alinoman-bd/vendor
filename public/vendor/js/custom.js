$(function() {
    let colsize = 3;
    if ($(window).width() < 768) {
        colsize = 2;
    }
    if ($(window).width() < 576) {
        colsize = 1;
    }
    loadMenu(colsize);
    var more_ph = $(".gallery-thumbs1 .swiper-slide").width();
    $(".more-photos1").width(more_ph);
    var more_ph2 = $(".gallery-thumbs2 .swiper-slide").width();
    $(".more-photos2").width(more_ph2);
    var more_ph3 = $(".gallery-thumbs3 .swiper-slide").width();
    $(".more-photos3").width(more_ph3);

    var td_w = $(".td-width-unc211").height();
    $(".price-tbl").height(td_w + 30);
    $(window).resize(function() {
        var more_ph = $(".gallery-thumbs1 .swiper-slide").width();

        $(".more-photos1").width(more_ph);
        var more_ph2 = $(".gallery-thumbs2 .swiper-slide").width();
        $(".more-photos2").width(more_ph2);
        var more_ph3 = $(".gallery-thumbs3 .swiper-slide").width();
        $(".more-photos3").width(more_ph3);
    });
    $(document).on("click", ".panel-heading", function() {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
        } else {
            $(this).addClass("active");
        }
    });
    $(document).on("click", ".show-menu-bar", function() {
        $(".show-mbl-sh").slideToggle(400);
    });
    $(document).on("click", ".ctm-select-txt", function() {
        $(".ctm-select-txt").removeClass("active-ctm-s");
        $(this).addClass("active-ctm-s");
        $(".ctm-select-txt").each(function() {
            if ($(this).hasClass("active-ctm-s")) {
                if ($(this).hasClass("ctm-slct-hide")) {
                    $(this).removeClass("ctm-slct-hide");
                    $(this)
                        .parent()
                        .find(".ctm-option-box")
                        .hide();
                } else {
                    $(this).addClass("ctm-slct-hide");
                    $(this)
                        .parent()
                        .find(".ctm-option-box")
                        .show();
                }
            } else {
                $(this).removeClass("ctm-slct-hide");
                $(this)
                    .parent()
                    .find(".ctm-option-box")
                    .hide();
            }
        });
    });
    $(document).on("click", ".show-reg-form", function() {
        $(".register-cnt").removeClass("d-none");
        $(".reg-tlt").removeClass("d-none");
        $(".login-cnt").addClass("d-none");
        $(".log-tlt").addClass("d-none");
        $("#logModal .modal-dialog").addClass("reg-modal-width");
    });
    $(document).on("click", ".show-log-form", function() {
        $(".register-cnt").addClass("d-none");
        $(".reg-tlt").addClass("d-none");
        $(".login-cnt").removeClass("d-none");
        $(".log-tlt").removeClass("d-none");
        $("#logModal .modal-dialog").removeClass("reg-modal-width");
    });

    $(document).on("click", ".manu-show-btn", function() {
        if ($(this).hasClass("menu-hide")) {
            $(this).removeClass("menu-hide");
            $(this)
                .parent()
                .removeClass("active");
        } else {
            $(this).addClass("menu-hide");
            $(this)
                .parent()
                .addClass("active");
        }
    });
    $(document).on("click", ".ctm-option", function() {
        var option_val = $(this).text();
        $(this)
            .parents()
            .find(".active-ctm-s .select-txt")
            .text(option_val);
        $(".ctm-option-box").hide();
        $(".ctm-select .ctm-select-txt").removeClass("ctm-slct-hide");
    });
    $(document).on("click", ".li-cnt-show", function() {
        $(".li-cnt-show").removeClass("active");
        $(this).addClass("active");
        tabShow(event, 1);
    });
    $(window).resize(function() {
        let colsize = 3;
        if ($(window).width() < 768) {
            colsize = 2;
        }
        if ($(window).width() < 576) {
            colsize = 1;
        }
        loadMenu(colsize);
    });

    $(function() {
        $('[data-fancybox="gallery"]').fancybox({
            thumbs: {
                autoStart: true
            }
        });
    });
});

function openFancyboxItem(id) {
    $('[data-fancy-id="' + id + '"]').click();
}
$(document).on("click", function(e) {
    if (
        !$(e.target).hasClass("ctm-select-txt") &&
        $(e.target).parents(".ctm-select-txt").length === 0 &&
        $(e.target).parents(".ctm-option-box").length === 0
    ) {
        $(".ctm-option-box").hide();
        $(".ctm-select-txt").removeClass("ctm-slct-hide");
    }
    if (
        !$(e.target).hasClass("li-cnt-show") &&
        $(e.target).parents(".li-cnt-show").length === 0 &&
        $(e.target).parents(".main-cnt-show").length === 0
    ) {
        $(".main-cnt-show").addClass("d-none");
        $(".li-cnt-show").removeClass("active");
    }
});
function tabShow(e, n) {
    if (n == 1) {
        $(".main-menu .li-cnt-show").each(function(i, v) {
            if ($(this).hasClass("active")) {
                x = i;
            }
        });

        $(".main-cnt-show").addClass("d-none");
        $(".main-cnt-show")
            .eq(x)
            .removeClass("d-none");
    }
}

var galleryThumbs1 = new Swiper(".gallery-thumbs1", {
    spaceBetween: 10,
    slidesPerView: 5,
    loop: false,
    freeMode: true,
    loopedSlides: 5,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    breakpoints: {
        450: {
            slidesPerView: 2
        },
        767: {
            slidesPerView: 3
        },
        1200: {
            slidesPerView: 4
        }
    }
});
var galleryTop1 = new Swiper(".gallery-top1", {
    spaceBetween: 10,
    loop: false,
    loopedSlides: 5,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
    },
    thumbs: {
        swiper: galleryThumbs1
    }
});

var galleryThumbs2 = new Swiper(".gallery-thumbs2", {
    spaceBetween: 10,
    slidesPerView: 5,
    loop: false,
    freeMode: true,
    loopedSlides: 5,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    breakpoints: {
        450: {
            slidesPerView: 2
        },
        767: {
            slidesPerView: 3
        },
        1200: {
            slidesPerView: 4
        }
    }
});
var galleryTop2 = new Swiper(".gallery-top2", {
    spaceBetween: 10,
    loop: false,
    loopedSlides: 5,
    thumbs: {
        swiper: galleryThumbs2
    }
});
var swiper = new Swiper(".swiper-container1", {
    slidesPerView: 3,
    spaceBetween: 30,
    freeMode: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true
    }
});
function loadMenu(colsize) {
    var location = $("#menu_location_id").val();
    var city = $("#menu_city_id").val();
    $.ajax({
        url: window.base_url + "/load-menu",
        data: {
            colsize: colsize,
            location_id: location,
            city_id: city
        },
        success: function(response) {
            $(".city_location").html(response.city);
            $(".location_lake").html(response.lake);
            $(".location_river").html(response.river);
        }
    });
}
function searchmenu(key) {
    var not_available = true;
    search_text = document.getElementById(key).value;
    var items = document.getElementsByClassName(key);
    for (var item of items) {
        let lists = item.querySelectorAll("a");
        for (let menu of lists) {
            let inner_text = menu.innerText;
            if (!menu.parentNode.classList.contains("cnt-tlt")) {
                menu.parentNode.style.display = "none";
                let exists = inner_text
                    .toLowerCase()
                    .includes(search_text.toLowerCase());
                if (exists) {
                    menu.parentNode.style.display = "block";
                }
            }
        }
    }
    for (let item of items) {
        let titles = item.querySelectorAll(".cnt-tlt");
        for (let title of titles) {
            let inner_text = title.innerText;
            let exists = inner_text
                .toLowerCase()
                .includes(search_text.toLowerCase());
            if (!exists) {
                title.style.display = "none";
            } else {
                title.style.display = "block";
            }
            let lists = title.nextElementSibling.querySelectorAll(".cnt-link");
            lists.forEach(element => {
                let hasElement = false;
                if (element.style.display == "block") {
                    not_available = false;
                    hasElement = true;
                }
                if (hasElement) {
                    title.style.display = "block";
                    return hasElement;
                }
            });
        }
    }
    if (not_available) {
        var selector;
        if (key == "lake_location_cols") {
            selector = "location_lake";
        }
        if (key == "river_location_cols") {
            selector = "location_river";
        }
        if (key == "city_location_cols") {
            selector = "city_location";
        }
        var search_area = document.getElementsByClassName(selector)[0];
        var para = document.createElement("p");
        var textnode = document.createTextNode("No result available");
        para.appendChild(textnode);
        para.classList.add("no-data");
        if (document.getElementsByClassName("no-data").length == 0) {
            search_area.appendChild(para);
            console.log(document.getElementsByClassName("no-data").length);
        }
    }
}

function resetFilter(type) {
    url = window.location.href;
    url = url.replace(type + "/", "");
    window.location.href = url;
}

function resendVCode(params) {
    console.log(params);
}

$("div.address").click(function() {
    $("html, body").animate(
        {
            scrollTop: $("div#user-map").offset().top
        },
        1000
    );
});
