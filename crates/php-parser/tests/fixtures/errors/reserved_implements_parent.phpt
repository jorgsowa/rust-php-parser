===source===
<?php class A implements parent {}
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
          "extends": null,
          "implements": [
            {
              "parts": [
                "parent"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 25,
                "end": 32,
                "start_line": 1,
                "start_col": 25
              }
            }
          ],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 34,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34,
    "start_line": 1,
    "start_col": 0
  }
}
