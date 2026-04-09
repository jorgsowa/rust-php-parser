===source===
<?php abstract final class Foo {}
===errors===
expected 'class', found 'final'
===ast===
{
  "stmts": [
    {
      "kind": "Error",
      "span": {
        "start": 6,
        "end": 15,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Class": {
          "name": "Foo",
          "modifiers": {
            "is_abstract": false,
            "is_final": true,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 21,
        "end": 33,
        "start_line": 1,
        "start_col": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33,
    "start_line": 1,
    "start_col": 0
  }
}
