===source===
<?php class A extends parent {}
===errors===
cannot use 'parent' as class name
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "A",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "parent"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 22,
              "end": 29,
              "start_line": 1,
              "start_col": 22
            }
          },
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 31,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31,
    "start_line": 1,
    "start_col": 0
  }
}
