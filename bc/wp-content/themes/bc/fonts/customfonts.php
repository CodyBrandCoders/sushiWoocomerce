<?php header ("Content-type: text/css; charset: UTF-8"); /*This line forces the browser to interpret this PHP file as a CSS File*/ ?>

/* FontAwesome 5 =============================================================================== */
@import url("/bc/wp-content/themes/bc/fonts/_FontAwesome5/css/font-awesome-core.css");
@import url("/bc/wp-content/themes/bc/fonts/_FontAwesome5/css/font-awesome-solid.css"); /* Default FA Library. Usage: "fa" */
@import url("/bc/wp-content/themes/bc/fonts/_FontAwesome5/css/font-awesome-light.css"); /* Light FA Library. Usage: "fal" */
@import url("/bc/wp-content/themes/bc/fonts/_FontAwesome5/css/font-awesome-regular.css"); /* Regular FA Library. Usage: "far" */
@import url("/bc/wp-content/themes/bc/fonts/_FontAwesome5/css/font-awesome-brands.css"); /* Brands FA Library. Usage: "fab" */

<?php /* @import url("/bc/fonts/FontAwesome5/css/font-awesome-svg-framework.css"); DISABLED - REQUIRES JAVASCRIPT. NOT SURE OF BENEFITS. LEARN MORE // SVG FA Library. Usage: "fa" */ ?>

<?php /* DISABLED
// MrEavesXLModern ============================================================================
@font-face {
    font-family: 'MrEavesXLModern';
    src: url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Thin.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Thin.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Thin.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Thin.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Thin.svg') format('svg');
    font-weight: 100;
    font-style: normal;
}
@font-face {
    font-family: 'MrEavesXLModern';
    src: url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-ThinItalic.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-ThinItalic.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-ThinItalic.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-ThinItalic.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-ThinItalic.svg') format('svg');
    font-weight: 100;
    font-style: italic;
}
@font-face {
    font-family: 'MrEavesXLModern';
    src: url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Light.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Light.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Light.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Light.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Light.svg') format('svg');
    font-weight: 200;
    font-style: normal;
}
@font-face {
    font-family: 'MrEavesXLModern';
    src: url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-LightItalic.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-LightItalic.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-LightItalic.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-LightItalic.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-LightItalic.svg') format('svg');
    font-weight: 200;
    font-style: italic;
}
@font-face {
    font-family: 'MrEavesXLModern';
    src: url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Book.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Book.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Book.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Book.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Book.svg') format('svg');
    font-weight: 400;
    font-style: normal;
}
@font-face {
    font-family: 'MrEavesXLModern';
    src: url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-BookItalic.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-BookItalic.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-BookItalic.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-BookItalic.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-BookItalic.svg') format('svg');
    font-weight: 400;
    font-style: italic;
}
@font-face {
    font-family: 'MrEavesXLModern';
    src: url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Reg.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Reg.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Reg.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Reg.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Reg.svg') format('svg');
    font-weight: 500;
    font-style: normal;
}
@font-face {
    font-family: 'MrEavesXLModern';
    src: url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-RegItalic.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-RegItalic.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-RegItalic.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-RegItalic.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-RegItalic.svg') format('svg');
    font-weight: 500;
    font-style: italic;
}
@font-face {
    font-family: 'MrEavesXLModern';
    src: url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Bold.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Bold.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Bold.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Bold.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Bold.svg') format('svg');
    font-weight: 700;
    font-style: normal;
}
@font-face {
    font-family: 'MrEavesXLModern';
    src: url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-BoldItalic.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-BoldItalic.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-BoldItalic.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-BoldItalic.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-BoldItalic.svg') format('svg');
    font-weight: 700;
    font-style: italic;
}
@font-face {
    font-family: 'MrEavesXLModern';
    src: url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Heavy.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Heavy.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Heavy.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Heavy.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Heavy.svg') format('svg');
    font-weight: 800;
    font-style: normal;
}
@font-face {
    font-family: 'MrEavesXLModern';
    src: url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-HeavyItalic.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-HeavyItalic.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-HeavyItalic.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-HeavyItalic.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-HeavyItalic.svg') format('svg');
    font-weight: 800;
    font-style: italic;
}
@font-face {
    font-family: 'MrEavesXLModern';
    src: url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Ultra.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Ultra.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Ultra.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Ultra.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-Ultra.svg') format('svg');
    font-weight: 900;
    font-style: normal;
}
@font-face {
    font-family: 'MrEavesXLModern';
    src: url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-UltraItalic.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-UltraItalic.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-UltraItalic.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-UltraItalic.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/MrEavesXLModern/MrEavesXLModern-UltraItalic.svg') format('svg');
    font-weight: 900;
    font-style: italic;
}
DISABLED */ ?>

