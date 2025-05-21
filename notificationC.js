document.addEventListener("DOMContentLoaded", function() {
    const receiver_id = 2;  // ثابت مؤقتاً، المفترض يتغير بناءً على تسجيل الدخول

    fetch('get_notifications.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ receiver_id: receiver_id })
    })
    .then(response => response.json())
    .then(data => {
        const notificationsList = document.getElementById("notificationsList");
        notificationsList.innerHTML = "";

        if (data.length === 0) {
            notificationsList.innerHTML = "<p>No notifications available.</p>";
        } else {
            data.forEach(notification => {
                const notificationItem = document.createElement("div");
                notificationItem.classList.add("notification");
                notificationItem.innerHTML = `
                    <div class="message">${notification.message}</div>
                    <div class="timestamp">${notification.created_at}</div>
                `;
                notificationsList.appendChild(notificationItem);
            });
        }
    })
    .catch(error => {
        console.error("Error:", error);
    });
});
