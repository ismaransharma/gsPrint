const mediaQuery = window.matchMedia("(max-width: 600px)");

function handleMediaQueryChange(e) {
    if (e.matches) {
        const changeText = document
            .getElementByCLassName("home")
            .innerHTML("Hi");
    } else {
    }
}
