<form action="<?php echo home_url( '/' ); ?>">
	<!-- Ici on affiche le champ « s »
	mais nous aurions pu également en faire
	un champ de type hidden avec une valeur vide-->
  <p>
  	<input type="text" name="s" placeholder="Ville / Nom du lieu" value="<?php the_search_query(); ?>" id="s">
  </p>
  <p>
    <input type="text" name="s" placeholder="Date" value="<?php the_search_query(); ?>" id="s">
  </p>
  <p>
    <input type="number" name="nombreparticipants" placeholder="Nombre de Participants" min="0" value="<?php
    if ( isset( $_GET['nombreparticipants'] ) && $_GET['nombreparticipants'] ) {
      echo intval( $_GET['nombreparticipants'] );
    } ?>" id="nombreparticipants">
  </p>
  <p>
  	<input type="number" name="prix-maxi" min="0" value="<?php
  	if ( isset( $_GET['prix-maxi'] ) && $_GET['prix-maxi'] ) {
  		echo intval( $_GET['prix-maxi'] );
  	} ?>" id="prix-maxi">
  </p>
  <?php
$equips = array(
	'ordinateur'  => __( 'Ordinateur' ),
	'imprimante'  => __( 'Imprimante' ),
	'wifi'  => __( 'Wifi' ),
	'television' => __( 'Télévision' ),
  'enceinte' => __( 'Enceinte' ),
  'microphone' => __( 'Microphone' ),
  'paperboard' => __( 'Paperboard' ),
  'tableau' => __( 'Tableau' ),
  'projecteur-ecran' => __( 'Projecteur' ),
  'photocopieuse' => __( 'Photocopieuse' ),
  'regie-son' => __( 'son' ),
  'regie-lumiere' => __( 'lumière' ),
  'cafetariat' => __( 'Cafétariat' ),
  'cafe' => __( 'Café' ),
    );
    ?>


    <?php

        $num = 1;
        $breaker = 5; //How many cols inside a row?

        foreach ( $equips as $key => $equip ) {

            if ($num == 1) echo '<div class="row">'; //First col, so open the row.

                echo '<div class="col-xs-2"> <input type="checkbox" name="equipements[]" class="checkbox-equip" '
                . 'id="equipment[' . $key . ']" value="' . $key . '"'
                . checked( in_array( $key, get_query_var( 'equipements' ) ), true, false ) . '> <label for="equipment[' . $key . ']"><p class = "search-font">' . $equip . '</p><img src="/wordpress/wp-content/themes/blankslate-child/images/equipements/'. $key .'.png"/></label> </div>';

            $num++;

            if ($num > $breaker) { echo '</div>'; $num = 1; } // The num arrived at the break-point. Close the row!

        }
    ?>
  </div>
    <div class="row">
      <div class="col-xs-offset-1">
	<button type="submit">Rechercher</button>
</div>
</div>
</form>
