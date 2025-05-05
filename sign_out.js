document.addEventListener("DOMContentLoaded", function () {
    const authLinks = document.getElementById('auth-links');
    const isSignedIn = localStorage.getItem('isSignedIn') === 'true';
    const userType = localStorage.getItem('userType');

    if (isSignedIn) {
        if (userType === 'User') {
 
            authLinks.innerHTML = `
                <a href="#" class="btn btn-secondary" id="sign-out_button">Sign out</a>
            `;


            document.getElementById('sign-out_button').addEventListener('click', function (e) {
                e.preventDefault();
                localStorage.removeItem('isSignedIn');
                localStorage.removeItem('userType');

                window.location.reload(); 
            });
        } else if (userType === 'Admin') {

            authLinks.innerHTML = `
                <li id="sign-in-out">
                    <a href="admin.php" class="nav-cta-button">
                        <i class="fa-solid fa-toolbox"></i>
                    </a> 
            <a href="#" class="btn btn-secondary" id="sign-out_button">Sign out</a>
                </li>
            `;

            document.getElementById('sign-out_button').addEventListener('click', function (e) {
                e.preventDefault();
                localStorage.removeItem('isSignedIn');
                localStorage.removeItem('userType');
        
                window.location.reload(); 
            });
        }
    } else {
         $.post('sign_out.php');
    }
});