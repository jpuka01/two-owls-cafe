document.getElementById('order_form').addEventListener('submit', function(event) {
    // Ensure at least one item is ordered
    const quantities = document.querySelectorAll("select[name^='quantity_']");
    let hasOrder = false;

    quantities.forEach((select) => {
        if (parseInt(select.value) > 0) {
            hasOrder = true;
        }
    });

    if (!hasOrder) {
        alert("Please order at least one item.");
        event.preventDefault();
        return;
    }

    // Ensure both first and last names are provided
    const firstName = document.getElementById('firstName').value.trim();
    const lastName = document.getElementById('lastName').value.trim();

    if (!firstName || !lastName) {
        alert("Please provide both first and last names.");
        event.preventDefault();
        return;
    }

    // Calculates pickup time (20 minutes from now)
    const currentTime = new Date();
    currentTime.setMinutes(currentTime.getMinutes() + 20);
    const pickupTime = currentTime.toISOString().slice(0, 19).replace("T", " ");
    document.getElementById('pickupTime').value = pickupTime;
});