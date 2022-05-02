$('input[type=checkbox]').on('change', function (e) {
    if ($('input[type=checkbox]:checked').length > 4) {
        $(this).prop('checked', false);
        alert("Można wybrać tylko 4 tagi naraz");
    }
});


