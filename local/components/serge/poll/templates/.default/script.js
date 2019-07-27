$(document).ready(function () {
    $("#other, #nothing").on("click", function () {
        if ($(this).is(':checked')) {
            var id = $(this).attr("id");

            $("#career input").each(function () {


                if ($(this).attr("id") !== id) {

                    if ($(this).is(':checked')) {
                        $(this).prop('checked', false);
                    }

                    $(this).attr('disabled', 'disabled');
                }


            });
        } else {
            $("#career input").each(function () {
                $(this).removeAttr('disabled');
            });
        }

    });
    $("#button").on("click", function () {
        arCareer = [];
        $('#career input:checkbox:checked').each(function () {
            arCareer.push($(this).attr("id"));
        });
        $.ajax({
            url: '/ajax/polls/poll.php',
            data: {
                "name": $('#name').val(),
                "family": $('#family').val(),
                "pol": $('#sex option:selected').data("id"),
                "career": arCareer,
                "age": $('#age option:selected').data("id"),
            },
            type: 'GET',
            success: function (data) {
                if (data == 'N') {
                    alert("Вы заполнили не все поля");
                } else if (data == 'Error') {
                    alert("Вы уже проходили данный опрос");
                } else {
                    $('#exampleModal').modal('toggle');
                }
            },
            error: function () {
                alert("no");
            }
        });
    });
    $('#home').click(function () {
        $(location).attr('href', "/");
    });
    $('#results').click(function () {
        $(location).attr('href', "/polls/results.php");
    });
});


