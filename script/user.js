function incrementCount(countId) {
    var countElement = document.getElementById(countId);
    var hiddenCountElement = document.getElementById('hidden-' + countId);

    var currentCount = parseInt(countElement.innerText);
    countElement.innerText = currentCount + 1 ;

    hiddenCountElement.value = currentCount + 1;
}