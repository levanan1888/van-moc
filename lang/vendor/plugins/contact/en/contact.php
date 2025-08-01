<?php

return [
    'menu' => 'Contact',
    'edit' => 'View contact',
    'tables' => [
        'phone' => 'Phone',
        'email' => 'Email',
        'full_name' => 'Full Name',
        'time' => 'Time',
        'address' => 'Address',
        'subject' => 'Subject',
        'content' => 'Content',
        'file' => 'File'
    ],
    'contact_information' => 'Contact information',
    'download' => 'Download',
    'replies' => 'Replies',
    'email' => [
        'header' => 'Email',
        'title' => 'New contact from your site',
    ],
    'form' => [
        'name' => [
            'required' => 'Name is required',
        ],
        'email' => [
            'required' => 'Email is required',
            'email' => 'The email address is not valid',
        ],
        'phone' => [
            'required' => 'Phone is required',
        ],
        'content' => [
            'required' => 'Content is required',
        ],
        'file' => [
            'required' => 'File is not in the correct format :extensions or exceeds :capacityMb in size.',
            'label' => 'Support extensions :extensions and under :capacityMb'
        ]
    ],
    'contact_sent_from' => 'This contact information sent from',
    'sender' => 'Sender',
    'sender_email' => 'Email',
    'sender_address' => 'Address',
    'sender_phone' => 'Phone',
    'message_content' => 'Message content',
    'sent_from' => 'Email sent from',
    'form_name' => 'Name',
    'form_email' => 'Email',
    'form_address' => 'Address',
    'form_subject' => 'Subject',
    'form_phone' => 'Phone',
    'form_message' => 'Message',
    'required_field' => 'The field with (<span style="color: red">*</span>) is required.',
    'send_btn' => 'Send message',
    'new_msg_notice' => 'You have <span class="bold">:count</span> New Messages',
    'view_all' => 'View all',
    'statuses' => [
        'read' => 'Read',
        'unread' => 'Unread',
    ],
    'phone' => 'Phone',
    'address' => 'Address',
    'message' => 'Message',
    'settings' => [
        'email' => [
            'title' => 'Contact',
            'description' => 'Contact email configuration',
            'templates' => [
                'notice_title' => 'Send notice to administrator',
                'notice_description' => 'Email template to send notice to administrator when system get new contact',
            ],
        ],
        'title' => 'Contact',
        'description' => 'Settings for contact plugin',
        'blacklist_keywords' => 'Blacklist keywords',
        'blacklist_keywords_placeholder' => 'keywords...',
        'blacklist_keywords_helper' => 'Blacklist contact requests if it includes those keywords in the content field (separate by comma).',
        'blacklist_email_domains' => 'Blacklist email domains',
        'blacklist_email_domains_placeholder' => 'domain...',
        'blacklist_email_domains_helper' => 'Blacklist contact requests if the email domain is in blacklist domains (separate by comma).',
        'enable_math_captcha' => 'Enable math captcha?',
    ],
    'no_reply' => 'No reply yet!',
    'reply' => 'Reply',
    'send' => 'Send',
    'shortcode_name' => 'Contact form',
    'shortcode_description' => 'Add a contact form',
    'shortcode_content_description' => 'Add shortcode [contact-form][/contact-form] to editor?',
    'message_sent_success' => 'Message sent successfully!',
    'home_shortcode_name' => 'Home Contact form',
    'home_shortcode_description' => 'Add a home contact form',
    'number_of_capacity' => 'Number of capacity (Mb)',
    'number_of_extensions' => 'Number of extensions (jpge;jpg;png)',
    'background' => 'Background'
];
