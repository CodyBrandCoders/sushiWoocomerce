# Docs For BC-Starter

This theme is still undergoing major changes weekly so shortcodes are subject to change. 

This theme uses Bootstrap so you must be familiar with BS syntax in order to understand how to use this theme.

Files inside the theme that have variables to change layout and other styles and should be changed per website are as follows:

- `header.php`

- `footer.php`

- `includes/footer/`

- `includes/footer/`

## Shortcodes

### Buttons
Creates a button that has many customizable options.

    [bc_btn href="http://google.com/" size="md" class="btn-blue" icon_after="fa-arrow-right"]Button Text Goes Here[/bc_btn]

####Options:
`href` : The link to page or URL. Default value `#`.

`size` : Sizes are as follows - `sm ` `md` `lg` `xlg`. Default value `md`.

`block` : Set to `true` to make the button go 100% width. Default value `false`.

`icon_before` : Add an icon before the button text. Use the font awesome class of the icon you would like.

`icon_after` : Add an icon after the button text. Use the font awesome class of the icon you would like.

`class` : Add classes to the button. Comes with the class `.btn`.

`style` : Add inline styles to button.


###Sections
Creates a new `<section>` with the option to add a container and a row. This this how almost <strong>every</strong> section of the webpage should start.

    [section container="true" row="true"]
    <div class="col-xs-12 col-sm-8">
    <p>Hello World</p>
    </div>
    <div class="col-xs-12 col-sm-8">
    <p>Lorem Ipsum Dolor</p>
    </div>
    [/section]

####Options:
`container` : Set to `true` to create a container inside the section. Default value `false`.

`row` : Set to `true` to create a row inside the section. Default value `false`.

`class` : Add classes to the outer containing `<section>`. Comes with a default class of `.section`.

`style` : Add inline styles to the outer containing `<section>`.

###Accordion
Creates and accordion.

    [accordion]
	[accordion_item title="Header One"]
	<p>Hello World.</p>
	[/accordion_item]
	[accordion_item title="Header Two"]
	<p>Goodbye World.</p>
	[/accordion_item]
	[/accordion]

####Options for accordion:

`class` : Add class to the whole accordion.

`style` : Add inline styles to the whole accordion.

####Options for accordion_item:

`title` : The accordion header.

`class` : Add class to the accordion_item.

`style` : Add inline styles to the accordion_item.

###Block Grid
Creates a block grid that can be customized to look great any viewport. You <strong>must</strong> set all the size values as shown in the example.

    [block_grid xxs="2" xs="2" sm="3" md="3" lg="3"]
    [block_grid_item]<img src="http://placehold.it/250x250 />[/block_grid_item]
    [block_grid_item]<img src="http://placehold.it/250x250 />[/block_grid_item]
	[block_grid_item]<img src="http://placehold.it/250x250 />[/block_grid_item]
	[block_grid_item]<img src="http://placehold.it/250x250 />[/block_grid_item]
	[block_grid_item]<img src="http://placehold.it/250x250 />[/block_grid_item]
	[block_grid_item]<img src="http://placehold.it/250x250 />[/block_grid_item]
	[/block_grid]

####Options for block_grid
`xxs` : Number of columns per row 0px-479px. No Default Value.

`xs` : Number of columns per row 480px-767px. No Default Value.

`sm` : Number of columns per row 768px-991px. No Default Value.

`md` : Number of columns per row 992px-1199px. No Default Value.

`lg` : Number of columns per row 1200px+. No Default Value.

`class`  : Add classes to the block_grid.

`style` : Add inline styles to the block_grid.

####Options for block_grid_item
`class`  : Add classes to the block_grid.

`style` : Add inline styles to the block_grid.

###Page Banner
A page banner with the option to set the title and a background image. Not recommended for the home page since this is meant to be used as a smaller banner.

    [page_banner title="Page Banner" background="/path/to/image"]

####Options
`title` : The text that gets output on the page inside the banner.

`background` : Set a background image. Default vaule `http://placehold.it/1200x350`.

`class`  : Add classes to the banner.

`style` : Add inline styles to the banner.

###Address Loop
Use this shortcode when you have registered company address' in the backend on the Options page. The shortcode will output all the address' entered with schema, links, etc.

    [address_loop class="sidebar-schema"]

####Options
`class` : Add a class to <strong>each</strong> individual address schema.

###Mobile Location Conversion
Use this shortcode when you have registered company address' in the backend on the Options page. The shortcode will output the <strong>mobile only</strong> version of our conversion.

    [mobile_location_conversion]

####Options
`class` : Add a class to <strong>each</strong> individual location block.