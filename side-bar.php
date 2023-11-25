<!-- Add this PHP code at the top of your HTML file -->
<?php
// Get the current page URL
$current_page = basename($_SERVER['PHP_SELF']);

// Define an array of page URLs and their corresponding nav_link classes
$page_classes = array(
    'dashboard.php' => 'nav_link',
    'grafik-siswa.php' => 'nav_link',
);

// Initialize the default class for nav_links
$default_class = 'nav_link';

// Loop through the page_classes array and check if the current page matches
foreach ($page_classes as $page_url => $class) {
    $active_class = ($current_page == $page_url) ? ' active' : '';
    // Add your icon and span elements here
    echo '</a>';
}
?>

<header class="header" id="header">
    <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
    <div class="header_img"><img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
</header>
<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div>
            <a href="#" class="nav_logo">
                <i class='bx bx-layer nav_logo-icon'></i>
                <span class="nav_logo-name">Rumah</span>
            </a>
            <div class="nav_list">
                <?php
                foreach ($page_classes as $page_url => $class) {
                    $active_class = ($current_page == $page_url) ? ' active' : '';
                    echo '<a href="' . $page_url . '" class="' . $class . $active_class . '">';

                    // Add your icon and span elements here
                    if ($page_url == 'dashboard.php') {
                        echo '<i class="bx bx-grid-alt nav_icon"></i>';
                    } elseif ($page_url == 'grafik-siswa.php') {
                        echo '<i class="bx bx-user nav_icon"></i>';
                    }

                    echo '<span class="nav_name">' . ucfirst(str_replace('.php', '', $page_url)) . '</span>';

                    echo '</a>';
                }
                ?>
            </div>

        </div>
        <a href="logout.php" class="nav_link">
            <i class='bx bx-log-out nav_icon'></i>
            <span class="nav_name">SignOut</span>
        </a>
    </nav>
</div>