# Require any additional compass plugins here.

## Retina compass helpers https://github.com/joelambert/Retina-Compass-Helpers
retina_ext = File.join(File.expand_path(File.dirname(__FILE__)), "sass", "plugins", "retina")
require File.join(retina_ext, "lib", "sass_extensions.rb")
add_import_path File.join(retina_ext, "stylesheets")

## Base64 encode sass plugin http://stackoverflow.com/a/15455580/333625
require File.join(File.expand_path(File.dirname(__FILE__)), "sass", "plugins", "base64encode.rb")

## Susy http://susy.oddbird.net/guides/getting-started/
require "susy"

# Set this to the root of your project when deployed:
http_path = "/"
css_dir = ""
sass_dir = "sass"
images_dir = "img"
javascripts_dir = "js"
fonts_dir = "fonts"

# Development or production?
environment = :development
# environment = :production

# Compress the CSS when in production
output_style = environment == :production ? :compressed : :nested

relative_assets = true

# To disable debugging comments that display the original location of your selectors. Uncomment:
# line_comments = false

preferred_syntax = :sass

enable_sourcemaps = true