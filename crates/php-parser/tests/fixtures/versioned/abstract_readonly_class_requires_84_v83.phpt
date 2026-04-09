===config===
parse_version=8.3
===source===
<?php abstract readonly class Foo {}
===errors===
'abstract readonly class' requires PHP 8.4 or higher (targeting PHP 8.3)
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
          "modifiers": {
            "is_abstract": true,
            "is_final": false,
            "is_readonly": true
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 24,
        "end": 36,
        "start_line": 1,
        "start_col": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36,
    "start_line": 1,
    "start_col": 0
  }
}
