## WARNING THIS IS WEBSITE HACKING, DON'T PROCEED IF YOU DON'T KNOW HOW TO LINUX ON A SERVER (IT'S UNIX SYSTEM, I KNOW THIS!)

This is a module for the [podlove](https://wordpress.org/plugins/podlove-podcasting-plugin-for-wordpress/) plugin used on wordpress.  podlove allows it functionality to be enhanced by a directory to a subfolder written in php.

To add this module it expected that the user is comfortable with adding directories and files to a subdirectory of your wordpress install.  

Only these tags have been added at this time:

`<podcast:locked>`

`<podcast:value>`

### **DO NOT DO AN AUTOMATIC UPDATE OF THE PODLOVE PLUGIN IF YOU HAVE THIS MODULE INSTALLED**

If you log in to the server hosting your wordpress, the whole website will sit under one directory

i.e. https://gurucomedy.com is located @ /home/douglaskastle/gurucomedy.com on my server, this is where the wordpress install is.

Make sure that you have the podlove plugin installed and activated (if you are reading this there you probably do)

Go to this directory:

`<your wordpress install>/wp-content/plugins/podlove-publisher/lib/modules`

Download the [release zip](https://github.com/podonaut/namespace_enhance/releases/download/v0.2/namespace_enhance.tar.gz) and unpack it in that directory:

`wget https://github.com/podonaut/namespace_enhance/releases/download/v0.2/namespace_enhance.tar.gz`

`tar -zxvf namespace_enhance.tar.gz`

in the directory you should find a new directory `namespace_enhance`. That should be it here!

Going back to the admin section of your wordpress site. Click on the the modules submenu for podlove in the left hand side bar of the admin menu.

![Menu](https://github.com/podonaut/namespace_enhance/blob/main/images/ns00.png)

The modules page will look now have an extra option

![](https://github.com/podonaut/namespace_enhance/blob/main/images/ns01.png)

Click the radio button on the left and at the bottom of the page there is a big save button, click **SAVE**

Now the same module will have more options, and look like this:

![](https://github.com/podonaut/namespace_enhance/blob/main/images/ns02.png)

**Locked** just enables or disables the podcast:locked tag

And the remaining fields (10 of this writing) are for the value tag.  Suggested is the amount to send per minute of episode play time, defined in bitcoin. This module allows one to add up to 3 value recipients.  You can add the lnd address value, the name of the recipient and the split.

The split between recipients is supposed to add up to 100.  However this plugin isn't smart enough (yet) you'll have to manage that requirement.

The value tag and recipients are only currently settable for the whole podcast there is no feature (yet) to handle the the episode case.

This is what a filled out table looks like:

![](https://github.com/podonaut/namespace_enhance/blob/main/images/ns03.png)

And this is what your RSS feed should look like:

![](https://github.com/podonaut/namespace_enhance/blob/main/images/ns04.png)

**REMEMBER**:
There is a lot of caching going on in the world of websites. Sometimes if you are refreshing a lot, you may not see an updated RSS feed as your wordpress might be caching, podlove might be caching and if you use cloudflare it might also have a cached version. Give it 10 minutes and try again, or maybe another browser.

### **DO NOT DO AN AUTOMATIC UPDATE OF THE PODLOVE PLUGIN IF YOU HAVE THIS MODULE INSTALLED**

Again this is a pre-beta hack.  Best case it blows away your copied module and you have to do this all over again. I had a case where the whole podlove plugin erased itself.  I had to add it again and then this hack, but it is all working again.

### IF ANYTHING GOES WRONG, JUST DELETE THE `namespace_enhance` DIRECTORY FROM THE MODULES.

