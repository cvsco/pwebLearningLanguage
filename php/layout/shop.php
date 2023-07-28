<div id="shop_content">
	<h1 id="title_head">Power-Up</h1>
	<ul id="item_list">
		<li id="streak_freeze">
			<span id="streak_freeze_img" class="powerupImg"></span>
			<div class="details">
				<h2>Streak Freeze</h2>
				<p>Streak Freeze permette di congelare la propria serie di punti streak per un intero giorno di inattività.</p>
			</div>
			<?php
				echo '<button class="buyButton" onclick="ShopDataLoader.updatePowerupData('.FREEZE_POWERUP.')">';
				echo 'ATTIVA PER: 10';
				echo '<span class="priceImg"></span>';
				echo '</button>';
			?>
		</li>

		<li id="coins_bet">
			<span id="coins_bet_img" class="powerupImg"></span>
			<div class="details">
				<h2>Raddoppia monete</h2>
				<p>Eseguendo esercizi per 7 giorni consegutivi raddoppierai la tua scommessa di 5 monete.</p>
			</div>
			<?php
				echo '<button class="buyButton" onclick="ShopDataLoader.updatePowerupData('.BET_POWERUP.')">';
				echo 'ATTIVA PER: 5';
				echo '<span class="priceImg"></span>';
				echo '</button>';
			?>
		</li>
	</ul>
		
	<div id="coin_rules">
		<h3 class="title">Come guadagnare monete ?</h3>
		<ol id="coin_rules_list">
			<li>
				<h4>Completando gli argomenti:</h4>
				<p>Ogni due light guadagnate si ottiene una moneta</p>
			</li>
			<li>
				<h4>Mantenendo uno strek di 10 giorni:</h4>
				<p>Guadagni una moneta ogni 10 giorni di streak (1 per 10, 2 per 20, ...)</p>
			</li>
		</ol>
	</div>
</div>

