
function openSetAddress(){
    document.getElementById('set-location').classList.add('open');
}

function closeSetAddress(){
    document.getElementById('set-location').classList.remove('open');
}


document.querySelectorAll('form.product-card').forEach(form => {
  form.addEventListener('submit', function(event) {
    //event.preventDefault();  // stop reload

    // Your custom JS before submit
    openMerchSide();

    this.closest('form').submit();
    // Form will submit normally unless you call event.preventDefault()
    // So page reload and PHP POST will still happen
  });
});

function openMerchSide() {
  document.getElementById('pro-add-sidepop').classList.add('open');
  console.log('Merch side opened!');
}



//Quantity Counter
const quantityValue = document.getElementById('quantity-value');
const quantityInput = document.getElementById('quantity-hidden-value');

const getQuantity = () => {
  return parseInt(quantityValue.textContent, 10);
}

const setQuantity = (newValue) => {
  quantityValue.textContent = newValue;
  quantityInput.value = newValue;
}

const minusBtn = document.getElementById('minus-quantity');
if (minusBtn) {
  minusBtn.addEventListener('click', () => {
    if(getQuantity() > 1){
      setQuantity(getQuantity() - 1);
    }
  });
}

const plusBtn = document.getElementById('plus-quantity');
if (plusBtn) {
  plusBtn.addEventListener('click', () => {
    setQuantity(getQuantity() + 1);
  });
}



//FADE-IN
function checkFadeIn() {
  document.querySelectorAll('.fade-in').forEach(el => {
    const rect = el.getBoundingClientRect();
    if (rect.top < window.innerHeight - 50) {
      el.classList.add('visible');
    }
  });
}

window.addEventListener('DOMContentLoaded', checkFadeIn);
window.addEventListener('scroll', checkFadeIn);


function openOverlay() {
  document.getElementById("help-center-popup").style.display = "flex"; // show overlay
  document.body.style.overflow = "hidden"; // disable background scroll
}

function closeOverlay(){
  document.getElementById("help-center-popup").style.display = "none"
  document.body.style.overflow = ""; // disable background scroll
}

//
function editShow(){
  document.getElementById('del-btn').style.display = "block";
  document.getElementById('done').style.display = "block";
}

function editUnshow(){
  document.getElementById('del-btn').style.display = "none";
  document.getElementById('done').style.display = "none";
}

         document.querySelectorAll(".minus-quant").forEach(btn => {
            btn.addEventListener("click", () => {
                let container = btn.closest(".merch-quantity");
                let quantityEl = container.querySelector(".quantity-value");
                let hiddenInput = container.querySelector("input[type=hidden]");
                
                let qty = parseInt(quantityEl.textContent);
                if (qty > 1) qty--;
                
                quantityEl.textContent = qty;
                hiddenInput.value = qty;
                console.log('clicked');
            });
        });



        document.querySelectorAll(".plus-quant").forEach(btn => {
            btn.addEventListener("click", () => {
                let container = btn.closest(".merch-quantity");
                let quantityEl = container.querySelector(".quantity-value");
                let hiddenInput = container.querySelector("input[type=hidden]");
                
                let qty = parseInt(quantityEl.textContent);
                qty++;
                
                quantityEl.textContent = qty;
                hiddenInput.value = qty;
            });
        });

