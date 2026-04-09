===source===
<?php

// foo
{
    // bar
    {
        // baz
        $a;
    }
}

// empty
{}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Block": [
          {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 56,
                        "end": 58,
                        "start_line": 8,
                        "start_col": 8
                      }
                    }
                  },
                  "span": {
                    "start": 56,
                    "end": 64,
                    "start_line": 8,
                    "start_col": 8
                  }
                }
              ]
            },
            "span": {
              "start": 31,
              "end": 65,
              "start_line": 6,
              "start_col": 4
            }
          }
        ]
      },
      "span": {
        "start": 14,
        "end": 67,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Block": []
      },
      "span": {
        "start": 78,
        "end": 80,
        "start_line": 13,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 80,
    "start_line": 1,
    "start_col": 0
  }
}
