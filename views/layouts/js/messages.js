function showError(title, message){
    setTitleAndMessage(title, message);
    $('#alertMessageWindow_message').addClass("bg-danger");
    $('#alertMessageWindow_message').addClass("text-white");
    $('#alertMessageWindow').modal('show');
}


function showMessage(title, message){
    setTitleAndMessage(title, message);

    $('#alertMessageWindow_message').addClass("bg-success");
    $('#alertMessageWindow_message').addClass("text-white");
    $('#alertMessageWindow').modal('show');
}

function showWarning(title, message){
    setTitleAndMessage(title, message);

    $('#alertMessageWindow_message').addClass("bg-warning");
    $('#alertMessageWindow_message').addClass("text-white");
    $('#alertMessageWindow').modal('show');
}

function setTitleAndMessage(title, message){
    $('#alertMessageWindow_message').removeClass("bg-danger");
    $('#alertMessageWindow_message').removeClass("bg-success");
    $('#alertMessageWindow_message').removeClass("bg-warning");

    $('#alertMessageWindow_title').html(title);
    $('#alertMessageWindow_message').html(message);
}