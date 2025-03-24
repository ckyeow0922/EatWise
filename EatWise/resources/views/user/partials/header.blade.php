<!-- main header @s -->
<div class="nk-header nk-header-fixed is-light" style="background:#9FC131">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-header-app-name">
                <img class="logo-header" src="images/eatWise-logo-removebg-preview.png" alt="">
                <div class="nk-header-app-info">
                    <span class="sub-text" style="color: white">Dashboard</span>
                    <span class="lead-text" style="color: white">EatWise</span>
                </div>
            </div>
            <div class="nk-header-menu is-light">
                <div class="nk-header-menu-inner">
                    <!-- Menu -->
                    <ul class="nk-menu nk-menu-main">
                        <li class="nk-menu-item">
                            <a href="html/index.html" class="nk-menu-link">
                                <span class="nk-menu-text">BMI Tracker</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="html/components.html" class="nk-menu-link">
                                <span class="nk-menu-text">Diet Recommender</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Menu -->
                </div>
            </div>
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    <span class="lead-text" style="color: white">Welcome!!! {{ $userName }}</span>
                    </li><!-- .dropdown -->
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle me-n1" data-bs-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar">
                                    <em class="icon ni ni-user-alt"></em>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end">

                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a href="html/user-profile-regular.html"><em
                                                class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                    <li><a href="html/user-profile-setting.html"><em
                                                class="icon ni ni-setting-alt"></em><span>Account Setting</span></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a href={{ route('user.logout') }}><em
                                                class="icon ni ni-signout"></em><span>Sign
                                                out</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<style>
    .nk-menu-text {
        color: white;
        transition: color 0.2s ease;
    }

    .nk-menu-text:hover {
        color: #02735E;
    }

    .logo-header {
        max-height: 70px;
    }
</style>
