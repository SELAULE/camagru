function likes(img_id) {
  // alert(img_id.getAttribute("data-imgid"));

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("POST", "likes.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
       // document.getElementById("").innerHTML = xmlhttp.responseText;
     //  alert(xmlhttp.responseText);
    }
  };
  xmlhttp.send("img_id=" + img_id.getAttribute("data-imgid"));
}