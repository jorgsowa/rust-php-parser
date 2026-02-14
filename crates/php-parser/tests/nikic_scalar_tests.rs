mod common;

nikic_test!(nikic_scalar_constantstring, "scalar/constantString.php");
nikic_test!(nikic_scalar_docstring, "scalar/docString.php");
nikic_test!(nikic_scalar_encapsedstring, "scalar/encapsedString.php");
nikic_test!(nikic_scalar_explicitoctal, "scalar/explicitOctal.php");
nikic_test!(nikic_scalar_float, "scalar/float.php");
nikic_test!(nikic_scalar_invalidoctal_1, "scalar/invalidOctal_1.php");
nikic_test!(nikic_scalar_invalidoctal_2, "scalar/invalidOctal_2.php");
nikic_test!(nikic_scalar_magicconst, "scalar/magicConst.php");
nikic_test!(
    nikic_scalar_numberseparators,
    "scalar/numberSeparators.php",
    errors
);
nikic_test!(nikic_scalar_unicodeescape_1, "scalar/unicodeEscape_1.php");
nikic_test!(nikic_scalar_unicodeescape_2, "scalar/unicodeEscape_2.php");
nikic_test!(nikic_scalar_unicodeescape_3, "scalar/unicodeEscape_3.php");
