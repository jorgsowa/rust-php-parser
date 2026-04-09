===source===
<?php class Foo { public const A = 1; protected const B = 2; private const C = 3; }
===ast===
{
  "stmts": [
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
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": "A",
                  "visibility": "Public",
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 35,
                      "end": 36,
                      "start_line": 1,
                      "start_col": 35
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 38,
                "start_line": 1,
                "start_col": 18
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "B",
                  "visibility": "Protected",
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 58,
                      "end": 59,
                      "start_line": 1,
                      "start_col": 58
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 38,
                "end": 61,
                "start_line": 1,
                "start_col": 38
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "C",
                  "visibility": "Private",
                  "value": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 79,
                      "end": 80,
                      "start_line": 1,
                      "start_col": 79
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 61,
                "end": 82,
                "start_line": 1,
                "start_col": 61
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 83,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 83,
    "start_line": 1,
    "start_col": 0
  }
}
