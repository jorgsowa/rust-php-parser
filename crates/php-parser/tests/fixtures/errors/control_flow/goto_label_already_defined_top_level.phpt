===source===
<?php
a:
while (true) {
    a:
}
===errors===
Label 'a' already defined
===php_error===
PHP Fatal error:  Label 'a' already defined in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Label": {
          "name": "a",
          "span": {
            "start": 6,
            "end": 7
          }
        }
      },
      "span": {
        "start": 6,
        "end": 8
      }
    },
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 16,
              "end": 20
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Label": {
                      "name": "a",
                      "span": {
                        "start": 28,
                        "end": 29
                      }
                    }
                  },
                  "span": {
                    "start": 28,
                    "end": 30
                  }
                }
              ]
            },
            "span": {
              "start": 22,
              "end": 32
            }
          }
        }
      },
      "span": {
        "start": 9,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
