function upVote(id) {
    sendVote(`./vote.php?mode=up&id=${id}`);
}

function downVote(id) { 
    sendVote(`./vote.php?mode=down&id=${id}`);
}

function sendVote(target) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = () => {
        if (this.readyState == 4 && this.status == 200) {
            console.log("sent");
        } else {
            console.log("oeps")
        }
    }

    xhttp.open("POST", target, true);
    xhttp.send();
}