<?php
$this->theme->setTitle("Welcome to Anax");
?>
<div style="background-color:lightgrey; padding:5px; border:solid black 3px;">
<h4 style="margin-bottom:0px; font-weight:bold;"><?=$question->title?></h4> <span style="font-size:16px; font-style:italic;">postad av <a href="<?=$this->url->create('users/id/' . $question->user)?>"><?=$question->user?></a> <?=$question->created?></span>

<p style="margin-top:10px;"><?=$question->content?></p>



<?php foreach ($comments as $comment) { ?>
<div style="background-color:white; border-left:solid black 3px; border-bottom:solid black 3px; margin-bottom:5px;">
	<span><?=$comment->content?> - </span><span> kommenterat av <a href="<?=$this->url->create('users/id/' . $comment->user)?>"><?=$comment->user?></a></span> <span style="font-style:italic;"><?=$comment->created?></span>
</div>


<? } ?>
<form action="<?=$this->url->create('questions/addComment/')?>" method="POST">
	<br>
<input type="text" name="content"> 
<input type="hidden" name="linkid" value="<?=$question->id?>">
<input type="hidden" name="redirect" value="<?=$question->id?>">
<input type="hidden" name="type" value="question">
<input type="hidden" name="user" value="<?=$_SESSION['user']?>">
<input type="submit" value="Kommentera">
<br><br>
</form>
</div>

<?php foreach($answers as $answer) { ?>
<div style="background-color:#ADC2FF; padding:0px; margin-top:30px; padding:5px; border:solid black 3px;">

<p style=""><?=$answer['content']?></p>
<span style="font-style:italic;">Besvarad av <a href="<?=$this->url->create('users/id/' . $answer['user'])?>"><?=$answer['user']?></a></span><span style="font-style:italic;"> <?=$answer['created']?></span>

<form action="<?=$this->url->create('questions/addComment/')?>" method="POST">
	<br>
<input type="text" name="content"> 
<input type="hidden" name="linkid" value="<?=$answer['id']?>">
<input type="hidden" name="redirect" value="<?=$question->id?>">
<input type="hidden" name="type" value="answer">
<input type="hidden" name="user" value="<?=$_SESSION['user']?>">
<input type="submit" value="Kommentera">
<br><br>
</form>


<?php foreach($answer['comments'] as $comment) {?>

<div style="background-color:white; border-left:solid black 3px; border-bottom:solid black 3px; margin-top:5px;">
	<span><?=$comment->content?> - </span><span> kommenterat av <a href="<?=$this->url->create('users/id/' . $comment->user)?>"><?=$comment->user?></a></span> <span style="font-style:italic;"><?=$comment->created?></span>
</div>



<?php }?>
</div>
<?php }?>

<div style="margin-top:20px;min-width:100%; background-color:lightgrey;"><h3 style="margin-bottom:0px;">Besvara denna fråga</h3><?=$form?></div>
	

