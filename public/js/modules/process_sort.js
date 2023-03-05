$('input[type=radio][name=sort-product]').change(function() {
    let nameSort = $(this).parent().find('label').text();
    $('[name-sort]').text(nameSort);
    console.log($(this).data('sort'));
});