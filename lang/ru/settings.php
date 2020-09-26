<?php

/**
 * @author Intervision https://github.com/intervisionlord
 * v.0.5
 */
$lang['seconds']     = 'Время до редиректа (сек)';
$lang['minSeconds']  = 'Минимально разрешенное время ожидания перед редиректом (сек)';
$lang['auto_login'] = 'При входе автоматически перенаправлять на преднастроенную страницу, указанную в <code>auto_options</code> и/или настройках<code>group options</code>.';
$lang['auto_options'] = 'Цель редиректа при входе. В любом случае <b>user</b> используется для перенаправления в пространство имен \'user\' ' .
         '.  Если имя пользователя "foo", то ":user_page" будет ":foo"; '  .
		 ' "user_ns:user_page" в таком случае будет ":foo:foo"; ":user_ns:start_page" будет ":foo:start". <b>common_ns</b> ' .
		 'определяется в  настройках <code>common_ns</code>.';
$lang['common_ns'] = 'An arbitrarily defined namespace of any depth where all auto login pages will reside. This can include the wildcard <code>user_ns<code>';		 
$lang['group'] = 'Группа пространств имен, на которые пользователи могут быть перенаправлены (через запятую). Разные пользователи могут быть в разных группах.  Если пользователь состоит в двух группах, то будет перенаправлен в первую указанную.';
$lang['group_options'] = "Пользователь модет быть перенаправлен или на начальную страницу группы или на страницу пользователя в пространстве группы.";
/*
$lang['group_only'] ="Redirect only to group namespaces, i.e. not to user namespaces and pages";
$lang['user_only'] = "Redirect to user namespaces and pages only, i.e. not to group namespaces.";
*/
$lang['only_option'] = '<b><code>group</code></b> перенаправляет только на группу пространства имен и их страницы; ' .
          '<b><code>user</code></b> для пространства имен пользователей и их страниц; ' .
		  '<b><code>default</code></b> to either, with group having precedence.';
