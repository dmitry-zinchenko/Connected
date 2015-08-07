/**
 * Created by Dmitry on 07.08.2015.
 */

$(document).ready(function() {

    $('#delete-confirmation').on('click', function() {
        return confirm('This can not be undone, really. Are you sure?');
    })

});