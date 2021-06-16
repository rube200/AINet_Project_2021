function AddCart(id, fullShow)
{
    const elementId = 'add-to-cart-form-' + id;
    let mainElement = document.getElementById(elementId);
    if (fullShow || mainElement.style.display === "block")
    {
        let ajax = new XMLHttpRequest();
        let formdata = new FormData(mainElement);
        ajax.onloadend = function() {
            if (ajax.status != 200)
                return;

            console.log("ok");
        }

        ajax.open("POST", mainElement.action, true);
        try
        {
            ajax.send(formdata);
        }
        catch (error)
        {
            console.error(error);
        }

        if (!fullShow)
            mainElement.style.display = "none";
        return;
    }

    let elements = document.querySelectorAll('*[id^="add-to-cart-form-"]');
    elements.forEach((elem) =>
    {
        if (elem === mainElement)
            elem.style.display= "block";
        else
            elem.style.display = 'none';
    });
}

function AddCartColorSelect(id)
{
    let element = document.getElementById('add-cart-select-color-' + id);
    element.style.backgroundColor = '#' + element.value;
}
