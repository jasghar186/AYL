<?php
    $font_size_options = array(
        'Small (16px)' => '1rem',
        'Medium (18px)' => '1.125rem',
        'Large (20px)' => '1.25rem',
        'X-Large (22px)' => '1.375rem',
    );
    
    $GLOBALS['font_size_options'] = array(
        'Small (16px)' => '1rem',
        'Medium (18px)' => '1.125rem',
        'Large (20px)' => '1.25rem',
        'X-Large (22px)' => '1.375rem',
    );
    $GLOBALS['h1_font_size_options'] = array(
        'Small (24px)' => '24px',
        'Medium (36px)' => '36px',
        'Large (42px)' => '42px',
        'X-Large (56px)' => '56px',
    );
    $GLOBALS['body_font_options'] = array(
        'Arial' => 'Arial, sans-serif',
        'Baskerville' => 'Baskerville, "Baskerville Old Face", "Hoefler Text", Garamond, "Times New Roman", serif',
        'Book Antiqua' => 'Book Antiqua, Palatino, "Palatino Linotype", "Palatino LT STD", Georgia, serif',
        'Calibri' => 'Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif',
        'Cambria' => 'Cambria, Georgia, serif',
        'Century Gothic' => 'Century Gothic, sans-serif',
        'Constantia' => 'Constantia, Georgia, serif',
        'Courier New' => '"Courier New", Courier, monospace',
        'Franklin Gothic' => '"Franklin Gothic Medium", "Franklin Gothic", "ITC Franklin Gothic", Arial, sans-serif',
        'Futura' => 'Futura, "Trebuchet MS", Arial, sans-serif',
        'Garamond' => 'Garamond, Baskerville, "Baskerville Old Face", "Hoefler Text", "Times New Roman", serif',
        'Georgia' => 'Georgia, serif',
        'Gill Sans' => '"Gill Sans", "Gill Sans MT", Calibri, sans-serif',
        'Lucida Bright' => '"Lucida Bright", Georgia, serif',
        'Palatino' => 'Palatino, "Palatino Linotype", "Palatino LT STD", "Book Antiqua", Georgia, serif',
        'System Default' => 'System Default, sans-serif',
        'Tahoma' => 'Tahoma, Geneva, sans-serif',
        'Times New Roman' => '"Times New Roman", Times, serif',
        'Trebuchet' => '"Trebuchet MS", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif',
        'Verdana' => 'Verdana, Geneva, sans-serif',
        'Abril Fatface' => 'Abril Fatface, cursive',
        'Amatic SC' => 'Amatic SC, cursive',
        'Crimson Text' => 'Crimson Text, serif',
        'Great Vibes' => 'Great Vibes, cursive',
        'Inconsolata' => 'Inconsolata, monospace',
        'Lato' => 'Lato, sans-serif',
        'Libre Baskerville' => '"Libre Baskerville", serif',
        'Lora' => 'Lora, serif',
        'Merriweather' => 'Merriweather, serif',
        'Mr De Haviland' => '"Mr De Haviland", cursive',
        'Noto Serif' => '"Noto Serif", serif',
        'Open Sans' => '"Open Sans", sans-serif',
        'Playball' => 'Playball, cursive',
        'Playfair Display' => '"Playfair Display", serif',
        'Poppins' => 'Poppins, sans-serif',
        'Raleway' => 'Raleway, sans-serif',
        'Roboto Slab' => '"Roboto Slab", serif',
        'Jangerine' => 'Jangerine, cursive',
        'Work Sans' => '"Work Sans", sans-serif',
        'custom' => 'Custom', // Placeholder for custom font option
    );
    
    $GLOBALS['post_meta_options'] = array(
        'Date Modified' => 'modified',
        'Date Published' => 'published',
        'Display Both' => 'both',
    );
    $GLOBALS['site_logo_height'] = array(
        'Small (50px)' => '50px',
        'Medium (75px)' => '75px',
        'Large (100px)' => '100px',
        'Extra Large (150px)' => '150px',
    );
    $GLOBALS['featured_images_size'] = array(
        'Trellis: Square' => '1*1',
        'Trellis: 3x4' => '3*4',
        'Trellis: 4x3' => '4*3',
        'Trellis: 16x9' => '16*9',
        'Full Size' => 'full',
    );

    $GLOBALS['site_colors'] = array(
        'red' => '#ff0000',
        'black' => '#000000',
        'orange' => '#ffc000',
        'Turquoise' => '#40E0D0',
        'Slate Gray' => '#708090',
        'Crimson' => '#DC143C',
    );

    $GLOBALS['layout_space'] = array(
        'Comfortable' => 'Comfortable',
        'Compact' => 'Compact',
    );

    $GLOBALS['lead_form_popup_timer'] = array(
        '15 Seconds' => '15000',
        '20 Seconds' => '20000',
        '30 Seconds' => '30000',
    );

    $GLOBALS['page_scroll_limit'] = array(
        '30%' => '30',
        '50%' => '50',
        '75%' => '75',
    );
    $GLOBALS['article_schema_type'] = array(
        'Article' => 'Article',
        'News Article' => 'News Article',
        'Blog Posting' => 'Blog Posting',
    );
    $GLOBALS['authorized_users'] = array(
        'Article' => 'Article',
        'News Article' => 'News Article',
        'Blog Posting' => 'Blog Posting',
    );

    // Get admin and editors and merge them
    $admin_users = get_users(
        array(
            'role' => 'administrator',
        )
    );
    $editor_users = get_users(
        array(
            'role' => 'subscriber',
        )
    );

    $merged_users = [];
    $admins = [];
    $editors = [];

    foreach($admin_users as $index => $admin) {
        $admin_name = $admin->data->user_login;
        $admins[$admin_name] = $admin_name;
    }
    foreach($editor_users as $index => $editor) {
        $editor_name = $editor->data->user_login;
        $editors[$editor_name] = $editor_name;
    }

    $merged_users = array_merge($admins, $editors);

    $GLOBALS['authorized_users'] = $merged_users;

    // Get the categories that are not blanked and not uncategorized
    $categories = get_categories(array(
        'exclude' => get_cat_ID('uncategorized'), // Exclude the "uncategorized" category
        'parent' => 0, // Include only top-level categories
        'hide_empty' => false,
    ));
    
    $GLOBALS['exclusive_content_categories'] = array();
    foreach ($categories as $category) {
        // Include child categories
        $child_args = array(
            'parent' => $category->term_id,
            'hide_empty' => false,
        );
        $child_categories = get_categories($child_args);
        
        $GLOBALS['exclusive_content_categories'][$category->slug] = $category->slug;
    
        foreach ($child_categories as $child_category) {
            $GLOBALS['exclusive_content_categories'][$child_category->slug] = $child_category->slug;
        }
    }
    