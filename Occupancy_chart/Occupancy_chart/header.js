function getTime() {
    const date = new Date();
    const hours = date.getHours();
    const minutes = date.getMinutes();
    const seconds = date.getSeconds();
    const ampm = hours >= 12 ? 'PM' : 'AM';
    const formattedHours = hours % 12 === 0 ? 12 : hours % 12;
    const formattedMinutes = minutes < 10 ? `0${minutes}` : minutes;
    const formattedSeconds = seconds < 10 ? `0${seconds}` : seconds;
    const currentTime = `${formattedHours}:${formattedMinutes}:${formattedSeconds} ${ampm}`;

    return currentTime;
  }

  // Update the current time every second
  function updateTime() {
    const currentTimeElement = document.querySelector('.current-time');
    setInterval(() => {
      const currentTime = getTime();
      currentTimeElement.textContent = currentTime;
    }, 1000);
  }

  updateTime();

  // Toggle the dropdown menu when the menu button is clicked
  const menuButton = document.querySelector('.dropbtn');
  const menu = document.querySelector('.dropdown-content');

  menuButton.addEventListener('click', () => {
    menu.classList.toggle('show');
  });

  // Hide the dropdown menu when the user clicks outside of it
  window.addEventListener('click', (event) => {
    if (!event.target.matches('.dropbtn')) {
      if (menu.classList.contains('show')) {
        menu.classList.remove('show');
      }
    }
  });

  const logoutLink = document.querySelector('.logout-menu a');
  logoutLink.addEventListener('click', () => {
    // Perform logout functionality here, e.g. clear user session

    // Redirect to the login page
    window.location.href = 'login.php';
  });

  // Send message form submission
  const sendMessageForm = document.querySelector('#send-message-form');
  const messageInput = document.querySelector('#msg');
  const countBadge = document.querySelector('#count');

  sendMessageForm.addEventListener('submit', (event) => {
    event.preventDefault();

    const formData = new FormData(sendMessageForm);
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // Message sent successfully
          messageInput.value = '';
          alert('Message sent!');

          // Update notification count
          const count = parseInt(countBadge.textContent);
          countBadge.textContent = count + 1;
        } else {
          // Error occurred while sending message
          console.error(xhr.responseText);
        }
      }
    };

    xhr.open('POST', 'send_msg.php');
    xhr.send(formData);
  });

  //notifications

  const notificationButton = document.querySelector('.notification-button');
  const notificationDropdown = document.querySelector('.dropdown-content.notification-dropdown');

  notificationButton.addEventListener('click', () => {
    notificationDropdown.classList.toggle('show');
  });

  // Hide the notification dropdown when the user clicks outside of it
  window.addEventListener('click', (event) => {
    if (!event.target.matches('.notification-button')) {
      if (notificationDropdown.classList.contains('show')) {
        notificationDropdown.classList.remove('show');
      }
    }
  });