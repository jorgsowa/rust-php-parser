===source===
<?php class A { public public const X = 1; }
===errors===
cannot use multiple visibility modifiers
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
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": "X",
                  "visibility": "Public",
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 40,
                      "end": 41,
                      "start_line": 1,
                      "start_col": 40
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 43,
                "start_line": 1,
                "start_col": 16
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 44,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44,
    "start_line": 1,
    "start_col": 0
  }
}
