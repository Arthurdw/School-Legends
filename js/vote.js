function upVote(el, id) {
    sendVote("up", id);
    el.classList.toggle("vote-plus");
    el.classList.remove("vote-minus");
}

function downVote(el, id) { 
    sendVote("down", id);
    el.classList.toggle("vote-minus");
    el.classList.remove("vote-plus");
}

function sendVote(mode, id) {
    const xhttp = new XMLHttpRequest();
    const formData = new FormData();

    formData.append("mode", mode);
    formData.append("id", id);

    const window = this.window;

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status == 401) window.location.href = "./login.php";
            else if (this.status == 201) console.log("Voted succesfully");
            else if (this.status == 403) {
                if (mode == "up") downVote(id);
                else if (mode == "down") upVote(id);
                else console.error("Invalid request type.")
            }
            else if (this.status == 400) console.error(this.status, this.statusText);
            else console.log(this.status, this.statusText)
        }
    }

    xhttp.open("POST", "./vote.php", true);
    xhttp.send(formData);
}