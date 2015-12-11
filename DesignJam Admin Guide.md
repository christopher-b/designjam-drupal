# DesignJam Admin Guide
## TL;DR
 - Home page content sections are “blocks”, except for Workshops
 - Workshops section on home page is a “View”
 - Workshops items are content items of the “Event” type
 - About, Terms and Partners are “Pages”
 - Menus are menus
 - A bunch of stuff is hard-coded into the templates, for now.

## The Home Page
The home page content are “Blocks”, except for the workshops section. They are assigned to the “Highlighted” region. The intro text for each block can be edited by going to Structure > Block > Configure. Each block has a custom template file, so anything other than the intro text can only be changed by modifying that file. This was the fastest way to get the job done, but I’m hoping to, down the road, make all of the content accessible from the admin pages.

## Events
The Workshops Events section on the home page works differently, it’s a “View” (there’s also a block for it, but there are no configurable options in the block screen). The intro text for that section is in Structure > Views > Events / Edit > Header / Global:Text Area. This view loads a list of “events”, which are a custom content type. There are also custom templates for the display of these items. Creating a new event (“Add Content > Event”) will add an item to that list. As an aside - if we end up having events that are not workshops events, we may need to add a workshops?” flag to the event content type to control what goes where. When creating an event, there is a field for the Eventbrite Id number - this is the number at the end of the Eventbrite URL. It’s used to generate the link to the event, and eventually to do the API calls.

## Footer
The contact menu in the footer is hard-coded for now. The middle column is a menu block and the right column is a content block. The main site nav is also a menu block. Pages can be added to these menus arbitrarily by updating the menu (Structure > Menus).

## Pages
About, Partners and Terms of Service are plain ‘ole “Basic Pages”, and can be found in the content section.  

# Sponsors
~~The sponsor images are one big image for now,~~ living in a block in the “Page bottom” region.
