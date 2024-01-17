const notificationButton = document.querySelector('.notification-button');
const notificationDropdown = document.querySelector('.notification-dropdown');

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