<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <!-- Link to CSS stylesheet -->
    <link rel="stylesheet" type="text/css" href="styled.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- Add this line -->
  

    

    <style>
    .notification-dropdown {
        right: 0; /* Add this to align the dropdown to the right */
    }

  
    
    
</style>

</head>
<body>
<?php include 'admin_header.php'; ?>


<div class="left-nav">
    <ul>
        
        <li><a href="Occupancy_chart/index.php">Room Booking</a></li>
        <li><a href="ManageUsers.html">Manage users</a></li>
        <li><a href="#">Occupancy Chart</a></li>
        <li><a href="edit_timetable.php">Manage Timetables</a></li>
    </ul>
</div>
<br><br> 
<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="ab3.jpg" style="width:100%">
  <div class="text">Caption Text</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <img src="amma.jpg" style="width:100%">
  <div class="text">Caption Two</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <img src="amp.jpg" style="width:100%">
  <div class="text">Caption Three</div>
</div>

</div>
<br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
</div>


<!-- Rest of your HTML content -->
<table>
  <td> 
    <fieldset style="height: 150%; width: 185%; margin-left: 200px; border:none;">
      <pre style="font-family: Arial, Helvetica, sans-serif; font-size: medium; font-weight: bold; color: rgb(255, 255, 255); font-size: larger;">
        <a href="https://intranet.cb.amrita.edu/sites/default/files/2022-2023/Calender/Academic-Calendar-for-the-AY2022-23-EvenSemester-HigherSemster-Classes.pdf"><img src="cal.png" width="255" height="210" alt="cttering"></a>    <a href="https://intranet.cb.amrita.edu/exam-cell"><img src="examsch.png" width="190" height="170" alt="travel"></a>  <a href="#holiday"><img src="itfac.png" width="220" height="180" alt="holiday"></a>  
                                                                                                        
         
        <a href="https://intranet.cb.amrita.edu/academics/undergraduate"><img src="curriculum.png" width="210" height="180" alt="holiday"></a>  <a href="https://intranet.cb.amrita.edu/intercom/"><img src="intercom.png" width="235" height="210" alt="gallery"></a>   <a href="#holiday"><img src="itfac.png" width="220" height="205" alt="holiday"></a>
      </pre>
    </fieldset>
  </td> 
  <td> 
 <center> <h3 class="event-heading"><div class="scrolling-words-container">
 <div class="scrolling-words-container">
  <div class="scrolling-words-box">
    <ul>
      <li style="color: #ea4335">Conference</li>
      <li style="color: #4285f4">Workshop</li>
      <li style="color: #34a853">Seminar</li>
      <li style="color: #fbbc04">Webinar</li>
      <li style="color: #ea4335">Hackathon</li>
    </ul>
  </div>
  <span style="color: #5f6368">Upcoming Events</span>
</div>
</h3></center>
    <fieldset class="fieldsetting" style="height: 150%; width: 55%; margin-left: 20%;border:none;">
    
      <div class="event-display">
    
        <div class="event-list">
        <div class="event-display">
  <div class="event-list">
    <div class="event">
      <div class="event-date">May 15, 2023</div>
      <div class="event-details">Conference on Web Development</div>
    </div>
    <div class="event">
      <div class="event-date">May 20, 2023</div>
      <div class="event-details">Workshop on UI/UX Design</div>
    </div>
    <div class="event">
      <div class="event-date">May 25, 2023</div>
      <div class="event-details">Seminar on Digital Marketing</div>
    </div>
    <div class="event">
      <div class="event-date">May 30, 2023</div>
      <div class="event-details">Webinar on Artificial Intelligence</div>
    </div>
    <div class="event">
      <div class="event-date">June 5, 2023</div>
      <div class="event-details">Hackathon for Mobile App Development</div>
    </div>
    <div class="event">
      <div class="event-date">June 11, 2023</div>
      <div class="event-details">Code Masterclass: Advanced JavaScript Techniques</div>
    </div>
    <div class="event">
      <div class="event-date">June 20, 2023</div>
      <div class="event-details">Build Your Own Website: HTML and CSS Basics</div>
    </div>
    <div class="event">
      <div class="event-date">June 25, 2023</div>
      <div class="event-details">Create Stunning Graphics: Introduction to Adobe Illustrator</div>
    </div>
    <div class="event">
      <div class="event-date">June 30, 2023</div>
      <div class="event-details">Design Thinking Workshop: Innovation and Problem Solving</div>
    </div>
    <div class="event">
      <div class="event-date">July 5, 2023</div>
      <div class="event-details">Code for Good: Using Technology to Make a Positive Impact</div>
    </div>
  </div>
</div>

         
        
          
          <!-- Add more events as needed -->
        </div>
      </div>
    </fieldset>
  </td>
</table>

  

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
-->

<!-- Rest of your HTML content -->

<script>
  // Get the current time and format it
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
</script>




<script>
let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 10000); // Change image every 2 seconds
}
</script>
<script src="evo-calendar.min.js"> </script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
<script>
  // Initialize evo-calendar in your script file or an inline <script> tag
$(document).ready(function() {
    $('#calendar').evoCalendar({
        settingName: settingValue
    })
})

</script>


<script>
  // Infinite scrolling for event display
  const eventList = document.getElementById('event-list');

  function loadMoreEvents() {
    // Simulate loading more events (replace with your own logic to fetch events)
    const newEvents = [
      { date: 'June 1, 2023', details: 'Event 4 Details' },
      { date: 'June 5, 2023', details: 'Event 5 Details' },
      // Add more events as needed
    ];

    newEvents.forEach((event) => {
      const eventElement = document.createElement('div');
      eventElement.classList.add('event');
      eventElement.innerHTML = `
        <div class="event-date">${event.date}</div>
        <div class="event-details">${event.details}</div>
      `;
      eventList.appendChild(eventElement);
    });
  }

  function handleScroll() {
    const scrollPosition = window.innerHeight + window.pageYOffset;
    const pageHeight = document.documentElement.scrollHeight;

    if (scrollPosition >= pageHeight) {
      // Load more events when the user reaches the bottom of the page
      loadMoreEvents();
    }
  }

  window.addEventListener('scroll', handleScroll);
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>$(document).ready(function() {
  $('.event-display').hover(
    function() {
      $('.event-list').addClass('paused');
    },
    function() {
      $('.event-list').removeClass('paused');
    }
  );
});
</script>


</body>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<tfoot>
  <pre style="font-family: Arial, Helvetica, sans-serif; text-align: center;">©️ Copyright 2023, CRMS@Amrita</pre>
  </tfoot>
</html>
