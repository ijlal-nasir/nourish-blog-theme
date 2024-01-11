<?php

/**
 * Template part for theme options
 */

$theme_options = get_option('theme-options');

if (isset($_POST['update-theme-options'])) {
    $theme_options = array(
        'header-bg-color' => $_POST['header-bg-color'],
        'site-header-logo' => $_POST['site-header-logo'],
        'sticky_header' => $_POST['sticky_header'],
        'banner-bg-color' => $_POST['banner-bg-color'],
        'banner-title' => $_POST['banner-title'],
        'banner-describtion' => $_POST['banner-describtion'],
        'banner-cta-link' => $_POST['banner-cta-link']
    );
    update_option('theme-options', $theme_options);
}
if ($theme_options['sticky_header'] == 'on') {
    $checked = 'checked';
} else {
    $checked = '';
}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<div id="theme-options-page">
    <h1>Theme Options</h1>
    <div class="row">

        <div class="col-md-2">
            <ul id="theme-options-vertical-tabs">
                <li class="theme-vertical-tab-list-item active-tab" onclick="tabChange('#theme-options-header-section')">Header</li>
                <li class="theme-vertical-tab-list-item" onclick="tabChange('#theme-options-top-banner-section')">Site Banner</li>
            </ul>
        </div>
        <form action="" method="POST">
            <div class="col-md-8 content-tab-section">
                <h2 id="selected-section-heading">Header Settings</h2>
                <div id="theme-options-header-section" class="settings-content-sections">
                    <table class="table table-striped">
                        <tr>
                            <td>Background Color</td>
                            <td><input type="color" name="header-bg-color" value="<?php echo $theme_options['header-bg-color'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Upload Logo</td>
                            <td class="header-logo-upload">
                                <img src="<?php echo $theme_options['site-header-logo'] ?>" alt="site-logo" id="uploaded_site_logo" />
                                <input type="hidden" id="site-header-logo" name="site-header-logo" value="<?php echo $theme_options['site-header-logo'] ?>">
                                <input type="button" id="upload_site_logo" class="btn btn-primary" name="header-bg-color" value="Upload Logo">
                            </td>
                        </tr>
                        <tr>
                            <td>Sticky Header</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" name="sticky_header" <?php echo $checked; ?>>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="theme-options-top-banner-section" class="settings-content-sections element-none">
                    <table class="table table-striped">
                        <tr>
                            <td>Background Color</td>
                            <td><input type="color" name="banner-bg-color" value="<?php echo $theme_options['banner-bg-color'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Title</td>
                            <td><textarea name="banner-title" placeholder="Enter your first line"><?php echo $theme_options['banner-title'] ?></textarea></td>
                        </tr>
                        <tr>
                            <td>Describtion</td>
                            <td><textarea name="banner-describtion" placeholder="Enter your Second line"><?php echo $theme_options['banner-describtion'] ?></textarea></td>
                        </tr>
                        <tr>
                            <td>CTA Link</td>
                            <td><input type="url" name="banner-cta-link" value="<?php echo $theme_options['banner-cta-link'] ?>"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <input type="submit" id="update-theme-options" name="update-theme-options" value="Update Settings" class="btn btn-success" />
        </form>

    </div>
</div>