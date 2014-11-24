<h1><?=$title?></h1>

<?=$content?>

<?php if($message == 'success') : ?>
<span style="color:lightgreen;">Grattis! Du lyckades skapa en ny användare, varsågod och logga in.</span>
<?php else : ?>
<span><a href="users/create">Skapa ny användare</a></span>	
<?php endif ; ?>

<?php if (isset($links)) : ?>
<ul>
<?php foreach ($links as $link) : ?>
<li><a href="<?=$link['href']?>"><?=$link['text']?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
