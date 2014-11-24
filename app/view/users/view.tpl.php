<div style='clear:both; overflow:auto; padding:10px;'>
<h2 style="margin-bottom:0px;"><a href='<?=$this->url->create('users/id/' . $user->acronym)?>'><?=$user->acronym?></a></h2>

<img style='float:left;margin-right:5px; border:solid 3px #222A38;'src="<?php echo 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($user->email))) . '.jpg?s=80';?>">
<span style="font-weight:bold;">Email: <?=$user->email?><br>Namn: <?=$user->firstname?> <?=$user->lastname?><br>Skapad: <?=$user->created?></span>

<?php if(isset($logout)) {
	$loggaut = $this->url->create('users/logout/');
	$edit = $this->url->create('users/update/' . $user->acronym);
	$pass = $this->url->create('users/changePassword/' . $user->acronym);
	echo "<br><a href='$loggaut'>Logga ut</a> -  <a href='$edit'>Redigera info</a> -  <a href='$pass'>Ändra Lösenord</a>";
}?>

</div>

<h3 style="margin-bottom:0px;">Frågor skapade av <?=$user->acronym?></h3>
<?php if (is_array($questions) && !empty($questions)) : ?>  
<div class="questions"> 
	<?php $color=0; ?> 
<?php foreach ($questions as $question) : ?>  

<?php $url = $this->url->create('questions/show') .'/' . $question->id?>

<a href=<?php echo $url?>><div class="question"  style='overflow:auto; padding:10px; padding-bottom:10px;<?php if (($color % 2) == 0) {echo "background-color: lightgrey;";} else {echo "background-color: white;";} ?>position:relative;'>
<?php $color++; ?>

<h4 style="clear:both;"><span class='questionName'><?=$question->title?></span></h4>



	 <span style="float:right;"><?=$question->created?></span> 
</div></a>
<?php endforeach;?> 

</div>  
<?php endif; ?> 

<h3 style="margin-bottom:0px;">Frågor besvarade av <?=$user->acronym?></h3>

<?php if (is_array($answers) && !empty($answers)) : ?>  
<div class="questions"> 
	<?php $color=0; ?> 
<?php foreach ($answers as $question) : ?> 


<?php $url = $this->url->create('questions/show') .'/' . $question[0]->id?>

<a href=<?php echo $url?>><div class="question"  style='overflow:auto; padding:10px; padding-bottom:10px;<?php if (($color % 2) == 0) {echo "background-color: lightgrey;";} else {echo "background-color: white;";} ?>position:relative;'>
<?php $color++; ?>

<h4 style="clear:both;"><span class='questionName'><?=$question[0]->title?></span></h4>



	 <span style="float:right;"><?=$question[0]->created?></span> 
</div></a>
<?php endforeach;?> 

</div>  
<?php endif; ?> 