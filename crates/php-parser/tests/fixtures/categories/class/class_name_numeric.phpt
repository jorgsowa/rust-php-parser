===description===
`numeric` is NOT a PHP reserved class name (unlike int/float/string/bool).
PHP accepts `class numeric {}`, so the parser must not emit a reserved-name error.
===source===
<?php
class numeric {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "numeric",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
