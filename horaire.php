<?php
session_start();
include "inc/entete.inc"
?>

    <h2><?php echo($data['notre_horaire']) ?></h2>
    <p><?php echo($data['horaire_desc']) ?></p>

    <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%237386d5&amp;ctz=America%2FToronto&amp;src=bmFuY3kuYmx1dGVhdUBnbWFpbC5jb20&amp;src=YWRkcmVzc2Jvb2sjY29udGFjdHNAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&amp;src=ZnIuY2FuYWRpYW4jaG9saWRheUBncm91cC52LmNhbGVuZGFyLmdvb2dsZS5jb20&amp;color=%23039BE5&amp;color=%2333B679&amp;color=%230B8043&amp;title=Maison%20des%20Jeunes"
            style="border:solid 1px #777" width="800" height="600" frameborder="0" scrolling="no"></iframe>

<?php
include "inc/piedPage.inc";
?>