function share(url, id) {
    navigator.clipboard.writeText(url);
    const sharebtntxt = document.querySelector("#share-btn-text" + id);
    sharebtntxt.textContent = 'clipped!';
}

function showReplies(commentID) {
    var repliesdiv = document.getElementById("replies" + commentID);
    var btn = document.getElementById("show-replies-btn" + commentID);
    if (repliesdiv.style.display === 'none') {
        repliesdiv.style.display = "inline";
        btn.textContent = 'hide replies';
    }
    else
    {
        repliesdiv.style.display = "none";
        btn.textContent = 'show replies';
    }
}
function reply(commentID) {
    var addreply = document.getElementById("addreply" + commentID);
    if (addreply.style.display === 'none') {
        addreply.style.display = "inline";
    }
}
function cancel(commentID) {
    var addreply = document.getElementById("addreply" + commentID);
    if (addreply.style.display === 'inline') {
        addreply.style.display = "none";
    }
}
