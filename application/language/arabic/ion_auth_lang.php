<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth Lang - Arabic
*
* Author: Emad Elsaid
* 		  blazeeboy@gmail.com
*
* Location: https://github.com/benedmunds/CodeIgniter-Ion-Auth
*
* Created:  30.08.2010
*
* Description:  Arabic language file for Ion Auth messages and errors
*
*/

// Account Creation
$lang['account_creation_successful']            = 'تم انشاء حسابك بنجاح';
$lang['account_creation_unsuccessful']          = 'حدث خطأ اثناء انشاء حسابك لدينا';
$lang['account_creation_duplicate_email'] 	    = 'هذا البريد الإلكترونى تم استخدامه من قبل او غير صحيح';
$lang['account_creation_duplicate_identity']    = 'اسم المستخدم تم التسجيل به من قبل او غير صحيح';
$lang['account_creation_missing_default_group'] = 'لم يتم اختيار مجموعة';
$lang['account_creation_invalid_default_group'] = 'خطأ فى تحديد المجموعة';


// Password
$lang['password_change_successful']   = 'تم تغيير كلمة السر';
$lang['password_change_unsuccessful'] = 'لا يمكن تغيير كلمة السر';
$lang['forgot_password_successful']   = 'تم ارسال بريد لإستعادة كلمة السر';
$lang['forgot_password_unsuccessful'] = 'لا يمكن استعادة كلمة السر';

// Activation
$lang['activate_successful']            = 'تم تفعيل حسابك';
$lang['activate_unsuccessful']          = 'لا يمكن تفعيل حسابك';
$lang['deactivate_successful']          = 'تم إيقاف حسابك';
$lang['deactivate_unsuccessful']        = 'لا يمكن إيقاف حسابك';
$lang['activation_email_successful']    = 'تم إرسال بريد التفعيل';
$lang['activation_email_unsuccessful']  = 'لا يمكن ارسال بريد التفعيل';
$lang['deactivate_current_user_unsuccessful']= 'لا يمكنك ايقاف حسابك بنفسك';

// Login / Logout
$lang['login_successful']             = 'تم تسجيل الدخول بنجاح';
$lang['login_unsuccessful']           = 'معلومات الدخول غير صحيحة';
$lang['login_unsuccessful_not_active']= 'الحساب غير مفعل';
$lang['login_timeout']                = 'الحساب معلق حاليا برجاء المحاولة مرة أخرى.';
$lang['logout_successful']            = 'تم تسجيل خروجك';

// Account Changes
$lang['update_successful'] 		 	 = 'تم تعديل معلومات حسابك';
$lang['update_unsuccessful'] 		 	 = 'لا يمكن تعديل معلومات الحساب';
$lang['delete_successful'] 		 	 = 'تم إلغاء المستخدم';
$lang['delete_unsuccessful'] 		 	 = 'لا يمكن إلغاء المستخدم';

// Groups
$lang['group_creation_successful']  = 'تم انشاء مجموعة بنجاح';
$lang['group_already_exists']       = 'اسم المجموعة مستخدم من قبل';
$lang['group_update_successful']    = 'تم تحديث بيانات المجموعة';
$lang['group_delete_successful']    = 'تم الغاء المجموعة';
$lang['group_delete_unsuccessful'] 	= 'لا يمكن الغاء المجموعة';
$lang['group_delete_notallowed']    = 'لا يمكن الغاء مجموعة رئيسية';
$lang['group_name_required'] 		= 'مطلوب اسم المجموعة';
$lang['group_name_admin_not_alter'] = 'لا يمكن تغيير اسم المجموعة الرئيسية';

// Activation Email
$lang['email_activation_subject']            = 'تفعيل حساب';
$lang['email_activate_heading']    = 'تفعيل حساب لدينا %s';
$lang['email_activate_subheading'] = 'من فضلك اضغط على الرابط %s';
$lang['email_activate_link']       = 'تفعيل حسابك';
// Forgot Password Email
$lang['email_forgotten_password_subject']    = 'تأكيد فقدان كلمة السر';
$lang['email_forgot_password_heading']    = 'اعادة تعيين كلمة السر %s';
$lang['email_forgot_password_subheading'] = 'من فضلك اضغط على الرتبط التالى %s';
$lang['email_forgot_password_link']       = ' اعادة تعيين كلمة السر';
