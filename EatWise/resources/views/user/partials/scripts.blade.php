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
