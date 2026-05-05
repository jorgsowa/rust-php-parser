===source===
<?php enum Status { /** Status constant */ #[Attr1] #[Attr2('value')] const ?string VALUE = null; }
===print===
enum Status
{
    /** Status constant */
    #[Attr1]
    #[Attr2('value')]
    const ?string VALUE = null;
}
