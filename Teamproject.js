// Get references to the text element and buttons
var textElement = document.getElementById("text");
var increaseButton = document.getElementById("increaseButton");
var decreaseButton = document.getElementById("decreaseButton");

// Set initial font size
var currentSize = 16; // Initial font size in pixels

// Add event listeners to the buttons
increaseButton.addEventListener("click", function() {
    currentSize += 2; // Increase font size by 2 pixels
    textElement.style.fontSize = currentSize + "px";
});

decreaseButton.addEventListener("click", function() {
    if (currentSize > 10) { // Ensure font size doesn't go below 10 pixels
        currentSize -= 2; // Decrease font size by 2 pixels
        textElement.style.fontSize = currentSize + "px";
    }
});


function changeBackgroundColor() {
    // Generate a random color
    const randomColor = '#' + Math.floor(Math.random()*16777215).toString(16);
    document.body.style.backgroundColor = randomColor;
}

