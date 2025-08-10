// LOGIN FUNCTION
function loginUser(event) {
  event.preventDefault();
  const username = document.getElementById("username").value.trim();
  const password = document.getElementById("password").value.trim();

  if (username === "user" && password === "1234") {
    localStorage.setItem("isLoggedIn", "true");
    window.location.href = "menu.html";
  } else {
    alert("Invalid login. Try: user / 1234");
  }
}


// PROTECT menu.html
if (window.location.pathname.includes("menu.html")) {
  if (localStorage.getItem("isLoggedIn") !== "true") {
    alert("You must login first.");
    window.location.href = "login.html";
  }
}

// LOGOUT FUNCTION (Optional)
function logout() {
  localStorage.removeItem("isLoggedIn");
  window.location.href = "login.html";
}
function submitOrderForm(event) {
    event.preventDefault();
    const name = document.getElementById('order-name').value;
    const phone = document.getElementById('order-phone').value;
    const item = document.getElementById('order-item').value;

    fetch("submit_order.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ name, phone, item })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            alert("Order placed! Receipt ID: " + data.order_id);
        } else {
            alert("Failed to place order: " + data.message);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("An error occurred while placing the order.");
    });

    document.getElementById('orderForm').reset();
    bootstrap.Modal.getInstance(document.getElementById('orderModal')).hide();
}

