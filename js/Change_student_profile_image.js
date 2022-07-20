function changemyprofile() {

    var file = document.getElementById("profilefile").files[0];
    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
        var xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //alert(this.responseText);
            if (this.responseText.trim() == "fileerror") {
                document.getElementById("figcup").innerHTML = "Oops !! Your image have an error";
                document.getElementById("figcup").style.color = "red";
            } else if (this.responseText.trim() == "unsupported") {
                document.getElementById("figcup").innerHTML = "Oops !! Unknown image format";
                document.getElementById("figcup").style.color = "red";
            } else if (this.responseText.trim() == "toobig") {
                document.getElementById("figcup").innerHTML = "Oops !! Your image size is too big";
                document.getElementById("figcup").style.color = "red";
            } else if (this.responseText.trim() == "unchanged") {
                document.getElementById("figcup").innerHTML = "Oops !! Un able to change your profile";
                document.getElementById("figcup").style.color = "red";
            } else if (this.responseText.trim() == "changed") {
                var reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById("profileimage").src = event.target.result;
                    document.getElementById("figcup").innerHTML = "Successfully changed your profile picture";
                    document.getElementById("figcup").style.color = "green";
                }
                reader.readAsDataURL(file);
            } else {
                alert(this.responseText);
                document.getElementById("figcup").innerHTML = "Oops !! An error happen while changing your profile";
                document.getElementById("figcup").style.color = "red";
            }
        }
    };
    var formdata = new FormData();
    formdata.append("imagefile", file);
    xmlhttp.open("post", "../php/Change_student_profile_image.php");
    //xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(formdata);
}

function clickme() {
    document.getElementById("profilefile").click();
}