<?php

require_once __DIR__ . '/dbconnection.php';

mysqli_report(MYSQLI_REPORT_OFF);

$setupToken = 'smc_seed_20260523_9f61ab4e27';
$providedToken = $_GET['token'] ?? '';

if (!hash_equals($setupToken, $providedToken)) {
    http_response_code(403);
    header('Content-Type: text/plain; charset=utf-8');
    echo "Forbidden.\n";
    exit;
}

function table_exists(mysqli $connection, string $table): bool
{
    $escapedTable = mysqli_real_escape_string($connection, $table);
    $sql = "SHOW TABLES LIKE '{$escapedTable}'";
    $result = mysqli_query($connection, $sql);

    return $result instanceof mysqli_result && mysqli_num_rows($result) > 0;
}

function table_count(mysqli $connection, string $table): int
{
    $sql = "SELECT COUNT(*) AS total FROM `{$table}`";
    $result = mysqli_query($connection, $sql);

    if (!($result instanceof mysqli_result)) {
        return 0;
    }

    $row = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return (int) ($row['total'] ?? 0);
}

function column_exists(mysqli $connection, string $table, string $column): bool
{
    $tableEscaped = mysqli_real_escape_string($connection, $table);
    $columnEscaped = mysqli_real_escape_string($connection, $column);
    $sql = "SELECT COUNT(*) AS total
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_SCHEMA = DATABASE()
              AND TABLE_NAME = '{$tableEscaped}'
              AND COLUMN_NAME = '{$columnEscaped}'";
    $result = mysqli_query($connection, $sql);

    if (!($result instanceof mysqli_result)) {
        return false;
    }

    $row = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return (int) ($row['total'] ?? 0) > 0;
}

function ensure_social_media_rankings_column(mysqli $connection): void
{
    if (!column_exists($connection, 'social_media_rankings', 'TechnologyDetails')) {
        mysqli_query($connection, 'ALTER TABLE social_media_rankings ADD COLUMN TechnologyDetails TEXT NULL');
    }
}

function quote_value(mysqli $connection, $value): string
{
    if ($value === null) {
        return 'NULL';
    }

    return "'" . mysqli_real_escape_string($connection, (string) $value) . "'";
}

function insert_rows_if_empty(mysqli $connection, string $table, array $rows, array &$messages): void
{
    if (!table_exists($connection, $table)) {
        $messages[] = "Skipped {$table}: table does not exist.";
        return;
    }

    if (table_count($connection, $table) > 0) {
        $messages[] = "Skipped {$table}: table already has data.";
        return;
    }

    if ($rows === []) {
        $messages[] = "Skipped {$table}: no seed rows configured.";
        return;
    }

    $columns = array_keys($rows[0]);
    $columnSql = implode(', ', array_map(static fn ($column) => "`{$column}`", $columns));
    $valueRows = [];

    foreach ($rows as $row) {
        $valueRows[] = '(' . implode(', ', array_map(
            static fn ($column) => quote_value($connection, $row[$column] ?? null),
            $columns
        )) . ')';
    }

    $sql = "INSERT INTO `{$table}` ({$columnSql}) VALUES " . implode(",\n", $valueRows);

    if (!mysqli_query($connection, $sql)) {
        $messages[] = "Failed {$table}: " . mysqli_error($connection);
        return;
    }

    $messages[] = "Seeded {$table}: " . count($rows) . " row(s).";
}

ensure_social_media_rankings_column($connection);

$messages = [];

