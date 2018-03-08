# Setting up the CWA Newsletter website

1. Install the [pods](https://wordpress.org/plugins/pods/) plugin
2. Disable comments
  1. In Settings, Discussion: uncheck all default article boxes
  2. Install plugin: Disable Comments, and select Everywhere.
  3. Delete plugin: Akismet (since we don't use commenting)
3. Setup pods plugin
  1. Disable pods component: _Templates_
  2. Enable pods component: _Migrate: Packages_
  3. Enable pods component: _Translate: Pods Admin_, and activate `nl_NL` in _Translate Pods_.
  4. Import pods config:
      1. _Pods Admin_ > _Migrate Packages_
      2. _Import_
      3. Copy content of `pods_config.json` to clipboard, paste in field and submit.
4. Install this theme using a zip archive
  1. _Appearance_ > _Themes_ > _Add New_ > _Upload Theme_ and install the archive.
  2. Activate the theme.
  3. Install and activate the [github-updater plugin](https://github.com/afragen/github-updater/wiki/Installation)
5. Customize the theme
  1. Logo
  2. Site title: _Catholic Worker Amsterdam_
  3. Tagline: _Nieuwsbrief Jeannette Noëlhuis_
  4. (in the future: don't show tagline and site title)
  5. Color scheme: (todo)
  6. Add primary menu (name it _Header_), adding
    1. Custom link to '/' named _Voorpagina_
    2. Newsletter archives named _Archief_
  7. Add menu _Social Links_, adding custom links for _Facebook_ and _Twitter_
6. Configure permalinks
  1. Install plugin: _Custom Post Type Permalinks_
  2. For `newsletter_article` set permalink to: `/%issue_nr%/%postname%-%post_id%/`
  3. For `newsletter` set permalink to: `/%issue_nr%/`

## Content
1. Create page: _Colofon_
2. Create users, one for each author _and_ an 'unknown' user (without login).
  1. Create user with _Users_ -> _Add New_
  2. Set display name to first name for each
  3. If there is an author that doesn't need to login, you can use a dummy
     email address ike `jantje@noreply.noelhuis.nl`.
3. ...

## To investigate

- Install https://wordpress.org/plugins/redirection/ ?
- Improve security, e.g. plugin _Limit Login Attempts_ or _iThemes Security_.
