const slider = document.getElementById('slider');
const minView = document.getElementById("minView")
const maxView = document.getElementById("maxView")
const minHidden = document.getElementById("minHidden")
const maxHidden = document.getElementById("maxHidden")
console.log(parseFloat(maxView.textContent))
noUiSlider.create(slider, {
    start: [parseFloat(minView.textContent), parseFloat(maxView.textContent)],
    connect: true,
    range: {
        'min': parseFloat(minView.textContent),
        'max': parseFloat(maxView.textContent)
    },
     
});

function refresh(values) {
    console.log(values)
    minView.textContent=values[0];
    maxView.textContent=values[1];
    minHidden.value=values[0];
    maxHidden.value=values[1];
}

// Binding signature
slider.noUiSlider.on("update", refresh);


console.log("hello")