// Envoyer le formulaire pour modifier une usager dans modifierUsager.php après avoir clicker sur un hyperlien "Modifier"
function submitModifierForm(idUsager) {
    var form = document.getElementById('formModifierU');
    form.action = 'modifierUsager.php?action=modifier&id=' + idUsager;

    form.submit();
}