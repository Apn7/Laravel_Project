function commentDeleteForm(commentID) {
    document.getElementById("deleteCommentForm"+commentID).submit();
}
function memeDeleteForm(memeID) {
    document.getElementById("deleteMemeForm"+memeID).submit();
}

function memeEditForm(memeID){
    document.getElementById("editMemeForm"+memeID).submit();
}

function reportMemeForm(memeId) {
    document.getElementById("reportMemeForm" + memeId).submit();
}
