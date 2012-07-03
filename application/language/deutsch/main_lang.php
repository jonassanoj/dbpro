<?php

/*
 * language/deutsch/main_lang.php
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
$lang['language_name'] = "deutsch"; // name of the language as it should be displayed.
$lang['language_code'] = "de"; // language code, e.g. fa for Farsi,  ps for Pashto, de for German
$lang['language_region'] = "DE"; // regional language subtype, DE for Germany, so de-DE is German spoken in Germany.
$lang['language_dir'] = "ltr"; // language direction can be ltr (left-to-right) or rtl (right-to-left)

// Titles
$lang['title_main'] = "Goftogo";  
$lang['title_alt'] =  "Dialog"; // alternative name (translation of the word Goftogo into this language)
$lang['title_recent_questions'] = "Die neuesten Fragen";
$lang['title_popular_questions'] = "Die beliebtesten Fragen";
$lang['title_your_questions'] = "Deine Fragen";
$lang['title_your_interest'] = "Fragen, die dich interessieren könnten";
$lang['title_about'] = "Über Goftogo";
$lang['tittle_comment_create'] = "Sie können neue Kommentar!";
$lang['tittle_existing_comment'] = "Bearbeiten einer vorhandenen Kommentar!";
$lang['tittle_update_comment'] = "Sie haben den Kommentar aktualisiert!";
$lang['tittle_delete_comment'] = "Sie haben das kommentarlos gelöscht!";

// Words
$lang['w_about'] = "über";
$lang['w_home'] = "home";
$lang['w_back'] = "zurück";
$lang['w_lang_ps'] = "‏paschtu";
$lang['w_lang_fa'] = "persisch";
$lang['w_lang_de'] = "deutsch";
$lang['w_lang_en'] = "english";
$lang['update_comment'] = "aktualisieren";
$lang['add_comment'] = "hinzufügen";
$lang['cancel_comment'] = "absagen";

// Form
$lang['form_username'] = "Benutzername";
$lang['form_password'] = "Passwort";
$lang['form_remember'] = "Name merken";
$lang['form_login'] = "Login";
$lang['form_register'] = "Anmelden";

// Messages 
$lang['msg_login_failed'] = "Login fehlgeschlagen!";
$lang['msgvar_username_taken'] = "Der Benutzername %s ist bereits registriert!";
$lang['msgvar_users_online'] = "Momentan sind %u registrierte Nutzer und %u Gäste online.";
$lang['msgvar_login_trial'] = "Du hast %u mal erfolglos versucht, dich einzuloggen.";
$lang['msg_inserted_comment'] = "Ihr Kommentar wird erfolgreich eingesetzt!";
$lang['msg_sorry_comment'] = "Leider Ihr Kommentar wird nicht eingesetzt, später versuchen";
$lang['msg_notUpdated_comment'] = "Kommentar nicht aktualisiert werden, versuchen Sie es später!";
$lang['msg_delete_comment'] = "Kommentar gelöscht!";
$lang['msg_notFound_comment'] = "Kommentar nicht gefunden wird, die gelöscht werden!";
$lang['comment_textarea_label'] = "Schreiben Sie hier Ihren Kommentar !";
$lang['msg_update_comment'] = "Kommentar wurde erfolgreich aktualisiert !";
// Paragraphs 
$lang['par_about'] = "Goftogo (Dialog) ist eine Frage und Antwort Webseite zum Thema Informatik, die afghanische Informatikstudenten, 
-lehrer und -profis zusammenbringen will. Ob ein Student im ersten Semester, ein erfahrenerer Programmierer, der täglich die neuesten 
Technologien einsetzt, oder ein Professor mit langjähriger wissenschaftlicher Laufbahn: Tritt Goftogo jetzt bei! Hier kannst du Fragen 
beantwortet bekommen und für deine qualifizierten Antworten Dank ernten. <br> Im Gegensatz zu anderen Dingen wird Wissen immer
 mehr, je öfter man es teilt!";

