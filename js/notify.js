

function testfunc() {
    var box = document.getElementById("chbx");
    var xhr = new XMLHttpRequest();
    var url = "notify.php";
    if (box.checked) {
        var notify = 1;
    }
    else {
        var notify = 0;
    }
    var newvars = "notify=" + notify;
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
       // document.getElementById("").innerHTML = xmlhttp.responseText;
      // alert(xhr.responseText);
    }
  }
    xhr.send(newvars);
  //   alert('')
  }
  
  
  function checkcheck() {
    var box = document.getElementById("chbx");
    var xhr = new XMLHttpRequest();
    var url = "notify.php";
    var newvars = "mypostname=" + "testttt";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            chkstat = xhr.responseText;
           // alert (chkstat[1]);
            if (chkstat[1] == "1") {
                box.checked = true;
            }
            else {
                box.checked = false;
            }
  
        }
    };
    xhr.send(newvars);
  
  }
  
  window.onload = function () {
    checkcheck();
  //   alert('Something');
    var chk = document.getElementById('chbx').addEventListener('click', function(event)
    {
      //   alert('Something');

        testfunc();
    });
  }