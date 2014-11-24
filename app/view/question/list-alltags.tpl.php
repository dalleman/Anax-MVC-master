<?php $color=0; ?>
<h3><?=$title?></h3>
<?php foreach($taglist as $tag) {?>
<div style='clear:both; overflow:auto; padding:10px;<?php if (($color % 2) == 0) {echo "background-color: lightgrey;";} else {echo "background-color: white;";} ?>'>
	<?php $color++; ?>
<span style="margin-bottom:0px; font-size:26px;"><a style="text-decoration:none;" href="<?=$this->url->create('questions/list/' . $tag->tag)?>"><?=$tag->tag?></a></span><span style="font-style:italic;"> - <?=$tag->count?> inlägg</span>
</div>

<? } ?>