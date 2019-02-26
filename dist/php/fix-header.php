<?php

function getStyleBG($img) {
    return getStyleBG_1($img)." ".getStyleBG_2($img)." ".getStyleBG_3($img);
}

function getStyleBG_1($img) {
    return "background-image: linear-gradient(to right, #121726 0%, #121726 20%, rgba(18, 23, 38, 0) 100%), url($img);";
}
function getStyleBG_2($img) {
    return "background-image: -o-linear-gradient(to right, #121726 0%, #121726 20%, rgba(18, 23, 38, 0) 100%), url($img);";
}
function getStyleBG_3($img) {
    return "background-image: -webkit-linear-gradient(to right, #121726 0%, #121726 20%, rgba(18, 23, 38, 0) 100%), url($img);";
}

function getStyleAboutBG($img) {
    return "background: transparent url($img) no-repeat 50% 0";
}

function getStyleSlider($img) {
    return getStyleSlider_1($img)." ".getStyleSlider_2($img)." ".getStyleSlider_3($img);
}

function getStyleSlider_1($img) {
    return "background-image: linear-gradient(left, #121726 0%, #121726 20%, rgba(18, 23, 38, 0) 100%), url($img);";
}
function getStyleSlider_2($img) {
    return "background-image: -o-linear-gradient(left, #121726 0%, #121726 20%, rgba(18, 23, 38, 0) 100%), url($img);";
}
function getStyleSlider_3($img) {
    return "background-image: -webkit-linear-gradient(left, #121726 0%, #121726 20%, rgba(18, 23, 38, 0) 100%), url($img);";
}
?>