<?php /* DISABLED
// MONTSERRAT ============================================================================
@font-face {
    font-family: 'Montserrat';
    src: url('/bc/wp-content/themes/bc/fonts/Montserrat/Montserrat-Hairline.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/Montserrat/Montserrat-Hairline.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/Montserrat/Montserrat-Hairline.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/Montserrat/Montserrat-Hairline.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/Montserrat/Montserrat-Hairline.svg') format('svg');
    font-weight: 100;
    font-style: normal;
}
@font-face {
    font-family: 'Montserrat';
    src: url('/bc/wp-content/themes/bc/fonts/Montserrat/Montserrat-Light.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/Montserrat/Montserrat-Light.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/Montserrat/Montserrat-Light.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/Montserrat/Montserrat-Light.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/Montserrat/Montserrat-Light.svg') format('svg');
    font-weight: 300;
    font-style: normal;
}
@font-face {
    font-family: 'Montserrat';
    src: url('/bc/wp-content/themes/bc/fonts/Montserrat/Montserrat-Regular.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/Montserrat/Montserrat-Regular.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/Montserrat/Montserrat-Regular.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/Montserrat/Montserrat-Regular.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/Montserrat/Montserrat-Regular.svg') format('svg');
    font-weight: 500;
    font-style: normal;
}
@font-face {
    font-family: 'Montserrat';
    src: url('/bc/wp-content/themes/bc/fonts/Montserrat/Montserrat-Bold.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/Montserrat/Montserrat-Bold.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/Montserrat/Montserrat-Bold.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/Montserrat/Montserrat-Bold.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/Montserrat/Montserrat-Bold.svg') format('svg');
    font-weight: 700;
    font-style: normal;
}
@font-face {
    font-family: 'Montserrat';
    src: url('/bc/wp-content/themes/bc/fonts/Montserrat/Montserrat-Black.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/Montserrat/Montserrat-Black.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/Montserrat/Montserrat-Black.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/Montserrat/Montserrat-Black.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/Montserrat/Montserrat-Black.svg') format('svg');
    font-weight: 900;
    font-style: normal;
}
DISABLED */ ?>

