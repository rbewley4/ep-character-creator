<?php
declare(strict_types=1);
?>
<ul class="mainlist" id="lastDetails">
	  <?php

		$playerName		= creator()->character->playerName;
		$charName		= creator()->character->charName;
		$realAge		= creator()->character->realAge;
		$birthGender	= creator()->character->birthGender;
		$note			= creator()->character->note;

		echo "	<li>
					<label>Player Name</label>
					<input  type='text' id='mPlayerName' placeholder='your name' value='".$playerName."' />
				</li>
				<li>
					<label>Char. Name</label>
					<input  type='text' id='mCharacterName' placeholder='character name' value='".$charName."' />
				</li>
				<li>
					<label>Real age</label>
					<input type='number' id='mRealAge' value='".$realAge."' />
				</li>
				<li>
					<label>Birth Gender</label>
					<input  type='text' id='mBirthGender' placeholder='original gender' value='".$birthGender."' />
				</li>
				<li>
					<label>Notes</label>
					<textarea id='mNote' cols='32' rows='3'  placeholder='Notes about your character'  >".$note."</textarea>
				</li>";
	?>
</ul>