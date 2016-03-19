# DesignJam Admin Guide

## TL;DR
 - Home page content sections are “blocks”, except for Workshops
 - Workshops section on home page is a “View”
 - Workshops items are content items of the “Event” type
 - About, Terms and Partners are “Pages”
 - Toolbox entries and People are "Taxonomies"
 - Menus are menus
 - A bunch of stuff is hard-coded into the templates, for now.

## The Home Page
The home page content are “Blocks”  assigned to the “Highlighted” region. The intro text for each block can be edited by going to Structure > Block > Configure. Each block has a custom template file, so anything other than the intro text can only be changed by modifying that file. This was the fastest way to get the job done, but I’m hoping to, down the road, make all of the content accessible from the admin pages.

The "Workshops" section is a view block, so the contents of this block are modified through the view, not the block.


## Workshops
The workshops home page section and listing page are *View Displays*. The intro text for these section can be configured in the Events View: Structure > Views > Events (Edit) > Header / Global:Text Area. This view loads a list of “events”, which are a custom content type. There are also custom templates for the display of these items.

To add an event, create a new *Event* content item (“Add Content > Event”). Some relevant fields:

 - Summary: This will appear in the listings on the home page and workshops listing page.
 - EventbriteID: Used to generate *Register* link. This is the number at the end of the Eventbrite URL.
 - Event Type: Workshop or BigTent. Will control how the event looks and where it appears.
 - People: Will generate *Facilitators* section and allow cross-linking.
 - Publishing Options: Events that are not *published* won't appear. Only events *Promoted to front page* appear on the home page.

### Home page
This section of the home page is a *View Block Display*. Filters in the block setting determine which events are displayed, how many are displayed, and in what order. To add an event here, set the *Event Type* to workshop and under publishing options, set *Promoted to front page*

### Workshops listing page (/workshops)
This page is a *View Page Display*. Settings are similar to the Block on the home page, but list all events, not just promoted events.


## Footer
The contact menu in the footer is hard-coded for now. The middle column is a menu block and the right column is a content block. The main site nav is also a menu block. Pages can be added to these menus arbitrarily by updating the menu (Structure > Menus).


## Toolbox
Toolbox “Themes” and “Topics” are terms in the “Toolbox Categories” taxonomy. They can be added / edited under Structure > Taxonomy > Toolbox Categories. A term with no parent will appear on the Toolbox homepage, otherwise it appear as a Topic on the Theme page. The descriptions on these terms appear on the relevant pages.

You can add content to the “Topics” by creating “Media Items”, which are a custom content type. Go to Content > Add Content > Media Item. You can upload a file or copy a link to a video or other external resource. If you’re uploading a file, use the Attachment field and leave URL blank. If you’re embedding something like a Vimeo video, copy and past the video link into the URL field. It will be smart about embedding this content, but so far only supports Vimeo videos. Anything other URLs will be treated like external links and will just open that url in a new tab.


## Pages
About, Partners and Terms of Service are plain ‘ole “Basic Pages”, and can be found in the content section.  



## People
You can add “people” as taxonomy terms, and attach them to media items in the Creator field. People can have bios, portraits, etc. Don’t use the top-level “people” link, that’s for adding admin users to the site.
