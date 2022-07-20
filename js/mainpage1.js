var counter = 0;
var timeout1, timeout2;

function openmodal() {
    if (counter == 0) {
        document.getElementById("parent2").style.top = "140px";
        //navigator.userAgent.indexOf("Firefox") > -1 //this is used to detect the navigator browser if the navigator browser is Firefox it will return true other wise it will return false
        $("#modal").css({
            "transform": "scale(0)"
        });
        
         $("#parent2").css({
            "transform": "scale(1)"
        });
        document.getElementById("navigation").style.left = "-500px";
        document.getElementById("full-nav").style.backgroundColor = "rgba(0,0,0,0)";
        document.getElementById("teacherhead").innerHTML = "Welcome ! View Your Profile below";
        counter = 1;
        timeout1 = setTimeout(changetext1, 1200);
    } else if (counter == 1) {
        document.getElementById("parent2").style.top = "-500px";
        $("#modal").css({
            "transform": "scale(1)"
        });
        document.getElementById("navigation").style.left = "-500px";
        document.getElementById("full-nav").style.backgroundColor = "rgba(0,0,0,0)";
        document.getElementById("teacherhead").innerHTML = "Welcome ! Upload Files or View Files";
        counter = 0;
        timeout2 = setTimeout(changetext2, 1200);
    }
}

function changetext1() {
    document.getElementById("profiletext").innerHTML = "Upload or View Files";
    clearTimeout(timeout1);
}

function changetext2() {
    document.getElementById("profiletext").innerHTML = "View profile";
    clearTimeout(timeout2);
}

/* window.onclick = function(event) {
if (event.target != document.getElementById('modal1')) {
document.getElementById("modal1").style.top = "-400px;";
}
} -->*/

