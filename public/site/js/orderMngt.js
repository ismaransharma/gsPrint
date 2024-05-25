// allOrder()
// deliveredOrder()
// pendingOrder()
// cancelOrder()

document.addEventListener("DOMContentLoaded", function () {
    // Set the initial value to "allOrders"
    const select = document.getElementById("orderSelect");
    select.value = "allOrders";
    handleOrderChange();
});

function handleOrderChange() {
    const select = document.getElementById("orderSelect");
    const selectedValue = select.value;

    // Hiding all sections
    document.querySelectorAll(".order-section").forEach((section) => {
        section.style.display = "none";
    });

    // Show selected section
    if (selectedValue === "allOrders") {
        document.getElementById("allOrdersSection").style.display = "block";
    } else if (selectedValue === "deliveredOrders") {
        document.getElementById("deliveredOrdersSection").style.display =
            "block";
    } else if (selectedValue === "pendingOrders") {
        document.getElementById("pendingOrdersSection").style.display = "block";
    } else if (selectedValue === "cancelOrders") {
        document.getElementById("cancelOrdersSection").style.display = "block";
    } else if (selectedValue === "refundOrders") {
        document.getElementById("refundOrdersSection").style.display = "block";
    } else if (selectedValue === "shippedOrders") {
        document.getElementById("shippedOrdersSection").style.display = "block";
    }
}
