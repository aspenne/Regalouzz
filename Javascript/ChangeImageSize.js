// get the main_image and the image_on_left side of the page
tabImage = document.getElementsByClassName("image_on_left");
image_full = document.getElementById("main_image");

// get at the max the 3 images and giving them the function ChangeSize
for (var i = 0; i < tabImage.length; i++) {
    tabImage[i].addEventListener("click", ChangeSize);
}

// change the size property of the main_image
function ChangeSize(){
  image_full.style.width = 500;
  image_full.style.height = 500;
}