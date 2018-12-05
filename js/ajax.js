function likes(img_id) {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("").innerHTML = this.responseText;
    }
  };

  xmlhttp.open("POST", "whatever.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("img_id=" + img_id);
}