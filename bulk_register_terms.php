<?php
/* Code By "אלחנן לבבי" 
*  https://www.facebook.com/profile.php?id=1005501556
*  Register Bulk Taxonomies
*  1. שנה את product_tag לטקסונומיה שלך.
*  2. אחרי שהפונקציה עשתה את העבודה ניתן להסיר אותה.
*  3. אם אתה רוצה לשלוט בתיאור פשוט תוסיף למערכים description.
*/
/* Register terms */
function register_terms() {
$terms = array(
'אמהות',
'אמנות',
'החברה החרדית',
'הסכסוך הישראלי פלסטיני',
'זיקנה',
'זוגיות',
'יחסי הורים – ילדים',
'ציונות',
'שואה',
'צבא',
);
$taxonomy = 'product_tag';
foreach ($terms as $term) {
if (!term_exists( $term, $taxonomy )){
wp_insert_term(
$term,
$taxonomy,
array(
'slug' => $term,
)
);
}
}
}
add_action( 'init', 'register_terms' );