<?php /* DISABLED
// Proxima Nova ============================================================================
@font-face {
    font-family: 'Proxima Nova';
    src: url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-100.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-100.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-100.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-100.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-100.svg') format('svg');
    font-weight: 100;
    font-style: normal;
}
@font-face {
    font-family: 'Proxima Nova';
    src: url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-100-Italic.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-100-Italic.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-100-Italic.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-100-Italic.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-100-Italic.svg') format('svg');
    font-weight: 100;
    font-style: italic;
}
@font-face {
    font-family: 'Proxima Nova';
    src: url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-300.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-300.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-300.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-300.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-300.svg') format('svg');
    font-weight: 300;
    font-style: normal;
}
@font-face {
    font-family: 'Proxima Nova';
    src: url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-300-Italic.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-300-Italic.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-300-Italic.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-300-Italic.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-300-Italic.svg') format('svg');
    font-weight: 300;
    font-style: italic;
}
@font-face {
    font-family: 'Proxima Nova';
    src: url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-400.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-400.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-400.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-400.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-400.svg') format('svg');
    font-weight: 400;
    font-style: normal;
}
@font-face {
    font-family: 'Proxima Nova';
    src: url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-400-Italic.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-400-Italic.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-400-Italic.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-400-Italic.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-400-Italic.svg') format('svg');
    font-weight: 400;
    font-style: italic;
}
@font-face {
    font-family: 'Proxima Nova';
    src: url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-600.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-600.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-600.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-600.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-600.svg') format('svg');
    font-weight: 600;
    font-style: normal;
}
@font-face {
    font-family: 'Proxima Nova';
    src: url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-600-Italic.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-600-Italic.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-600-Italic.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-600-Italic.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-600-Italic.svg') format('svg');
    font-weight: 600;
    font-style: italic;
}
@font-face {
    font-family: 'Proxima Nova';
    src: url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-700.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-700.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-700.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-700.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-700.svg') format('svg');
    font-weight: 700;
    font-style: normal;
}
@font-face {
    font-family: 'Proxima Nova';
    src: url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-700-Italic.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-700-Italic.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-700-Italic.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-700-Italic.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-700-Italic.svg') format('svg');
    font-weight: 700;
    font-style: italic;
}
@font-face {
    font-family: 'Proxima Nova';
    src: url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-800.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-800.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-800.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-800.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-800.svg') format('svg');
    font-weight: 800;
    font-style: normal;
}
@font-face {
    font-family: 'Proxima Nova';
    src: url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-800-Italic.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-800-Italic.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-800-Italic.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-800-Italic.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-800-Italic.svg') format('svg');
    font-weight: 800;
    font-style: italic;
}
@font-face {
    font-family: 'Proxima Nova';
    src: url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-900.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-900.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-900.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-900.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-900.svg') format('svg');
    font-weight: 900;
    font-style: normal;
}
@font-face {
    font-family: 'Proxima Nova';
    src: url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-900-Italic.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-900-Italic.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-900-Italic.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-900-Italic.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/ProximaNova/ProximaNova-900-Italic.svg') format('svg');
    font-weight: 900;
    font-style: italic;
}
DISABLED */ ?>

<?php /* DISABLED
// AACHEN ============================================================================
@font-face {
    font-family: 'Aachen';
    src: url('/bc/wp-content/themes/bc/fonts/Aachen/Aachen-Regular.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/Aachen/Aachen-Regular.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/Aachen/Aachen-Regular.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/Aachen/Aachen-Regular.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/Aachen/Aachen-Regular.svg') format('svg');
    font-weight: 400;
    font-style: normal;
}
@font-face {
    font-family: 'Aachen';
    src: url('/bc/wp-content/themes/bc/fonts/Aachen/Aachen-Bold.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/Aachen/Aachen-Bold.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/Aachen/Aachen-Bold.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/Aachen/Aachen-Bold.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/Aachen/Aachen-Bold.svg') format('svg');
    font-weight: 700;
    font-style: normal;
}
DISABLED */ ?>

<?php /* DISABLED
// Vinyl ============================================================================
@font-face {
    font-family: 'Vinyl';
    src: url('/bc/wp-content/themes/bc/fonts/Vinyl/Vinyl-400-Regular.eot?#iefix') format('embedded-opentype'),
         url('/bc/wp-content/themes/bc/fonts/Vinyl/Vinyl-400-Regular.woff2') format('woff2'),
         url('/bc/wp-content/themes/bc/fonts/Vinyl/Vinyl-400-Regular.woff') format('woff'),
         url('/bc/wp-content/themes/bc/fonts/Vinyl/Vinyl-400-Regular.ttf') format('truetype'),
         url('/bc/wp-content/themes/bc/fonts/Vinyl/Vinyl-400-Regular.svg') format('svg');
    font-weight: 400;
    font-style: normal;
}
DISABLED */ ?>