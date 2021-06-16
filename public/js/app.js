function AddCart(id, fullShow)
{
    const elementId = 'add-to-cart-form-' + id;
    let mainElement = document.getElementById(elementId);
    if (fullShow || mainElement.style.display === "block")
    {
        let ajax = new XMLHttpRequest();
        let formdata = new FormData(mainElement);
        ajax.onloadend = async function () {
            if (ajax.status !== 200)
                return;

            let alertElement = document.getElementById('added-to-cart-alert');
            alertElement.style.display = "block";
            setTimeout(function () {
                alertElement.style.display = "none";
            }, 2000);
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

function AddCartAmountSelect(id)
{
    let amount = parseInt(document.getElementById('add-cart-amount-' + id).value);
    let discountAmount = parseInt(document.getElementById('discount-amount').value);

    let priceId;
    if (amount >= discountAmount)
    {
        priceId = 'preco-desconto-';
    }
    else
    {
        priceId = 'preco-';
    }

    let basePrice = document.getElementById(priceId + id).value;
    let price = amount * basePrice;

    let textElement = document.getElementById('add-cart-total-price-text-' + id);
    let showElement = document.getElementById('add-cart-total-price-' + id);
    showElement.innerHTML = textElement.value.replace(":price", price.toFixed(2));
}
