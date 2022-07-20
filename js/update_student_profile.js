var counter2 = 0;
var timeout1;
var timeout2;

function update_profile() {
    if (document.getElementById("password").value.length == 0) {
        document.getElementById("head2").innerHTML = "Password Field is Empity !!";
        document.getElementById("head2").style.color = "red";
        $("#head2").animate({
            "paddingLeft": "25px"
        }, 100);
        $("#head2").animate({
            "paddingLeft": "0px"
        }, 100);
        $("#head2").animate({
            "paddingLeft": "25px"
        }, 100);
        $("#head2").animate({
            "paddingLeft": "0px"
        }, 100);
    } else {
        document.getElementById("head2").innerHTML = "Update your Password";
        document.getElementById("head2").style.color = "black";
        var newpassword = document.getElementById("password").value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert(this.responseText);
                if (this.responseText == "updated") {
                    document.getElementById("greenpassword1").innerHTML = newpassword;
                    document.getElementById("greenpassword1").style.color = "red";
                    document.getElementById("greenpassword").style.color = "red";
                    timeout1 = setTimeout(show, 0);
                } else if (this.responseText == "Error") {
                    document.getElementById("head2").innerHTML = "Error updating your password";
                    document.getElementById("head2").style.color = "red";
                    timeout2 = setTimeout(close2, 2000);
                }
            }
        }
        xmlhttp.open("post", "update_student_password.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("yesverified=verified" + "&" + "newpassword=" + newpassword);
    }
}


function show() {
    document.getElementById("notification").style.display = "block";
    timeout2 = setTimeout(close, 2000);
}

function close() {
    document.getElementById("notification").style.display = "none";
    clearTimeout(timeout1);
    clearTimeout(timeout2);
}

function show1() {
    document.getElementById("notification2").style.display = "block";
    timeout4 = setTimeout(close1, 2000);
}

function close1() {
    document.getElementById("notification2").style.display = "none";
    clearTimeout(timeout3);
    clearTimeout(timeout4);
}

function close2() {
    document.getElementById("head2").innerHTML = "Update your password";
    document.getElementById("head2").style.color = "black";
    clearTimeout(timeout2);
}

function post_comment() {
    if (document.getElementById("comment").value.length == 0) {
        document.getElementById("header").innerHTML = "Comment Field is Empity";
        document.getElementById("header").style.color = "red";
        $("#header").animate({
            "paddingLeft": "25px"
        }, 100);
        $("#header").animate({
            "paddingLeft": "0px"
        }, 100);
        $("#header").animate({
            "paddingLeft": "25px"
        }, 100);
        $("#header").animate({
            "paddingLeft": "0px"
        }, 100);
    } else {
        var comment = document.getElementById("comment").value;
        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            var xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert(this.responseText);
                if (this.responseText.trim() == "commented") {
                    timeout3 = setTimeout(show1, 0);
                    document.getElementById("header").innerHTML = "Give us a comment Here";
                    document.getElementById("header").style.color = "black";
                } else if (this.responseText.trim() == "more_than_trial") {
                    document.getElementById("header").innerHTML = "You reachs your allowed number of chance.";
                    document.getElementById("header").style.color = "red";
                    $("#header").animate({
                        "paddingLeft": "25px"
                    }, 100);
                    $("#header").animate({
                        "paddingLeft": "0px"
                    }, 100);
                    $("#header").animate({
                        "paddingLeft": "25px"
                    }, 100);
                    $("#header").animate({
                        "paddingLeft": "0px"
                    }, 100);
                }

                else if (this.responseText.trim()=="Logouted") {
                    document.getElementById("header").innerHTML = "Some one is Logedout before !! you must refresh the page";
                    document.getElementById("header").style.color = "red";
                    $("#header").animate({
                        "paddingLeft": "25px"
                    }, 100);
                    $("#header").animate({
                        "paddingLeft": "0px"
                    }, 100);
                    $("#header").animate({
                        "paddingLeft": "25px"
                    }, 100);
                    $("#header").animate({
                        "paddingLeft": "0px"
                    }, 100);
                }

                 else {
                    document.getElementById("header").innerHTML = "Error uploading The comment1";
                    document.getElementById("header").style.color = "red";
                    $("#header").animate({
                        "paddingLeft": "25px"
                    }, 100);
                    $("#header").animate({
                        "paddingLeft": "0px"
                    }, 100);
                    $("#header").animate({
                        "paddingLeft": "25px"
                    }, 100);
                    $("#header").animate({
                        "paddingLeft": "0px"
                    }, 100);
                }
            }
        };
        xmlhttp.open("post", "upload_student_comment.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("yesverified2=comment&comment=" + comment);
    }
}

function showpassword() {
    if (document.getElementById("password").value.length != 0 && document.getElementById("eye").className == "fa fa-eye") {
        document.getElementById("password").type = "text";
        document.getElementById("eye").className = "fa fa-eye-slash";
    } else if (document.getElementById("password").value.length != 0 && document.getElementById("eye").className == "fa fa-eye-slash") {
        document.getElementById("password").type = "password";
        document.getElementById("eye").className = "fa fa-eye";
    }
}

function changetoeye() {
    if (document.getElementById("password").value.length == 0 && document.getElementById("eye").className == "fa fa-eye-slash") {
        document.getElementById("eye").className = "fa fa-eye";
        document.getElementById("password").type = "password";
    }
}