function checkform() {
    var username = document.getElementById("username1").value.trim();
    var password = document.getElementById("password1").value;
    var department = document.getElementById("teacherdepartment").options[document.getElementById("teacherdepartment").selectedIndex].value;
    if (username == "" || password == "") {
        document.getElementById("error_message1").style.display = "block";
        document.getElementById("error_message1").innerHTML = "Error: Field is empity";
        animateimage("#image1");
        return false;
    } else {

        // if (!navigator.onLine) {
        //     document.getElementById("error_message1").style.display = "block";
        //     document.getElementById("error_message1").innerHTML = "You are offline !!";
        //     animateimage("#image1");
        // } else {
            var whichtype = document.getElementById("type2").options[document.getElementById("type2").selectedIndex].value;
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                var xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            if (whichtype == "Student") {
                xmlhttp.open("POST", "../php/verify_Student.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("username=" + username + "&password=" + password + "&department=" + department + "&page=fromstudentviewpdf");
            } else if (whichtype == "Instructor") {
                xmlhttp.open("POST", "../php/verifyteacher.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("username=" + username + "&password=" + password + "&department=" + department + "&page=fromteacher");
            }
            xmlhttp.onreadystatechange = function() {
                //alert(this.responseText);
                if (this.readyState == 4 && this.status == 200) {
                    //alert(this.responseText);
                    //alert("unauthorized" == "unauthorized");
                    if (this.responseText.trim() == "unknownerror") {
                        document.getElementById("error_message1").style.display = "block";
                        document.getElementById("error_message1").innerHTML = "Error setuping your info";
                        animateimage("#image1");
                        return false;
                    } else if (this.responseText.trim() == "unauthorized") {
                        //alert(this.responseText);
                        document.getElementById("error_message1").style.display = "block";
                        document.getElementById("error_message1").innerHTML = "hmmm: You are not authorized";
                        animateimage("#image1");
                        return false;
                    } else if (this.responseText.trim() == "authorized") {
                        if (whichtype == "Student") {
                            location.href = "../php/Student_profile.php";
                        } else
                            location.href = "../php/teacherprofile.php";
                    }
                }
            };
        //}
    }
}

function checkinput() {
    var whichtype = document.getElementById("type").options[document.getElementById("type").selectedIndex].value;
    var username = document.getElementById("username").value.trim();
    var password = document.getElementById("password").value;
    var file = document.getElementById("file").files; //returns the file selected by the user in the input field
    var department = document.getElementById("teacherdepartment2").options[document.getElementById("teacherdepartment2").selectedIndex].value;
    if (username == "" || password == "") {
        document.getElementById("error_message").innerHTML = "Error : field is empity";
        document.getElementById("error_message").style.display = "block";
        animateimage("#image");
        return false;
    } else if (file.length == 0 && whichtype == "Instructor") {
        animateimage("#image");
        document.getElementById("error_message").innerHTML = "You have not selected a file.";
        document.getElementById("error_message").style.display = "block";
        return false;
    } else {
        // if (!navigator.onLine) {
        //     document.getElementById("error_message").style.display = "block";
        //     document.getElementById("error_message").innerHTML = "You are offline !!";
        //     animateimage("#image");
        // } else {
            var whichtype = document.getElementById("type").options[document.getElementById("type").selectedIndex].value;
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                var xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            if (whichtype == "Student") {
                xmlhttp.open("POST", "../php/verify_Student.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("username=" + username + "&password=" + password + "&department=" + department + "&page=fromstudent");
            } else if (whichtype == "Instructor") {
                xmlhttp.open("POST", "../php/verifyteacher.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("username=" + username + "&password=" + password + "&department=" + department + "&page=fromteacher1");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText.trim() == "unknownerror") {
                        document.getElementById("error_message").style.display = "block";
                        document.getElementById("error_message").innerHTML = "Error setuping your info";
                        animateimage("#image");
                        return false;
                    } else if (this.responseText.trim() == "unauthorized") {
                        //alert(this.responseText);
                        document.getElementById("error_message").style.display = "block";
                        document.getElementById("error_message").innerHTML = "hmm: You are not authorized";
                        animateimage("#image");
                        return false;
                    } else if (this.responseText.trim() == "authorized") {
                        if (whichtype == "Instructor") {
                            uploadfile();
                        } else if (whichtype == "Student") {
                            location.href = "../php/book_store_interaface.php";
                        }
                    } else {
                        //alert(this.responseText);
                        document.getElementById("error_message").style.display = "block";
                        document.getElementById("error_message").innerHTML = "Oops !! Error happen.";
                        animateimage("#image");
                        return false;
                    }
                };

            }
        //}
    }
}

function uploadfile() {
    document.getElementById("error_message").style.display = "none";
    //alert("hello wolrd");
    var file = document.getElementById("file").files[0];
    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
        var xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.upload.addEventListener("progress", onprogress, false);
    xmlhttp.addEventListener("load", oncomplete, false);
    var formdata = new FormData();
    formdata.append("file", file);
    xmlhttp.open("POST", "../php/upload.php");
    //xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(formdata);
    //alert(file.error);

}
var timeout;

function onprogress(event) {
    //alert("hellow gemechu");
    if (document.getElementById("file").files[0].size > 3000000) {
        document.getElementById("progressid").style.transform = "scaleX(1)";
    }
    // document.getElementById("progressbar").value = Math.round((event.loaded / event.total) * 100);
    var percent = Math.round((event.loaded / event.total) * 100);
    if (percent >= 0 && percent < 10) {
        document.getElementById("dote5").style.color = "red";
    } else if (percent >= 15 && percent < 20) {
        document.getElementById("dote4").style.color = "red";
    } else if (percent >= 25 && percent < 30) {
        document.getElementById("dote3").style.color = "red";
    } else if (percent >= 35 && percent < 40) {
        document.getElementById("dote2").style.color = "red";
    } else if (percent >= 45 && percent < 50) {
        document.getElementById("dote1").style.color = "red";
    } else if (percent >= 55 && percent < 60) {
        document.getElementById("dote9").style.color = "red";
    } else if (percent >= 65 && percent < 70) {
        document.getElementById("dote8").style.color = "red";
    } else if (percent >= 75 && percent < 80) {
        document.getElementById("dote7").style.color = "red";
    } else if (percent >= 85 && percent < 90) {
        document.getElementById("dote6").style.color = "red";
    } else if (percent >= 95 && percent <= 100) {
        document.getElementById("statustext").innerHTML = "Finalysing ...";
    }
}

function oncomplete(event) {

    document.getElementById("dote1").style.color = "white";
    document.getElementById("dote2").style.color = "white";
    document.getElementById("dote3").style.color = "white";
    document.getElementById("dote4").style.color = "white";
    document.getElementById("dote5").style.color = "white";
    document.getElementById("dote6").style.color = "white";
    document.getElementById("dote7").style.color = "white";
    document.getElementById("dote8").style.color = "white";
    document.getElementById("dote9").style.color = "white";
    document.getElementById("statustext").innerHTML = "Uploading the file";
    document.getElementById("progressid").style.transform = "scaleX(0)";
    if (event.target.responseText == "Upload completed") {
        document.getElementById("error_message").style.color = "green";
    } 
    // else {
    //     document.getElementById("error_message").style.color = "red";
    // }
    document.getElementById("error_message").style.boxShadow = "0px 0px 0px green";
    document.getElementById("error_message").innerHTML = event.target.responseText;
    document.getElementById("error_message").style.display = "block";
}

function animateimage(imageid) {
    $(imageid).animate({
        marginLeft: '30px'
    }, 100);
    $(imageid).animate({
        marginLeft: '0px'
    }, 100);
    $(imageid).animate({
        marginLeft: '30px'
    }, 100);
    $(imageid).animate({
        marginLeft: '0px'
    }, 100);
}



function destroyme() {
    document.getElementById("error_message").style.display = "none";
}

function destroymessage() {
    document.getElementById("error_message").style.display = "none";
}
