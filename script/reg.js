function showHideGuestField() {
    var typeSelect = document.getElementById("type");
    var guestField = document.getElementById("guestField");

    if (typeSelect.value === "Guest") {
        guestField.style.display = "block";
    } else {
        guestField.style.display = "none";
    }
}