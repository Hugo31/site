
function runEffect($identifiant) {
        $($identifiant).toggle('blind');
}
    
function enableTriStateCheckBox(checkbox){
    // Apparently click is better chan change? Cuz IE?
    $(checkbox).change(function(e) {
        var checked = $(this).prop("checked"),
        container = $(this).parent(),
        siblings = container.siblings();

        container.find('input[type="checkbox"]').prop({
            indeterminate: false,
            checked: checked
        });
        checkSiblings(container, checked);
    });
}

function checkSiblings(el, checked) {
    var parent = el.parent().parent(),
    all = true;

    el.siblings().each(function() {
        return all = ($(this).children('input[type="checkbox"]').prop("checked") === checked);
    });

    if (all && checked) {
        parent.children('input[type="checkbox"]').prop({
            indeterminate: false,
            checked: checked
        });
        checkSiblings(parent);
    } else if (all && !checked) {
        parent.children('input[type="checkbox"]').prop("checked", checked);
        parent.children('input[type="checkbox"]').prop("indeterminate", (parent.find('input[type="checkbox"]:checked').length > 0));
        checkSiblings(parent, checked);
    } else {
        el.parents("li").children('input[type="checkbox"]').prop({
            indeterminate: true,
            checked: false
        });
    }
}