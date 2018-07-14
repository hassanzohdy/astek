# Astek

Simple application to write html pages in organized way.

# Requirements
- PHP >= 7.0

# Installation
- Download the project.
- In the project directory, run in the command line `composer install`.
- All done.

# Usage
Edit `config.json` file to adjust your needs

```json
{
    "title": "Hello, World!",
    "favicon": "images/favicon.png",
    "styles": [
        "css/bootstrap.min.css",
        "css/font-awesome.min.css"
    ],
    "js": [
        "js/jquery.min.js"
    ],
    "common": {
        "beforeContent": [
            "header"
        ],
        "afterContent": [
            "footer"
        ]
    },
    "pages": {
        "default": "home",
        "list": [
            "home",
            {
                "name": "category",
                "title": "My Category Page",
                "favicon": "images/favicon.png",
                "styles": [
                    "extra-style.css"
                ],
                "js": [
                    "js/extra-js.js"
                ],
                "common": {
                    "beforeContent": [
                        "special-products"
                    ],
                    "afterContent": [
                        "banner"
                    ]
                }
            },
            "page-2"
        ]
    }
}
```

The file is **self-explained** but here is some details that you may want more explanation,

| Key                    | Description                                                                       |
| ---------------------- | --------------------------------------------------------------------------------- |
| `title`              | Page Title for all pages                                                                        |
| `favicon`              | Path to favicon: **Relative to `style` path**.                                                                        |
| `styles`              | List of all stylesheets that will be used in the application: **Relative to `style` path**.                                                                        |
| `js`              | List of all javascript files that will be used in the application: **Relative to `style` path**.                                                                        |
| `common`               | This list will be attached automatically in every page                            |
| `common.beforeContent` | List all of the common sections that will be included **before** the main content |
| `common.afterContent`  | List all of the common sections that will be included **after** the main content  |
| `pages`                | List all of the app pages                                                         |
| `pages.default`        | Default page to be loaded if there is no query string in the url                  |
| `pages.list`        | A list of all of the application pages, each page could be a string to represent the page name or an object to override the default config values. 
    **Available options**: 
    `name`: Page name.
    `title` Page title.
    `favicon`: favicon for that page.
    `styles`: Add more stylesheet files to the default `styles` section
    `js`: Add more javascript files to the default `js` section.
    `common`: Add more common sections.
 |

# Launching the application
Once you type in the browser the path to your application `localhost/asek`, it will load the default page that you set in the `config.json` file.

If you want to start developing another page, just append the query string `?page=` with your page name.

For example: `localhost/astek?page=contact-us` to start developing contact us page.

## Common folder
Add all of your common in that folder like header, footer, sidebar..etc.

> Any common file **MUST BE** a php file, like `header.php`, `footer.php` ..etc.

## Pages folder
All of applications pages **body only** must be included here 

> Any page file **MUST BE** a php file, like `home.php`, `contact-us.php` ..etc.

# Styling

By default, the application uses `scss` for rendering your code **Not external files**.

All of `sass` files **MUST** be included in `style/scss` directory.

`style/scss/app.scss` is the entry point to your styling code.

By default, there are many **helpers** attached to help you write code faster.

- [Compass](http://compass-style.org/) Great library to prefix your css3 codes
- [Response](https://github.com/hassanzohdy/sass-helpers) Simple yet powerful mixin to write your responsive code in elegant way.
- Margins: list of classes for margins to adjust it so easily
- Paddings: list of classes for paddings to adjust it so easily
- Colors: Put all of your main colors there so you can it in the entire application with some nice mixins to directly include it in your code.
- Standard: this is just my styling standard code that i use in my applications, something like `resetting` some properties.

## Styling common sections and pages

### Common sections
All of the common sections will have a files to be included in every page and will be listed in `style/scss/common/`.
> If the `common-file.scss` file doesn't exist, it will be created automatically.

### Pages
Every page will have its own styling file located in `style/scss/pages/` based on its name.

> If the `page-name-file.scss` file doesn't exist, it will be created automatically.


### Styling flow
The order of called files in the `sass` sections as follows:
- app.scss
- Any `import` file in the `app.scss`
- All `common` sass files
- Current page `scss` file 

### Styling production
Ad the end of every request, a file with page name will be created in the `css` folder based on current page as it will be generated automatically from the `scss` code.

For example if we're developing `product` page, then its corresponding css file will be `style/css/product.css`.

> Please note that the page style file will include only `sass` code not the other stylesheets in the `config.json`

# Layout
All common sections + current page are contained in the `layout.php` file.

Feel free if you want to add or modify it.

> Every page will add an id to the `body` tag, for example if we are in the home page then the `body` tag id will be `home-page` for its name so it can be easy to write your code based on current page only.

# Attached plugins

- Bootstrap 4.1.1
- Font awesome 5.1 
- jquery 3.3.1

> You can add font awesome icon directly using `fa($icon, $prefix = 'fas')`.
> You may also add additional classes in the `$icon` parameter, for example fa('home colored', 'fas') will output `<i class="fas fa-home colored"></i>`.

# Production

Every time you request a page, the compiled file will appear in the `production` directory with its name, for example: `production/home.html` when you request the home page.