$users = [
    [
        'Firstname' => 'Admin',
        'Surname' => 'User',
        'Gender' => 'NotSay',
        'PhoneNumber' => '',
        'DOB' => null,
        'Email' => 'admin@example.com',
        'Address' => '',
        'Username' => 'admin',
        'Password' => password_hash('12345', PASSWORD_DEFAULT),
        'Country' => 'Myanmar',
        'Profile' => 'photos/profile_photos/alexslott_images.jfif',
        'SignupDate' => '2026-05-23 00:00:00',
        'Role' => 'Admin',
        'Remark' => 'Seeded admin account',
    ],
    [
        'Firstname' => 'Demo',
        'Surname' => 'Member',
        'Gender' => 'Female',
        'PhoneNumber' => '09123456789',
        'DOB' => '2008-01-15',
        'Email' => 'demo@example.com',
        'Address' => 'Yangon',
        'Username' => 'demo_user',
        'Password' => password_hash('demo12345', PASSWORD_DEFAULT),
        'Country' => 'Myanmar',
        'Profile' => 'photos/profile_photos/susu_istockphoto-1386479313-612x612.jpg',
        'SignupDate' => '2026-05-23 00:00:00',
        'Role' => 'user',
        'Remark' => 'Seeded demo user account',
    ],
];

$contacts = [
    [
        'Firstname' => 'Aye',
        'Surname' => 'Chan',
        'Email' => 'aye.chan@example.com',
        'Message' => 'Thank you for sharing practical safety tips for families.',
        'Remark' => 'Seeded contact message',
    ],
    [
        'Firstname' => 'Ko',
        'Surname' => 'Min',
        'Email' => 'ko.min@example.com',
        'Message' => 'Please continue posting new guidance for social media awareness.',
        'Remark' => 'Seeded contact message',
    ],
];

$participations = [
    [
        'name' => 'Mya Mya',
        'email' => 'mya@example.com',
        'interest' => 'Digital Detox',
        'message' => 'Interested in joining awareness campaigns for students and parents.',
        'Remark' => 'Seeded participation record',
    ],
    [
        'name' => 'Thura',
        'email' => 'thura@example.com',
        'interest' => 'Cyberbullying Awareness',
        'message' => 'Would like to volunteer in a youth safety campaign.',
        'Remark' => 'Seeded participation record',
    ],
];

$socialMediaInterest = [
    [
        'name' => 'Nandar',
        'email' => 'nandar@example.com',
        'interest' => 'Online Safety Workshop',
        'message' => 'Interested in social media education materials for teenagers.',
        'Remark' => 'Seeded social media outreach record',
    ],
];

