# php-image-magician

Forked from [Oberto/php-image-magician](https://github.com/Oberto/php-image-magician)
A comprehensive image manipulation library for PHP using the GD library.

**Modernized Version 2.0.0** - PHP 7.0+ with graceful degradation for legacy compatibility

---

## Features

### Core Operations
- **Resize Images** - Multiple resize modes (exact, portrait, landscape, auto, crop)
- **Crop Images** - Precise cropping with 9 predefined positions or custom coordinates
- **Rotate Images** - Rotate by degrees or predefined directions (left, right, upside)
- **Image Conversion** - Convert between formats (JPG, PNG, GIF, BMP, WebP, AVIF)

### Filters & Effects
- **Grayscale** - Basic, enhanced, and dramatic grayscale filters
- **Black & White** - High contrast monochrome conversion
- **Sepia** - Vintage sepia tone effects
- **Negative** - Invert image colors
- **Vintage** - Pre-made vintage filter presets
- **Colorize** - Apply color tints to images

### Overlays & Annotations
- **Watermarks** - Add image watermarks with position and opacity control
- **Text** - Add text with custom fonts, colors, sizes, and positioning
- **Caption Boxes** - Add semi-transparent caption boxes with auto-centered text

### Borders & Frames
- **Borders** - Add custom colored borders
- **Border Presets** - Quick drop shadow and bevel effects
- **Rounded Corners** - Create images with rounded corners
- **Drop Shadows** - Add realistic drop shadows with blur control
- **Reflections** - Add reflection effects (inside or outside the image)

### Metadata
- **EXIF Data** - Read camera metadata (make, model, exposure, ISO, etc.)
- **PSD Support** - Read Photoshop files (limited)
- **BMP Support** - Read and write BMP files

### Advanced Features
- **Transparency Preservation** - Maintain PNG/GIF transparency during operations
- **Image Sharpening** - Automatic sharpening for resized JPG images
- **Stackable Operations** - Chain multiple transformations together
- **Batch Processing** - Process multiple images programmatically

---

## Requirements

- **PHP 7.0+** (Gracefully degrades features unavailable in PHP 7.0)
- **GD Library** (Required)
- **EXIF Extension** (Optional - for metadata reading)
- **FreeType** (Optional - for text rendering with custom fonts)

### Version-Specific Features

| PHP Version | Features |
|-------------|----------|
| 7.0+ | All core features |
| 7.1+ | Improved transparency handling |
| 7.4+ | Better type safety |
| 8.0+ | Full compatibility with named arguments |

---
## Installation

### Manual Installation

1. Copy the `imageLib.php` file to your project
2. Include it in your PHP scripts:

```php
require_once('imageLib.php');
```

### Composer (Recommended)

```bash
composer require warner-h/php-image-magician
```
Composer will autoload the class. No namespace is used:

```php
// Class is autoloaded automatically
$magician = new imageLib('racecar.jpg');
```

---
## Quick Start

### Basic Resize

```php
require_once('imageLib.php');

// Open image
$magician = new imageLib('racecar.jpg');

// Resize to 200x200, cropping to fit
$magician->resizeImage(200, 200, 'crop');

// Save the resized image
$magician->saveImage('racecar_small.jpg', 90);
```

### Add Watermark

```php
require_once('imageLib.php');

$magician = new imageLib('racecar.jpg');
$magician->addWatermark('logo.png', 'br', 50); // Bottom right, 50px padding
$magician->saveImage('racecar_watermarked.png');
```

### Apply Filters

```php
$magician = new imageLib('racecar.jpg');
$magician->greyScaleEnhanced();
$magician->addBorder(5, '#000000');
$magician->saveImage('racecar_bw.jpg');
```

---

## Resize & Crop

### Resize Modes

| Mode | Description |
|------|-------------|
| `exact` or `0` | Exact width and height (may distort aspect ratio) |
| `portrait` or `1` | Resize by height, auto-calculate width |
| `landscape` or `2` | Resize by width, auto-calculate height |
| `auto` or `3` | Automatically choose best mode |
| `crop` or `4` | Resize and crop for best fit |

```php
// Exact dimensions
$magician->resizeImage(300, 200, 'exact');

// Resize by height (portrait)
$magician->resizeImage(0, 200, 'portrait');

// Resize by width (landscape)
$magician->resizeImage(300, 0, 'landscape');

// Auto-detect best mode
$magician->resizeImage(300, 200, 'auto');

// Resize and crop
$magician->resizeImage(300, 200, 'crop');
```

### Crop Position Options

When using crop mode, specify the crop position:

```php
// Array format: ['crop', position]
$magician->resizeImage(300, 200, ['crop', 'tl']); // Top-left
$magician->resizeImage(300, 200, ['crop', 'm']);  // Center (default)
$magician->resizeImage(300, 200, ['crop', 'br']); // Bottom-right

// Position codes: tl, t, tr, l, m, r, bl, b, br, auto
```

### Standalone Crop

```php
$magician = new imageLib('racecar.jpg');
$magician->cropImage(200, 150, 'm'); // Crop to 200x150 from center
$magician->saveImage('racecar_cropped.jpg');
```

---

## Filters & Effects

### Grayscale Options

```php
// Basic grayscale
$magician->greyScale();

// Enhanced grayscale (higher contrast)
$magician->greyScaleEnhanced();

// Dramatic grayscale (preset effect)
$magician->greyScaleDramatic();

// Black and white (high contrast)
$magician->blackAndWhite();
```

### Color Filters

```php
// Sepia tone
$magician->sepia();

// Alternative sepia
$magician->sepia2();

// Negative/inverted colors
$magician->negative();

// Vintage preset
$magician->vintage();
```

### Custom Colorize

```php
// Apply custom color tint
$magician->image_colorize(['r' => 180, 'g' => 100, 'b' => 50]);
```

---

## Rotation

```php
// Rotate by degrees (clockwise)
$magician->rotate(90);
$magician->rotate(180);
$magician->rotate(270);

// Rotate by direction
$magician->rotate('left');   // 270 degrees
$magician->rotate('right');  // 90 degrees
$magician->rotate('upside'); // 180 degrees

// With background color
$magician->rotate(45, '#cccccc');
$magician->rotate(90, 'transparent');
```

---

## Watermarks

### Basic Watermark

```php
// Add watermark to bottom-right with 50px padding
$magician->addWatermark('logo.png', 'br', 50);
```

### Position Options

| Position | Description |
|----------|-------------|
| `tl` | Top-left |
| `t` | Top center |
| `tr` | Top-right |
| `l` | Left center |
| `m` | Center (default) |
| `r` | Right center |
| `bl` | Bottom-left |
| `b` | Bottom center |
| `br` | Bottom-right |
| `100x50` | Exact coordinates |

```php
// Custom position
$magician->addWatermark('logo.png', '100x50');

// With opacity (PNG only)
$magician->addWatermark('logo.png', 'br', 50, 50); // 50% opacity
```

---

## Text

### Add Text

```php
// Basic text at default position (20x20)
$magician->addText('Hello World');

// Text with custom position and styling
$magician->addText(
    'Hello World',    // Text
    'br',             // Position (bottom-right)
    10,               // Padding from edge
    '#ffffff',        // Font color (hex)
    16,               // Font size
    0,                // Angle
    'fonts/arial.ttf' // Font file
);
```

### Text to Caption Box

```php
// Add caption box
$magician->addCaptionBox('b', 50, 10, '#000000', 50);

// Add text to caption box
$magician->addTextToCaptionBox('Photo by John Doe');
```

---

## Borders & Frames

### Custom Border

```php
// Add 5px black border
$magician->addBorder(5, [0, 0, 0]);

// Add 3px white border using hex
$magician->addBorder(3, '#ffffff');
```

### Border Presets

```php
// Drop shadow preset
$magician->borderPreset('dropShadow');

// Bevel preset
$magician->borderPreset('bevel');

// Custom thickness
$magician->borderPreset(5);
```

### Rounded Corners

```php
// Round corners with 10px radius
$magician->roundCorners(10);

// Round corners with background color
$magician->roundCorners(10, '#ffffff');

// Round corners with transparency
$magician->roundCorners(10, 'transparent');
```

### Drop Shadow

```php
// Add drop shadow
$magician->addShadow(45, 15); // Angle 45°, blur 15px

// Custom shadow with background
$magician->addShadow(45, 20, '#f0f0f0');
```

### Reflection

```php
// Add reflection below image
$magician->addReflection(50, 30, false);

// Reflection inside image bounds
$magician->addReflection(50, 30, true);

// Custom reflection with background
$magician->addReflection(50, 30, false, '#ffffff', false, 0);
```

---

## EXIF Metadata

```php
// Get EXIF data from JPEG
$exif = $magician->getExif();

// Access specific data
echo $exif['make'];        // Camera manufacturer
echo $exif['model'];       // Camera model
echo $exif['iso'];         // ISO setting
echo $exif['focal length']; // Focal length
echo $exif['exposure time']; // Shutter speed
echo $exif['aperture value']; // Aperture
echo $exif['iso'];         // ISO sensitivity
```

**Note:** EXIF data is only available for JPEG images and requires the EXIF extension.

---

## Output Options

### Save to File

```php
// Save with default quality
$magician->saveImage('output.jpg');

// Save with specific quality (0-100)
$magician->saveImage('output.jpg', 90);

// Save as different format
$magician->saveImage('output.png');
$magician->saveImage('output.gif');
$magician->saveImage('output.bmp');
$magician->saveImage('output.webp');
```

### Display to Browser

```php
// Display as JPEG
$magician->displayImage('jpg', 90);

// Display as PNG
$magician->displayImage('png');

// Display as WebP
$magician->displayImage('webp', 85);
```

### Supported Output Formats

| Format | Extension | Quality Support |
|--------|-----------|-----------------|
| JPEG | `.jpg`, `.jpeg` | Yes (0-100) |
| PNG | `.png` | Yes (0-9, mapped from 0-100) |
| GIF | `.gif` | No |
| BMP | `.bmp` | No |
| WebP | `.webp` | Yes (requires PHP 7.0+) |
| AVIF | `.avif` | Yes (requires PHP 8.0+) |

---

## Configuration

### Transparency Handling

```php
// Disable transparency preservation (for JPG output)
$magician->setTransparency(false);

// Set fill color for transparent areas
$magician->setFillColor('#ffffff'); // White background
$magician->setFillColor([255, 255, 255]); // RGB array
```

### Stretching Behavior

```php
// Disable stretching for smaller images
$magician->setForceStretch(false);

// Enable stretching (default)
$magician->setForceStretch(true);
```

### Crop from Top

```php
// Set default crop position from top percentage
$magician->setCropFromTop(10); // Crop from top 10%
```

### Reset for Multiple Outputs

```php
// Process same source image multiple times
$magician = new imageLib('source.jpg');

// First output: resized
$magician->resizeImage(200, 200, 'crop');
$magician->saveImage('thumb.jpg');

// Reset to original
$magician->reset();

// Second output: filtered
$magician->resizeImage(400, 300, 'auto');
$magician->sepia();
$magician->saveImage('filtered.jpg');
```

---

## Chaining Operations

Operations can be chained together:

```php
$magician = new imageLib('racecar.jpg');
$magician
    ->resizeImage(300, 200, 'crop')
    ->greyScaleEnhanced()
    ->addBorder(3, '#000')
    ->addWatermark('logo.png', 'br', 10)
    ->saveImage('processed.jpg');
```

---

## Getters & Diagnostics

### Image Dimensions

```php
// Current dimensions (after processing)
$width = $magician->getWidth();
$height = $magician->getHeight();

// Original dimensions
$origWidth = $magician->getOriginalWidth();
$origHeight = $magician->getOriginalHeight();

// File name
$fileName = $magician->getFileName();
```

### Error Handling

```php
// Get error array
$errors = $magician->getErrors();

// Check if file is valid image
$isImage = $magician->testIsImage();

// Check GD library
$gdInstalled = $magician->testGDInstalled();

// Check EXIF extension
$exifInstalled = $magician->testEXIFInstalled();
```

---

## Error Handling

### Legacy Mode (Default)

Errors cause script termination with `die()` message:

```php
// Enable debug mode (default)
$magician = new imageLib('image.jpg');
// Errors will display and stop execution

// Disable debug mode
$magician->debug = false;
// Errors will die silently
```
## Examples

See the `examples/` directory for complete working examples:

| Example | Description |
|---------|-------------|
| `1.1_resize_basic.php` | Basic resize operations |
| `1.2_resize_advanced.php` | Advanced resize with crop |
| `2.x_*_grayscale*.php` | Various grayscale filters |
| `3.x_*_rotate*.php` | Image rotation |
| `4.x_*_watermark*.php` | Watermarking |
| `5.x_*_text*.php` | Text overlay |
| `6.x_*_border*.php` | Borders and presets |
| `8.1_stackable_transformations.php` | Chaining operations |
| `9.x_*_reflection*.php` | Reflection effects |
| `10.1_round_corners.php` | Rounded corners |
| `11.1_shadow.php` | Drop shadows |
| `12.1_caption_box.php` | Caption boxes |
| `15.1_chaining_(reset).php` | Multiple outputs from one source |

---
## Contributing

Contributions are welcome! Please:

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test with all example files
5. Submit a pull request

### Testing

Run all example files to verify functionality:

```bash
cd examples
for file in *.php; do php "$file"; done
```

---

## License

This work is licensed under the Creative Commons Attribution 3.0 Unported License.

To view a copy of this license, visit http://creativecommons.org/licenses/by/3.0/ or send a letter to Creative Commons, 444 Castro Street, Suite 900, Mountain View, California, 94041, USA.

---

## Credits

- **Original Author**: Jarrod Oberto
- **Original Project**: [php-image-magician](https://github.com/Oberto/php-image-magician)
- **PSD Reader**: Tim de Koning (PhpPsdReader)
- **BMP Support**: James Heinrich (phpThumb)
- **Filters**: Marc Hibbins

---

## Support

For issues, questions, or contributions, please open an issue on GitHub.