

const registrationForm = document.getElementById( 'user-registration' );

if ( registrationForm ) {

    const responseContainer = document.querySelector( '.response' );

    registrationForm.addEventListener( 'submit',  ( e ) => {

        e.preventDefault();
        responseContainer.style.display = 'none';

        fetch( '/wp-admin/admin-ajax.php?action=handle_registration_form',
        {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams( new FormData( registrationForm ) )
        }).then( response => {
            return response.json();
        }).then( jsonResponse  => {

            console.log({jsonResponse});
            
            if ( jsonResponse.success ) {
                responseContainer.innerHTML = 'You have been registered!';
                registrationForm.reset();
            } else {
                responseContainer.innerHTML = jsonResponse.data.toString();
            }

            responseContainer.style.display = 'block';

        }) 



    })



}