<?php

/**
 * Get font awesome icon 
 * 
 * @param string $icon
 * @param string $prefix
 * @return string
 */
function fa($icon, $prefix = 'fas') 
{
    return "<i class=\"$prefix fa-$icon\" ></i>";
}
