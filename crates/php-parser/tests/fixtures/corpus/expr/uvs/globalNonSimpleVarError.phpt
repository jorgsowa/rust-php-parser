===source===
<?php
global $$foo->bar;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Global": [
          {
            "kind": {
              "PropertyAccess": {
                "object": {
                  "kind": {
                    "VariableVariable": {
                      "kind": {
                        "Variable": "foo"
                      },
                      "span": {
                        "start": 14,
                        "end": 18,
                        "start_line": 2,
                        "start_col": 8
                      }
                    }
                  },
                  "span": {
                    "start": 13,
                    "end": 18,
                    "start_line": 2,
                    "start_col": 7
                  }
                },
                "property": {
                  "kind": {
                    "Identifier": "bar"
                  },
                  "span": {
                    "start": 20,
                    "end": 23,
                    "start_line": 2,
                    "start_col": 14
                  }
                }
              }
            },
            "span": {
              "start": 13,
              "end": 23,
              "start_line": 2,
              "start_col": 7
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 24,
        "start_line": 2,
        "start_col": 0
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
