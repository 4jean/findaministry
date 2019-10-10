<?php

// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('home'));
});

Breadcrumbs::register('login', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Login', route('login'));
});

Breadcrumbs::register('register', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Register', route('register'));
});

Breadcrumbs::register('thank_you', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Thank You', route('thank_you'));
});

Breadcrumbs::register('my_account', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('My Account', route('my_account'));
});

Breadcrumbs::register('about', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('About Us', route('about'));
});

Breadcrumbs::register('terms_of_use', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Terms and Conditions', route('terms_of_use'));
});

Breadcrumbs::register('privacy_policy', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Privacy Policy', route('privacy_policy'));
});

Breadcrumbs::register('contact', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Contact Us', route('contact'));
});

Breadcrumbs::register('my_profile', function ($breadcrumbs) {
    $breadcrumbs->parent('my_account');
    $breadcrumbs->push('Profile', route('my_profile'));
});

Breadcrumbs::register('my_ministries', function ($breadcrumbs) {
    $breadcrumbs->parent('my_account');
    $breadcrumbs->push('My Ministries', route('my_ministries'));
});

Breadcrumbs::register('add_ministry', function ($breadcrumbs) {
    $breadcrumbs->parent('my_ministries');
    $breadcrumbs->push('Add Ministry', route('add_ministry'));
});

Breadcrumbs::register('edit_ministry', function ($breadcrumbs, $min) {
    $breadcrumbs->parent('my_ministries');
    $breadcrumbs->push('Edit Ministry', route('edit_ministry', $min->id));
});

Breadcrumbs::register('ministries', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Ministries', route('ministries'));
});

Breadcrumbs::register('my_bookmarks', function ($breadcrumbs) {
    $breadcrumbs->parent('ministries');
    $breadcrumbs->push('My Bookmarks', route('my_bookmarks'));
});

Breadcrumbs::register('show_ministry', function ($breadcrumbs, $min) {
    $breadcrumbs->parent('ministries');
    $breadcrumbs->push(Str::limit($min->name), $min->url);
});

Breadcrumbs::register('claim_ministry', function ($breadcrumbs, $min) {
    $breadcrumbs->parent('ministries');
    $breadcrumbs->push('Claim Ministry', route('claim_ministry', Fam::hash($min->id)));
});

Breadcrumbs::register('search', function ($breadcrumbs) {
    $breadcrumbs->parent('ministries');
    $breadcrumbs->push('Search', route('search'));
});


Breadcrumbs::register('categories', function ($breadcrumbs) {
    $breadcrumbs->parent('ministries');
    $breadcrumbs->push('Categories', route('categories'));
});

Breadcrumbs::register('show_category', function ($breadcrumbs, $min_cat_name) {
    $breadcrumbs->parent('categories');
    $breadcrumbs->push($min_cat_name, route('categories'));
});

/**************************** GUIDES **************************/

Breadcrumbs::register('guides', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Guides', route('guides'));
});

Breadcrumbs::register('set_page_name', function ($breadcrumbs) {
    $breadcrumbs->parent('guides');
    $breadcrumbs->push('Choosing A Ministry Page Name', route('set_page_name'));
});

Breadcrumbs::register('guides.verify_ministry', function ($breadcrumbs) {
    $breadcrumbs->parent('guides');
    $breadcrumbs->push('How To Verify A Ministry', route('guides.verify_ministry'));
});

