<?php

// TODO: Translate all the string values to Dari/Farsi. You can write your own short text for $lang['par_about'].   

/*
 * language/farsi/main_lang.php
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
$lang['language_name'] = "‏درى‎"; // name of the language as it should be displayed.
$lang['language_code'] = "fa"; // language code, e.g. fa for Farsi,  ps for Pashto, de for German
$lang['language_region'] = "AF"; // regional language subtype, AF for Afghanistan (so fa-AF is dari)
$lang['language_dir'] = "rtl"; // language direction can be ltr (left-to-right) or rtl (right-to-left)


// TODO: translate the values to farsi/dari. 
// Titles
$lang['title_main'] = "گفتگو";  
$lang['title_alt'] =  "Goftogo"; // alternative name 
$lang['title_recent_questions'] = "آخرین سوالات ";
$lang['title_popular_questions'] = "پربیننده ترین سوالات";
$lang['title_your_questions'] = "سوالات شما ";
$lang['title_your_interest'] = "سوالات که ممکن مورد علاقه شما باشد";
$lang['title_about'] = "در باره گفتگو";
$lang['tittle_comment_create'] = "شمامیتوانیدنظریهٔ جدیدایجادکنید";
$lang['tittle_existing_comment'] = "نظریهٔ موجوده را تغیربدهید";
$lang['tittle_update_comment'] = "نظریهٔ شما تصحیح گردید";
$lang['tittle_delete_comment'] = "نظریهٔ شماحذف گردید";

// Words
$lang['w_about'] = "درباره";
$lang['w_home'] = "صفحه اصلی";
$lang['w_back'] = "برگشت";
$lang['w_lang_ps'] = "‏پشتو";
$lang['w_lang_fa'] = "‏درى‎";
$lang['w_lang_de'] = "آلمانی";
$lang['w_lang_en'] = "انگلیسی";
$lang['update_comment'] = "تصحیح";
$lang['add_comment'] = "افزودب";
$lang['cancel_comment'] = "لغو";

//new 
$lang['admin_user'] = "صفحه ای ادمین";
// Form
$lang['form_username'] = "نام ";
$lang['form_password'] = "رمزعبور";
$lang['form_remember'] = " مرا به یاد بسپار ";
$lang['form_login'] = "ورود";
$lang['form_register'] = "ثبت";

// Messages 
$lang['msg_login_failed'] = "ورود ناموفق است";
$lang['msgvar_username_taken'] = "متاسفانه نام %s قبلا ثبت شده است ";
$lang['msgvar_users_online'] = "اکنون %u کاربر عضو و %uکاربر مهامن انلاین هستند.";
$lang['msgvar_login_trial'] = "شما %u مرتبه ورود ناموفق داشته اید.";
$lang['msg_inserted_comment'] = "نظریهٔ شمابامؤفقیت درج گردید";
$lang['msg_sorry_comment'] =  "متأسفانه,نظریهٔ شمادرج نگردید,بعداًامتحان کنید";
$lang['msg_notUpdated_comment'] = "نظریهٔ شماتصحیح نگردید, لطفاً,بعداًامتحان کنید";
$lang['msg_delete_comment'] = "نظریهٔ شماحذف گردید";
$lang['msg_notFound_comment'] = "نظریهٔ یافت نگردیدتاحذف گردد";
$lang['comment_textarea_label'] = "نظریهٔ خودرااینجابنویسید";
$lang['msg_update_comment'] = "نظریهٔ شمابامؤفقیت تصحیح گردید";
// Paragraphs . 
$lang['par_about'] = "
گفتگو صفحه انترنتی  سوال و جواب درباره موضوعات کمپیوتر ساینس است که هدف آن تامین روابط نزدیک میان شاگردان استادان و افراد مسلکی رشته تکنالوژی معلوماتی میباشد. 
اگر شما جدیدا تکنالوژی معلوماتی می آموزید یا هم برنامه نویس هستید که روزانه با تکنالوژی روز سر و کار دارید و یاهم پروفیسور با سابقه 
علوم ساینسی و تکنالوژی هستید : همین اکنون با ما بپیوندید وبا طرح نمودن سوالات و یا ارایه پاسخ به سوالات دیگران  آنهارا یاری نموده  
بر غنامندی علم خویش بیافزایید.علم با شریک ساختن و اموزاندن دیگران بیشتر میشود.";
