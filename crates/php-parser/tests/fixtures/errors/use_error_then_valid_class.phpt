===source===
<?php use ; class Foo {}
===errors===
expected identifier, found ';'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "<error>"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 10,
                  "end": 10,
                  "start_line": 1,
                  "start_col": 10
                }
              },
              "alias": null,
              "span": {
                "start": 10,
                "end": 10,
                "start_line": 1,
                "start_col": 10
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 12,
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
        "start": 12,
        "end": 24,
        "start_line": 1,
        "start_col": 12
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24,
    "start_line": 1,
    "start_col": 0
  }
}
