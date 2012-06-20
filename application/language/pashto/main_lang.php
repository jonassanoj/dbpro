<?php

// TODO: Translate all the string values to Pashto. You can write your own short text for $lang['par_about'].   

/*
 * language/pashto/main_lang.php
 * 
 * ****************************************** 
 *  Goftogo Internationalization: Conventions
 * ******************************************
 * 
 * 1. Capitalization 
 * For sentences only the first letter is capitalized. If you need all words capitalized you can still ucfirst().
 * Or use strtolower() id you want all lowercase. Single words should be capitalized only if they are capitalized 
 * in common English (e.g. countries, languages, or proper names) or if they are form captions (begin with form_).
 * 
 * 2. Spaces and Punctuation
 * do not use leading or trailing spaces. Punctuation should only be used at the end of complete sentences.
 * Not for single words or titles. 
 * 
 * 3. Key-Names
 * The names of all keys are prefixed with their usage on the site:
 * language_: meta-information about the language. 
 * title_ : these are used in headings
 * w_ : single words that are often used.
 * form_ : these are used as labels or text in forms. Begin with a capital letter.
 * msg_: all kind of warnings, errors or notifications.
 * msgvar_: like _msg but contains variables to be replaces sprintf, see php.net/manual/en/function.sprintf.php
 * par_: these are paragraphs that contain a long text (e.g. text on the about page).
 *       They can include simple html tags. Tags should be consistent across languages 
 * 
 * 4. Language-Files
 * Language files should be loaded in the controller constructor (see controllers/main for an example). 
 * main_lang.php is always required as it contains translations for the title, etc.
 * Rarely needed or long pieces of text should be put in separate files and loaded when needed.
 * 
 */ 


// Meta-Information
$lang['language_name'] = "‏پښتو‎"; // name of the language as it should be displayed.
$lang['language_code'] = "ps"; // language code, e.g. fa for Farsi,  ps for Pashto, de for German
$lang['language_region'] = "AF"; // regional language subtype, AF for Afghanistan (so fa-AF is dari)
$lang['language_dir'] = "rtl"; // language direction can be ltr (left-to-right) or rtl (right-to-left)


// TODO: translate the values to pashto/dari. 
// Titles
$lang['title_main'] = "ګفتګو";  
$lang['title_alt'] =  "Goftogo"; // alternative name 
$lang['title_recent_questions'] = "تازه پوښتنی";
$lang['title_popular_questions'] = "ډیر کتل شوی پوښتنی";
$lang['title_your_questions'] = "ستاسی پوښتنی";
$lang['title_your_interest'] = "پوښتنی چی ستا به هم خوښی شی";
$lang['title_about'] = "د ګفتګو په اړه";

// Words
$lang['w_about'] = "په اړه";
$lang['w_home'] = "کورپاڼه";
$lang['w_back'] = "شاته";
$lang['w_lang_ps'] = "‏پښتو";
$lang['w_lang_fa'] = "‏درى‎";
$lang['w_lang_de'] = "آلمانی";
$lang['w_lang_en'] = "انگلیسی";


// Form
$lang['form_username'] = "نوم";
$lang['form_password'] = "رمز";
$lang['form_remember'] = "یاد می وساته";
$lang['form_login'] = "ننوتل";
$lang['form_register'] = "راجستر";

// Messages 
// Messages 
$lang['msg_login_failed'] = "Login failed!";
$lang['msgvar_username_taken'] = "Sorry, the username %s is already registered!";
$lang['msgvar_users_online'] = "At the moment, %u registered users and %u guests are online.";
$lang['msgvar_login_trial'] = "You tried %u times to login unsuccessully";
// Paragraphs 
$lang['par_about'] = "Goftogo (Dialogue) is a Computer Science related Q&A site, that wants to bring Afghan IT students, 
teachers and professionals closer together. Whether you are just starting to learn about IT at university, are an experienced 
programmer working daily with the most up-to-date technology or a professor with years of experience and a scientific background: 
Join now to ask questions and receive answers, to give answers and receive gratitude. Unlike other things, knowledge only gets 
bigger the more it is shared!";
