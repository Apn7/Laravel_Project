function commentDeleteForm(commentID) {
    document.getElementById("deleteCommentForm" + commentID).submit();
}
function memeDeleteForm(memeID) {
    document.getElementById("deleteMemeForm" + memeID).submit();
}

function memeEditForm(memeID) {
    document.getElementById("editMemeForm" + memeID).submit();
}

function reportMemeForm(memeId) {
    document.getElementById("reportMemeForm" + memeId).submit();
}

document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
        var alert = document.querySelector(".custom-alert");
        if (alert) {
            alert.classList.remove("show");
            alert.classList.add("hide");
            setTimeout(function () {
                alert.remove();
            }, 500); // Smooth removal transition of 0.5 seconds
        }
    }, 3000); // Now correctly set for 3 seconds
});

document.addEventListener("DOMContentLoaded", function () {
    var input = document.querySelector('#tags');
    var tagify = new Tagify(input);

    // Listen to form submission
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function (e) {
            // Extract tag values
            var tagData = tagify.value.map(tag => tag.value);
            // Set input value to comma-separated string
            input.value = tagData.join(',');
        });
    });
});

