class SpecialHeader extends HTMLElement {
    connectedCallback(){
        this.innerHTML = `
        <header>
        <div class="logo_header">
        <img src="D:/Portfolio/MAPECON/Pictures/MAPECON_logo.png" alt="MAPECON Logo">
      </div>
      <div class="profile-dropdown">
        <input type="checkbox" id="profile-dropdown-toggle" class="profile-dropdown-toggle">
        <label for="profile-dropdown-toggle" class="profile-dropdown">
          <img src="D:/Portfolio/MAPECON/Pictures/profile.png" alt="Profile">
          <div class="dropdown-content">
            <a href="H:/mapecon/mapecon/User Interface/User Profile.html">Profile </a>
            <a href="H:/mapecon/mapecon/User Interface/User Change Password.html">Change Password</a>
            <a href="H:/mapecon/mapecon/User Interface/User Log in.html">Logout</a>
          </div>
        </label>
      </div>
      </header>`;

        // Adding the CSS styles
        const style = document.createElement('style');
        style.textContent = `
          
        *{
            margin: 0;
        }

        header {
        background-color: #303033;
        border-bottom: 4px solid #B40000;
        color: #fff;
        padding: 10px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
        }

        .logo_header img {
        width: 120px;
        height: auto;
        margin-left: 40px;
        }

        .profile-dropdown {
        position: absolute;
        top: 100%;
        right: 20px;
        }

        .profile-dropdown img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        margin-right: 30px;

        }

        .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        width: max-content;
        /* Set the width to expand as wide as necessary */
        white-space: nowrap;
        /* Prevent line breaks */
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
        border-radius: 10px;
        /* Adjust the value to change the amount of rounding */
        padding: 8px;
        /* Adjust the padding to create space around the dropdown content */
        transition: all 0.3s ease;
        /* Smooth transition on hover */
        margin-right: 30px;
        }

        .dropdown-content:hover {
        padding: 12px;
        /* Increase padding on hover to create space */
        }

        .dropdown-content a {
        color: #fff;
        padding: 8px 16px;
        /* Adjust padding for each dropdown item */
        text-decoration: none;
        display: block;
        width: 100%;
        /* Ensure each item takes full width */
        box-sizing: border-box;
        /* Include padding and border in the width */
        }

        .dropdown-content a:hover {
        border-radius: 10px;
        color: #b40000;
        /* White font color on hover */
        }

        /* PROFILE DROPDOWN */
        /* Style for the profile dropdown */
        .profile-dropdown-toggle {
            display: none; /* Hide the checkbox input */
        }
        
        .profile-dropdown {
            position: relative;
            display: inline-block;
        }
        
        .profile-dropdown img {
            width: 40px; /* Adjust the width of the profile image */
            height: 40px; /* Adjust the height of the profile image */
            border-radius: 50%; /* Make the profile image circular */
            cursor: pointer;
        }
        
        .dropdown-content {
            position: absolute;
            right: 0; /* Adjust the right position of the dropdown content */
            background-color: #f9f9f9;
            min-width: 120px; /* Set the minimum width of the dropdown content */
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2); /* Add shadow to the dropdown content */
            z-index: 1;
            display: none; /* Hide the dropdown content by default */
        }
        
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        
        .dropdown-content a:hover {
            background-color: #f1f1f1; /* Change background color on hover */
        }
        
        /* Show dropdown content when checkbox is checked */
        .profile-dropdown-toggle:checked + .profile-dropdown .dropdown-content {
            display: block;
        }
        
        /* END PROFILE DROPDOWN */

            /* Media query for responsiveness */
            @media only screen and (max-width: 600px) {
                header {
                    padding: 20px 20px;
                }

                .logo_header img {
                    width: 100px;
                    margin-left: 10px;
                }

                .profile-dropdown img {
                    width: 30px;
                    height: 30px;
                }

                .file-leave-container {
                    padding: 10px;
                }
            }
            `;
            this.appendChild(style);
        }
    }

customElements.define('special-header', SpecialHeader)