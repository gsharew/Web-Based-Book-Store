function opennavigation() {
    document.getElementById("navigation").style.left = "0";
    document.body.style.backgroundColor = "rgba(0,0,0,0.5)";
    document.getElementById("full-nav").style.width = "100%";
}

window.onclick = function(event) {
    if (event.target == document.getElementById("full-nav")) {
        document.getElementById("navigation").style.left = "-500px";
        document.body.style.backgroundColor = "#a5a5a5";
        document.getElementById("full-nav").style.width = "0%";
    }
}

function closenav() {
    document.getElementById("navigation").style.left = "-500px";
    document.getElementById("full-nav").style.width = "0%";
    document.body.style.backgroundColor = "#a5a5a5";
    document.getElementById("footerid").style.color = "black";
}

function openme() {
    if (document.getElementById("type").options[document.getElementById("type").selectedIndex].value == "Instructor") {
        $("#file").fadeIn("fast");
        $("#filedesc").fadeIn("fast");
        document.getElementById("uploadid").value = "Upload the File";
        document.getElementById("betweenlines").innerHTML = "Upload";
    } else {
        $("#file").fadeOut("fast");
        $("#filedesc").fadeOut("fast");
        document.getElementById("betweenlines").innerHTML = "View Files";
        document.getElementById("uploadid").value = "View uploaded files";
    }
}

function openfile() {
    if (document.getElementById("type").options[document.getElementById("type").selectedIndex].value == "Instructor") {
        $("#file").fadeIn("slow");
        $("#filedesc").fadeIn("slow");
        document.getElementById("uploadid").value = "Upload the File";
        document.getElementById("betweenlines").innerHTML = "Upload";
    } else {
        document.getElementById("betweenlines").innerHTML = "View Files";
        document.getElementById("uploadid").innerHTML = "View uploaded files";
    }
}