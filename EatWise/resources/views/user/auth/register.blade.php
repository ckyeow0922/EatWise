<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../../">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <!-- Page Title  -->
    <title>Register | EatWise</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="assets/css/dashlite.css?ver=3.1.1">
    <link id="skin-default" rel="stylesheet" href="assets/css/theme.css?ver=3.1.1">
</head>

<body class="nk-body npc-default pg-auth" style="background: #9FC131">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body wide-xs">
                        <div class="brand-logo pb-4 text-center">
                            <a href="html/index.html" class="logo-link">
                                {{-- <img class="logo-light logo-img logo-img-lg"
                                    src="images/eatWise-logo-removebg-preview.png"
                                    srcset="images/eatWise-logo-removebg-preview.png" alt="logo"> --}}
                                <img class="logo" src="images/eatWise-logo-removebg-preview.png"
                                    srcset="images/eatWise-logo-removebg-preview.png" alt="logo-dark">
                            </a>
                        </div>
                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Register As User</h4>
                                        <div class="nk-block-des">
                                            <p>Create New EatWise Account</p>
                                        </div>
                                    </div>
                                </div>
                                <form id = "signUpForm" onsubmit="register(event)">
                                    <div class="form-group">
                                        <label class="form-label" for="name">Name</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" id="name"
                                                placeholder="Enter your name">
                                            <span id="nameError" class="invalid font-medium"
                                                style="display: none;"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="email">Email</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" id="email"
                                                placeholder="Enter your email address">
                                            <span id="emailError" class="invalid font-medium"
                                                style="display: none;"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="password">Password</label>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg"
                                                data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" class="form-control form-control-lg" id="password"
                                                placeholder="Enter your password">
                                            <span id="passwordError" class="font-medium invalid"
                                                style="display: none;"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="password">Confirm Password</label>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg"
                                                data-target="confirmPassword">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" class="form-control form-control-lg"
                                                id="confirmPassword" placeholder="Enter your confirmation password">
                                            <span id="confirmPasswordError" class="font-medium invalid"
                                                style="display: none;"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit"
                                            class="btn btn-lg btn-primary btn-block">Register</button>
                                    </div>
                                </form>
                                <div class="form-note-s2 text-center pt-4"> Already have an account? <a
                                        href="html/pages/auths/auth-login-v2.html"><strong>Sign in instead</strong></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="assets/js/bundle.js?ver=3.1.1"></script>
    <script src="assets/js/scripts.js?ver=3.1.1"></script>
    @include('user.partials.modals')
    <script>
        function register(event) {
            event.preventDefault();
            var name = $('#name').val().trim();
            var email = $('#email').val().trim();
            var password = $('#password').val().trim();
            var password_confirmation = $('#confirmPassword').val().trim();

            clearValidationMessages()
            var formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('password', password);
            formData.append('confirmPassword', password_confirmation);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content')); // Include CSRF token

            const errorIds = [
                'nameError',
                'emailError',
                'passwordError',
                'confirmPasswordError',
            ];

            errorIds.forEach((errorId) => {
                $(`#${errorId}`).css('display', 'none').text('');
            });

            $('#registerBtn').prop('disabled', true);

            $.ajax({
                url: '{{ route('createUser') }}',
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function(response) {
                    if (response.status === true) {
                        $('#modalSuccessMessage').text(response.message);
                        $('#modalSuccess').modal('show');
                        $('#modalSuccess').on('hidden.bs.modal', function(e) {
                            window.location.href = '/user/login';
                        });
                    } else {
                        $('#modalFail').modal('show');
                        $('#modalFailMessage').text(response.message);
                        $('#modalFail').on('hidden.bs.modal', function(e) {
                            location.reload();
                        });
                    }
                },
                error: function(response) {
                    if (response.status === 422) {
                        handleError(response);
                    } else {
                        console.log(response);
                        $('#modalFailMessage').text(response.message);
                        $('#modalFail').modal('show');
                    }
                },
                complete: function(response) {
                    $('#registerBtn').prop('disabled', false);
                }
            })
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        function setMarginTop() {
            // Get the header element
            var header = document.getElementById('header');
            // Get the main element
            var main = document.getElementById('main');

            // Get the category sidebars
            var sidebars = [
                document.getElementById('categorySidebar1'),
                document.getElementById('categorySidebar2'),
                document.getElementById('categorySidebar3'),
                document.getElementById('categorySidebar4'),
                document.getElementById('mobileSidebar'),
                document.getElementById('sidebar'),
            ];

            // Calculate the margin-top and height for main and sidebars
            var headerHeight = header.offsetHeight;
            var windowHeight = window.innerHeight;
            var sidebarHeight = windowHeight - headerHeight;

            // Set the margin-top of the main body to be equal to the height of the header
            main.style.setProperty('margin-top', headerHeight + 'px', 'important');

            // Set the margin-top and height for the category sidebars
            sidebars.forEach(function(sidebar) {
                if (sidebar) {
                    sidebar.style.setProperty('margin-top', headerHeight + 'px', 'important');
                    sidebar.style.setProperty('height', sidebarHeight + 'px', 'important');
                }
            });
        }

        window.addEventListener('load', function() {
            // Call the setMarginTop function when the window loads
            setMarginTop();
            // Call the setMarginTop function when the window is resized
            window.addEventListener('resize', setMarginTop);

            const pageLoader = document.getElementById('pageLoader');
            pageLoader.style.opacity = '0';
            setTimeout(function() {
                pageLoader.style.display = 'none';
            }, 500);
        });

        function handleError(response) {
            const errors = response.responseJSON.errors;

            // Display errors to the user
            for (let fieldName in errors) {
                if (errors.hasOwnProperty(fieldName)) {
                    const errorMessage = errors[fieldName][0];
                    $(`#${fieldName}Error`).css('display', 'block').text(errorMessage);
                }
            }
        }

        function numberFormatter(input, digitLength, decimalLength) {
            let value = $(input).val();
            if (value.includes('.') && decimalLength > 0) { // Decimal
                const splittedValue = value.split('.');
                const digit = integerFormatter(splittedValue[0], digitLength);
                const decimal = integerFormatter(splittedValue[1], decimalLength);
                if (decimal.length < 1 && digit.length < 1) {
                    value = 0;
                } else {
                    value = digit + '.' + decimal;
                }
            } else { // Integer
                value = integerFormatter(value, digitLength);
            }
            $(input).val(value);
        }

        function integerFormatter(value, length) {
            const filteredValue = value.replace(/\D/g, '').substring(0, length);
            return filteredValue ? filteredValue : '';
        }

        // Keep track of the sidebar state
        let sidebarNavigationOpen = false;

        // Function to open or close the mobile navigation
        function toggleNavigation() {
            if (sidebarNavigationOpen) {
                closeNavigation();
            } else {
                openNavigation();
            }
        }

        function openNavigation() {
            closeMobileNav();
            // let filterMenu = document.getElementById('filterMenu');
            // const overlayMobileFilter = document.getElementById('overlayMobileFilter');
            // filterMenu.style.display = 'none';
            // overlayMobileFilter.style.display = 'none';
            sidebarNavigationOpen = true;
            document.getElementById("sidebar").style.right = "0"; // Move the sidebar into view
            document.getElementById("sidebar").style.display = "block";
            // Show the overlay
            document.getElementById("overlayMobileNav").style.display = "block";
        }

        /* Close the sidebar for hidden header options */
        function closeNavigation() {
            sidebarNavigationOpen = false;
            document.getElementById("sidebar").style.display = "none"; // Move the sidebar off-screen to the right
            // Show the overlay
            document.getElementById("overlayMobileNav").style.display = "none";
        }

        // JavaScript for closing the sidebar when clicking outside the sidebar area
        window.onclick = function(event) {
            if (!event.target.matches('.btn-header')) {
                closeNavigation();
            }
            if (!event.target.matches('.sidebar-toggle-btn')) {
                closeNav();
            }

            var mobileSidebar = document.getElementById('mobileSidebar');
            // Check if the clicked element is not part of the mobile sidebar or the sidebar toggle button
            if (!mobileSidebar.contains(event.target) && !event.target.matches('.sidebar-toggle-btn')) {
                closeMobileNav(); // Function to close the mobile sidebar
            }
        }

        // JavaScript to close sidebar when screen size is increased above 991px
        window.addEventListener('resize', function() {
            if (window.innerWidth > 991) {
                closeNavigation();
                closeMobileNav();
            }
            if (window.innerWidth < 991) {
                closeNav();
            }
        });

        // Keep track of the sidebar state
        let sidebarOpen = false;

        // Function to open or close the mobile navigation
        function toggleNav() {
            if (sidebarOpen) {
                closeNav();
            } else {
                openNav();
            }
        }

        // Open the sidebar
        function openNav() {
            const sidebar = document.getElementById("categorySidebar1");
            sidebar.style.left = "0"; // Slide in from the left
            sidebarOpen = true;

            // Show the overlay
            document.getElementById("overlay").style.display = "block";
        }

        /* Close the sidebar */
        function closeNav() {
            document.getElementById("categorySidebar1").style.left = "-200px"; // Slide out to the left
            document.getElementById("categorySidebar2").style.display = "none"; // Slide out to the left
            document.getElementById("categorySidebar3").style.display = "none"; // Slide out to the left
            document.getElementById("categorySidebar4").style.display = "none"; // Slide out to the left
            sidebarOpen = false;

            // Show the overlay
            document.getElementById("overlay").style.display = "none";
        }

        // Keep track of the mobile sidebar state
        let mobileSidebarOpen = false;

        // Function to open or close the mobile navigation
        function toggleMobileNav() {
            if (mobileSidebarOpen) {
                closeMobileNav();
            } else {
                openMobileNav();
            }
        }

        // Open the sidebar
        function openMobileNav() {
            closeNavigation();
            // let filterMenu = document.getElementById('filterMenu');
            // const overlayMobileFilter = document.getElementById('overlayMobileFilter');
            // filterMenu.style.display = 'none';
            // overlayMobileFilter.style.display = 'none';
            const sidebar = document.getElementById("mobileSidebar");
            mobileSidebarOpen = true;
            sidebar.style.left = "0";
            // Show the overlay
            sidebar.style.display = "block";
            document.getElementById("overlayMobileCat").style.display = "block";
        }

        /* Close the sidebar */
        function closeMobileNav() {
            document.getElementById("mobileSidebar").style.display = "none"; // Slide out to the left
            mobileSidebarOpen = false;
            // Show the overlay
            document.getElementById("overlayMobileCat").style.display = "none";
        }

        // Retrieve hierarchical categories from PHP


        // Function to populate a sidebar with categories
        function populateSidebar(sidebarId, categories, parentCategories = []) {
            const sidebar = document.getElementById(sidebarId);

            sidebar.innerHTML = ''; // Clear previous content

            // Check if it's the main sidebar (sidebar 1)
            if (sidebarId === 'categorySidebar1') {
                // Add the black box as the first element
                const allCategoriesBox = document.createElement('div');
                allCategoriesBox.textContent = '모든 카테고리';
                allCategoriesBox.classList.add('header-nav', 'font-medium');
                allCategoriesBox.style.backgroundColor = 'black';
                allCategoriesBox.style.color = 'white';
                allCategoriesBox.style.padding = '15px';
                allCategoriesBox.style.paddingTop = '20px';
                allCategoriesBox.style.paddingLeft = '35px'; // Adjust as needed
                allCategoriesBox.style.lineHeight = '1.5';
                allCategoriesBox.style.position = 'relative';
                sidebar.appendChild(allCategoriesBox);
            }

            // Add a 10px margin spacer
            const spacer = document.createElement('div');
            spacer.style.height = '10px';
            sidebar.appendChild(spacer);

            // Loop through each category
            categories.forEach(categoryName => {
                // Create the heading element (h6)
                const heading = document.createElement('h6');
                // Set the text content of the heading to the category name
                heading.textContent = categoryName;

                // Create the link element (a)
                const link = document.createElement('a');
                // Add classes to the link
                link.classList.add('header-nav', 'font-light');
                // Construct the href attribute with up to four levels of categories
                const categoryFilter = encodeURIComponent(categoryName); // Encode category name
                const href = `/product-search?${constructCategoryQueryString(parentCategories, categoryName)}`;
                link.setAttribute('href', href);
                // Append the heading to the link
                link.appendChild(heading);
                // Append the link container to the sidebar
                sidebar.appendChild(link);

                // Handle mouseover event for the category link
                link.addEventListener('mouseover', function() {
                    // Check if the category has subcategories
                    const subcategories = findSubcategories(hierarchicalCategories, categoryName);
                    if (subcategories && Object.keys(subcategories).length > 0 && !subcategories._token) {
                        // Find the next subcategory sidebar
                        const nextSidebarNumber = parseInt(sidebarId.replace('categorySidebar', '')) + 1;
                        const nextSubcategorySidebarId = 'categorySidebar' + nextSidebarNumber;
                        const nextSubcategorySidebar = document.getElementById(nextSubcategorySidebarId);
                        if (nextSubcategorySidebar) {
                            // Clear the content of next subcategory sidebar
                            nextSubcategorySidebar.innerHTML = '';
                            // Populate and display the next subcategory sidebar
                            populateSidebar(nextSubcategorySidebarId, Object.keys(subcategories), [...
                                parentCategories, categoryName
                            ]);
                            nextSubcategorySidebar.style.left = (sidebar.offsetWidth + sidebar.offsetLeft) +
                                'px';
                            nextSubcategorySidebar.style.display = 'block';
                        }
                        // Hide all subsequent subcategory sidebars
                        hideSubsequentSidebars(nextSidebarNumber + 1);
                    } else {
                        // If no subcategories, hide all subsequent subcategory sidebars
                        hideSubsequentSidebars(parseInt(sidebarId.replace('categorySidebar', '')) + 1);
                    }
                });
            });
        }


        // Function to hide subsequent subcategory sidebars
        function hideSubsequentSidebars(startIndex) {
            for (let i = startIndex; i <= 4; i++) {
                const sidebarId = 'categorySidebar' + i;
                const sidebar = document.getElementById(sidebarId);
                if (sidebar) {
                    sidebar.innerHTML = ''; // Clear the content
                    sidebar.style.display = 'none'; // Hide the sidebar
                }
            }
        }

        // Recursive function to find subcategories
        function findSubcategories(categories, targetCategory) {
            for (const categoryName in categories) {
                if (categoryName === targetCategory) {
                    return categories[categoryName];
                }
                const subcategories = categories[categoryName];
                if (subcategories && typeof subcategories === 'object') {
                    const foundSubcategories = findSubcategories(subcategories, targetCategory);
                    if (foundSubcategories) {
                        return foundSubcategories;
                    }
                }
            }
            return null;
        }

        // Function to construct the query string for categories
        function constructCategoryQueryString(parentCategories, currentCategory) {
            const categoryLevels = parentCategories.concat(currentCategory);
            const queryString = categoryLevels.map((category, index) =>
                `category${index + 1}=${encodeURIComponent(category)}`).join('&');
            return queryString;
        }

        // Function to initialize the main sidebar with top-level categories
        function initializeSidebar() {
            const mainSidebar = document.getElementById('categorySidebar1');
            mainSidebar.innerHTML = ''; // Clear previous content

            // Assuming hierarchicalCategories is an object where keys are category names and values are subcategory objects
            const categories = Object.keys(hierarchicalCategories); // Get an array of category names

            populateSidebar('categorySidebar1', categories);
        }

        // Call the initializeSidebar function to set up the initial state
        initializeSidebar();

        var openMobileIcon =
            '{{ asset('storage/library/Icons/Arrows_Dropdown_More/Dropdown_W10px_H5px_Black.svg') }}';

        var closeMobileIcon =
            '{{ asset('storage/library/Icons/Arrows_Dropdown_More/Dropdown_W10px_H5px_Red_Open.svg') }}';

        // Function to populate the mobile sidebar menu with categories
        function populateMobileSidebar(categories, parentElement, parentCategories = []) {
            // Add spacer
            const spacer = document.createElement('div');
            spacer.style.height = '10px';
            parentElement.appendChild(spacer);

            const menu = document.createElement('ul');
            menu.classList.add('sidebar-menu');
            parentElement.appendChild(menu);

            for (const categoryName in categories) {
                const category = categories[categoryName];
                const hasSubcategories = Object.keys(category).length > 1;

                const listItem = document.createElement('li');
                menu.appendChild(listItem);

                const link = document.createElement('a');
                link.classList.add('header-nav', 'font-light');

                // Construct the href attribute with current and parent categories
                const categoryParams = [...parentCategories, categoryName].map((cat, index) =>
                    `category${index + 1}=${encodeURIComponent(cat)}`).join('&');
                link.setAttribute('href', `/product-search?${categoryParams}`);

                listItem.appendChild(link);

                const categoryContainer = document.createElement('div');
                categoryContainer.classList.add('category-container');
                link.appendChild(categoryContainer);

                const heading = document.createElement('h5');
                heading.textContent = categoryName;
                categoryContainer.appendChild(heading);

                if (hasSubcategories) {
                    const dropdownIcon = document.createElement('img');
                    dropdownIcon.src = openMobileIcon;
                    dropdownIcon.classList.add('dropdown-icon');
                    categoryContainer.appendChild(dropdownIcon);

                    const subMenu = document.createElement('ul');
                    subMenu.classList.add('sub-menu');
                    listItem.appendChild(subMenu);
                    subMenu.style.display = 'none';

                    populateSubcategories(category, subMenu, [...parentCategories, categoryName]);

                    link.addEventListener('click', function(event) {
                        event.preventDefault();
                        subMenu.style.display = subMenu.style.display === 'none' ? 'block' : 'none';
                        dropdownIcon.src = listItem.parentNode.classList.contains('selected') ?
                            closeMobileIcon :
                            openMobileIcon;
                    });
                }
            }
        }

        // Function to populate subcategories recursively
        function populateSubcategories(categories, parentElement, parentCategories = []) {
            for (const categoryName in categories) {
                if (categoryName !== '_token') {
                    const listItem = document.createElement('li');
                    parentElement.appendChild(listItem);

                    const link = document.createElement('a');
                    link.classList.add('header-nav', 'font-light');

                    // Construct the href attribute with current and parent categories
                    const categoryParams = [...parentCategories, categoryName].map((cat, index) =>
                        `category${index + 1}=${encodeURIComponent(cat)}`).join('&');
                    link.setAttribute('href', `/product-search?${categoryParams}`);

                    listItem.appendChild(link);

                    const categoryContainer = document.createElement('div');
                    categoryContainer.classList.add('category-container');
                    link.appendChild(categoryContainer);

                    const heading = document.createElement('h6'); // Set heading to h6
                    heading.textContent = categoryName;
                    categoryContainer.appendChild(heading);

                    if (Object.keys(categories[categoryName]).length > 1) {
                        const dropdownIcon = document.createElement('img');
                        dropdownIcon.src = openMobileIcon;
                        dropdownIcon.classList.add('dropdown-icon');
                        categoryContainer.appendChild(dropdownIcon);

                        const subMenu = document.createElement('ul');
                        subMenu.classList.add('sub-menu');
                        listItem.appendChild(subMenu);
                        subMenu.style.display = 'none';

                        populateSubcategories(categories[categoryName], subMenu, [...parentCategories, categoryName]);

                        link.addEventListener('click', function(event) {
                            event.preventDefault();
                            subMenu.style.display = subMenu.style.display === 'none' ? 'block' : 'none';
                            dropdownIcon.src = listItem.parentNode.classList.contains('selected') ?
                                closeMobileIcon :
                                openMobileIcon;
                        });
                    }
                }
            }
        }

        // Call the function to populate mobile sidebar with top-level categories
        populateMobileSidebar(hierarchicalCategories, document.getElementById('mobileSidebarMenu'));

        // Add event listener to category links
        document.querySelectorAll('.sidebar-menu li a').forEach(function(link) {
            link.addEventListener('click', function() {
                if (this.nextElementSibling && this.nextElementSibling.classList.contains('sub-menu')) {
                    this.parentNode.classList.toggle('selected');
                    const dropdownIcon = this.querySelector('.dropdown-icon');
                    if (dropdownIcon) {
                        dropdownIcon.src = this.parentNode.classList.contains('selected') ?
                            closeMobileIcon :
                            openMobileIcon;
                    }
                } else {
                    this.parentNode.classList.remove('selected');
                }
            });
        });

        function clearValidationMessages() {
            // Get all elements with the "invalid" class within the form
            var invalidElements = document.querySelectorAll('.invalid');

            // Loop through each invalid element and hide it
            invalidElements.forEach(function(element) {
                element.style.display = 'none';
                element.textContent = '';
            });
        }

        function showLoading() {
            $('#modalLoading').modal('show');
        }

        function hideLoading() {
            $('#modalLoading').modal('hide');
        }

        document.addEventListener("DOMContentLoaded", function() {
            // Dropdown items
            var dropdownItems = document.querySelectorAll('.toggle-member-nav');
            dropdownItems.forEach(function(item) {
                item.addEventListener('click', function() {
                    toggleSubMenu(this);
                });

                // Arrow icons click event
                var arrowIcons = item.querySelectorAll('.arrow-icon');
                arrowIcons.forEach(function(arrowIcon) {
                    arrowIcon.addEventListener('click', function(event) {
                        event.stopPropagation(); // Prevent event bubbling
                        toggleSubMenu(item);
                    });
                });
            });

            // Toggle submenu visibility
            function toggleSubMenu(item) {
                var submenu = item.nextElementSibling;
                var arrowIcon = item.querySelector('.arrow-icon i');
                submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
                arrowIcon.classList.toggle('down-arrow');
            }

            // Highlight active navigation link
            var path = window.location.pathname;
            var navLinks = document.querySelectorAll('.dropdown_selection ul a');

            navLinks.forEach(function(link) {
                var href = link.getAttribute('href');
                if (href.includes(path)) {
                    link.classList.add('active');
                    var submenu = link.closest('.dropdown_selection').querySelector('ul');
                    submenu.style.display = 'block'; // Make submenu visible
                    var arrowIcon = link.closest('.dropdown_selection').querySelector('.arrow-icon i');
                    arrowIcon.classList.add('down-arrow'); // Make arrow icon face downwards
                }
            });
        });
    </script>
    <style>
        .logo {
            width: 150px;
            /* Adjust the width as needed */
            height: auto;
            /* Maintains the aspect ratio */
        }
    </style>

</html>
