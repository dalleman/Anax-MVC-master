<h1><?=$title?></h1>

<?php $color=0; ?>
<?php foreach ($users as $user) : ?>

<div style='clear:both; overflow:auto; padding:10px;<?php if (($color % 2) == 0) {echo "background-color: lightgrey;";} else {echo "background-color: white;";} ?>'>
<?php $color++; ?>
<h2 style="margin-bottom:0px;"><a href='<?=$this->url->create('users/id/' . $user->acronym)?>'><?=$user->acronym?></a></h2>

<img style='float:left;margin-right:5px; border:solid 3px #222A38;'src="<?php echo 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($user->email))) . '.jpg?s=80';?>">
<span style="font-weight:bold;">Email: <?=$user->email?><br>Namn: <?=$user->firstname?> <?=$user->lastname?><br>Skapad: <?=$user->created?></span>

</div>
 
<?php endforeach; ?>
 