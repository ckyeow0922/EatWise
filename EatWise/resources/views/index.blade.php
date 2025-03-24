<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Fav Icon  -->
<link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
<!-- Page Title  -->
<title>EatWise</title>
<!-- StyleSheets  -->
<link rel="stylesheet" href="{{ asset('assets/css/dashlite.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('storage\adminISMRO.css') }}"> --}}
<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css">
<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">
<div class="nk-app-root" style="background: white;">
    <div class="nk-wrap">
        <div class="nk-header nk-header-fixed is-light" style="background:#9FC131">
            <div class="container-fluid">
                <div class="nk-header-wrap">
                    <div class="nk-header-app-name">
                        {{-- <div class="nk-header-app-logo">
                            <em class="icon ni"> --}}
                        <img class="logo-header" src="images/eatWise-logo-removebg-preview.png" alt="">
                        {{-- </em>
                        </div> --}}
                        <div class="nk-header-app-info">
                            <span class="sub-text" style="color: white">Dashboard</span>
                            <span class="lead-text" style="color: white">EatWise</span>
                        </div>
                    </div>
                    <div class="nk-header-menu is-light">
                        <div class="nk-header-menu-inner">
                            <!-- Menu -->
                            <ul class="nk-menu nk-menu-main">
                                <span style="color: white;font-weight:bold;">Welcome To EatWise!</span>
                            </ul>
                            <!-- Menu -->
                        </div>
                    </div>
                    <div class="nk-header-tools">
                        <ul class="nk-quick-nav">
                            </li><!-- .dropdown -->
                            <li class="dropdown user-dropdown">
                                <a href="#" class="dropdown-toggle me-n1" data-bs-toggle="dropdown">
                                    <div class="user-toggle">
                                        <span class="nk-menu-text">Log In</span>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-end">
                                    <div class="dropdown-inner">
                                        <ul class="link-list">
                                            <li><a href={{ route('user.login') }}><em
                                                        class="icon ni ni-user-alt"></em><span>As
                                                        User</span></a>
                                            </li>
                                            <li><a href="html/user-profile-setting.html"><em
                                                        class="icon ni ni-setting-alt"></em><span>As Admin</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown user-dropdown">
                                <a href="#" class="dropdown-toggle me-n1" data-bs-toggle="dropdown">
                                    <div class="user-toggle">
                                        <span class="nk-menu-text">Register</span>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-end">
                                    <div class="dropdown-inner">
                                        <ul class="link-list">
                                            <li><a href={{ route('user.register') }}><em
                                                        class="icon ni ni-user-alt"></em><span>As User</span></a>
                                            </li>
                                            <li><a href="html/user-profile-setting.html"><em
                                                        class="icon ni ni-setting-alt"></em><span>As Admin</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-content ">
            <div class="container-fluid">
                <div class="nk-content-inner">
                    <div class="nk-content-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/charts/gd-analytics.js') }}"></script>
<script src="{{ asset('assets/js/libs/jqvmap.js') }}"></script>

