===source===
<?php
foreach ($items $item) {
    echo $item;
}
===errors===
expected 'as', found variable
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
          "key": null,
          "value": {
            "kind": {
              "Variable": "item"
            },
            "span": {
              "start": 22,
              "end": 27
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
                          "Variable": "item"
                        },
                        "span": {
                          "start": 40,
                          "end": 45
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 35,
                    "end": 46
                  }
                }
              ]
            },
            "span": {
              "start": 29,
              "end": 48
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected variable "$item" in Standard input code on line 2
