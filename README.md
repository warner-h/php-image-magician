# php-image-magician


Image manipulation at it's finest.

Forked from [Oberto/php-image-magician](https://github.com/Oberto/php-image-magician)

### Features
* Quick and easy resize - Resize to landscape, portrait, or auto
* Easy crop
* Add text
* Watermarking
* Shadows and reflections
* Transparency support
* Read EXIF metadata
* Borders, Rounded corners, Rotation
* Filters and effects
* All operations (eg. filter, effects) can be stacked
* Image sharpening
* Image type conversion
* BMP support (read/write support)
* PSD reader support (limited)
* **WebP support** (read/write support)
* **PHP 8 compatible**
* **Robust image type detection** - Uses PHP's native image type detection to avoid crashes when file extension doesn't match actual format
* **Fallback image detection** - Gracefully handles environments without fileinfo extension


### Resize &amp; Crop Example

    // Include PHP Image Magician library
    require_once('php_image_magician.php');

    // Open JPG image
    $magicianObj = new imageLib('racecar.jpg');

    // Resize to best fit then crop
    $magicianObj -> resizeImage(100, 200, 'crop');

    // Save resized image as a PNG
    $magicianObj -> saveImage('racecar_small.png');



### Watermark Example

    // Include PHP Image Magician library
    require_once('php_image_magician.php');

    // Open JPG image
    $magicianObj = new imageLib('racecar.jpg');

    // Add watermark to bottom right, 50px from the edges
    $magicianObj -> addWatermark('monkey.png', 'br', 50);

    // Save watermarked image as a PNG
    $magicianObj -> saveImage('racecar_small.png');

### Contributions
If you'd like to contribute features or bug fixes to the project, please be my guest.