$safetyTips = [
    [
        'AppName' => 'TikTok',
        'Description' => 'TikTok is a video-sharing app where users create and share short clips set to music, participate in viral challenges, and express creativity.',
        'Safety_tips' => 'Set your account to private, monitor followers, and avoid sharing personal information.',
        'Features' => 'Family Pairing, privacy controls, comment filters, and screen time management.',
        'Logo' => 'tiktok.png',
        'Remark' => 'Seeded safety tip',
    ],
    [
        'AppName' => 'Instagram',
        'Description' => 'Instagram allows users to share photos, videos, and stories and remains one of the most visual social platforms.',
        'Safety_tips' => 'Use a private profile, review follower requests, and share stories only with trusted groups.',
        'Features' => 'Stories, Reels, Close Friends, privacy controls, and account restrictions.',
        'Logo' => 'instagram-icon.jpg',
        'Remark' => 'Seeded safety tip',
    ],
    [
        'AppName' => 'Facebook',
        'Description' => 'Facebook connects friends and communities through posts, photos, videos, groups, and events.',
        'Safety_tips' => 'Review privacy settings, limit public information, and be careful with unknown friend requests.',
        'Features' => 'Groups, Marketplace, Events, page controls, and block/report tools.',
        'Logo' => 'facebook-icon.jpg',
        'Remark' => 'Seeded safety tip',
    ],
    [
        'AppName' => 'Twitter',
        'Description' => 'Twitter is a microblogging platform focused on short posts, trends, and public conversations.',
        'Safety_tips' => 'Think before posting publicly and use settings that control who can contact or mention you.',
        'Features' => 'Hashtags, lists, direct messaging, muting, and content filters.',
        'Logo' => 'twitter-icon.jpg',
        'Remark' => 'Seeded safety tip',
    ],
    [
        'AppName' => 'YouTube',
        'Description' => 'YouTube is a major video-sharing platform where users watch, upload, and comment on content.',
        'Safety_tips' => 'Use Restricted Mode, supervise younger users, and avoid oversharing in comments or uploads.',
        'Features' => 'Channels, playlists, parental controls, reporting, and watch history settings.',
        'Logo' => 'youtube-icon.jpg',
        'Remark' => 'Seeded safety tip',
    ],
    [
        'AppName' => 'Snapchat',
        'Description' => 'Snapchat is known for disappearing messages, stories, and camera filters.',
        'Safety_tips' => 'Limit who can message you, review story privacy, and avoid sharing sensitive snaps.',
        'Features' => 'Stories, Snap Map, privacy controls, and friend management tools.',
        'Logo' => 'snapchat.png',
        'Remark' => 'Seeded safety tip',
    ],
    [
        'AppName' => 'Reddit',
        'Description' => 'Reddit is a community-driven discussion platform built around topic-based subreddits.',
        'Safety_tips' => 'Avoid posting personal details, follow subreddit rules, and report harmful behavior.',
        'Features' => 'Subreddits, moderation tools, voting, and content reporting.',
        'Logo' => 'reddit.png',
        'Remark' => 'Seeded safety tip',
    ],
    [
        'AppName' => 'LinkedIn',
        'Description' => 'LinkedIn is a professional networking platform used for careers, business updates, and job opportunities.',
        'Safety_tips' => 'Share only professional information and adjust profile visibility to your comfort level.',
        'Features' => 'Networking, messaging, job search, visibility controls, and profile privacy settings.',
        'Logo' => 'linkedin.png',
        'Remark' => 'Seeded safety tip',
    ],
    [
        'AppName' => 'Tumblr',
        'Description' => 'Tumblr supports short-form blogging with multimedia posts and community interaction.',
        'Safety_tips' => 'Use privacy settings, manage interactions carefully, and moderate who can contact you.',
        'Features' => 'Blogs, queued posts, privacy options, and moderation controls.',
        'Logo' => 'tumblr.png',
        'Remark' => 'Seeded safety tip',
    ],
    [
        'AppName' => 'WhatsApp',
        'Description' => 'WhatsApp supports encrypted text, voice, and video communication across mobile devices.',
        'Safety_tips' => 'Enable two-step verification and control who sees your last seen, status, and profile photo.',
        'Features' => 'End-to-end encryption, group chats, calls, and privacy settings.',
        'Logo' => 'whatsapp.png',
        'Remark' => 'Seeded safety tip',
    ],
    [
        'AppName' => 'Viber',
        'Description' => 'Viber provides messaging plus voice and video calling features with privacy controls.',
        'Safety_tips' => 'Be careful with unknown contacts and review who can reach you through the app.',
        'Features' => 'Encrypted communication, stickers, calls, and contact controls.',
        'Logo' => 'viber.png',
        'Remark' => 'Seeded safety tip',
    ],
    [
        'AppName' => 'Discord',
        'Description' => 'Discord offers voice, video, and text chat in organized servers and channels.',
        'Safety_tips' => 'Join trusted servers, limit direct messages, and use block/report tools when needed.',
        'Features' => 'Servers, channels, moderation tools, direct messages, and role permissions.',
        'Logo' => 'discord.png',
        'Remark' => 'Seeded safety tip',
    ],
    [
        'AppName' => 'WeChat',
        'Description' => 'WeChat combines messaging, social posting, and payments in one multi-purpose platform.',
        'Safety_tips' => 'Review your contact and post visibility settings, and be cautious when connecting with unknown users.',
        'Features' => 'Messaging, Moments, payments, group chats, and privacy settings.',
        'Logo' => 'wechat.png',
        'Remark' => 'Seeded safety tip',
    ],
];

