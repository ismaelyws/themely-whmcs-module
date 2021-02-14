# Themely WHMCS Addon Module

#### Integrate Themely cPanel plugin with WHMCS and automatically install user selected themes and WordPress for new accounts.

## Installation Instructions

Hooks live inside files located within the `/[WHMCS_ROOT]/includes/hooks/` directory. To integrate Themely with WHMCS follow the instructions below.

**Step 1**

- [Download this zip file](https://github.com/ismaelyws/themely-whmcs-hook/archive/master.zip)
- Unzip the file
- Locate the `themely.php` file located inside the folder
- Upload it to the WHMCS hooks directory on your server `/[WHMCS_ROOT]/includes/hooks/`.

**Step 2**

Log into your WHMCS Admin Dashboard and navigate to `Setup > Products & Services > Products & Services`.

**Step 3**

Click the edit icon for the product you wish to configure. Then, click on `Custom Fields`.

**Step 4**
 
Create 2 custom fields for the WordPress Admin Username and Password. Field names **must be exactly** as you see highlighted below (upper and lowercase characters do matter). Display order is of course at your discretion.

`WordPress Admin Username`

`WordPress Admin Password`

Select *Required Field* & *Show on Order Form* for both custom fields.

![Themely WHMCS Custom Fields](assets/whmcs-custom-fields-20191205.PNG)


## Configuration Instructions

You can select which theme will be installed with WordPress by editing line 90 and 91 of the `themely.php` file.

Configuration options are found on line 86-89.

![Themely WHMCS Hook Config](assets/whmcs-hook-config-20191205.PNG)

## Quick Shortcut

You can also add a shortcut to Themely within the Quick Shortcuts panel in WHMCS, [follow these instructions](https://github.com/ismaelyws/Themely-WHMCS-Quick-Shortcut).


## Get Help/Support

To get assistance with the Themely WHMCS hook or to suggest new features; here's how you can reach us:

[Create new issue on Github](https://github.com/ismaelyws/themely-whmcs-hook/issues) (click the green **New Issue** button)

[Chat with us on Discord](https://discord.gg/f3m2Pmp)

Send an email to `hans@themely.com`

Call or text on Whatsapp `+1 (514) 883-0132`

Time Zone: Eastern Standard Time (GMT -4)

Spoken & written languages: English, Français, Español (un poquito)

Office Location: Montreal, Canada