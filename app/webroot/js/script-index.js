/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$('#checkall').change(function () {
    $('input.ids').each(function () {
        $(this).attr('checked', $('#checkall').is(':checked'));
    });
})

$('#formindex').submit(function (event) {
    var marcou = false;
    $('input.ids').each(function () {
        if (this.checked) {
            marcou = true;
        }
    });

    if (marcou) {
        if (confirm('Deseja realmente excluir?')) {
            return true;
        }
    }
    event.preventDefault();
    return false;
});
