# LX Training records #

- This plugin for Moodle 3.1.x ++
- This plugin type is Local

## setup git #

### config git #

```bash
git config --global user.name "Komkrit Aree"
git config --global user.email komkrit@learningx.co
```

### checking #

```bash
git config --global --list
```

### create init git #

```bash
git init
```

### create .gitignore and insert data to home directory ~/.gitignore #

```bash
# Created by https://www.toptal.com/developers/gitignore/api/macos
# Edit at https://www.toptal.com/developers/gitignore?templates=macos

### macOS ###
# General
.DS_Store
.AppleDouble
.LSOverride

# Icon must end with two \r
Icon


# Thumbnails
._*

# Files that might appear in the root of a volume
.DocumentRevisions-V100
.fseventsd
.Spotlight-V100
.TemporaryItems
.Trashes
.VolumeIcon.icns
.com.apple.timemachine.donotpresent

# Directories potentially created on remote AFP share
.AppleDB
.AppleDesktop
Network Trash Folder
Temporary Items
.apdisk

### macOS Patch ###
# iCloud generated files
*.icloud

# End of https://www.toptal.com/developers/gitignore/api/macos
```

## Installing via uploaded ZIP file #

1. Log in to your Moodle site as an admin and go to _Site administration >
   Plugins > Install plugins_.
2. Upload the ZIP file with the plugin code. You should only be prompted to add
   extra details if your plugin type is not automatically detected.
3. Check the plugin validation report and finish the installation.

## Installing manually #

The plugin can be also installed by putting the contents of this directory to

```bash
    {your/moodle/dirroot}/local/{pluginname}
```

Afterwards, log in to your Moodle site as an admin and go to _Site administration >
Notifications_ to complete the installation.

Alternatively, you can run for Moodle 3.1

```bash
    $ php  {your/moodle/dirroot}/admin/cli/upgrade.php
```

IF can not upgrade, you can run for Moodle 3.9+

```bash
    $ php  {your/moodle/dirroot}/admin/cli/uninstall_plugins.php --plugins=local_lxtrainingrecords --run
```

to complete the installation from the command line.

## License #

2024 LearningX <komkrit@learningx.co>
