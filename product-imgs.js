var $ProductImg = $("#ProductImg");
var $SmallImg = $(".small-img");

$SmallImg[0].onclick = function(){
    $ProductImg.attr("src", $SmallImg[0].src);
}

$SmallImg[1].onclick = function(){
    $ProductImg.attr("src", $SmallImg[1].src);
}

$SmallImg[2].onclick = function(){
    $ProductImg.attr("src", $SmallImg[2].src);
}

$SmallImg[3].onclick = function(){
    $ProductImg.attr("src", $SmallImg[3].src);
}