$parentTips = [
    [
        'Title' => 'Open Communication Is Key',
        'Description' => 'Regular conversations help teens feel comfortable sharing their online experiences and challenges.',
        'Tips' => 'Talk often about apps, trends, online friends, and anything that makes your teen uncomfortable.',
        'Image' => 'image2.jfif',
        'Remark' => 'Seeded parents tip',
    ],
    [
        'Title' => 'Set Boundaries And Screen Time Limits',
        'Description' => 'Healthy limits help teens balance social media with sleep, school, and offline activities.',
        'Tips' => 'Create no-phone times, encourage hobbies, and agree on realistic daily screen rules together.',
        'Image' => 'image3.png',
        'Remark' => 'Seeded parents tip',
    ],
    [
        'Title' => 'Teach Privacy And Safety Skills',
        'Description' => 'Teens need practical guidance on privacy settings, passwords, and safe digital habits.',
        'Tips' => 'Review privacy options, discuss personal information risks, and encourage strong unique passwords.',
        'Image' => 'image3.jfif',
        'Remark' => 'Seeded parents tip',
    ],
    [
        'Title' => 'Be Aware Of Cyberbullying',
        'Description' => 'Recognizing harmful online behavior early can protect a teen’s mental health and confidence.',
        'Tips' => 'Look for emotional changes, teach reporting steps, and reassure your teen they can ask for help.',
        'Image' => 'image4.jfif',
        'Remark' => 'Seeded parents tip',
    ],
    [
        'Title' => 'Model Positive Online Behavior',
        'Description' => 'Parents set the tone when they show respectful, balanced, and thoughtful device habits.',
        'Tips' => 'Put devices away during family time and demonstrate kind, responsible digital communication.',
        'Image' => 'image5.png',
        'Remark' => 'Seeded parents tip',
    ],
    [
        'Title' => 'Discuss Digital Footprints',
        'Description' => 'What teens post online can affect how others view them later in life.',
        'Tips' => 'Encourage thinking before posting and explain that deleted content can still spread or be saved.',
        'Image' => 'image6.png',
        'Remark' => 'Seeded parents tip',
    ],
];

$legislation = [
    [
        'Title' => 'Children’s Online Privacy Protection Act (COPPA)',
        'Description' => 'COPPA protects children under 13 by requiring parental consent before collecting personal information online.',
        'Guidance' => 'Review privacy policies carefully and make sure platforms used by young teens are age-appropriate and compliant.',
        'Image' => 'image1.jfif',
        'Remark' => 'Seeded legislation guidance',
    ],
    [
        'Title' => 'General Data Protection Regulation (GDPR)',
        'Description' => 'GDPR provides strong rights around access, correction, and deletion of personal data within the European Union.',
        'Guidance' => 'Teach teens that they have rights around data access and that consent and transparency matter online.',
        'Image' => 'image5.png',
        'Remark' => 'Seeded legislation guidance',
    ],
    [
        'Title' => 'Online Harms White Paper (UK)',
        'Description' => 'This UK policy effort focuses on reducing harmful online content such as harassment, abuse, and misinformation.',
        'Guidance' => 'Familiarize families with reporting tools and community protections available on major platforms.',
        'Image' => 'image7.png',
        'Remark' => 'Seeded legislation guidance',
    ],
    [
        'Title' => 'Community Standards Of Social Platforms',
        'Description' => 'Most social media platforms define rules for harassment, hate speech, spam, and inappropriate content.',
        'Guidance' => 'Review community rules together so teens understand expectations and know how to report violations.',
        'Image' => 'image8.png',
        'Remark' => 'Seeded legislation guidance',
    ],
    [
        'Title' => 'Parental Controls And Privacy Settings',
        'Description' => 'Built-in privacy tools can reduce unwanted contact, limit visibility, and support healthier social media use.',
        'Guidance' => 'Check platform settings regularly and use content controls or supervision tools where appropriate.',
        'Image' => 'image9.png',
        'Remark' => 'Seeded legislation guidance',
    ],
];

