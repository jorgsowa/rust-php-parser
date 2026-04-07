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
                        "end": 58
                      }
                    }
                  },
                  "span": {
                    "start": 56,
                    "end": 64
                  }
                }
              ]
            },
            "span": {
              "start": 31,
              "end": 65
            }
          }
        ]
      },
      "span": {
        "start": 14,
        "end": 67
      }
    },
    {
      "kind": {
        "Block": []
      },
      "span": {
        "start": 78,
        "end": 80
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 80
  }
}
