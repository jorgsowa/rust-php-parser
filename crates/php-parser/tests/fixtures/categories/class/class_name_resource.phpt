===description===
`resource` is NOT a PHP reserved class name. PHP accepts `class resource {}`,
so the parser must not emit a reserved-name error.
===source===
<?php
class resource {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "resource",
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
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
