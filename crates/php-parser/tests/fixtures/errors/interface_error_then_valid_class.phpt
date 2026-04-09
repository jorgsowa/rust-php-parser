===source===
<?php interface Foo { const X = ; } class Baz {}
===errors===
expected expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": "Foo",
          "extends": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": "X",
                  "visibility": null,
                  "value": {
                    "kind": "Error",
                    "span": {
                      "start": 32,
                      "end": 33,
                      "start_line": 1,
                      "start_col": 32
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 34,
                "start_line": 1,
                "start_col": 22
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 35,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Class": {
          "name": "Baz",
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
        "start": 36,
        "end": 48,
        "start_line": 1,
        "start_col": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48,
    "start_line": 1,
    "start_col": 0
  }
}
