===source===
<?php
class Test {
    public static function create(): static {}
}
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
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "create",
                  "visibility": "Public",
                  "is_static": true,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "static"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 56,
                          "end": 62,
                          "start_line": 3,
                          "start_col": 37
                        }
                      }
                    },
                    "span": {
                      "start": 56,
                      "end": 62,
                      "start_line": 3,
                      "start_col": 37
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 66,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 67,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67,
    "start_line": 1,
    "start_col": 0
  }
}
