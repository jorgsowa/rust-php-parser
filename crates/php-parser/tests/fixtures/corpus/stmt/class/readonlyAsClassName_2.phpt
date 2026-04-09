===source===
<?php
class ReadOnly {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "ReadOnly",
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
        "end": 23,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23,
    "start_line": 1,
    "start_col": 0
  }
}
