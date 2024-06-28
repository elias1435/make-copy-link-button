<?php
function add_copy_link_script() {
    ?>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            // Function to add copy buttons dynamically
            function addCopyButtons() {
                jQuery('#wcfm-products a.wcfm-action-icon:first-child').each(function() {
                    if (!jQuery(this).prev('.copy-link-btn').length) { // Prevent adding duplicate buttons
                        var link = jQuery(this).attr('href');
                        jQuery(this).before("<button class='copy-link-btn' data-link='" + link + "' style='margin-right: 10px;'>Copy Link</button>");
                    }
                });
            }

            // Initial call to add buttons
            addCopyButtons();

            // Handle copy button click
            jQuery(document).on('click', '.copy-link-btn', function() {
                var button = jQuery(this);
                var link = button.data('link');
                copyToClipboard(link);
                button.text('Copied'); // Change button text to "Copied"
            });

            function copyToClipboard(text) {
                var textarea = document.createElement('textarea');
                textarea.value = text;
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand('copy');
                document.body.removeChild(textarea);
                alert('Link copied to clipboard: ' + text);
            }

            // Use MutationObserver to detect changes in the DOM
            var observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.addedNodes.length) {
                        addCopyButtons();
                    }
                });
            });

            // Start observing the document body for changes
            observer.observe(document.body, { childList: true, subtree: true });
        });
    </script>
    <?php
}
add_action('wp_footer', 'add_copy_link_script');
