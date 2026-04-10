===source===
<?php foreach ($a as $b):
    echo $b;
} endforeach;
===errors===
expected expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 15,
              "end": 17
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 21,
              "end": 23
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
                          "Variable": "b"
                        },
                        "span": {
                          "start": 35,
                          "end": 37
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 30,
                    "end": 38
                  }
                },
                {
                  "kind": "Error",
                  "span": {
                    "start": 39,
                    "end": 38
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 52
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 52
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52
  }
}
