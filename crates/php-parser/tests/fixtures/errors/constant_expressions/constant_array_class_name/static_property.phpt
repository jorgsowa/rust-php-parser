===source===
<?php
array(1)::$x;
===errors===
Illegal class name
===php_error===
PHP Fatal error:  Illegal class name in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 12,
                            "end": 13
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 13
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 14
                }
              },
              "member": {
                "kind": {
                  "Identifier": "x"
                },
                "span": {
                  "start": 16,
                  "end": 18
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}
