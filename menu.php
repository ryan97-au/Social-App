<!--
QUT Capstone Project 2018
Project Owner: Nursery Road State Special School

SNAP - Social Networking Action Platform

Author: Jerusha Kolapudi
Author: Jessica Simpkins
Author: Laine Buraga
Author: Woong Adrian Jekal	
-->


<!--
This side navigation needs to be changed to buttons instead of <a> tags
Onfocus is used to create an event where the element is being focused on so its useful for the auditory feedback
-->

<div class="sidenav">
        <button id="user_home_btn" class="button sidebutton" onclick="location.href='user_home.php';" onkeyup="user_home_btn(event)" onfocus="homeAudio()">HOME<i class="fas fa-hands-helping" style="font-size: 4.5em;" name="loopmenu"></i></button>
        <button id="news_feed_btn" class="button sidebutton" onclick="location.href='view_feed.php';" onkeyup="news_feed_btn(event)" onfocus="newsfeedAudio()">NEWS FEED<i class="fas fa-newspaper" style="font-size: 4.5em; background-color: teal;" name="loopmenu"></i></button>
        <button id="new_post_btn" class="button sidebutton" onclick="location.href='create_post.php';" onkeyup="create_post_btn(event)" onfocus="newPostAudio()">NEW POST<i class="fas fa-pencil-alt" style="font-size: 4.5em;" name="loopmenu"></i/></button>
        <button id="message_post_btn" class="button sidebutton" onclick="location.href='friends.php';" onkeyup="message_btn(event)" onfocus="messageAudio()">MESSAGE<i class="far fa-envelope" style="font-size: 4.4em;" name="loopmenu"></i></button>
        <button id="events_btn" class="button sidebutton" onclick="location.href='events.php';" onkeyup="events_btn(event)" onfocus="eventsAudio()">EVENTS<i class="fas fa-calendar-alt" style="font-size: 4.5em;" name="loopmenu"></i></button><br/>
</div>



<body>

<!--
Originally the audio tag for a "Get help!" button for students to get the attention of a teacher

<audio id="getHelp">
    <source src="sound/rooster.ogg" type="audio/ogg">
</audio> 
-->


<!--
Creating the audio tags for the corresponding audio source, which is located in the sound folder.
-->

<audio id="home">
    <source src="sound/home.ogg" type="audio/ogg">
</audio>

<audio id="newsfeed">
    <source src="sound/newsfeed.ogg" type="audio/ogg">
</audio>

<audio id="newPost">
    <source src="sound/new_post.ogg" type="audio/ogg">
</audio>

<audio id="message">
    <source src="sound/message.ogg" type="audio/ogg">
</audio>

<audio id="events">
    <source src="sound/events.ogg" type="audio/ogg">
</audio>

<script src="js/menu.js" type="text/javascript"></script>

</body>

    </body>


