<?php 
echo formee_open('user/delete/deactivate');
echo formee_div(8);
echo lang('title_deactivate_user','deactivate');
echo formee_div();echo formee_div(4);
echo form_submit('deactivate',lang('form_deactivate'));
echo formee_div();
echo form_close();

echo formee_open('user/delete/anonymize');
echo formee_div(8);
echo lang('title_anonymize_user','anonymize');
echo formee_div();echo formee_div(4);
echo form_submit('anonymize',lang('form_anonymize'));
echo formee_div();
echo form_close();

echo form_open('user/delete/cascade');
echo lang('title_deactivate_user','cascade');
echo form_submit('cascade',lang('form_delete'));
echo form_close();
