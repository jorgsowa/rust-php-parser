===source===
<?php foreach ($items as $k => $v) { echo $k; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "items"
            },
            "span": {
              "start": 15,
              "end": 21
            }
          },
          "key": {
            "kind": {
              "Variable": "k"
            },
            "span": {
              "start": 25,
              "end": 27
            }
          },
          "value": {
            "kind": {
              "Variable": "v"
            },
            "span": {
              "start": 31,
              "end": 33
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Variable": "k"
                        },
                        "span": {
                          "start": 42,
                          "end": 44
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 37,
                    "end": 45
                  }
                }
              ]
            },
            "span": {
              "start": 35,
              "end": 47
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
  }
}
