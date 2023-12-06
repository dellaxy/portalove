function downloadGame(gameId, userId) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "lib/download-game.php",
        data: {
            gameId: gameId,
            userId: userId
        },
        success: function (response) {
            location.reload();
        },
        error: function (error) {
            console.log(error);
        }
    })
}

function uninstallGame(gameId, userId) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "lib/uninstall-game.php",
        data: {
            gameId: gameId,
            userId: userId
        },
        success: function (response) {
            location.reload();
        },
        error: function (error) {
            console.log(error);
        }
    })
}

function openProfileEditModal(profileDataObj) {
    console.log(profileDataObj);
    let updateModal = $('#profileEditModal');
    let profileForm = updateModal.find('#profileUpdateForm');
    profileForm.find('[name="nickname"]').val(profileDataObj.nickname);
    profileForm.find('[name="bio"]').text(profileDataObj.bio);

    updateModal.modal('show');
}