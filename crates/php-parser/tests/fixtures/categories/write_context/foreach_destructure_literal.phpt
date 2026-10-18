===source===
<?php foreach ($a as [$x, 1]) {}
===errors===
Assignments can only happen to writable values
===php_error===
PHP Fatal error:  Assignments can only happen to writable values in Standard input code on line 1
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
              "Array": [
                {
                  "key": null,
                  "value": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 22,
                      "end": 24
                    }
                  },
                  "unpack": false,
                  "span": {
                    "start": 22,
                    "end": 24
                  }
                },
                {
                  "key": null,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 26,
                      "end": 27
                    }
                  },
                  "unpack": false,
                  "span": {
                    "start": 26,
                    "end": 27
                  }
                }
              ]
            },
            "span": {
              "start": 21,
              "end": 28
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 30,
              "end": 32
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