$rankings = [
    [
        'Rank' => 1,
        'AppName' => 'Instagram',
        'Description' => 'A popular photo and video sharing app with filters, stories, and creator tools for personal and business use.',
        'Features' => 'Photo filters, Stories, Direct messaging, Shopping',
        'Ratings' => '4.5/5',
        'Image' => 'instagram-icon.jpg',
        'DateAdded' => '2024-09-07 00:00:00',
        'ReportLink' => 'https://play.google.com/store/apps/details?id=com.instagram.android&hl=en',
        'TechnologyDetails' => 'Uses AI-driven image recognition, personalized feed ranking, and AR filters for interactive content.',
    ],
    [
        'Rank' => 2,
        'AppName' => 'Twitter',
        'Description' => 'A real-time microblogging platform built around short posts, trends, and public conversations.',
        'Features' => 'Real-time updates, Hashtags, Direct messaging, Lists',
        'Ratings' => '4.2/5',
        'Image' => 'twitter-icon.jpg',
        'DateAdded' => '2024-09-07 00:00:00',
        'ReportLink' => 'https://twitter.fileplanet.com/apk/download',
        'TechnologyDetails' => 'Combines real-time data processing, trend detection, and machine learning for recommendations.',
    ],
    [
        'Rank' => 3,
        'AppName' => 'Facebook',
        'Description' => 'A broad social network for connection, sharing, events, communities, and business engagement.',
        'Features' => 'Friend connections, Groups, Marketplace, Events',
        'Ratings' => '4.0/5',
        'Image' => 'facebook-icon.jpg',
        'DateAdded' => '2024-09-07 00:00:00',
        'ReportLink' => 'https://play.google.com/store/apps/details?id=com.facebook.katana&hl=en',
        'TechnologyDetails' => 'Leverages advanced analytics, ad targeting systems, AI moderation, and efficient video delivery.',
    ],
    [
        'Rank' => 4,
        'AppName' => 'LinkedIn',
        'Description' => 'A professional networking platform for careers, business updates, and job discovery.',
        'Features' => 'Professional networking, Job searching, Skills endorsements, Messaging',
        'Ratings' => '4.3/5',
        'Image' => 'linkedin.png',
        'DateAdded' => '2024-09-07 00:00:00',
        'ReportLink' => 'https://members.linkedin.com/en-gb/download-the-linkedin-app',
        'TechnologyDetails' => 'Uses big data matching, AI-powered career insights, and recommendation systems for networking relevance.',
    ],
    [
        'Rank' => 5,
        'AppName' => 'Snapchat',
        'Description' => 'A multimedia messaging app focused on disappearing messages, stories, and filters.',
        'Features' => 'Disappearing messages, Filters, Stories, Snap Map',
        'Ratings' => '4.1/5',
        'Image' => 'snapchat.png',
        'DateAdded' => '2024-09-07 00:00:00',
        'ReportLink' => 'https://www.snapchat.com/download',
        'TechnologyDetails' => 'Known for real-time AR filters, camera effects, and strong mobile-first multimedia messaging.',
    ],
    [
        'Rank' => 6,
        'AppName' => 'TikTok',
        'Description' => 'A short-form video platform built around trends, music, and highly personalized discovery feeds.',
        'Features' => 'Short videos, Music integration, Trends, Challenges',
        'Ratings' => '4.6/5',
        'Image' => 'tiktok.png',
        'DateAdded' => '2024-09-07 00:00:00',
        'ReportLink' => 'https://play.google.com/store/apps/details?id=com.ss.android.ugc.trill&hl=en',
        'TechnologyDetails' => 'Relies heavily on machine learning, video editing tools, and fast recommendation feedback loops.',
    ],
    [
        'Rank' => 7,
        'AppName' => 'Reddit',
        'Description' => 'A discussion platform with topic communities where users share links, questions, and opinions.',
        'Features' => 'Discussion forums, Upvotes/Downvotes, AMAs, Communities',
        'Ratings' => '4.4/5',
        'Image' => 'reddit.png',
        'DateAdded' => '2024-09-07 00:00:00',
        'ReportLink' => 'https://play.google.com/store/apps/details?id=com.reddit.frontpage&hl=en',
        'TechnologyDetails' => 'Uses community moderation systems, ranking algorithms, and anti-spam tooling to surface relevant discussions.',
    ],
    [
        'Rank' => 8,
        'AppName' => 'YouTube',
        'Description' => 'A large video platform for uploads, subscriptions, live streaming, and creator communities.',
        'Features' => 'Video sharing, Channels, Subscriptions, Live streaming',
        'Ratings' => '4.7/5',
        'Image' => 'youtube-icon.jpg',
        'DateAdded' => '2024-09-07 00:00:00',
        'ReportLink' => 'https://play.google.com/store/apps/details?id=com.google.android.youtube&hl=en',
        'TechnologyDetails' => 'Uses recommendation models, scalable video compression, and creator analytics for distribution.',
    ],
    [
        'Rank' => 9,
        'AppName' => 'WhatsApp',
        'Description' => 'An encrypted messaging app supporting text, voice, and video communication worldwide.',
        'Features' => 'Text messaging, Voice calls, Video calls, Encryption',
        'Ratings' => '4.3/5',
        'Image' => 'whatsapp.png',
        'DateAdded' => '2024-09-07 00:00:00',
        'ReportLink' => 'https://play.google.com/store/apps/details?id=com.whatsapp&hl=en',
        'TechnologyDetails' => 'Built around end-to-end encryption, real-time message delivery, and efficient mobile networking.',
    ],
    [
        'Rank' => 10,
        'AppName' => 'Discord',
        'Description' => 'A communication platform designed around servers, voice chat, community management, and group interaction.',
        'Features' => 'Voice chat, Video chat, Text channels, Server management',
        'Ratings' => '4.5/5',
        'Image' => 'discord.png',
        'DateAdded' => '2024-09-07 00:00:00',
        'ReportLink' => 'https://discord.com/download',
        'TechnologyDetails' => 'Focuses on low-latency voice/video streaming and rich server moderation capabilities.',
    ],
    [
        'Rank' => 11,
        'AppName' => 'Tumblr',
        'Description' => 'A microblogging platform that blends blogging, social interaction, and multimedia posting.',
        'Features' => 'Multimedia posts, Blog customization, Follow/Reblog',
        'Ratings' => '3.8/5',
        'Image' => 'tumblr.png',
        'DateAdded' => '2024-09-07 00:00:00',
        'ReportLink' => 'https://play.google.com/store/apps/details?id=com.tumblr&hl=en',
        'TechnologyDetails' => 'Supports flexible multimedia posts, customizable blog themes, and content management tooling.',
    ],
    [
        'Rank' => 12,
        'AppName' => 'WeChat',
        'Description' => 'A multi-purpose app combining messaging, social posts, and digital payments in one ecosystem.',
        'Features' => 'Messaging, Social media, Mobile payments, Group chats',
        'Ratings' => '4.4/5',
        'Image' => 'wechat.png',
        'DateAdded' => '2024-09-07 00:00:00',
        'ReportLink' => 'https://www.wechat.com/',
        'TechnologyDetails' => 'Integrates messaging, payment systems, and APIs for a broad all-in-one mobile experience.',
    ],
    [
        'Rank' => 13,
        'AppName' => 'Viber',
        'Description' => 'A messaging app known for voice and video calling along with direct chat features.',
        'Features' => 'Voice calls, Video calls, Text messaging, Stickers',
        'Ratings' => '4.1/5',
        'Image' => 'viber.png',
        'DateAdded' => '2024-09-07 00:00:00',
        'ReportLink' => 'https://www.viber.com/en/download/',
        'TechnologyDetails' => 'Provides high-definition calling, secure messaging, and rich communication add-ons like stickers.',
    ],
];

