$(document).ready(function () {
    $("#logo").on("click", function () {
        location.href = "index.html"
    })
    check()
    response()
})

function check() {
    $.post("controllers/session.php", (res) => {
        if (res == true) {
            $("#logout").show()
        } else {
            $("#logout").hide()
        }
    })
}

function admin() {
    $.post("controllers/session.php", (res) => {
        if (res == true) {
            location.href = "route.html"
        } else {
            $("div.modal").modal("show")
        }
    })
}

function back() {
    $("div.modal").modal("hide")
}

function logout() {
    $.post("controllers/logout.php", function (res) {
        location.href = "index.html"
    })
}

function response() {
    $.post("controllers/get.php",{action: "response"},function (res) {
        let responses = JSON.parse(res).length
        $("#response").append(`<span id="count-badge" class="align-items-center">${responses}</span>`)
    })
}