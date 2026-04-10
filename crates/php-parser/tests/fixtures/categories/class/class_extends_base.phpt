===source===
<?php class Incomplete extends Base {
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Incomplete",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "Base"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 31,
              "end": 35
            }
          },
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
