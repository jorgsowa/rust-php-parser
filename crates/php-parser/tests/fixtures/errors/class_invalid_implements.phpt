===source===
<?php class Test implements { }
===errors===
expected identifier, found '{'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Test",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [
            {
              "parts": [
                "<error>"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 28,
                "end": 28,
                "start_line": 1,
                "start_col": 28
              }
            }
          ],
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