<script src="https://kit.fontawesome.com/0a14a1d42d.js" crossorigin="anonymous"></script>
<script>
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


    function showOrderDetails(orderDetails, order) {
        event.preventDefault();
        const modalBody = document.getElementById('orderDetailsBody');
        modalBody.innerHTML = '';

        orderDetails.forEach(detail => {
            const product = detail.product;
            const productHtml = `
        <div class="row my-4">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <img src="${product.product_image}" alt="${product.product_name}" class="" style="border: 1.5px solid var(--grey-2);">
            </div>
            <div class="col-12 col-sm-6 col-md-8 col-lg-9">
                <h6 class="font-medium product-name" style="color: var(--black-1)">${product.product_name}</h6>
                <dl class="row font-medium mb-0" style="word-break:break-all">
                    <dt class="col-5 col-sm-6 col-lg-5 py-1" style="color:var(--red-1)">
                        단가
                    </dt>
                    <dd class="col-7 col-sm-6 col-lg-7 m-0 py-1 d-flex align-items-center" style="color:var(--black-1)">
                        ${detail.price}원
                    </dd>
                    <dt class="col-5 col-sm-6 col-lg-5 py-1" style="color:var(--red-1)">
                        수량
                    </dt>
                    <dd class="col-7 col-sm-6 col-lg-7 py-1 m-0 d-flex align-items-center" style="color:var(--black-1)">
                        ${detail.quantity}
                    </dd>
                    ${detail.delivery_status !== '알려지지 않은.' ? `
                    <dt class="col-5 col-sm-6 col-lg-5 py-1" style="color:var(--red-1)">
                        배송 상황
                    </dt>
                    <dd class="col-7 col-sm-6 col-lg-7 m-0 py-1 d-flex align-items-center" style="color:var(--black-1)">
                        ${detail.delivery_status}
                    </dd>` : ''}
                    <dt class="col-5 col-sm-6 col-lg-5 py-1" style="color:var(--red-1)">
                        총 가격
                    </dt>
                    <dd class="col-7 col-sm-6 col-lg-7 m-0 py-1 d-flex align-items-center" style="color:var(--black-1)">
                        ${detail.total_price}원
                    </dd>
                    ${order.order_status === '주문이 거부되었습니다' ? `
                    <dt class="col-5 col-sm-6 col-lg-5 py-1" style="color:var(--red-1)">
                        논평하다
                    </dt>
                    <dd class="col-7 col-sm-6 col-lg-7 m-0 py-1 d-flex align-items-center" style="color:var(--black-1)">
                        ${order.remark}
                    </dd>` : ''}
                    ${detail.delivery_status === '주문을 한국으로 발송하지 못했습니다.' ? `
                    <dt class="col-5 col-sm-6 col-lg-5 py-1" style="color:var(--red-1)">
                        주목
                    </dt>
                    <dd class="col-7 col-sm-6 col-lg-7 m-0 py-1 d-flex align-items-center" style="color:var(--black-1)">
                        ${detail.remark}
                    </dd>` : ''}
                    ${detail.shipping_company && detail.tracking_number ? `
                    <dt class="col-5 col-sm-6 col-lg-5 py-1" style="color:var(--red-1)">
                        배송 사
                    </dt>
                    <dd class="col-7 col-sm-6 col-lg-7 m-0 py-1 d-flex align-items-center" style="color:var(--black-1)">
                        ${detail.shipping_company}
                    </dd>
                    <dt class="col-5 col-sm-6 col-lg-5 py-1" style="color:var(--red-1)">
                        운송장 번호
                    </dt>
                    <dd class="col-7 col-sm-6 col-lg-7 m-0 py-1 d-flex align-items-center" style="color:var(--black-1)">
                        ${detail.tracking_number}
                    </dd>` : ''}
                </dl>
            </div>
        </div>
        <hr class="border-light m-0">
        `;
            modalBody.innerHTML += productHtml;
        });

        const additionalDetailsHtml = `
        <div class="border-top border-dark mb-lg-3 mb-md-2 mb-sm-1 mb-1 border-2"></div>
        <dl class="row font-medium mb-0" style="word-break:break-all">
            <dt class="col-5 col-lg-3 pb-2" style="color:var(--red-1)">
                주문 번호
            </dt>
            <dd class="col-7 col-lg-9 m-0 pb-2 d-flex align-items-center" style="color:var(--black-1)">
                ${order.reference_number}
            </dd>
            <dt class="col-5 col-lg-3" style="color:var(--red-1)">
                주문 시간
            </dt>
            <dd class="col-7 col-lg-9 m-0 d-flex align-items-center" style="color:var(--black-1)">
                ${order.formattedCreatedAt}KST
            </dd>
            <div><hr class="border-light"></div>
            <dt class="col-5 col-lg-3 pb-2" style="color:var(--red-1)">
                수취인 이름
            </dt>
            <dd class="col-7 col-lg-9 m-0 d-flex pb-2 align-items-center" style="color:var(--black-1)">
                ${order.contact_name}
            </dd>
            <dt class="col-5 col-lg-3 pb-2" style="color:var(--red-1)">
                전화 번호
            </dt>
            <dd class="col-7 col-lg-9 m-0 d-flex pb-2 align-items-center" style="color:var(--black-1)">
                ${order.contact_number}
            </dd>
            <dt class="col-5 col-lg-3" style="color:var(--red-1)">
                배송 주소
            </dt>
            <dd class="col-7 col-lg-9 m-0 d-flex align-items-center" style="color:var(--black-1)">
                ${order.delivery_address}
            </dd>
            <div><hr class="border-light"></div>
            <dt class="col-5 col-lg-3 pb-2" style="color:var(--red-1)">
                총 상품 가격
            </dt>
            <dd class="col-7 col-lg-9 m-0 d-flex pb-2 align-items-center" style="color:var(--black-1)">
                ${order.total_product_price}원
            </dd>
            <dt class="col-5 col-lg-3 pb-2" style="color:var(--red-1)">
                총 배송비
            </dt>
            <dd class="col-7 col-lg-9 m-0 d-flex pb-2 align-items-center" style="color:var(--black-1)">
                ${order.total_shipping_price}원
            </dd>
            <dt class="col-5 col-lg-3 pb-2" style="color:var(--red-1)">
                총 금액
            </dt>
            <dd class="col-7 col-lg-9 col-lg-3 m-0 d-flex pb-2 align-items-center" style="color:var(--black-1)">
                ${order.total_amount}원
            </dd>
        </dl>
    `;
        modalBody.innerHTML += additionalDetailsHtml;

        const orderDetailsModal = new bootstrap.Modal(document.getElementById('orderDetailsModal'));
        orderDetailsModal.show();
    }

    function showModal(refundExchangeModal, orderDetailId, quantity) {
        // Set the data in the hidden inputs
        event.preventDefault();
        document.getElementById('orderDetailIdInput').value = orderDetailId;
        document.getElementById('quantityInput').value = quantity;

        // Show the modal
        $(refundExchangeModal).modal('show');
    }

    let allFiles = [];

    function updateContainerAndButton() {
        const mediaPreviewContainer = document.getElementById('media-preview-container');
        const buttonUploadTextContainer = document.querySelector('.button-upload-text-container');
        const mediaCount = mediaPreviewContainer.querySelectorAll('.uploaded-media').length;
        const mediaContainer = document.getElementById('media-upload-container');

        buttonUploadTextContainer.style.display = 'inline-block';
        buttonUploadTextContainer.classList.add('d-flex');
        mediaContainer.classList.add('border-0');

        if (mediaCount > 0 && mediaCount < 5) {
            mediaPreviewContainer.style.alignItems = 'start';
            mediaPreviewContainer.style.justifyContent = 'start';
            buttonUploadTextContainer.style.height = '120px';
            buttonUploadTextContainer.style.width = '120px';
            buttonUploadTextContainer.style.marginLeft = '3px';
            mediaPreviewContainer.appendChild(buttonUploadTextContainer);
        } else if (mediaCount === 0) {
            mediaContainer.classList.remove('border-0');
            mediaPreviewContainer.style.justifyContent = 'center';
            mediaPreviewContainer.style.alignItems = 'center';
            buttonUploadTextContainer.style.height = '100px';
        } else {
            buttonUploadTextContainer.classList.remove('d-flex');
            buttonUploadTextContainer.style.display = 'none';
        }
    }

    function submitRefundExchange(event) {
        event.preventDefault();
        var formData = new FormData(event.target); // Use the form directly from the event
        clearValidationMessages();
        // Get the files from the input
        allFiles.forEach((file, index) => {
            formData.append('medias[' + index + ']', file);
        });

        var mediasError = document.getElementById('mediasError');
        mediasError.style.display = 'none';

        showLoading();
        $.ajax({
            url: '/order/refund-exchange/create',
            type: 'POST',
            processData: false,
            contentType: false,
            data: formData,
            success: function(response) {
                setTimeout(hideLoading, 1000);
                if (response.status === true) {
                    $('#modalSuccessMessage').text(response.message);
                    $('#modalSuccess').modal('show');
                    $('#modalSuccess').on('hidden.bs.modal', function(e) {
                        location.reload();
                    });
                } else {
                    $('#modalFailMessage').text(response.message);
                    $('#modalFail').modal('show');
                }
            },
            error: function(response) {
                setTimeout(hideLoading, 1000);
                if (response.status === 422) {
                    handleError(response);
                    const errorContainer = document.getElementById('mediasError');
                    let errorMessages = '';

                    for (let i = 0; i < 5; i++) {
                        const errorKey = `medias.${i}`;
                        if (response.responseJSON.errors[errorKey]) {
                            const errors = response.responseJSON.errors[errorKey];
                            // Loop through each error message in the array
                            for (let j = 0; j < errors.length; j++) {
                                errorMessages += errors[j] + '<br>';
                            }
                        }
                    }

                    // If there are any error messages, display them
                    if (errorMessages) {
                        mediasError.innerHTML += errorMessages;
                        mediasError.style.display = 'block';
                    }
                    setTimeout(function() {
                        $('#requestRefundModal').modal('show');
                    }, 1000);
                } else {
                    // console.log(response);
                    $('#modalFailMessage').text(response.message);
                    $('#modalFail').modal('show');
                }
            },
        });
    }

    function cancelOrderIni(orderId) {
        // Show the modal
        event.preventDefault();
        $('#modalWarning').modal('show');
        $('#modalWarningTitle').text('주문 취소')
        $('#modalWarningMessage').text('이 주문을 취소하시겠습니까?')
        // Set up event listener for the confirmation buttons inside the modal
        $('#modalWarningButton').click(function() {
            // Dismiss the modal
            $('#modalWarning').modal('hide');
        });

        $('#modalWarningButton2').click(function() {
            // Call the deletePromotion function
            cancelOrder(orderId);
            // Dismiss the modal
            $('#modalWarning').modal('hide');
        });
    }

    function cancelOrder(orderId) {
        // $('#softDeleteAddressButton' + token).prop('disabled', true).css({
        //     'opacity': '0.5',
        //     'cursor': 'not-allowed'
        // });
        showLoading();
        $.ajax({
            url: '/order/cancel',
            type: 'post',
            dataType: 'json',
            data: {
                orderId: orderId,
            },
            success: function(response) {
                setTimeout(hideLoading, 1000);
                if (response.status) {
                    $('#modalSuccessMessage').text(response.message);
                    $('#modalSuccess').modal('show');
                    $('#modalSuccess').on('hidden.bs.modal', function(e) {
                        var baseUrl = window.location.protocol + "//" + window.location.host +
                            window.location.pathname;
                        window.location.href = baseUrl;
                    });
                } else {
                    // $('#softDeleteAddressButton' + token).prop('disabled', false).css({
                    //     'opacity': '1',
                    //     'cursor': 'pointer'
                    // });
                    $('#modalFailMessage').text(response.message);
                    $('#modalFail').modal('show');
                }
            },
            error: function(response) {

                setTimeout(hideLoading, 1000);
                // $('#softDeleteAddressButton' + token).prop('disabled', false).css({
                //     'opacity': '1',
                //     'cursor': 'pointer'
                // });
                $('#modalFailMessage').text(response.return);
                $('#modalFail').modal('show');
            }
        });
    }

    function receiveOrderIni(orderId) {
        // Show the modal
        event.preventDefault();
        $('#modalWarning').modal('show');
        $('#modalWarningTitle').text('주문 접수됨')
        $('#modalWarningMessage').text('주문을 받으셨나요?')
        // Set up event listener for the confirmation buttons inside the modal
        $('#modalWarningButton').click(function() {
            // Dismiss the modal
            $('#modalWarning').modal('hide');
        });

        $('#modalWarningButton2').click(function() {
            // Call the deletePromotion function
            receiveOrder(orderId);
            // Dismiss the modal
            $('#modalWarning').modal('hide');
        });
    }

    function receiveOrder(orderId) {
        // $('#softDeleteAddressButton' + token).prop('disabled', true).css({
        //     'opacity': '0.5',
        //     'cursor': 'not-allowed'
        // });
        showLoading();
        $.ajax({
            url: '/order/receive',
            type: 'post',
            dataType: 'json',
            data: {
                orderId: orderId,
            },
            success: function(response) {
                setTimeout(hideLoading, 1000);
                if (response.status) {
                    $('#modalSuccessMessage').text(response.message);
                    $('#modalSuccess').modal('show');
                    $('#modalSuccess').on('hidden.bs.modal', function(e) {
                        var baseUrl = window.location.protocol + "//" + window.location.host +
                            window.location.pathname;
                        window.location.href = baseUrl;
                    });
                } else {
                    // $('#softDeleteAddressButton' + token).prop('disabled', false).css({
                    //     'opacity': '1',
                    //     'cursor': 'pointer'
                    // });
                    $('#modalFailMessage').text(response.message);
                    $('#modalFail').modal('show');
                }
            },
            error: function(response) {
                setTimeout(hideLoading, 1000);
                // $('#softDeleteAddressButton' + token).prop('disabled', false).css({
                //     'opacity': '1',
                //     'cursor': 'pointer'
                // });
                $('#modalFailMessage').text(response.return);
                $('#modalFail').modal('show');
            }
        });
    }

    @if (Auth::guard('web')->check())
        $(document).ready(function() {
            $('[id^="wishlistForm"]').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                const successIconUrl = '{{ asset('storage/library/Icons/Popup/Popup_Success.svg') }}';
                const errorIconUrl = '{{ asset('storage/library/Icons/Popup/Popup_Failure.svg') }}';
                var form = $(this); // Get the form that triggered the event
                var formData = new FormData(form[0]);

                // Append the wishlist product code directly to the form data
                var productId = form.attr('id').replace('wishlistForm', '');
                var product_code = $('[name="wishlist_product_code' + productId + '"]').val();
                formData.append('product_code', product_code);

                // Include wishlist token if it exists
                var wishlist_token = $('[name="wishlist_token' + productId + '"]').val();
                if (wishlist_token) {
                    formData.append('wishlist_token', wishlist_token);
                }

                $.ajax({
                    url: form.attr('action'),
                    type: 'post',
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(response) {
                        if (response.status === true) {
                            toastr.clear();
                            NioApp.Toast(
                                `<div style="display: flex; align-items: center;">
                                <img src="${successIconUrl}" style="width: 24px; height: 24px; margin-right: 8px;" alt="Success">
                                <span class="font-medium">${response.message}</span>
                                </div>`,
                                'success', {
                                    icon: false // Disable default icon
                                }
                            );

                            // Toggle action and display based on response
                            var productId = form.attr('id').replace('wishlistForm', '');
                            var wishlistButton = $('[id="wishlistForm' + productId +
                                '"] .product-wishlist');

                            if (response.action === 'added') {
                                wishlistButton.addClass('active');
                            } else if (response.action === 'removed') {
                                wishlistButton.removeClass('active');
                            }

                            var wishlistTokenInput = $('[name="wishlist_token' + productId +
                                '"]');

                            // Update or append wishlist token input
                            if (response.token !== null) {
                                // If token is not null, update or append input field
                                if (wishlistTokenInput.length) {
                                    wishlistTokenInput.val(response.token);
                                } else {
                                    form.append(
                                        '<input type="hidden" name="wishlist_token' +
                                        productId + '" value="' + response.token + '">');
                                }
                            } else {
                                // If token is null, remove input field if exists
                                wishlistTokenInput.remove();
                            }
                            if (window.location.pathname === '/wishlist') {
                                window.location.href = '/wishlist';
                            }

                        } else {
                            $('#modalFailMessage').text(response.message);
                            $('#modalFail').modal('show');
                        }
                    },
                    error: function(response) {
                        setTimeout(hideLoading, 1000);
                        $('#modalFailMessage').text('An error occurred. Please try again.');
                        $('#modalFail').modal('show');
                    }
                });
            });
        });
    @endif

    function addToCart(id) {
        event.preventDefault(); // Prevent the default form submission

        const successIconUrl = '{{ asset('storage/library/Icons/Popup/Popup_Success.svg') }}';
        const errorIconUrl = '{{ asset('storage/library/Icons/Popup/Popup_Failure.svg') }}';
        // Serialize the form data
        var formData = new FormData();

        var quantity = parseInt($('#quantityHiddenInput' + id).val());
        var product_code = $('#hidden_product_code' + id).val();
        formData.append('quantity', quantity);
        formData.append('product_code', product_code);
        //     formData.append('quantity', quantity);

        $.ajax({
            url: '/product/add-to-cart',
            type: 'post',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: formData,
            success: function(response) {
                if (response.status === true) {
                    // $('#successMessage').show().text(response.message);
                    toastr.clear();
                    NioApp.Toast(
                        `<div style="display: flex; align-items: center;">
                        <img src="${successIconUrl}" style="width: 24px; height: 24px; margin-right: 8px;" alt="Success">
                        <span class="font-medium">${response.message}</span>
                    </div>`,
                        'success', {
                            icon: false // Disable default icon
                        }
                    );

                } else {
                    // $('#softDeleteAddressButton' + token).prop('disabled', false).css({
                    //     'opacity': '1',
                    //     'cursor': 'pointer'
                    // });
                    $('#modalFailMessage').text(response.message);
                    $('#modalFail').modal('show');
                }
            },
            error: function(response) {
                setTimeout(hideLoading, 1000);
                $('#modalFailMessage').text(
                    'An error occurred. Please try again.');
                $('#modalFail').modal('show');
            }
        });
    }

    @if (Auth::guard('web')->check())
        $(document).ready(function() {
            // Attach event handler to all forms with id pattern 'addProductToCartForm'
            $('[id^="addProductToCartForm"]').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                const successIconUrl = '{{ asset('storage/library/Icons/Popup/Popup_Success.svg') }}';
                const errorIconUrl = '{{ asset('storage/library/Icons/Popup/Popup_Failure.svg') }}';
                var form = $(this); // Get the form that triggered the event
                var formData = new FormData(form[0]);

                // Extract the product ID from the form ID
                var productId = form.attr('id').replace('addProductToCartForm', '');
                var product_code = $('#hidden_product_code' + productId).val();

                formData.append('product_code', product_code);

                $.ajax({
                    url: form.attr('action'),
                    type: 'post',
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(response) {
                        if (response.status === true) {
                            toastr.clear();
                            NioApp.Toast(
                                `<div style="display: flex; align-items: center;">
                                    <img src="${successIconUrl}" style="width: 24px; height: 24px; margin-right: 8px;" alt="Success">
                                    <span class="font-medium">${response.message}</span>
                                </div>`,
                                'success', {
                                    icon: false // Disable default icon
                                }
                            );

                            if (response.redirect) {
                                window.location.href = response
                                    .redirect; // Redirect to checkout page
                            }
                        } else {
                            $('#modalFailMessage').text(response.message);
                            $('#modalFail').modal('show');
                        }
                    },
                    error: function(response) {
                        setTimeout(hideLoading, 1000);
                        $('#modalFailMessage').text('오류가 발생했습니다. 다시 시도해 주세요.');
                        $('#modalFail').modal('show');
                    }
                });
            });
        });
    @endif
</script>
<style>
    .nk-menu-text {
        color: white;
        transition: color 0.2s ease;
        font-weight: bold;
    }

    .nk-menu-text:hover {
        color: #02735E;
    }

    .logo-header {
        max-height: 70px;
    }
</style>
