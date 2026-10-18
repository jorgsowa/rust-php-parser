===source===
<?php [1]::b();
===errors===
Cannot dereference this expression
===php_error===
PHP Fatal error:  Illegal class name in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 7,
                          "end": 8
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 7,
                        "end": 8
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "method": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 11,
                  "end": 12
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 14
          }
        }
      },
      "span": {
        "start": 6,
        "end": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 15
  }
}