$livestreaming = [
    [
        'Title' => 'What Is Livestreaming?',
        'Description' => 'Livestreaming is broadcasting content live over the internet so viewers can watch and respond in real time.',
        'List' => 'Real-time interaction helps creators, educators, and communities connect instantly with viewers.',
        'Image' => 'live1.png',
        'Remark' => 'Seeded livestreaming content',
    ],
    [
        'Title' => 'Benefits Of Livestreaming',
        'Description' => 'Live video helps creators build community, showcase skills, and interact directly with an audience.',
        'List' => 'Popular benefits include engagement, monetization, visibility, and flexible content creation.',
        'Image' => 'live2.png',
        'Remark' => 'Seeded livestreaming content',
    ],
    [
        'Title' => 'Popular Livestreaming Platforms',
        'Description' => 'Different livestreaming platforms are suited to gaming, education, lifestyle content, and professional events.',
        'List' => 'Twitch, YouTube Live, Instagram Live, Facebook Live, and Discord are all common starting points.',
        'Image' => 'live3.png',
        'Remark' => 'Seeded livestreaming content',
    ],
    [
        'Title' => 'Types Of Livestream Content',
        'Description' => 'Livestreaming can support gaming, workshops, concerts, cooking shows, Q&A sessions, and everyday vlogs.',
        'List' => 'Choose a format that fits your audience and gives you control over what you share live.',
        'Image' => 'live4.png',
        'Remark' => 'Seeded livestreaming content',
    ],
    [
        'Title' => 'How To Livestream Safely',
        'Description' => 'Safety starts with limiting who can watch, protecting personal information, and moderating comments.',
        'List' => 'Use privacy settings, report abuse, avoid showing sensitive surroundings, and teach young streamers good habits.',
        'Image' => 'live5.png',
        'Remark' => 'Seeded livestreaming content',
    ],
    [
        'Title' => 'Platform Safety Features',
        'Description' => 'Major platforms usually include built-in tools that help reduce harassment and control access.',
        'List' => 'Useful tools include content filters, parental controls, reporting, blocking, and two-factor authentication.',
        'Image' => 'live6.png',
        'Remark' => 'Seeded livestreaming content',
    ],
    [
        'Title' => 'Interactive Engagement Tips',
        'Description' => 'Engagement features can make streams more fun while still keeping the environment controlled.',
        'List' => 'Polls, subscriber-only streams, alerts, and reward systems can improve participation safely.',
        'Image' => 'live7.png',
        'Remark' => 'Seeded livestreaming content',
    ],
    [
        'Title' => 'Real-World Livestream Examples',
        'Description' => 'Livestreaming is widely used in education, entertainment, charity events, and product launches.',
        'List' => 'Examples include virtual concerts, live classrooms, charity gaming marathons, and launch events.',
        'Image' => 'live8.png',
        'Remark' => 'Seeded livestreaming content',
    ],
    [
        'Title' => 'Tips For Parents And Guardians',
        'Description' => 'Parents can support young streamers by staying involved and setting clear boundaries.',
        'List' => 'Monitor activity, use privacy settings, agree on safe sharing rules, and keep conversations open.',
        'Image' => 'live9.png',
        'Remark' => 'Seeded livestreaming content',
    ],
];

insert_rows_if_empty($connection, 'usertb', $users, $messages);
insert_rows_if_empty($connection, 'contact', $contacts, $messages);
insert_rows_if_empty($connection, 'participate', $participations, $messages);
insert_rows_if_empty($connection, 'socialmeida', $socialMediaInterest, $messages);
insert_rows_if_empty($connection, 'safetytip', $safetyTips, $messages);
insert_rows_if_empty($connection, 'parentstip', $parentTips, $messages);
insert_rows_if_empty($connection, 'legislation', $legislation, $messages);
insert_rows_if_empty($connection, 'social_media_rankings', $rankings, $messages);
insert_rows_if_empty($connection, 'livestreaming', $livestreaming, $messages);

header('Content-Type: text/plain; charset=utf-8');
echo "Seed process completed.\n\n";
foreach ($messages as $message) {
    echo "- {$message}\n";
}
echo "\nTemporary accounts created by this seeder:\n";
echo "- admin / 12345\n";
echo "- demo_user / demo12345\n";
echo "\nRemove setup_seed_data.php, setup_admin.php, and setup_database.php after setup is complete.\n";
