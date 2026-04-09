===source===
<?php class {} function foo(): int { return 1; }
===errors===
expected class name, found '{'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "<error>",
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
        "end": 14,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Int": 1
                  },
                  "span": {
                    "start": 44,
                    "end": 45,
                    "start_line": 1,
                    "start_col": 44
                  }
                }
              },
              "span": {
                "start": 37,
                "end": 47,
                "start_line": 1,
                "start_col": 37
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "int"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 31,
                  "end": 34,
                  "start_line": 1,
                  "start_col": 31
                }
              }
            },
            "span": {
              "start": 31,
              "end": 34,
              "start_line": 1,
              "start_col": 31
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 48,
        "start_line": 1,
        "start_col": 15
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
