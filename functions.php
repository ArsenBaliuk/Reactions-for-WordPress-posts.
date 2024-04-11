<?php 
// !!!Be sure to connect Ajax
// Add this code to your theme's functions.php file
//
// Reactions to publications
function update_reaction_count() {

    $post_id = intval( $_GET['post_id'] ); //Post's ID
    if( filter_var( $post_id, FILTER_VALIDATE_INT ) ) {
        $article = get_post($post_id);
        $output_count = 0; // The initial value of reactions
        $output_negative_count = 0; // A variable for recording the amount of a preselected reaction
        $reaction_type = $_GET['reaction_type']; // Reaction type
        $last_current_reaction = $_COOKIE['current_reaction']; // The last selected reaction

        // Check and subtract the amount from the previously selected reaction
        switch ($last_current_reaction) {
            case 'love-reactions':
                $count = get_post_meta($post_id, 'love-reactions', true);
                $n = intval($count);
                $n--;
                update_post_meta($post_id, 'love-reactions', $n);
                $output_negative_count = $n;
                break;

            case 'tearful-reactions':
                $count = get_post_meta($post_id, 'tearful-reactions', true);
                $n = intval($count);
                $n--;
                update_post_meta($post_id, 'tearful-reactions', $n);
                $output_negative_count = $n;
                break;

            case 'surprised-reactions':
                $count = get_post_meta($post_id, 'surprised-reactions', true);
                $n = intval($count);
                $n--;
                update_post_meta($post_id, 'surprised-reactions', $n);
                $output_negative_count = $n;
                break;

            case 'thoughtful-reactions':
                $count = get_post_meta($post_id, 'thoughtful-reactions', true);
                $n = intval($count);
                $n--;
                update_post_meta($post_id, 'thoughtful-reactions', $n);
                $output_negative_count = $n;
                break;
        }

        // Check and add the amount of the reaction you just selected
        switch ($reaction_type) {
            case 'love-reactions':
                if (!is_null($article)) {
                    $count = get_post_meta($post_id, 'love-reactions', true);
                    if ($count == '') {
                        add_post_meta($post_id, 'love-reactions', '1');
                        $output_count = 1;
                    } else {
                        $n = intval($count);
                        $n++;
                        update_post_meta($post_id, 'love-reactions', $n);
                        $output_count = $n;
                    }
                }
                break;

            case 'tearful-reactions':
                if (!is_null($article)) {
                    $count = get_post_meta($post_id, "tearful-reactions", true);
                    if ($count == '') {
                        add_post_meta($post_id, "tearful-reactions", '1');
                        $output_count = 1;
                    } else {
                        $n = intval($count);
                        $n++;
                        update_post_meta($post_id, "tearful-reactions", $n);
                        $output_count = $n;
                    }
                }
                break;

            case 'surprised-reactions':
                if (!is_null($article)) {
                    $count = get_post_meta($post_id, 'surprised-reactions', true);
                    if ($count == '') {
                        add_post_meta($post_id, 'surprised-reactions', '1');
                        $output_count = 1;
                    } else {
                        $n = intval($count);
                        $n++;
                        update_post_meta($post_id, 'surprised-reactions', $n);
                        $output_count = $n;
                    }
                }
                break;

            case 'thoughtful-reactions':
                if (!is_null($article)) {
                    $count = get_post_meta($post_id, "$reaction_type", true);
                    if ($count == '') {
                        add_post_meta($post_id, "$reaction_type", '1');
                        $output_count = 1;
                    } else {
                        $n = intval($count);
                        $n++;
                        update_post_meta($post_id, "$reaction_type", $n);
                        $output_count = $n;
                    }
                }
                break;

        }

        // We record the last negative reaction by this user in the cookie
        // We store data about the selected reaction for a year – time() + 60*60*24*30*12
        setcookie("current_reaction", $value = $_GET['reaction_type'], time() + 60*60*24*30*12, "/");

    }
    // We save the amount for the actual reaction and for the previously selected one
    $output = array( 'count' => $output_count, 'negative_count' => $output_negative_count );

    // Transfer this data in JSON format
    echo json_encode( $output );

    exit();
};

add_action( 'wp_ajax_update_reactions', 'update_reaction_count' );
add_action( 'wp_ajax_nopriv_update_reactions', 'update_reaction_count' );

// Displaying the current number of reactions for this publication
function display_post_reactions_numb( $post_id = null, $post_meta ) {
    $value = '';
    if( is_null( $post_id ) ) {
        global $post;
        $value = get_post_meta( $post->ID, $post_meta, true );
    } else {
        $value = get_post_meta( $post_id, $post_meta, true );
    }
    echo $value;
}
