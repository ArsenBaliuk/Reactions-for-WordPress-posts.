// A function for obtaining data from a cookie by key
function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

// Ajax request to send data to and receive data from the server
function reactionPost( $ ) {

    $.fn.myPostReactions = function( options ) {
        options = $.extend({
            countElement: ".reactions-section__count"
        }, options);

        return this.each(function() {
            let $element = $( this ),

                $count = $( options.countElement, $element ), // Number of reactions
                url = ajax_data.ajaxurl,
                id = $element.data( "id" ), // Post's ID
                action = "update_reactions",
                reaction_type = '', // Declare a variable for the actual response
                last_reaction_type = getCookie('current_reaction'), // Mark the preselected reaction
                $previous_element = $('[data-id=last_reaction_type]'); // Element of a preselected reaction
                $previous_count = $( options.countElement, $previous_element ), // Number of a preselected reaction
            $element.on( "click", function( e ) {
                last_reaction_type = getCookie('current_reaction'); // Update the value of the last selected reaction
                $previous_element = $('#reactions_block').children('[data-type="'+last_reaction_type+'"]'); // Update the element of the last selected reaction
                $previous_count = $( options.countElement, $previous_element ), // Update the preselected reaction number

                e.preventDefault();
                $element.parent().children().removeClass('reactions-section__reaction_current'); // Remove a class from a preselected reaction
                $element.toggleClass('reactions-section__reaction_current'); // Adding a class to the newly selected reaction
                reaction_type = $element.data( "type" ); // Update the value of the response type, to transfer data to the server

                let data = {
                    reaction_type: reaction_type, // Selected reaction
                    action: action,
                    post_id: id
                };

                $.getJSON( url, data, function( json ) {
                    // Update the counts without page refresh
                    if( json && json.count ) {
                        $previous_count.text( json.negative_count ); // Update the number of preselected reactions (if necessary)
                        $count.text( json.count ); // Update the number of reactions
                    }
                });
            });
        });

    };

};
reactionPost( $ );

function reactionNumbs( $ ) {
    $(function() {
        if( $( ".reactions-section__reaction" ).length ) {
            $( ".reactions-section__reaction" ).myPostReactions();
        }
    });
};
reactionNumbs( $ );
